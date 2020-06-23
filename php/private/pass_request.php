<?php
    require_once "../core/decryption.php";
    // CHECK THAT USER EXISTS FUNCTION
    function user_exists($email, $conn)
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
                $result = array(false, "Error occured, try later!");
                return $result;
            }
            $list = $query->fetchAll();
            $user_found = false;
            foreach($list as $user)
            {
                if(decrypt_email($user['user_email'], $ckey1) === $email)
                {
                    $user_found = true;
                    $user_id = $user['user_id'];
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
            return $result;
        }
    }
    // CHANGE KEY IF ALREADY EXIST
    function validate_key($rkey, $conn)
    {
        $query = $conn->prepare("SELECT * FROM forgot_password WHERE key_series = :key_series");
        $query->bindParam(":key_series", $rkey);
        try
        {
            $check->execute();
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
    function create_request($user_id, $conn, $key)
    {
        $query = $conn->prepare("INSERT INTO forgot_password VALUES (NULL, :uid, :rkey, :expire_time, 0);");
        $query->bindParam(":uid", $user_id);
        $query->bindParam(":rkey", $rkey);
        $now = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime(date("Y-m-d H:i:s"))));
        $query->bindParam(":expire_time", $now);
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
            $_SESSION['result'] = "Error occured!";
            return false;
        }
        else
        {
            $subject = "Recovering password - Haiku Connects Us";

            $massage = '<a href="http://localhost/test/recover_pass.php?rk=' . $key . '">Recover password!</a>';

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
    require_once "../core/connect.php";
    require_once "../functions/random.php";
    if(!isset($_POST) || empty($_POST['email']))
    {
        $result = array(false, "You need to enter email!");
    }
    else
    {
        $email = $_POST['email'];
        $user_exist = user_exists($email, $conn);
        if($user_exist[0] == true)
        {
            do
            {
                $rkey = random_series(20);
                $rkey_unique = validate_rkey($rkey, $conn);
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
?>