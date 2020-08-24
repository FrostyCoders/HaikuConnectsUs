<?php
    session_start();
    if(!isset($_SESSION['logged_user']))
    {
        die(json_encode([false, "Error, you need to login before edit haiku!"]));
    }
    else if(!isset($_POST['haiku_id']) || !is_numeric($_POST['haiku_id']))
    {   
        die(json_encode([false, "Error, missing or wrong data required to edit haiku!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
        
        $haiku_exist = $conn->prepare("SELECT
                                         haiku.id as haiku_id,
                                         authors.id as author_id,
                                         authors.name,
                                         authors.surname,
                                         authors.country,
                                         haiku.content,
                                         haiku.content_native,
                                         haiku.background,
                                         haiku.handwriting
                                        FROM haiku
                                        INNER JOIN authors ON haiku.author = authors.id
                                        WHERE haiku.id = :hid");
        try
        {
            $haiku_exist->bindParam(":hid", $_POST['haiku_id']);
            $haiku_exist->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot get haiku info: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot edit haiku, try later!"]));
        }

        if($haiku_exist->rowCount() != 1)
        {
            die(json_encode([false, "Error, cannot find searched haiku to edit!"]));
        }

        $haiku = $haiku_exist->fetchAll();
        $haiku = $haiku[0];
        
        $result = array(
            true,
            array(
                $haiku['haiku_id'],
                $haiku['author_id'],
                decrypt_data($haiku['name'], CKEY4),
                decrypt_data($haiku['surname'], CKEY5),
                $haiku['country'],
                str_ireplace("<br />", "\r", $haiku['content']),
                $haiku['content_native'] != "NO" ?  str_ireplace("<br />", "\r", $haiku['content_native']) : "", 
                $haiku['background'],
                $haiku['handwriting']
            )
        );
    
        echo json_encode($result);
    }
?>