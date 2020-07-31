<?php
    if(isset($_GET['edit']) && is_numeric($_GET['edit']))
    {
        require_once "../config/config.php";
        require_once "db_connect.php";

        $haiku_exist = $conn->prepare("SELECT * FROM haiku WHERE id = :hid");
    
        try
        {
            $haiku_exist->bindParam(":hid", $_GET['edit']);
            $haiku_exist->execute();
        }
        catch(Exception $e)
        {
            die('<script>window.onload = () => { showCommunicate("Error, cannot find haiku to edit!") }</script>');
        }
    }
?>