<?php
    // EMAIL CHECKER
    if(!isset($_POST['email']))
    {
        die(json_encode([false, "Error, missing or wrong data, try later!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";
        require_once "../utils/decryption.php";
        
        $email = $_POST['email'];

        $query = $conn->prepare("SELECT email FROM users");

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            die(json_encode([0, "Error, Cannot load users data!"]));
        }
            
        $useremail = $query->fetchAll();
        //print_r($useremail);
        foreach($useremail as $email)
        {
            echo decrypt_email($email['email'], CKEY1);
            if(decrypt_email($email['email'], CKEY1) === $email)
            {
                die(json_encode([2, "The e-mail already exists!"]));
            }
            else
            {
                die(json_encode([1, "The e-mail is available!"]));
            }
        }
        echo json_encode($result);
    }    
?>