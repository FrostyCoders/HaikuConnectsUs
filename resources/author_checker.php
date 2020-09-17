<?php
    session_start();
    if(isset($_SESSION['logged_user']))
    {
        $status = true;
    }
    else
    {
        $status = false;
    }

    echo json_encode($status);
?>