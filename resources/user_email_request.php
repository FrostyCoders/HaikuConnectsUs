<?php
    require_once "../config/config.php";
    require_once "../utils/decryption.php";
    require_once "../utils/encryption.php";
    require_once "../utils/random.php";
    require_once "../classes/users.php";
    require_once "db_connect.php";
    // CHECK NEW EMAIL
    function email_repeated($new_email, $conn)
    {
        $query = $conn->prepare("SELECT user_email FROM users");
        try
        {
            $query->execute();
        }
        catch(Exception $e)
        {   
            return "error";
        }
        $list = $query->fetchAll();
        foreach($list as $email)
        {
            if(decrypt_email($email['user_email'], CKEY1) == $new_email)
            {
                return true;
            }
        }
        return false;
    }
    // CHANGE KEY IF ALREADY EXIST
    function validate_key($change_key, $conn)
    {
        $query = $conn->prepare("SELECT * FROM change_email WHERE key_series = :key_series");
        $query->bindParam(":key_series", $change_key);
        try
        {
            $query->execute();
        }
        catch(Exception $e)
        {
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
    function create_request($user_id, $new_email, $conn, $key)
    {
        $query = $conn->prepare("INSERT INTO change_email_requests VALUES (NULL, :uid, :rkey, :expire_time, 0, :new_email);");
        $query->bindParam(":uid", $user_id);
        $query->bindParam(":rkey", $rkey);
        $now = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime(date("Y-m-d H:i:s"))));
        $query->bindParam(":expire_time", $now);
        $query->bindParam(":new_email", $new_email);
        try
        {
            $query->execute();
            $result = array(true, "");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error occured, try later!");
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
            $subject = "Activate new e-mail - Haiku Connects Us";

            $message = '
            <!DOCTYPE html>
            <html>
            <head>
            </head>
            <body bgcolor="#f9f8f4" style="font-family: Verdana; color: #000000;">
                <div style="width: 70%; margin-left: auto; margin-right: auto;">
                    <header>
                        <div style="width: 12rem; margin-left: auto; margin-right: auto;"><h1 style="letter-spacing: 0.2rem; font-size: 2rem; font-weight: 300; color: #353330; text-align: center;">Haiku Connects Us</h1></div>
                        <div style="width: 100%; height: 3rem; border-bottom: 2px solid #353330; background-color: #dd3050;"><h2 style="color: #f9f8f4; font-size: 1.5rem; line-height: 3rem; margin-top: 1rem; margin-left: 1rem; font-weight: 200; letter-spacing: 0.1rem;">Activate new e-mail</h2></div>
                    </header>
                    <main>
                        <div style="width: 100%; min-height: 5rem;">
                            <p style="margin-left: 2rem; font-size: 1rem;">Hi,</p>
                            <p style="margin-left: 2rem; font-size: 1rem;">Someone started changing e-mail process on your profile on <a href="' . SITE_URL . '" target="_blank" style="color: #dd3050; font-weight: bold; text-decoration: none;">Haiku Connects Us</a>.</p>
                            <p style="margin-left: 2rem; font-size: 1rem;">If this person is you and you want to continue this process - click this button and follow the instructions.</p>
                            <div style="text-align: center;">
                                <a href="' . SITE_URL . '/php/public/change_email.php?ck=' . $key . '" target="_blank"><button style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 2rem; margin-bottom: 2rem; width: 10rem; height: 3rem; font-size: 1rem; text-align: center; border-radius: 0.5rem; font-weight: bold; background-color: #353330; color: #fff; border: 2px solid #dd3050; outline: none; cursor: pointer;">Continue recover</button></a>
                            </div>
                        </div>
                        <div style="width: 100%; min-height: 5rem;">
                            <p style="font-size: 1rem; margin-left: 2rem; color: #353330;">If not you started this process, you can ignore this message, but for your confidence check the security of your account.</p><br />
                            <p style="font-size: 1rem; margin-left: 2rem; color: #353330;">For more info or to ask us, write on this e-mail:</p>
                            <p style="font-size: 1rem; margin-left: 2rem; color: #353330; font-weight: bold;"><a href="mailto:#" style="text-decoration: none; color: #dd3050;">XYZ@xyz.xyz</a></p>
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

            $header = "From: noreply@gmail.com \nContent-Type:".
            ' text/html;charset="UTF-8"'.
            "\nContent-Transfer-Encoding: 8bit";
            if(mail($email, $subject, $massage, $header))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    // MAIN
    if(!isset($_POST['new_email']))
    {
        $result = array(false, "You must enter email address!");
    }
    else
    {
        $new_email = $_POST['new_email'];
        if(!filter_var($new_email, FILTER_VALIDATE_EMAIL))
        {
            $result = array(false, "You entered incorrect email address!");
        }
        else
        {
            session_start();
            $user_id = $_SESSION['logged_user']->showId();
            $email = $_SESSION['logged_user']->showEmail();
            if(email_repeated($new_email, $conn) == true)
            {
                $result = array(false, "Your new email address already belongs to other user!");
            }
            elseif(email_repeated($new_email, $conn) == "error")
            {
                $result = array(false, "Error occured, try later!");
            }
            else
            {
                do
                {
                    $change_key = random_series(20);
                    $change_key_unique = validate_key($change_key, $conn);
                }while($change_key_unique == 0);
                if($change_key_unique == 2)
                {
                    $result = array(false, "Error occured, try later!");
                }
                else
                {
                    $db_ok = create_request($user_exist[1], encrypt_email($new_email, CKEY2), $conn, $change_key);
                    if($db_ok[0] == true)
                    {
                        if(send_mail($email, $change_key) == true)
                        {
                            $result = array(true, "The activation link has been sent, you have 15 min accept new email on your old previous email account.");
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
        }
    }
    echo json_encode($result);
?>