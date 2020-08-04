<?php
    session_start();
    if(isset($_SESSION['logged_user']))
    {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haiku Connects Us - Admin Login</title>
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
            </div>
        </div>
        <div class="frame">
            <img id="haiku_logo" src="img/icons/haiku_logo_normal.svg" alt="Logo">
            <form id="login_form">
                <div class="input_frame">
                    <label class="input_label" for="">E-mail</label>
                    <input class="login_input" id="email" type="text">
                </div>
                <div class="input_frame">
                    <label class="input_label" for="">Password</label>
                    <input class="login_input" id="password" type="password">
                </div>
                <div class="last_input" class="input_frame">
                    <input type="submit" value="Login">
                    <div id="forgot_button" class="additional_option">
                        Forgot Password
                    </div>
                    <a href="index.php"><div class="additional_option">
                        Back to the page
                    </div></a>
                </div>
            </form>
            <form id="forgot_form">
                <div class="input_frame">
                    <label class="input_label" for="">Your account e-mail</label>
                    <input class="login_input" id="account_email" type="text">
                </div>
                <div class="last_input" class="input_frame">
                    <input id="login_button" type="submit" value="Send">
                    <div id="back_button" class="additional_option">
                        Go Back
                    </div>
                </div>
            </form>
            <div class="space">
                <div id="page_result"></div>
            </div>
            <div class="copy">
                Copyright &copy; - Frosty Coders 2020
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>