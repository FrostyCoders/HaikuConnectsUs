<?php
    class User
    {
        private $id;
        private $username;
        private $email;

        function __construct($id, $username, $email)
        {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
        }

        function showId(){return $this->id;}
        function showName(){return $this->username;}
        function showEmail(){return $this->email;}

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
                $result = array(false, "There was an error during changing password, try later.");
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
                $change_ok = false;
            }
            if($change_ok == true)
            {
                $result = array(true, "Successfully changed username.");
                $this->username = $newUsername;
            }
            else
                $result = array(false, "There was an error during changing username, try later.");
            
            unset($conn);
            return $result;
        }
    }
?>