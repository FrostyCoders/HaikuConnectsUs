<?php
    session_start();
    if(isset($_SESSION['logged_user']))
    {
        header("Location: main_page.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haiku ConnectUs - Login</title>
    <meta name="author" content="Frosty Coders">
    <link rel="shortcut icon" href="img/icons/haiku_normal.svg" type="image/x-icon" />
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="window">
        <div class="frame">
            <div class="logo"><img src="img/icons/haiku_normal.svg" alt="Haiku Logo"></div>
            <form action="php/core/login.php" method="POST">
                <p class="login_label">E-mail</p>
                <input type="text" name="email" required>
                <p class="password_label">Password</p>
                <input type="password" name="password" required><br>
                <p class="pass_forgot"><a href="forgotpasswd.php">Forgot Password</a></p>
                 <br><br>
                <input type="submit" class="submit-button" value="Login">
                <p class="login_error">
                    <?php
                        if(isset($_SESSION['login_error']))
                        {
                            echo $_SESSION['login_error'];
                            unset($_SESSION['login_error']);
                        }
                    ?>
                </p>
            </form>
        </div>
    </div>
    <div class="copy">Copyright &copy - Frosty Coders 2020</div>
    <script src="js/scripts.js"></script>
</body>
</html>