<?php
    // NICKNAME CHANGE
    if(!isset($_POST['nickname']) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['nickname']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
        echo json_encode($result);
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";
        require_once "../classes/users.php";
        session_start();

        $sessionId = $_SESSION['logged_user']->showId();

        $query = $conn->prepare("UPDATE users SET `name` = :new_username WHERE `id` = :uid");
        $query->bindParam(":new_username", $_POST['nickname']);
        $query->bindParam(":uid", $sessionId);

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, Cannot change nickname!");
            $query_ok = false;
        }

        if($query_ok == true)
        {
            $result = array(true, "The nickname is change!");
            $_SESSION['logged_user']->changeUsername($_POST['nickname']);
        }
        echo json_encode($result);
    }    
?>