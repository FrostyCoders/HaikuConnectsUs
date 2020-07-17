<?php
    session_start();
    if(!isset($_POST) || !isset($_POST['email']) || !isset($_POST['password']))
    {
       $result = array(false, "Error, try later!");
    }
    else
    {
        require_once "../config/config.php";
        require_once "../classes/users.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result = array(true);
    
        if(empty($email) || empty($password))
        {
            $result = array(false, "Both inputs must be filled!");
        }
        else
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $result = array(false, "Wrong e-mail form!");
            }
            else
            {
                if(strlen($password) < 8)
                {
                    $result = array(false, "Password must have at least 8 characters!");
                }
            }
        }
        if($result[0] == true)
        {
            $query = $conn->prepare("SELECT * FROM users");
            try
            {
                $query->execute();
            }
            catch(Exception $e)
            {
                $result = array(false, "Error, try later!");
            }
            $list = $query->fetchAll();
            foreach($list as $user)
            {
                $decrypted_email = decrypt_email($user['email'], CKEY1);
                if($decrypted_email === $email)
                {
                    if(password_verify($password, decrypt_pass($user['password'], CKEY2)))
                    {
                        $_SESSION['logged_user'] = new User($user['id'], $user['name'], $decrypted_email);
                        break;
                    }
                    else
                    {
                        continue;
                    }
                }
            }
            unset($conn);
            if(!isset($_SESSION['logged_user']))
            {
                $result = array(false, "Error, incorrect login or password!");
            }
            else
            {
                $result = array(true, "Everything right!");
            }
        }
    }
    echo json_encode($result);
?>