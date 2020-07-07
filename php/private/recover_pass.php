<?php
    //MAIN
    session_start();
    if(!isset($_GET['rk']) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['rk']))
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
            $check = $check->fetch();
            if($check['expire_time'] < date("Y-m-d H:i:s") || $check['used'] == 1)
            {
                $result = array(false, 'Your recovery link expired, <a href="../../index.php">create new.</a>');
            }
            else
            {
                $_SESSION['user_id'] = $check["user_id"];
                $result = array(true, '
                    <div class="input_container">
                        <label for="new_pass">New password</label>
                        <input id="new_pass" type="password">
                    </div>
                    <div class="input_container">
                        <label for="repeated_pass">Repeat new password</label>
                        <input id="repeated_pass" type="password">
                    </div>
                    <button id="change" type="button">Change password</button>
                    <div id="request_result_reset"></div>
                ');
            }
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