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

        $check = $conn->prepare("SELECT background, handwriting FROM haiku WHERE id = :hid");

        try
        {
            $check->bindParam(":hid", $_POST['haiku_id']);
            $check->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot get info about post images: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot delete haiku, try later!"]));
        }

        if($check->rowCount() == 0)
        {
            die(json_encode([false, "Error, cannot find haiku to delete!"]));
        }

        $query = $conn->prepare("DELETE FROM haiku WHERE id = :hid");
        $query2 = $conn->prepare("DELETE FROM haiku_reports WHERE haiku_id = :hid");
        
        try
        {
            $query->bindParam(":hid", $_POST['haiku_id']);
            $query2->bindParam(":hid", $_POST['haiku_id']);
            $query->execute();
            $query2->execute();
            $result = array(true, "Haiku deleted successfully.");
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot delete haiku from DB: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot delete haiku, try later!"]));
        }

        $images = $check->fetchAll();

        foreach($images as $image)
        {
            if(file_exists(HW_DIR . $image['handwriting']) && $image['handwriting'] != "no_hw.jpg")
                unlink(HW_DIR . $image['handwriting']);
            else if(file_exists(BG_DIR . $image['background']) && $image['background'] != "default.png")
                unlink(BG_DIR . $image['background']);
        }
    }
    echo json_encode($result); 
?>