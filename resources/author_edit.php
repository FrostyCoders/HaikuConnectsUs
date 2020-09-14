<?php
    session_start();
    if(!isset($_SESSION['logged_user'])) 
        die(json_encode([false, "Error, you need to log in!"]));
    else if(
        !isset($_POST['id']) ||
        !isset($_POST['name']) ||
        !isset($_POST['surname']) || 
        !isset($_POST['country']) || 
        empty($_POST['id']) ||
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
        $id = $_POST['id'];

        $specials = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
        if(preg_match($specials, $name) == true || (preg_match($specials, $surname) == true || (preg_match($specials, $country) == true)))
            die(json_encode([false, "Error, new author data could not contain special characters!"]));

        $query = $conn->prepare("UPDATE authors SET name=:name, surname=:surname, country=:country WHERE id=:id");

        try
        {
            $query->bindParam(":name", $name);
            $query->bindParam(":surname", $surname);
            $query->bindParam(":country", $country);
            $query->bindParam(":id", $id);
            $query->execute();
            $result = array(true, "Author edited succsessfully.");
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, cannot edit author!"]));
            saveToLog(0, "Cannot edit author: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }

    }
    echo json_encode($result);
?>