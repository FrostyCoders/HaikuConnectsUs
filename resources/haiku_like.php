<?php
    session_start();
    if(!isset($_POST['like']) || !isset($_POST['hid']) || !is_numeric($_POST['hid']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";
        $like = $_POST['like'];
        $haiku_id = $_POST['hid'];
        if($like == "true")
        {
            $sql = "UPDATE haiku SET like_counter = like_counter + 1 WHERE id = :hid";
        }
        else if($like == "false")
        {
            $sql = "UPDATE haiku SET like_counter = like_counter - 1 WHERE id = :hid";
        }
        else
        {
            die(json_encode([false, "Error, missing or wrong data, try later!"]));
        }
        $stmt = $conn->prepare($sql);
        try
        {
            $stmt->bindParam(":hid", $haiku_id);
            $stmt->execute();
            $result = array(true, "");
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot like haiku: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            $result = array(false, "Error, problem with connection occured!");
        }
    }
    echo json_encode($result);
?>