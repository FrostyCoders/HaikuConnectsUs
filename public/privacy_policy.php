<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="author" content="FrostyCoders">
    <meta name="description" content="Website dedicated to the work of Haiku authors from around the world!">
    <meta name="keywords" content="haiku, connects, us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>International Picture Postcard Project</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg" type="image/x-icon" />
    
    <!-- STYLE -->
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
    <?php
        if (!isset($_COOKIE['cookie_alert']))
        {
            echo '<div class="cookie-alert" id="cookie-alert">
            <div class="cookie-alert-close" id="cookie-alert-close"></div>
            <p><span>Hello There!</span> By using this website, you read and agree to our <a href="privacy_policy.php" target="_blank">privacy policy</a> and <a href="cookies_policy.php" target="_blank">cookie policy</a>.</p>
            </div>';
        }
    ?>
    <!-- PASEK NAWIGACYJNY -->
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="index.php">International Picture Postcard Project</a>
      
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
                            <h1 class="display-4">Privacy policy</h1>
                            <h3 class="my-4 font-weight-light">Some information about the privacy policy.</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 first-row">
                    <h4>Information:</h4>
                    <hr class="mt-3">
                    <p class="information"><strong>By using <q>International Picture Postcard Project</q>, you agree privacy policy and cookies policy.</strong></p>
                    <hr class="hr-big">
                    <p class="info-about">1. Sensitive user data related to the use of the website <q>International Picture Postcard Project</q> are encrypted.</p>
                    <p class="info-about">2. Creators of haiku on the website <q>International Picture Postcard Project</q> have given their full consent for the publication of their work with data:</p>
                    <ul>
                        <li>firstname</li>
                        <li>surname</li>
                        <li>country</li>
                        <li>created haiku</li>
                        <li>postcard background</li>
                        <li>handwritten haiku on postcard</li>
                    </ul>
                    <p class="info-about">3. It is not allowed to copy, distribute, sell haiku located on the website <q>Haiku Connects Us</q> without the prior consent of the creator of this haiku.</p>
                    <p class="info-about">4. On website <q>International Picture Postcard Project</q> it is not possible to create an account in order to log in, without consent the administrator of data and make by him account.</p>
                    <p class="info-about">5. In order to edit or delete of the post with haiku, please notify to the administrator of data by report this haiku with the appropriate button in the post menu.</p>
                    <p class="info-about">6. When reporting post with haiku you must not use vulgar language, make so-called spam, advertise.</p>
                    <p class="info-about">7. Any errors that occurred while using the website <q>International Picture Postcard Project</q> are recording and saving to provide you with a better website experience and possibility to fix errors.</p>
                    <p class="info-about">8. Website <q>International Picture Postcard Project</q> is provided as is. Creators of this website not be held responsible for errors while using website <q>International Picture Postcard Project</q>, errors of security are not responsible for any damage caused by the applications and website <q>International Picture Postcard Project</q>.</p>
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
    <script src="js/common.js"></script>
    
</body>
</html>
