<?php
    require_once "../core/decryption.php";
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
            if($email['user_email'] == $new_email)
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
        $query = $conn->prepare("INSERT INTO cnange_email VALUES (NULL, :uid, :rkey, :expire_time, 0, :new_email);");
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

            $massage = '<a href="http://localhost/test/recover_pass.php?rk=' . $key . '">Activate new password!</a>';

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
            require_once "../classes/users.php";
            require_once "../core/connect.php";
            require_once "../functions/random.php";
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
                    $db_ok = create_request($user_exist[1], $new_email, $conn, $change_key);
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