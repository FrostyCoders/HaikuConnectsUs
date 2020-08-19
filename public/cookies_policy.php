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
                            <h1 class="display-4">Cookies policy</h1>
                            <h3 class="my-4 font-weight-light">Some information about our cookies policy.</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 first-row">
                    <p class="information"><strong>By using <q>Haiku Connects Us</q>, you agree to the session mechanism and storage of cookies and data in local storage (if the browser's privacy settings for cookies and local/session storage have not been changed).</strong></p>
                    <hr class="hr-big">
                    <h4>What are cookies?</h4>
                    <hr class="mt-3">
                    <p class="info-about">Cookies are small files stored in the browser's memory (locally) that contain text content. Such files are created when you use your browser and visit websites that use cookies. They are often necessary to remember the user's preferences on a given website.</p>
                    <p class="info-about">Cookies contain little information - the name, content, URL of the website that created the cookie, the lifetime or the lifetime of the cookie. Normally, they cannot be used to reveal personal information, but can be used, for example, to tailor advertising to your preferences.</p>
                    <p class="info-about">You can disable cookies at any time in the privacy settings of your browser.</p>
                    <h4>Cookies used by us:</h4>
                    <hr class="mt-3">
                    <p class="info-about"><q>Haiku Connects Us</q> uses cookies to provide a unique session for the local user's device.</p>
                    <hr class="hr-big">
                    <h4>What are a local and session storage?</h4>
                    <hr class="mt-3">
                    <p class="info-about">Local storage is an area in the browser's memory, inaccessible to the server, where it stores data that does not have an expiry date, i.e. it remains even after closing the browser.</p>
                    <p class="info-about">Session storage is the equivalent of cookies, but with a larger size, that the server can access. Data in session storage is deleted after the session is terminated.</p>
                    <h4>Local and session storage used by us:</h4>
                    <hr class="mt-3">
                    <p class="info-about"><q>Haiku Connects Us</q> uses data stored in local and session storage for the mechanism of likes and reports.</p>
                    <hr class="hr-big">
                    <h4>What is a session?</h4>
                    <hr class="mt-3">
                    <p class="info-about">The session mechanism and session variables are stored on the server side, while the session id is on the user's local device. It makes it possible to transfer parameters between subpages of a given website in an easy way. Thanks to the session, it is possible, for example, to leave the same filters selected before reloading the website or to remain logged in, maneuvering between the subpages of a given website.</p>
                    <h4>Session used by us:</h4>
                    <hr class="mt-3">
                    <p class="info-about"><q>Haiku Connects Us</q> uses the session mechanism to provide the user with a better experience when using the website, remembering filters when refreshing a given subpage with filters and remembering the logged in user on a given local device.</p>
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
    <script src="js/main.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/change_icons_menu.js"></script>
    
</body>
</html>
