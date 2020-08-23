<?php
    function saveToLog($type = 2, $msg = "Unknown error", $file = "unknown file", $line = 0)
    {
        $fileName = realpath("../logs/"). "\\" . "errlog_" . date("d-m-Y") . ".txt";
        $logFile = fopen($fileName, "a");
        switch($type)
        {
            case 0:
            {
                $type = " Critical error: ";
                break;
            }
            case 1:
            {
                $type = " Warning: ";
                break;
            }
            default:
            {
                $type = " Notice: ";
                break;
            }
        }
        if(isset($_SESSION) && class_exists("User"))
        {
            if(isset($_SESSION['logged_user']))
            {
                $who = " while user with id: " . $_SESSION['logged_user']->showId() . " used app ";
            }
            else
            {
                $who = " while guest used app ";
            }
        }
        else
        {
            $who = "";
        }

        $line = "\n" . date('H:i:s') . $type . $msg . $who . " - in " . $file . " in line " . $line;
        fwrite($logFile, $line);
        fclose($logFile);
    }
?>