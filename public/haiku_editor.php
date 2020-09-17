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
    <link rel="stylesheet" type="text/css" href="css/add_haiku.css" />
    
</head>
<body>
    <!-- INNE -->
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
        <p id="author-p">Add new author:</p>
        <form id="add_author_form">
            <input type="text" id="author-firstname" placeholder="Firstname" />
            <input type="text" id="author-surname" placeholder="Surname" />
            <input type="text" id="author-country" placeholder="Country" />
            <input type="submit" id="author-submit" value="Add author" />
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
                        <label class="file-position">Background (JPG, JPEG, PNG or BMP - max. 10MB):
                            <div class="file-delete" id="file-delete-background" title="Delete"></div>
                        </label>
                        <label for="background-haiku" class="input-button" id="file-complete">Upload background</label>
                        <div class="file-name" id="background-name"></div>
                        <input type="file" id="background-haiku" name="bg_image" size="1" accept="image/jpeg,image/png,image/bmp,image/jpg"/>
                        <label class="file-position">Handwritten letter (JPG, JPEG, PNG or BMP - max. 10MB - optional):
                            <div class="file-delete" id="file-delete-handwriting" title="Delete"></div>
                        </label>
                        <label for="handwriting-haiku" class="input-button" id="file-complete-hand">Upload handwriting</label>
                        <input type="file" id="handwriting-haiku" name="hw_image" size="1" accept="image/jpeg,image/png,image/bmp,image/jpg" />
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
                        <div class="lang-switch" id="lang-switch">
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
    <script src="js/add_haiku_live.js"></script>
    <script src="js/haiku_editor.js"></script>
</body>
</html>
