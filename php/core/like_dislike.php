<?php
    require_once "../classes/users.php";
    session_start();
    if(!isset($_POST['like']) || !isset($_POST['hid']) || !is_bool($_POST['like']) || !is_numeric($_POST['hid']) || !isset($_SESSION['logged_user']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "connect.php";
        $like = $_POST['like'];
        $haiku_id = $_POST['hid'];
        if($like == true)
        {
            $sql = "INSERT INTO haiku_likes VALUES (NULL, :uid, :hid);
                    UPDATE haiku SET haiku_likes = haiku_likes + 1 WHERE haiku_id = :hid;";
        }
        else
        {
            $sql = "DELETE FROM haiku_likes WHERE user_id = :uid AND haiku_id = :hid;
                    UPDATE haiku SET haiku_likes = haiku_likes + 1 WHERE haiku_id = :hid;";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":uid", $_SESSION['logged_user']->showName());
        $stmt->bindParam(":hid", $haiku_id);
        try
        {
            $stmt->execute();
            $result = array(true, "Like/dislike operation complete!");
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, problem with connection occured!");
        }
    }
    echo json_encode($result);
?>