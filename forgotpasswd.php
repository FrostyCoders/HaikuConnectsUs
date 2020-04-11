<?php
    session_start();
    if(isset($_SESSION['haiku']) && $_SESSION['haiku'] == true)
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
    <title>Haiku ConnectUs - Password Restore</title>
    <meta name="author" content="Frosty Coders">
    <link rel="shortcut icon" href="img/icon.png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="window">
        <div class="frame">
            <div class="logo"><img src="img/logo.png" alt="Haiku Logo"></div>
            <form action="login.php" method="POST">
                <p class="login_label">E-mail</p>
                <input type="text" name="fp-login" required>
               
                 <br><br>
                <input type="submit" value="Reset Password">
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