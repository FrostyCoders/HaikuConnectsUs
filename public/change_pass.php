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
        require_once "../resources/db_connect.php";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haiku ConnectUs - Change Password</title>
    <meta name="author" content="Frosty Coders">
    <link rel="shortcut icon" href="../../icons/haiku_normal.svg">
    <link rel="stylesheet" href="../../css/variables.css">
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <div id="window">
        <div id="info">
            <div class="logo">
                <img src="../../icons/haiku_normal.svg" alt="Haiku Logo">
                <h1>Haiku Connects Us</h1>
                <h3>We are unique and that makes us different. Our work does not have to be underestimated and wait for greater publicity.</h3>
                <hr class="spacer">
                <p>Let's share it among those who also create haiku!</p>
            </div>
        </div>
        <div id="form">
            <h1>Change password</h1>
            <div class="frame">
                <?php
                    if($result[0] == false)
                    {
                        echo '<p class="error">'.$result[1].'</p>';
                    }
                    else
                    {
                        echo $result[1];
                    }
                ?>
            </div>
        <div class="copy">Copyright &copy - Frosty Coders 2020</div>
        </div>
    </div>
    <div class="cookies_button">Privacy Policies & Cookies</div>
    <div class="cookies_info">
        <div class="info_frame">
            This website uses cookies to function in proper way. <a href="#" target="_blank">Read more.</a>
            <img id="close_info" src="../../icons/close_icon.svg" alt="Close" title="Close">
        </div>
    </div>
    <script src="../../js/login.js"></script>
    <script src="../../js/forgot_pass/enter_new.js"></script>
</body>
</html>