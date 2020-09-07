<?php
    session_start();
    if(!isset($_SESSION['logged_user'])) 
        die(json_encode([false, "Error, you need to log in!"]));
    else if(
        !isset($_POST['name']) ||
        !isset($_POST['surname']) || 
        !isset($_POST['country']) || 
        empty($_POST['name']) ||
        empty($_POST['surname']) || 
        empty($_POST['country'])
    ) 
        die(json_encode([false, "Error, missing or wrong data, try later!"]));
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "db_connect.php";
        require_once "../utils/encryption.php";

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $country = $_POST['country'];

        $specials = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
        if(preg_match($specials, $name) == true || (preg_match($specials, $surname) == true || (preg_match($specials, $country) == true)))
            die(json_encode([false, "New author data could not contain special characters!"]));

        $query = $conn->prepare("INSERT INTO authors VALUES (NULL, :name, :surname, :country)");
        $get_id = $conn->prepare("SELECT id FROM authors ORDER BY id DESC LIMIT 1");

        try
        {
            $query->bindParam(":name", $name);
            $query->bindParam(":surname", $surname);
            $query->bindParam(":country", $country);
            $query->execute();
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, cannot add new author!"]));
            saveToLog(0, "Cannot add new author: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }

        try
        {
            $get_id->execute();
            $id = $get_id->fetchAll();
            $result = array(true, "New author created succsessfully.", $id[0]['id']);
        }
        catch(Exception $e)
        {  
            $result = array(true, "New author created succsessfully. Cannot get new author data!", false);
            saveToLog(1, "Cannot get new author id: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }
    }
    echo json_encode($result);
?>