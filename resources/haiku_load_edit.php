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
        
        $haiku_exist = $conn->prepare("SELECT haiku.*, authors.*
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
            die(json_encode([false, "Error, cannot edit haiku, try later!"]));
        }

        if($haiku_exist->rowCount() != 1)
        {
            die(json_encode([false, "Error, cannot find searched haiku to edit!"]));
        }

        $haiku = $haiku_exist->fetch();
        
        $result = array(
            true,
            array(
                $haiku['haiku.id'],
                $haiku['author.id'],
                decrypt_data($haiku['author.name'], CKEY4),
                decrypt_data($haiku['author.surname'], CKEY4),
                $haiku['author.country'],
                $haiku['haiku_title'],
                $haiku['haiku.content'],
                $haiku['haiku.content_native'],
                $haiku['haiku.like_counter'],
                $haiku['haiku.backdround']
            )
        );
    
        echo json_encode($result);
    }
?>