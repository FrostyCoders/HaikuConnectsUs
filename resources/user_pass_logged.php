<?php
    require_once "../config/config.php";
    require_once "../utils/logs.php";
    require_once "../utils/encryption.php";
    require_once "../utils/decryption.php";
    require_once "../utils/password.php";
    require_once "../classes/users.php";
    require_once "db_connect.php";
    
    session_start();

    if(!isset($_SESSION['logged_user']))
    {
        die(json_encode([false, "Can't change password, no authorization!"]));
    }
    else
    {
        if(!isset($_POST['pass1']) || !isset($_POST['pass2']) || !isset($_POST['current']))
        { 		
            die(json_encode([false, "Error, fill all password inputs!"]));
        }
        else
        {
            $current = $_POST['current'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $uid = $_SESSION['logged_user']->showId();

            $check_current = $conn->prepare("SELECT password FROM users WHERE id = :uid");

            try
            {
                $check_current->bindParam(":uid", $uid);
                $check_current->execute();
            }
            catch(Exception $e)
            {
                die(json_encode([false, "Error, cannot change password, try later!"]));
            }

            $check_current = $check_current->fetchAll();

            if(password_verify($current, decrypt_pass($check_current[0]['password'], CKEY2)))
            {
                $result = validate_passwords($pass1, $pass2);
                if($pass1 == $current)
                {
                    die(json_encode([false, "Error, old and new password are same!"]));
                }
                if($result[0] == true)
                {
                    do
                    {
                        $newPass = encrypt_pass($pass1, CKEY2);
                    }
                    while(password_verify($pass1, decrypt_pass($newPass, CKEY2)) != true);
                    echo json_encode($_SESSION['logged_user']->changePass($conn, $newPass));
                }
            }
            else
            {
                die(json_encode([false, "Error, your current password is incorrect!"]));
            }
        }
    }
?>