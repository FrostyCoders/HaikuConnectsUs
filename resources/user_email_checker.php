<?php
    // EMAIL CHECKER
    if(!isset($_POST['email']))
    {
        die(json_encode([false, "Error, missing or wrong data, try later!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
        
        $email = strtolower($_POST['email']);

        $query = $conn->prepare("SELECT email FROM users");

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot check email: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([0, "Error, Cannot load users data!"]));
        }
            
        $useremail = $query->fetchAll();
        foreach($useremail as $uemail)
        {
            $decrypted = decrypt_email($uemail['email'], CKEY1);
            if($decrypted === $email)
            {
                die(json_encode([2, "This e-mail is already in use by other user!"]));
            }
        }
        echo json_encode([1, "This e-mail is available!"]);
    }
?>