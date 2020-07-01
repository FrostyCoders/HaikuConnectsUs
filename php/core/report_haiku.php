<?php
    require_once "../classes/users.php";
    session_start();
    if(!isset($_POST['hid']) || !isset($_POST['reason']) || !is_numeric($_POST['hid']) || !is_numeric($_POST['reason']) || !isset($_SESSION['logged_user']))
    {
        $result = array(false, "Error, incorrect or missing data, try later!");
    }
    else
    {   
        require_once "connect.php";
        $haiku_id = $_POST['hid'];
        switch($_POST['reason'])
        {
            case 0:
                {
                    $reason = "Spam or scam.";
                    break;
                }
            case 1:
                {
                    $reason = "Hate speech.";
                    break;
                }
            case 2:
                {
                    $reason = "Other.";
                    break;
                }
            default:
                {
                    $reason = "Other.";
                    break;
                }
        }
        $report = $conn->prepare("INSERT INTO haiku_reports VALUES (NULL, :hid, :uid, :reason);");
        $report->bindParam(":hid", $haiku_id);
        $report->bindParam(":uid", $_SESSION['logged_user']->showName());
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