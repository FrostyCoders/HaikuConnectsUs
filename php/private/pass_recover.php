<?php
    require_once "../core/encryption.php";
    require_once "../core/connect.php";
    require_once "../functions/password.php";

    session_start();

    if(!isset($_POST['new_pass']) || !isset($_POST['repeated_pass']))
    { 		
        $result = array(false, "Error, enter both passwords!");
    }
    else
    {
        $user_id = $_SESSION['user_id'];
        $pass1 = $_POST['new_pass'];
        $pass2 = $_POST['repeated_pass'];
        $result = validate_passwords($pass1, $pass2);
        if($result[0] == true)
        {
            $pass1 = encrypt_pass($pass1, $ckey2);
            $query = $conn->prepare("UPDATE users SET password = :new_pass WHERE user_id = :user_id");
            $query->bindParam(":new_pass", $pass1);
            $query->bindParam(":user_id", $user_id);
            try
            {
                $query->execute();
                $result = array(false, "Password changed!");
            }
            catch(Exception $e)
            {
                $result = array(false, "Error occured during changing password, try later!");
            }
            unset($conn);
        }
    }
?>