<?php
    //MAIN
    session_start();
    if(!isset($_GET['rk']) && !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['rk']))
    {
        $result = array(false, "Error, incorrect recovery key!");
    }
    else
    {
        $recovery_key = $_GET['rk'];
        require_once "../core/connect.php";
        $check = $conn->prepare("SELECT * FROM pass_change_requests WHERE key_series = :rkey");
        $check->bindParam(":rkey", $recovery_key);
        try
        {
            $check->execute();
        }
        catch(Exception $e)
        {
            $result = array(false, "Error occured, try later!");
        }
        if($check->rowCount() == 1)
        {
            $check = $check->fetchAll();
            $_SESSION['user_id'] = $check["user_id"];
            $result = array(true, '
                Nowe hasło: <input id="new_pass" type="password"><br><br>
                Potwierź hasło: <input id="new_pass" type="password"><br><br>
                <button id="send">Zatwierdź</button>
            ');
        }
        elseif($check->rowCount() == 0)
        {
            $result = array(false, "Error, incorrect recovery key!");
        }
        else
        {
            $result = array(false, "Error occured, try later!");
        }
    }
    unset($conn);
?>