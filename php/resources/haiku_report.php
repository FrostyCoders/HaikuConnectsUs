<?php
    require_once "../classes/users.php";
    session_start();
    if(!isset($_POST['hid']) || !isset($_POST['reason']) || !is_numeric($_POST['hid']))
    {
        $result = array(false, "Error, incorrect or missing data, try later!");
    }
    else
    {   
        require_once "db_connect.php";
        $haiku_id = $_POST['hid'];
        $reason = $_POST['reason'];
        $report = $conn->prepare("INSERT INTO haiku_reports VALUES (NULL, :hid, :reason);");
        $report->bindParam(":hid", $haiku_id);
        $report->bindParam(":reason", $reason);
        try
        {
            $report->execute();
            $result = array(true, "Haiku reported successfully.");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, connection failed, haiku didn't report!");
        }
    }
    echo json_encode($result);
?>