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
    <div class="page-communicate" id="page-communicate">Something gone wrong...</div>
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
                            <h1 class="display-4">Reports list</h1>
                            <h3 class="my-4 font-weight-light">All reported problems and bugs are listed here.</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-0 first-row">
                    <h4>Reports and bugs:</h4>
                    <hr class="mt-3">
                    <div class="filters-form">
                        <div class="filter-option">
                            <p>Filters:</p>
                            <div class="radio-container">
                            <input type="radio" name="sort" value="latest" id="sort1" checked /><label for="sort1"><span class="radio">From the newest</span></label>
                            </div>
                            <div class="radio-container">
                            <input type="radio" name="sort" value="oldest" id="sort2" /><label for="sort2"><span class="radio">From the oldest</span></label>
                            </div>
                            <div class="radio-container">
                            <input type="radio" name="done" id="quantity1" value="0" checked /><label for="quantity1"><span class="radio">Undone</span></label><br />
                            </div>
                            <div class="radio-container">
                            <input type="radio" name="done"  id="quantity2" value="1" /><label for="quantity2"><span class="radio">Done</span></label><br />
                            </div>
                        </div>
                    </div>
                    <div class="report-content">
                        <div class="report-container">
                            <div class="report-sender"><span>Sender: </span>testowy@test.ojdfhsdfkjbdsfkjsdfjkdsfsdfkjtest</div>
                            <hr>
                            <div class="report-desc"><span>Report: </span>Asperiores architecto sit sint aut. Soluta impedit pariatur eum dignissimos natus sint labore. Rerum non sed et tempora vel beatae quia architecto. Iste deleniti autem veniam. Repellat voluptas molestias eos magnam porro et enim alias. Inventore tenetur dolores voluptates voluptatem impedit vitae quo. Quibusdam cum provident perspiciatis et facilis sunt earum. Ratione vel est reprehenderit ipsam quod ea animi ea dsflnj nNSDJNASN asndasdj sdfnbdvkd ndfgdnkfvn njdgkdgvdnv.</div>
                            <div class="report-time">12:00 30.03.20</div>
                            <div class="report-to-haiku">Check haiku</div>
                            <div class="report-switch">
                                <label class="report-switcher">
                                    <input type="checkbox" class="report-value" />
                                    <span class="report-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="report-container">
                            <div class="report-sender"><span>Sender: </span>testowy@test.test</div>
                            <hr>
                            <div class="report-desc"><span>Report: </span>Asperiores architecto sit sint aut. Soluta impedit pariatur eum dignissimos natus sint labore. Rerum non sed et tempora vel beatae quia architecto. Iste deleniti autem veniam. Repellat voluptas molestias eos magnam porro et enim alias. Inventore tenetur dolores voluptates voluptatem impedit vitae quo. Quibusdam cum provident perspiciatis et facilis sunt earum. Ratione vel est reprehenderit ipsam quod ea animi ea.</div>
                            <div class="report-time">12:00 30.03.20</div>
                            <div class="report-to-haiku">Check haiku</div>
                            <div class="report-switch">
                                <label class="report-switcher">
                                    <input type="checkbox" class="report-value" />
                                    <span class="report-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="report-container">
                            <div class="report-sender"><span>Sender: </span>testowy@test.test</div>
                            <hr>
                            <div class="report-desc"><span>Report: </span>Asperiores architecto sit sint aut. Soluta impedit pariatur eum dignissimos natus sint labore. Rerum non sed et tempora vel beatae quia architecto. Iste deleniti autem veniam. Repellat voluptas molestias eos magnam porro et enim alias. Inventore tenetur dolores voluptates voluptatem impedit vitae quo. Quibusdam cum provident perspiciatis et facilis sunt earum. Ratione vel est reprehenderit ipsam quod ea animi ea.</div>
                            <div class="report-time">12:00 30.03.20</div>
                            <div class="report-to-haiku">Check haiku</div>
                            <div class="report-switch">
                                <label class="report-switcher">
                                    <input type="checkbox" class="report-value" />
                                    <span class="report-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="report-container">
                            <div class="report-sender"><span>Sender: </span>testowy@test.test</div>
                            <hr>
                            <div class="report-desc"><span>Report: </span>Asperiores architecto sit sint aut. Soluta impedit pariatur eum dignissimos natus sint labore. Rerum non sed et tempora vel beatae quia architecto. Iste deleniti autem veniam. Repellat voluptas molestias eos magnam porro et enim alias. Inventore tenetur dolores voluptates voluptatem impedit vitae quo. Quibusdam cum provident perspiciatis et facilis sunt earum. Ratione vel est reprehenderit ipsam quod ea animi ea.</div>
                            <div class="report-time">12:00 30.03.20</div>
                            <div class="report-to-haiku">Check haiku</div>
                            <div class="report-switch">
                                <label class="report-switcher">
                                    <input type="checkbox" class="report-value" />
                                    <span class="report-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="nothing"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 offset-0 offset-lg-2">
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
    <!-- FOOTER -->

    <!-- SKRYPTY -->
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/change_icons_menu.js"></script>
    <script src="js/common.js"></script>
    <script src="js/reports.js"></script>

    
</body>
</html>
