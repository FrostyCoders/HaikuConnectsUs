<?php
    session_start();
    if(isset($_SESSION['logged_user']))
    {
        header("Location: main_page.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haiku Connects Us</title>
    <meta name="author" content="Frosty Coders">
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="window">
        <div id="info">
            <div class="logo">
                <img src="img/icons/haiku_logo_normal.svg" alt="Haiku Logo">
                <h1>Haiku Connects Us</h1>
                <h3>We are unique and that makes us different. Our work does not have to be underestimated and wait for greater publicity.</h3>
                <hr class="spacer">
                <p>Let's share it among those who also create haiku!</p>
            </div>
        </div>
        <div id="form">
            <!-- LOGIN FORM -->
            <div id="login">
                <h1>Log In</h1>
                <form>
                    <div class="input_container">
                        <label for="email">E-mail</label>
                        <input id="email" type="text">
                    </div>
                    <div class="input_container">
                        <label for="password">Password</label>
                        <input id="password" type="password">
                        <p class="forgot">Forgot password</p>
                    </div>
                    <button id="login_button" type="button">Login</button>
                    <div id="request_result_login"></div>
                </form>
            </div>
            <!-- FORGOT PASSWORD FORM -->
            <div id="forget_pass">
                <h1>Recover password</h1>
                <form id="forgot_form">
                    <div class="input_container">
                        <label for="recover_email">Account e-mail</label>
                        <input id="recover_email" type="text">
                        <p class="back_login">Go back</p>
                    </div>
                    <button id="forgot_button" type="button">Send Mail</button>
                    <div id="request_result_forgot"></div>
                </form>
            </div>
            <div class="copy">Copyright &copy - Frosty Coders 2020</div>
        </div>
    </div>
    <div class="cookies_button">Privacy Policies & Cookies</div>
    <div class="cookies_info">
        <div class="info_frame">
            This website uses cookies to function in proper way. <a href="#" target="_blank">Read more.</a>
            <img id="close_info" src="img/icons/close_icon.svg" alt="Close" title="Close">
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>