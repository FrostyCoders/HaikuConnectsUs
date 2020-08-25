<?php
    session_start();
    if($_SESSION['logged_user']) $result = array(false, "Error, you need to log in!");
    else if(
        !isset($_POST['author_id']) ||
        !isset($_POST['name']) ||
        !isset($_POST['surname']) || 
        !isset($_POST['country']) || 
        empty($_POST['author_id']) ||
        empty($_POST['name']) ||
        empty($_POST['surname']) || 
        empty($_POST['country'])
    ) $result = array(false, "Error, missing or wrong data, try later!");
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "../utils/encryption.php";

        $load = $conn->prepare("SELECT * FROM authors WHERE id = :aid");
        $load->bindParam(":aid", $_POST['author_id']);
        try
        {   
            $load->execute();
            $load_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, cannot change user data! Try later!");
            $load_ok = false;
            saveToLog(0, "Cannot load author data: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }

        if($load_ok == true)
        {
            $name = encrypt_data($_POST['name'], CKEY4);
            $surname = encrypt_data($_POST['surname'], CKEY5);
            $country = $_POST['country'];

            $query = $conn->prepare("UPDATE authors SET name = :name, surname = :surname, country = :country WHERE id = :aid");
            $query = bindParam(":name", $name);
            $query = bindParam(":surname", $surname);
            $query = bindParam(":country", $country);
            $query = bindParam(":aid", $_POST['aid']);

            try
            {
                $query->execute();
                $result = array(true, "Author modified succsessfully.");
            }
            catch(Exception $e)
            {
                $result = array(false, "Error, cannot modify author!");
                saveToLog(0, "Cannot change author data: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            }
        }
    }
    echo json_encode($result);
?>