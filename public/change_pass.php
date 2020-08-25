<?php
    if(!isset($_GET['rk']) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['rk']))
    {
        $result = array(false, "Error, incorrect recovery key!");
    }
    else
    {
        session_start();
        $recovery_key = $_GET['rk'];
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "../resources/db_connect.php";
        $check = $conn->prepare("SELECT * FROM pass_change_requests WHERE key_series = :rkey");
        $check->bindParam(":rkey", $recovery_key);
        try
        {
            $check->execute();
            $check_ok = true;
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot check key: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            $result = array(false, "Error occured, try later!");
            $check_ok = false;
        }
        if($check_ok == true)
        {
            if($check->rowCount() == 1)
            {
                $check = $check->fetch();
                if($check['expire_time'] < date("Y-m-d H:i:s") || $check['used'] == 1)
                {
                    $result = array(false, 'Your recovery link expired,<br> <a href="login.php">create new.</a>');
                }
                else
                {
                    $_SESSION['user_id'] = $check["user_id"];
                    $result = array(true, '
                        <form id="change_pass_form">
                            <div class="input_frame">
                                <label class="input_label" for="">New password</label>
                                <input class="login_input" id="new_pass" type="password">
                            </div>
                            <div class="input_frame">
                                <label class="input_label" for="">Repeat new password</label>
                                <input class="login_input" id="repeated_pass" type="password">
                            </div>
                            <div class="last_input" class="input_frame">
                                <input type="submit" value="Change Password">
                            </div>
                        </form>
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
    }
    unset($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haiku ConnectUs - Change Password</title>
    <meta name="author" content="Frosty Coders">
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="bg_image"></div>
    <div class="login_window">
        <div id="loading-container">
            <div class="points-loading-container">
                <div class="point1"></div>
                <div class="point2"></div>
            </div>
        </div>
        <div class="frame">
            <img id="haiku_logo" src="img/icons/haiku_logo_normal.svg" alt="Logo">
            <?php
                if($result[0] == false)
                {
                    echo '<p class="notification">'.$result[1].'</p>';
                }
                else
                {
                    echo $result[1];
                }
            ?>
            <div class="space">
                <div id="page_result"></div>
            </div>
            <div class="copy">
                Copyright &copy; - Frosty Coders 2020
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
    <script src="js/forgot_pass/enter_new.js"></script>
</body>
</html>