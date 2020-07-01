<?php
    function key_exists($ck, $conn)
    {
        $query = $conn->prepare("SELECT * FROM change_email_requests WHERE key_series = :ck AND used = 0");
        $query->bindParam(":ck", $ck);
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
                $result = array(true, array($query['request_id'], $query['user_id'], $query['new_email']));
            }
            else
            {
                $result = array(false, "Error, incorrect change e-mail key!");
            }
        }
        unset($conn);
        return $result;
    }
    // MAIN
    if(!isset($_GET['ck']) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['ck']))
    {
        $result = array(false, "Error, incorrect change e-mail key!");
    }
    else
    {
        require_once "../core/connect.php";
        $result = key_exists($_GET['ck'], $conn);
        if($change_data[0] == true)
        {
            $change_email = $conn->prepare("UPDATE users SET user_email = :new_email WHERE user_id = :uid");
            $change_email->bindParam(":new_email", $change_email[1][2]);
            $change_email->bindParam(":uid", $change_email[1][1]);
            $link_used = $conn->prepare("UPDATE change_email_requests SET used = 1 WHERE request_id = :rid");
            $link_used->bindParam(":rid", $change_data[1][0]);
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
        unset($conn);
    }
?>