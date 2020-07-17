<?php
    session_start();
    if($_SESSION['logged_user']) $result = array(false, "Error, you need to log in!");
    else if(
        !isset($_POST['name']) ||
        !isset($_POST['surname']) || 
        !isset($_POST['country']) || 
        empty($_POST['name']) ||
        empty($_POST['surname']) || 
        empty($_POST['country'])
    ) $result = array(false, "Error, missing or wrong data, try later!");
    else
    {
        require_once "../config/config.php";
        require_once "../utils/encryption.php";
        $name = encrypt_data($_POST['name'], CKEY4);
        $surname = encrypt_data($_POST['surname'], CKEY5);
        $country = $_POST['country'];

        $query = $conn->prepare("INSERT INTO authors VALUES (NULL, :name, :surname, :country)");
        $query = bindParam(":name", $name);
        $query = bindParam(":surname", $surname);
        $query = bindParam(":country", $country);

        try
        {
            $query->execute();
            $result = array(true, "New author created succsessfully.");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, cannot add new author!");
        }
    }
    echo json_encode($result);
?>