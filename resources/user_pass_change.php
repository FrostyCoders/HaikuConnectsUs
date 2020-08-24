<?php
    require_once "../config/config.php";
    require_once "../utils/encryption.php";
    require_once "../utils/password.php";
    require_once "db_connect.php";
    
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
                $pass1 = encrypt_pass($pass1, CKEY2);
                $query = $conn->prepare("UPDATE users SET password = :new_pass WHERE id = :user_id");
                $query2 = $conn->prepare("UPDATE pass_change_requests SET used = 1 WHERE user_id = :user_id");
                $query->bindParam(":new_pass", $pass1);
                $query->bindParam(":user_id", $user_id);
                $query2->bindParam(":user_id", $user_id);
                try
                {
                    $query2->execute();
                    $query->execute();
                    $result = array(true, 'Password changed! Now you can <a href="login.php">login.</a>');
                }
                catch(Exception $e)
                {
                    $result = array(false, "Error cannot change password, try later!");
                    saveToLog(0, "Cannot password in DB: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                }
                unset($conn);
            }
        }
    }
    echo json_encode($result);
?>