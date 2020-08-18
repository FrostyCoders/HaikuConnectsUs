<?php
    require_once "../config/config.php";
    require_once "../config/encryption.php";
    require_once "db_connect.php";
    if(!isset($_GET['ck']) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['ck']))
    {
        $result = array(false, "Error, incorrect change e-mail key!");
    }
    else
    {
        $query = $conn->prepare("SELECT * FROM change_email_requests WHERE key_series = :ck AND used = 0");
        $query->bindParam(":ck", $_GET['ck']);
        try
        {
            $query->execute();
            $result = array(true, "");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error occured, try later!");
        }
        if($result[0] == true)
        {
            if($query->rowCount() == 1)
            {
                $query = $query->fetch();
                $change_email = $conn->prepare("UPDATE users SET user_email = :new_email WHERE user_id = :uid");
                $change_email->bindParam(":new_email", encrypt_email($query['new_email'], CKEY1));
                $change_email->bindParam(":uid", $query['user_id']);
                $link_used = $conn->prepare("UPDATE change_email_requests SET used = 1 WHERE request_id = :rid");
                $link_used->bindParam(":rid", $query['request_id']);
                try
                {
                    $change_email->execute();
                    try
                    {
                        $link_used->execute();
                        $result = array(true, "Email changed successfully.");
                    }
                    catch(Exception $e)
                    {
                        $result = array(true, "Email changed with errors, now you can log in with new email.");
                    }
                }
                catch(Exception $e)
                {
                    $result = array(false, "Error during changing e-mail, try later!");
                }
            }
            else
            {
                $result = array(false, "Error, incorrect change e-mail key!");
            }
        }
        unset($conn);
    }
?>