<?php
    // NICKNAME CHECKER
    if(!isset($_POST['nickname']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
        echo json_encode($result);
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "db_connect.php";

        $query = $conn->prepare("SELECT name FROM users WHERE name LIKE :username");
        $query->bindParam(":username", $_POST['nickname']);

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot check nickname unique: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            $result = array(0, "Error, Cannot load users data!");
            $query_ok = false;
        }

        if($query_ok == true)
        {
            $username = $query->fetchAll();
            $username_list = array();
            foreach($username as $un)
            {
                array_push($username_list, array(
                    "name" => $un['name']
                ));
            }

            if(count($username_list) == 0)
            {
                $result = array(1, "The nickname is available!");
            }
            else
            {
                $result = array(2, "The nickname already exists!");
            }
        }
        echo json_encode($result);
    }    
?>