<?php
    // NICKNAME CHANGE
    require_once "../classes/users.php";
    session_start();
    if(!isset($_POST['nickname']) && isset($_POST['logged_user']))
    {
        die(json_encode([false, "Error, missing or wrong data, try later!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "db_connect.php";

        $nick = $_POST['nickname'];
        if(empty($nick) || strlen($nick) < 3)
            die(json_encode([false, "Error, new nickname must have at least 3 characters!"]));

        if(strlen($nick) > 15)
            die(json_encode([false, "Error, new nickname cannot have more than 15 characters long!"]));

        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $nick) == true)
            die(json_encode([false, "Error, new nickname cannot have special characters!"]));

        $operation = $_SESSION['logged_user']->changeUsername($conn, $nick);

        echo json_encode($operation);
    }
?>