<?php
    if(!isset($_GET['err']))
        header("Location: index.php");
    else
    {
        switch($_GET['err'])
        {
            case "400":
            {
                $text = "<h1>ERROR 400</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>Invalid query.</p>";
                break;
            }
            case "401":
            {
                $text = "<h1>ERROR 401</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>Unauthorized access.</p>";
                break;
            }
            case "403":
            {
                $text = "<h1>ERROR 403</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>No access to the subpage.</p>";
                break;
            }
            case "404":
            {
                $text = "<h1>ERROR 404</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>The subpage you are looking for is not on our website.</p>";
                break;
            }
            case "410":
            {
                $text = "<h1>ERROR 410</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>The requested resource is no longer available.</p>";
                break;
            }
            case "500":
            {
                $text = "<h1>ERROR 500</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>Internal server error.</p>";
                break;
            }
            case "501":
            {
                $text = "<h1>ERROR 501</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>The server does not have the functionality required in the request.</p>";
                break;
            }
            case "503":
            {
                $text = "<h1>ERROR 503</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>Service unavailable due to server overload.</p>";
                break;
            }
            default:
            {
                $text = "<h1>UNDEFINED ERROR</h1>";
                $text .= "<p>Oh, we have a problem!</p>";
                $text .= "<p>Undefined error occured.</p>";
                break;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="author" content="FrostyCoders">
    <meta name="description" content="Website dedicated to the work of Haiku authors from around the world!">
    <meta name="keywords" content="international picture postcard project, international, picture, postcard, project, haikuconnectsus, haiku, connects, us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>International Picture Postcard Project</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../img/icons/haiku_logo_normal.svg" type="image/x-icon" />
    
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
            <div class="point2"></div>
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
              <li class="nav-item active">
                 <a class="nav-link nav-text" href="index.php">Start</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="authors_list.php">Authors List</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="authors_map.php">Authors Map</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="about_the_project.php">About The Project</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="reports_list.php">Reports List</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="haiku_editor.php">Add Haiku</a>
              </li>
              <li class="nav-item nav-icon" id="nav-icons">
                 <a class="nav-link" href="#"><div class="avatar-nav-icon"></div></a>
                 <div id="nav-link-icon-container">
                 <a class="nav-link nav-link-icon" id="nav-link-icon1" href="../settings.php"><div class="gear-nav-icon" title="settings"></div></a>
                 <a class="nav-link nav-link-icon" id="nav-link-icon2" href="../resources/logout.php"><div class="logout-nav-icon" title="logout"></div></a>
                 </div>
              </li>
           </ul>
      </div>     
    </nav>

    <!-- ZAWARTOŚĆ  -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 offset-0 first-row">
                    <div class="error-img"></div>
                </div>
                <div class="col-12 col-md-7 offset-0 first-row">
                    <div class="error-message">
                        <?php echo $text; ?>
                        <a href="index.php"><button>Go back to the main page</button></a>
                    </div>
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
                    <a class="footer-a" href="privacy_policy.php">Privacy Policy</a>
                </div>
                <div class="col-md-2 mb-3">
                    <a class="footer-a" href="cookies_policy.php">Cookies Policy</a>
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
    <script src="js/common.js"></script>
    
</body>
</html>
