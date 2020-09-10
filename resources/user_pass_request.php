<?php
    require_once "../config/config.php";
    require_once "../utils/logs.php";
    require_once "../utils/decryption.php";
    require_once "../utils/random.php";
    require_once "db_connect.php";
    // CHECK THAT USER EXISTS FUNCTION
    function user_exists($email, $conn, $ckey1)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $result = array(false, "Entered email is incorrect!");
        }
        else
        {
            $query = $conn->prepare("SELECT * FROM users");
            try
            {
                $query->execute();
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot check that user exist: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                $result = array(false, "Error occured, try later!");
                return $result;
            }
            $list = $query->fetchAll();
            $user_found = false;
            foreach($list as $user)
            {
                if(decrypt_email($user['email'], CKEY1) === $email)
                {
                    $user_found = true;
                    $user_id = $user['id'];
                    break;
                }
            }
            if($user_found == true)
            {
                $result = array(true, $user_id);
            }
            else
            {
                $result = array(false, "There's no account with this email address!");
            }
            unset($conn);
        }
        return $result;
    }
    // CHANGE KEY IF ALREADY EXIST
    function validate_key($rkey, $conn)
    {
        $query = $conn->prepare("SELECT * FROM pass_change_requests WHERE key_series = :key_series");
        $query->bindParam(":key_series", $rkey);
        try
        {
            $query->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot validate key: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            return 2;
        }
        if($query->rowCount() != 0)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
    // CREATE NEW REQUEST
    function create_request($user_id, $conn, $key)
    {
        $query = $conn->prepare("INSERT INTO pass_change_requests VALUES (NULL, :uid, :rkey, :expire_time, 0)");
        $query->bindParam(":uid", $user_id);
        $query->bindParam(":rkey", $key);
        $now = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime(date("Y-m-d H:i:s"))));
        $query->bindParam(":expire_time", $now);
        try
        {
            $query->execute();
            $result = array(true, "");
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot create request: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            $result = array(false, "Error occured, try later!");
            echo $e;
        }
        return $result;
    }
    // SEND EMAIL WITH RECOVER LINK
    function send_mail($email, $key)
    {
        if(empty($email) || empty($key))
        {
            return false;
        }
        else
        {
            $subject = "Recovering password - Haiku Connects Us";

            $message = '
            <!DOCTYPE html>
            <html>
            <head>
            </head>
            <body bgcolor="#f9f8f4" style="font-family: Verdana; color: #000000;">
                <div style="width: 70%; margin-left: auto; margin-right: auto;">
                    <header>
                        <div style="width: 12rem; margin-left: auto; margin-right: auto;"><h1 style="letter-spacing: 0.2rem; font-size: 2rem; font-weight: 300; color: #353330; text-align: center;">Haiku Connects Us</h1></div>
                        <div style="width: 100%; height: 3rem; border-bottom: 2px solid #353330; background-color: #dd3050;"><h2 style="color: #f9f8f4; font-size: 1.5rem; line-height: 3rem; margin-top: 1rem; margin-left: 1rem; font-weight: 200; letter-spacing: 0.1rem;">Recover password</h2></div>
                    </header>
                    <main>
                        <div style="width: 100%; min-height: 5rem;">
                            <p style="margin: 0 2rem; font-size: 1rem;">Hi,</p>
                            <p style="margin: 0 2rem; font-size: 1rem;">Someone started recovering password process on your profile on <a href="' . SITE_URL . '" target="_blank" style="color: #dd3050; font-weight: bold; text-decoration: none;">Haiku Connects Us</a>.</p>
                            <p style="margin: 0 2rem; font-size: 1rem;">If this person is you and you want continue recover your password - click this button and follow the instructions.</p>
                            <div style="text-align: center;">
                                <a href="' . SITE_URL . '/public/change_pass.php?rk=' . $key . '" target="_blank"><button style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 2rem; margin-bottom: 2rem; width: 10rem; height: 3rem; font-size: 1rem; text-align: center; border-radius: 0.5rem; font-weight: bold; background-color: #353330; color: #fff; border: 2px solid #dd3050; outline: none; cursor: pointer;">Continue recover</button></a>
                            </div>
                        </div>
                        <div style="width: 100%; min-height: 5rem;">
                            <p style="font-size: 1rem; margin: 0 2rem; color: #353330;">If not you started this process, you can ignore this message, but for your confidence check the security of your account.</p><br />
                            <p style="font-size: 1rem; margin: 0 2rem; color: #353330;">For more info or to ask us, write on this e-mail:</p>
                            <p style="font-size: 1rem; margin: 0 2rem; color: #353330; font-weight: bold;"><a href="mailto:#" style="text-decoration: none; color: #dd3050;">XYZ@xyz.xyz</a></p>
                        </div>
                    </main>
                    <footer>
                        <div style="width: 100%; min-height: 5rem; border-top: 1px solid #353330; background-color: #eeeeee;">
                            <p style="font-size: 0.75rem; color: #353330; text-align: center;">This message is automatically generated. Please, do not answer on this e-mail.</p>
                            <p style="font-size: 0.75rem; color: #353330; text-align: center; font-weight: bold;">Website admin <a href="' . SITE_URL . '" target="_blank" style="text-decoration: none; color: #dd3050;">HaikuConnetsUs</a></p>
                        </div>
                    </footer>
                </div>
            </body>
            </html>
            ';


            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: <noreply@gmail.com>' . "\r\n";
            $header .= 'Cc: noreply@example.com' . "\r\n";

            try
            {
                mail($email, $subject, $message, $header);
                return true;
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot send mail: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                return false;
            }
        }
    }
    // MAIN
    if(!isset($_POST) || empty($_POST['email']))
    {
        $result = array(false, "You need to enter email!");
    }
    else
    {
        $email = $_POST['email'];
        $user_exist = user_exists($email, $conn, CKEY1);
        if($user_exist[0] == true)
        {
            do
            {
                $rkey = random_series(20);
                $rkey_unique = validate_key($rkey, $conn);
            }while($rkey_unique == 0);
            if($rkey_unique == 2)
            {
                $result = array(false, "Error occured, try later!");
            }
            else
            {
                $db_ok = create_request($user_exist[1], $conn, $rkey);
                if($db_ok[0] == true)
                {   
                    if(send_mail($email, $rkey) == true)
                    {
                        $result = array(true, "The recovery link has been sent, you have 15 min to change your password.");
                    }
                    else
                    {
                        $result = array(false, "Error occured, try later!");
                    }
                }
                else
                {
                    $result = array(false, $db_ok[1]);
                }
            }
        }
        else
        {
            $result = array(false, $user_exist[1]);
        }
    }
    echo json_encode($result);
?>