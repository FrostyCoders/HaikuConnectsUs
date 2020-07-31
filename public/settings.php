<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="author" content="FrostyCoders">
    <meta name="description" content="Website dedicated to the work of Haiku authors from around the world!">
    <meta name="keywords" content="haiku, connects, us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Haiku Connects Us</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg" type="image/x-icon" />
    
    <!-- SKRYPTY -->
    
    <!-- STYLE I CZCIONKI -->
    
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/rest.css" />
</head>
<body>
    <!-- INNE -->
    <div class="loading-container" id="loading-container">
        <div class="points-loading-container">
            <div class="point1"></div>
            <div class="point2"></div>
        </div>
    </div>
    <!-- PASEK NAWIGACYJNY -->
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="index.php">Haiku Connects Us</a>
      
      <button class="navbar-toggler custom-toggler" id="navbar-toggler-menu" type="button" data-toggle="collapse" data-target="#menu" aria-expanded="false">
         <span class="navbar-toggler-icon" id="navbar-toggler-icon-menu"></span>
      </button>
      <button class="navbar-toggler custom-toggler" id="navbar-toggler-menu-close" type="button" data-toggle="collapse" data-target="#menu" aria-expanded="false">
         <span class="navbar-toggler-icon" id="navbar-toggler-icon-menu-close"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="menu">
       
            <ul class="navbar-nav ml-auto mg-0">
                <?php
                    require_once "../resources/site_menu.php";
                    if(!isset($_SESSION['logged_user']))
                        header("Location: login.php");
                ?>
            </ul>
      </div>     
    </nav>

    <!-- ZAWARTOŚĆ  -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="w-100 jumbotron-my">
                        <div class="jumbotron-text">
                            <h1 class="display-4">Settings</h1>
                            <h3 class="my-4 font-weight-light">Here you can change your profile settings.</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 first-row">
                    <h4>Your profile:</h4>
                    <hr class="mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 offset-0 offset-md-2 settings">
                    <div class="settings-icon"></div>
                    <div class="settings-nickname" id="settings-nickname">Taki_Testowy_1</div>
                    <div class="settings-email" id="settings-email">takitestowy1@test.test</div>
                </div>
                <div class="col-12 col-md-4 offset-0 settings">
                    <label for="change-nickname">Change your nickname:</label>
                    <input type="text" id="change-nickname" placeholder="" />
                    <span class="settings-notification" id="nickname-notification"></span>
                    <input type="submit" id="confirm-nickname" value="Confirm"/>
                    <hr class="hr-big-space">
                    <label for="change-email">Change your e-mail:</label>
                    <input type="email" id="change-email" placeholder="" />
                    <span class="settings-notification" id="email-notification"></span>
                    <input type="submit" id="confirm-email" value="Confirm"/>
                    <hr class="hr-big-space">
                    <label for="check-password">Your current password:</label>
                    <input type="password" id="check-password" placeholder="" />
                    <label for="change-password">Your new password:</label>
                    <input type="password" id="change-password" placeholder="" />
                    <label for="repeat-password">Repeat new password:</label>
                    <input type="password" id="repeat-password" placeholder="" />
                    <span class="settings-notification" id="password-notification">Password must be 8 characters long</span>
                    <input type="submit" id="confirm-password" value="Confirm"/>
                </div>
            </div>
        </div>
    </main>
    
    <!-- STOPKA -->     
    <footer class="page-footer">
        <div class="container">
            <div class="row text-center d-flex justify-content-center pt-5 mb-3">
                 <h4>Project Partners:</h4>
            </div>
            <div class="row text-center justify-content-center pt-5 mb-3">
                <div class="col-6 col-lg-3 mb-3">
                    <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="img/icons/gear_normal.svg" title="Biblioteka w Nowym Targu">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="img/icons/gear_normal.svg" title="Zespół Szkół im. Władysława Orkana w Nowym Targu">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="img/icons/gear_normal.svg" title="FrostyCoders">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="img/icons/gear_normal.svg" title="Others">
                        </a>
                    </div>
                </div>
            </div>
            <hr class="hr-footer">
            <div class="row text-center d-flex justify-content-center pt-5 mb-3"> 
                <div class="col-md-2 mb-3">
                    <a class="footer-a" href="#">Privacy Policy</a>
                </div>
                <div class="col-md-2 mb-3">
                    <a class="footer-a" href="#">Cookies Policy</a>
                </div>
            </div>
        </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-4">2020 &copy; FROSTYCODERS</div>
    <!-- Copyright -->

    </footer>
    <!-- Footer -->

    
    <!-- SKRYPTY -->
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/change_icons_menu.js"></script>
    <script src="js/settings.js"></script>
    
</body>
</html>
