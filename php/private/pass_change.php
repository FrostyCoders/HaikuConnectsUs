<?php
    require_once "../core/encryption.php";
    require_once "../core/connect.php";
    require_once "../functions/password.php";

    session_start();

    if(!isset($_SESSION['user_id']))
    {
        $result = array(false, "Can't change password, no authorization!");
    }
    else
    {
        if(!isset($_POST['pass1']) || !isset($_POST['pass2']))
        { 		
            $result = array(false, "Error, enter both passwords!");
        }
        else
        {
            $user_id = $_SESSION['user_id'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $result = validate_passwords($pass1, $pass2);
            if($result[0] == true)
            {
                $pass1 = encrypt_pass($pass1, $ckey2);
                $query = $conn->prepare("UPDATE users SET password = :new_pass WHERE user_id = :user_id");
                $query2 = $conn->prepare("UPDATE forgot_pass_requests SET user = 1 WHERE user_id = :user_id");
                $query->bindParam(":new_pass", $pass1);
                $query->bindParam(":user_id", $user_id);
                $query2->bindParam(":user_id", $user_id);
                try
                {
                    $query->execute();
                    $result = array(true, 'Password changed! Now you can <a href="../../index.php">login.</a>');
                }
                catch(Exception $e)
                {
                    $result = array(false, "Error occured during changing password, try later!");
                }
                try
                {
                    $query2->execute();
                }
                catch(Exception $e)
                {
                    $result = array(true, 'Password changed with warning! Now you can <a href="../../index.php">login.</a>');
                }
                unset($conn);
            }
        }
    }
    echo json_encode($result);
?>