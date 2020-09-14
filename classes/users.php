<?php
    class User
    {
        private $id;
        private $username;
        private $email;
        private $pass_change;
        private $email_change;

        function __construct($id, $username, $email, $email_change)
        {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->email_change = $email_change;
        }

        function showId(){return $this->id;}
        function showName(){return $this->username;}
        function showEmail(){return $this->email;}
        function lastEmailChange(){return $this->email_change;}

        function changePass($conn, $new)
        {
            $change = $conn->prepare("UPDATE users SET password = :new_pass WHERE id = :id");
            try
            {
                $change->bindParam(":new_pass", $new);
                $change->bindParam(":id", $this->id);
                $change->execute();
                $result = array(true, "Successfully changed password.");
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot change password: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                $result = array(false, "Error, cannot change password right now, try later.");
            }
            unset($conn);
            return $result;
        }

        function changeUsername($conn, $newUsername)
        {
            $change = $conn->prepare("UPDATE users SET name = :newname WHERE id = :uid");
            try
            {
                $change->bindParam(":newname", $newUsername);
                $change->bindParam(":uid", $this->id);
                $change->execute();
                $change_ok = true;
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot change username: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                $change_ok = false;
            }
            if($change_ok == true)
            {
                $result = array(true, "Successfully changed username.");
                $this->username = $newUsername;
            }
            else
                $result = array(false, "Error, cannot change username right now, try later.");
            
            unset($conn);
            return $result;
        }
    }
?>