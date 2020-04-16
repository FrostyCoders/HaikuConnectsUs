<?php
    session_start();
    require_once "connect.php";
    if(!isset($_POST) || empty($_POST['email']))
    {
        header("Location: test_forgot.php");
        exit();
    }
    // GENERARE RANDOM SERIES
    function random_series($chars)
    {
        $chars;
        $final_series = "";
        $series = array();
        for($i=0; $i<$chars; $i++)
        {
            do
            {
                $series[$i] = rand(48, 122);
            }while(($series[$i] > 57) && ($series[$i] < 65) || ($series[$i] > 90) && ($series[$i] < 97));
            $final_series .= chr($series[$i]);
        }
        return $final_series;
    }
    // CHANGE KEY IF ALREADY EXIST
    function validate_key($key, $conn)
    {
        $check = $conn->prepare("SELECT * FROM forgot_password WHERE key_series = :key_series");
        $check->bindParam(":key_series", $key);
        try
        {
            $check->execute();
        }
        catch(Exception $e)
        {
            $_SESSION['result'] = "Error occured!";
            return false;
        }
        while($check->rowCount() != 0)
        {
            $key = random_series(20);
            $check->bindParam(":key_series", $key);
            $check->execute();
        }
        return $key;
    }
    // CHECK THAT USER EXISTS
    function validate_user($email, $conn)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['result'] = "Invalid email address entered!";
            return false;
        }
        $check = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
        $check->bindParam(":email", $email);
        try
        {
            $check->execute();
        }
        catch(Exception $e)
        {
            $_SESSION['result'] = "Error occured!";
            return false;
        }
        if($check->rowCount() == 0)
        {
            $_SESSION['result'] = "No account with this email address!";
            return false;
        }
        else
        {
            $check = $check->fetch();
            return $check['user_id'];
        }
    }
    // CHECK AND UPDATE OR CREATE NEW REQUEST
    function update_request($user_id, $conn, $key)
    {
        $check = $conn->prepare("SELECT * FROM forgot_password WHERE user_id = :user_id ORDER BY request_id DESC LIMIT 1");
        $check->bindParam(":user_id", $user_id);
        try
        {
            $check->execute();
        }
        catch(Exception $e)
        {
            $_SESSION['result'] = "Error occured!";
            return false;
        }
        $now = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime(date("Y-m-d H:i:s"))));
        $check2 = $check->fetch();
        if($check->rowCount() != 0 && $check2['expire_time'] >= date("Y-m-d H:i:s"))
        {
            global $key;
            $key = $check2['key_series'];
            $forgot = $conn->prepare("UPDATE forgot_password SET expire_time = :new_date WHERE request_id = :id");
            $forgot->bindParam(":new_date", $now);
            $forgot->bindParam(":id", $check2['request_id']);
        }
        else
        {
            $forgot = $conn->prepare("INSERT INTO forgot_password (`request_id`, `user_id`, `key_series`, `expire_time`, `used`) VALUES (NULL, :user, :series, :expire, 0)");
            $forgot->bindParam(":user", $user_id);
            $forgot->bindParam(":series", $key);
            $forgot->bindParam(":expire", $now);
        }
        try
        {
            $forgot->execute();
            return true;
        }
        catch(Exception $e)
        {
            $_SESSION['result'] = "Error occured!";
            return false;
        }
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
                $_SESSION['result'] = "Error occured!";
                return false;
            }
        }
    }
    // MAIN 
    $email = $_POST['email'];
    $user_exist = validate_user($email, $conn);
    if($user_exist === false)
    {
        echo $_SESSION['result'];
    }
    else
    {
        $key = random_series(20);
        $key = validate_key($key, $conn);
        if($key == false)
        {
            echo $_SESSION['result'];
        }
        else
        {
            if(!update_request($user_exist, $conn, $key))
            {
                echo $_SESSION['result'];
            }
            else
            {
                if(send_mail($email, $key))
                {
                    echo "DONE";
                }
                else
                {
                    echo $_SESSION['result'];
                }
            }
        } 
    }
?>