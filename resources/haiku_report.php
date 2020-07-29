<?php
    if(!isset($_POST['hid']) || !isset($_POST['reason']) || !isset($_POST['email']) || !is_numeric($_POST['hid']))
    {
        die(json_encode([false, "Error, incorrect or missing data, try later!"]));
    }
    else
    {   
        require_once "../config/config.php";
        require_once "db_connect.php";
        $check = $conn->prepare("SELECT * 
                                FROM haiku_reports
                                WHERE haiku_id = :hid AND guest_email = :email AND solved = 0;
        ");
        try
        {
            $check->bindParam(":hid", $_POST['hid']);
            $check->bindParam(":email", $_POST['email']);
            $check->execute();
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, connection failed, haiku didn't report!"]));
        }

        if($check->rowCount() == 0)
        {
            $haiku_id = $_POST['hid'];
            $email = $_POST['email'];
            $reason = $_POST['reason'];
            $current_time = date('Y-m-d H:i:s');
            $report = $conn->prepare("INSERT INTO haiku_reports(`report_id`, `guest_email`, `haiku_id`, `reason`, `solved`, `add_time`)
                                      VALUES (NULL, :email, :hid, :reason, 0, :time);");
            try
            {
                $report->bindParam(":hid", $haiku_id);
                $report->bindParam(":email", $email);
                $report->bindParam(":reason", $reason);
                $report->bindParam(":time", $current_time);
                $report->execute();
                $result = array(true, "Haiku reported successfully.");
            }
            catch(Exception $e)
            {
                $result = array(false, "Error, connection failed, haiku didn't report!");
            }
        }
        else
        {
            die(json_encode([false, "You recently reported problem with this haiku and it waits for solve. You cannot report this haiku right now!"]));
        }
    }
    echo json_encode($result);
?>