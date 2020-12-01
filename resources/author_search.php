<?php
    if(!isset($_POST['search']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
        

        empty($_POST['search']) ? $phrase = " " : $phrase = $_POST['search'];

        $query = $conn->prepare("SELECT * FROM authors ORDER BY surname");

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, cannot load authors data!");
            $query_ok = false;
            saveToLog(0, "Cannot search author: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }

        if($query_ok == true)
        {
            $authors = $query->fetchAll();
            $authors_list = array();
            $phrase = "/$phrase/i";
            foreach($authors as $a)
            {
                $full_name = $a['name'] . " " . $a['surname'];
                if(preg_match($phrase, $full_name . " " . $a['country']))
                {   
                    array_push($authors_list, array(
                        "id" => $a['id'],
                        "fname" => $full_name,
                        "firstname" => $a['name'],
                        "surname" => $a['surname'],
                        "country" => $a['country']
                    ));
                }
            }

            if(count($authors_list) == 0)
            {
                $result = array(false, "Nobody was found!");
            }
            else
            {
                $result = array(true, $authors_list);
            }
        }
    }
    echo json_encode($result);
?>