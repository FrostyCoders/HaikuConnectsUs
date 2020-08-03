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
    <link rel="stylesheet" type="text/css" href="css/add_haiku.css" />
    
</head>
<body>
    <!-- INNE -->
    <div class="loading-container" id="loading-container">
        <div class="points-loading-container">
            <div class="point1"></div>
            <div class="point2"></div>
        </div>
    </div>
    <div class="page-communicate" id="post-error">Something gone wrong...</div>
    <div class="add-new-author" id="add-new-author">
        <div class="add-new-author-close" id="add-new-author-close"></div>
        <p>Add new author:</p>
        <form id="add_author_form">
            <input type="text" id="author-firstname" placeholder="Firstname" />
            <input type="text" id="author-surname" placeholder="Surname" />
            <input type="text" id="author-country" placeholder="Country" />
            <input type="submit" value="Add author" />
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
                            <h1 class="display-4">Add new Haiku!</h1>
                            <h3 class="my-4 font-weight-light">Below is the editor for adding a new Haiku to the content of the page with live view.</h3>
                            <h3 class="my-4 font-weight-bold">Have fun!</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-5 offset-0 offset-md-1 add-inputs">
                    <h4>Make new Haiku:</h4>
                    <hr class="mt-3">
                    <form id="haiku_data">
                        <label for="author">Author:</label>
                        <input type="text" id="author" placeholder="Write author's firstname and surname..." autocomplete="off" />
                        <ul id="author_list">
                            <li>Start typing to search author...</li>
                            <li id="add-author">Add new author</li>
                        </ul>
                        <label for="in-english">In English:</label>
                        <textarea id="in-english" name="content" placeholder="Separate the lines with the ENTER..."></textarea>
                        <label for="in-native">In Native Language (optional):</label>
                        <textarea id="in-native" name="content_native" placeholder="Separate the lines with the ENTER..."></textarea>
                        <label class="file-position">Background (JPG or PNG):
                            <div class="file-delete" id="file-delete-background" title="Delete"></div>
                        </label>
                        <label for="background-haiku" class="input-button" id="file-complete">Upload background</label>
                        <div class="file-name" id="background-name"></div>
                        <input type="file" id="background-haiku" name="bg_image" size="1" accept="image/jpeg,image/png"/>
                        <label class="file-position">Handwritten letter from haiku (optional - JPG or PNG):
                            <div class="file-delete" id="file-delete-handwriting" title="Delete"></div>
                        </label>
                        <label for="handwriting-haiku" class="input-button" id="file-complete-hand">Upload handwriting</label>
                        <input type="file" id="handwriting-haiku" name="hw_image" size="1" accept="image/jpeg,image/png" />
                        <div class="file-name" id="handwriting-name"></div>
                        <input type="submit" id="add-haiku-button" value="Add Haiku" />
                    </form>
                </div>
                <div class="col-12 col-md-5 offset-0 live">
                    <h4>Live changes:</h4>
                    <hr class="mt-3">
                    <div class="posts">
                        <div class="post-header" id="post-header">
                            <div class="posts-haiku">
                                <p class="post-haiku" id="post-haiku"><br /></p>
                            </div>
                        </div>
                        <div class="lang-switch">
                            <label class="lang-switcher">
                                <input type="checkbox" id="ischecked">
                                <span class="lang-slider"></span>
                            </label>
                        </div>
                        <div class="post-nav" id="post-nav">
                            <div class="post-nav-dot"></div>
                            <div class="post-nav-handwriting" id="post-nav-handwriting">
                                <div class="post-nav-handwriting-close" id="post-nav-handwriting-close"></div>
                            </div>
                            <div class="post-nav-sub" id="post-nav-sub">
                                <div class="post-nav-sub-option" id="post-nav-sub-option-handwriting">Handwriting</div>
                            </div>
                        </div>
                        <div class="post-footer">
                            <div class="post-author" id="post-author"></div>
                            <div class="post-country" id="post-country"></div>
                            <div class="post-like"><span>Live</span></div>
                        </div>
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
    <script src="js/common.js"></script>
    <script src="js/add_haiku_live.js"></script>
    <script src="js/haiku_editor.js"></script>
</body>
</html>
