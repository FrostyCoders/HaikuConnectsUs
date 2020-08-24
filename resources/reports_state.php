<?php
    if(!isset($_POST['state']) || !isset($_POST['id']))
        die(json_encode([false, "Error, missing or wrong data!"]));
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";
        
        $sql = "UPDATE haiku_reports SET solved = :state WHERE report_id = :id";
        $query = $conn->prepare($sql);
        
        try
        {
            $query->bindParam(":state", $_POST['state']);
            $query->bindParam(":id", $_POST['id']);
            $query->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot change report state: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot set demanded report state, try later!"]));
        }

        die(json_encode([true, ""]));
    }
?>