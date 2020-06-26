<?php
    if(!isset($_GET['rk']))
    {
        header("Location: index.php");
        exit();
    }
    require_once "../private/recover_pass.php";
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