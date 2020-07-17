<?php
    session_start();
    if(!isset($_SESSION['logged_user'])) $result = array(false, "Error, you need to log in!");
    else if(!isset($_POST['haiku_id']) || empty($_POST['haiku_id']) || !is_numeric($_POST['haiku_id']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";

        $query = $conn->prepare("DELETE FROM haiku WHERE id = :hid");
        $query->bindParam(":hid", $_POST['haiku_id']);
        
        try
        {
            $query->execute();
            $result = array(true, "Haiku deleted successfully.");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, cannot delete haiku, try later!");
        }
    }
    echo json_encode($result); 
?>