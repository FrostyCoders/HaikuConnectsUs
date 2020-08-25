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
        </div>
    </div>
    <div class="page-communicate" id="page-communicate">Something gone wrong...</div>
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
                    require_once "../classes/users.php";
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
                    <div class="settings-nickname" id="settings-nickname"><?php echo $_SESSION['logged_user']->showName(); ?></div>
                    <div class="settings-email" id="settings-email"><?php echo $_SESSION['logged_user']->showEmail(); ?></div>
                </div>
                <div class="col-12 col-md-4 offset-0 settings">
                    <form id="form-nickname">
                    <label for="change-nickname">Change your nickname:</label>
                    <input type="text" id="change-nickname" placeholder="Letters and numbers only..." pattern="[A-Za-z0-9]+"/>
                    <span class="settings-notification" id="nickname-notification"></span>
                    <input type="submit" id="confirm-nickname" value="Confirm"/>
                    </form>
                    <hr class="hr-big-space">
                    <form id="form-email">
                    <label for="change-email">Change your e-mail:</label>
                    <input type="email" id="change-email" placeholder="New e-mail..." />
                    <span class="settings-notification" id="email-notification"></span>
                    <input type="submit" id="confirm-email" value="Confirm"/>
                    </form>
                    <hr class="hr-big-space">
                    <form id="form-pass">
                    <label for="check-password">Your current password:</label>
                    <input type="password" id="check-password" placeholder="Write current password..." />
                    <label for="change-password">Your new password:</label>
                    <input type="password" id="change-password" placeholder="Password must be 8 characters long..." />
                    <label for="repeat-password">Repeat new password:</label>
                    <input type="password" id="repeat-password" placeholder="Repeat new password..." />
                    <div class="password-checker">
                        <div class="password-weak" id="password-weak"></div>
                        <div class="password-medium" id="password-medium"></div>
                        <div class="password-strong" id="password-strong"></div>
                    </div>
                    <span class="settings-notification" id="password-notification"></span>
                    <input type="submit" id="confirm-password" value="Confirm"/>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <!-- FOOTER -->     
    <footer class="page-footer">
        <?php
            require_once "../resources/site_footer.php";
        ?>
    </footer>
    <!-- FOOTER -->

    <!-- SKRYPTY -->
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/change_icons_menu.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/common.js"></script>
    
</body>
</html>
