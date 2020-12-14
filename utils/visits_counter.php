<?php
    require_once "../config/config.php";
    require_once "../resources/db_connect.php";
    require_once "logs.php";

    // DEBUG
    $first_visit = "NO";
    $reset = "NO";

    $daily = "Unknown";
    $all_visits = "Unknown";
    $OK = true;
    $get_data = $conn->prepare("SELECT * FROM visits");
    try
    {
        $get_data->execute();
    }
    catch(Exception $e)
    {
        saveToLog(0, "Cannot get visits data due to the: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        $OK = false;
    }

    if($OK == true)
    {
        $get_data = $get_data->fetch();
        $daily = $get_data['daily_visits'];
        $all_visits = $get_data['all_visits'];

        if(strtotime($get_data['today']) != strtotime(date('Y-m-d')))
        {
            $daily = 0;
            $reset_daily = $conn->prepare("UPDATE visits SET today = NOW(), daily_visits = 0");
            try
            {
                $reset_daily->execute();
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot reset daily caounter due to the: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            }
            $reset = "YES";
        }

        if(!isset($_COOKIE['visited']))
        {
            $expire_time = new DateTime('NOW');
            $expire_time->setTime(23, 59, 59);
            setcookie("visited", "1", $expire_time->getTimestamp(), "/");
            $daily++;
            $all_visits++;
            $update_visits = $conn->prepare("UPDATE visits SET daily_visits = daily_visits + 1, all_visits = all_visits + 1");
            try
            {
                $update_visits->execute();
            }
            catch(Exception $e)
            {
                saveToLog(0, "Cannot update visits due to the: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            }
            $first_visit = "YES";
        }

        saveToLog(2, "Today: " . $get_data['today'] . " Daily: " . $daily . " All: " . $all_visits . " ID: " . session_id() . " First visit: " . $first_visit . " Reset: " . $reset);
        
    }
?>