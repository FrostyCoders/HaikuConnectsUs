<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="author" content="FrostyCoders">
    <meta name="description" content="Website dedicated to the work of Haiku authors from around the world!">
    <meta name="keywords" content="international picture postcard project, international, picture, postcard, project, haikuconnectsus, haiku, connects, us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <title>Haiku Connects Us</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="img/icons/haiku_logo_normal.svg" type="image/x-icon" />
    
    <!-- STYLE -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    
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
    <div class="post-report-menu" id="post-report-menu">
        <div class="post-report-close" id="post-report-close"></div>
        <form id="report_form">
            <p>Report an error:</p>
            <textarea name="text-report" placeholder="Write why you are reporting this haiku..."></textarea>
            <label>Write your e-mail:</label>
            <input name="guest-email" type="email" placeholder="Must have to send" />
            <input type="submit" value="Send" />
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
                    require_once "../utils/visits_counter.php";
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
                            <h1 class="display-4">Haiku Postcard Project!</h1>
                            <h3 class="my-4 font-weight-light">We are unique and that makes us different.<br/>Our work does not have to be underestimated<br/>and wait for greater publicity.</h3>
                            <hr class="my-4">
                            <p class="m-1 mb-4">Let's share it among those who also create haiku!</p>
                        </div>
                        <div class="jumbotron-img">
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-2 offset-0 offset-lg-1 filters">
                    <h4>Filters:</h4>
                    <hr class="mt-3">
                    <p id="show-filters">Show filters</p>
                    <p id="hide-filters">Hide filters</p>
                    <form id="filters-form">
                        <div class="filter-option">
                            <p>Sort by:</p>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="newest" id="sort1" checked /><label for="sort1"><span class="radio">From the newest</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="oldest" id="sort2" /><label for="sort2"><span class="radio">From the oldest</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="popularity" id="sort3" /><label for="sort3"><span class="radio">Popularity</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="random" id="sort4" /><label for="sort4"><span class="radio">Randomness</span></label>
                            </div>
                        </div>
                        <div class="filter-option" id="grid-option">
                            <p>Grid of posts:</p>
                            
                            <div class="radio-container">
                            <input type="radio" name="posts_grid" id="quantity1" value="3" /><label for="quantity1"><span class="radio">3 posts in grid</span></label><br />
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="posts_grid"  id="quantity2" value="2" checked /><label for="quantity2"><span class="radio">2 posts in grid</span></label><br />
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="posts_grid"  id="quantity3" value="1" /><label for="quantity3"><span class="radio">1 posts in grid</span></label><br />
                            </div>
                        </div>
                        <div class="filter-option">
                            <p>Search author:</p>
                            <input id="author_input" type="text" placeholder="Search..." autocomplete="off" />
                            <ul id="author_list">
                                
                            </ul>
                        </div>
                        <div class="filter-option">
                            <p>Todays visits:</p>
                            <p class="filter-counter"><?php echo $daily; ?></p>
                        </div>
                        <div class="filter-option">
                            <p>All visits:</p>
                            <p class="filter-counter"><?php echo $all_visits; ?></p>
                        </div>
                    </form>
                </div>
                <div id="haiku_box" class="col-12 col-lg-9 offset-0">
                </div>
                <div class="col-12 col-lg-9 offset-0 offset-lg-3">
                    <nav aria-label="Page pagination">
                        <ul class="pagination justify-content-center">
                            <li id="previous_button" class="page-item">
                                <a class="page-link">&laquo;&laquo; Previous</a>
                            </li>
                            <li id="page_number" class="page-item"><a class="page-link page-link-number"></a></li>
                            <li id="next_button" class="page-item">
                                <a class="page-link" >Next &raquo;&raquo;</a>
                            </li>
                        </ul>
                    </nav>
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
    <script src="js/haiku.class.js"></script>
    <script src="js/main_page.js"></script>
    <script src="js/common.js"></script>
</body>
</html>
