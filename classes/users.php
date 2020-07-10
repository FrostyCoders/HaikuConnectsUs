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
            $change->bindParam(":new_pass", $new);
            $change->bindParam("id", $this->id);
            try
            {
                $change->execute();
                $result = array(true, "Successfully changed password.");
            }
            catch(Exception $e)
            {
                $result = array(false, "There was an error during changing password, try later.");
            }
            $conn->close();
            return $result;
        }
    }
?>