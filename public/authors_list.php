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
    <div class="add-new-author" id="add-new-author">
        <div class="add-new-author-close" id="add-new-author-close"></div>
        <p id="author-p">Edit author:</p>
        <form id="add_author_form">
            <input type="text" id="author-firstname" placeholder="Firstname" />
            <input type="text" id="author-surname" placeholder="Surname" />
            <input type="text" id="author-country" placeholder="Country" />
            <input type="submit" id="author-submit" value="Edit author" />
        </form>
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
                <div class="col-12 col-lg-6 offset-0 table-con">
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
                 <div class="col-12 col-lg-6 offset-0 table-con">
                    <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr><th>Authors</th><th>Country</th></tr>
                        </thead>
                        <tbody id="table-response2">
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
    <!-- FOOTER -->

    <!-- SKRYPTY -->
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/change_icons_menu.js"></script>
    <script src="js/common.js"></script>
    <script src="js/author_list.js"></script>
    
</body>
</html>
