<?php
    session_start();
    if(!isset($_POST) || !isset($_POST['email']) || !isset($_POST['password']))
    {
        header("Location: ../../login.php");
        $_SESSION['login_error'] = "Error, try later!";
        exit();
    }

    require_once "../classes/users.php";
    require_once "connect.php";
    require_once "decryption.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $OK = true;

    if(empty($email)){$OK = false;}
    if(empty($password)){$OK = false;}
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $OK = false;
    }
    if(strlen($password) < 8)
    {
        $OK = false;
    }
    if($OK == true)
    {
        $query = $conn->prepare("SELECT * FROM users");
        try
        {
            $query->execute();
        }
        catch(Exception $e)
        {
            $_SESSION['login_error'] = "Error, try later!";
        }
        $list = $query->fetchAll();
        foreach($list as $user)
        {
            $decrypted_email = decrypt_email($user['user_email'], $ckey1);
            if($decrypted_email === $email)
            {
                if(password_verify($password, decrypt_pass($user['password'], $ckey2)))
                {
                    $_SESSION['logged_user'] = new User($user['user_id'], $user['user_name'], $decrypted_email);
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
            $_SESSION['login_error'] = "Error, incorrect login or password!";
        }
        else
        {
            header("Location: ../../index.html");
            exit();
        }
    }
    else
    {
        $_SESSION['login_error'] = "Error, incorrect login or password!";
    }
    header("Location: ../../login.php");
    exit();



    
?>