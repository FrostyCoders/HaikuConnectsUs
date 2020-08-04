<?php
    // EMAIL CHECKER
    if(!isset($_POST['email']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
        echo json_encode($result);
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
            $result = array(0, "Error, Cannot load users data!");
            $query_ok = false;
        }

        if($query_ok == true)
        {
            $useremail = $query->fetchAll();
            foreach($useremail as $email)
            {
                if(decrypt_email($email['email'], CKEY1) == $email)
                {
                    $result = array(2, "The e-mail already exists!");
                }
                else
                {
                    $result = array(1, "The e-mail is available!");
                }
            }
        }
        echo json_encode($result);
    }    
?>