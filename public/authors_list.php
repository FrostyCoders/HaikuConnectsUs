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
    <title>Haiku Connects Us</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg" type="image/x-icon" />
    
    <!-- STYLE -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/rest.css" />

</head>
<body>
    <!-- OTHER -->
    <div class="loading-container" id="loading-container">
        <div class="points-loading-container">
            <div class="point1"></div>
        </div>
    </div>
    <div class="page-communicate" id="page-communicate">
    <div class="page-communicate-icon" id="page-communicate-icon"></div>
    <div class="page-communicate-text" id="page-communicate-text"></div>
    </div>
    <div class="add-new-author" id="add-new-author">
        <div class="add-new-author-close" id="add-new-author-close"></div>
        <p id="author-p">Edit author:</p>
        <form id="add_author_form">
            <input type="text" id="author-firstname" placeholder="Firstname" />
            <input type="text" id="author-surname" placeholder="Surname" />
            <input type="text" id="author-country" placeholder="Country" />
            <div class="author-submit-container">
            <input type="button" id="author-show-haiku" value="Show Haiku" />
            <input type="submit" id="author-submit" value="Edit Author" />
            </div>
        </form>
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
    <!-- NAV -->
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

    <!-- MAIN -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="w-100 jumbotron-my">
                        <div class="jumbotron-text">
                            <h1 class="display-4">Authors list</h1>
                            <h3 class="my-4 font-weight-light">List of all haiku authors creating this project.</h3>
                            <h3 class="my-4 font-weight-bold">Thank you for all work put into the project and the opportunity to read your haiku here!</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 first-row">
                    <h4>List of authors:</h4>
                    <hr class="mt-3">
                </div>
            </div>    
            <div class="row" id="table-box"> 
                <div class="col-12 col-lg-6 offset-0 offset-lg-3 table-con">
                    <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr><th>Authors</th><th>Country</th></tr>
                        </thead>
                        <tbody id="table-response1">
                        </tbody>
                    </table>
                    </div>
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

    <!-- SCRIPTS -->    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/author_list.js"></script>
</body>
</html>
