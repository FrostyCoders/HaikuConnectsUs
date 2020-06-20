<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="author" content="FrostyCoders">
    <meta name="description" content="Haiku Website">
    <meta name="keywords" content="haiku, connects, us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Haiku Connect People</title>
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="icons/haiku_normal.svg" type="image/x-icon" />
    
    <!-- SKRYPTY -->
    
    <!-- STYLE I CZCIONKI -->
    
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    
</head>
<body>
    <!-- PASEK NAWIGACYJNY -->
    <nav class="navbar navbar-expand-md">
      <a class="navbar-brand" href="#">Haiku Connects Us</a>
      
      <button class="navbar-toggler custom-toggler" id="navbar-toggler-menu" type="button" data-toggle="collapse" data-target="#menu" aria-expanded="false">
         <span class="navbar-toggler-icon" id="navbar-toggler-icon-menu"></span>
      </button>
      <button class="navbar-toggler custom-toggler" id="navbar-toggler-menu-close" type="button" data-toggle="collapse" data-target="#menu" aria-expanded="false">
         <span class="navbar-toggler-icon" id="navbar-toggler-icon-menu-close"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="menu">
       
           <ul class="navbar-nav ml-auto mg-0">
              <li class="nav-item active">
                 <a class="nav-link nav-text" href="#">Start</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="#">My Haiku</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="#">List Haiku</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link nav-text" href="#">About The Project</a>
              </li>
              <li class="nav-item nav-icon" id="nav-icons">
                 <a class="nav-link" href="#"><div class="avatar-nav-icon"></div></a>
                 <div id="nav-link-icon-container">
                 <a class="nav-link nav-link-icon" id="nav-link-icon1" href="#"><div class="gear-nav-icon" title="settings"></div></a>
                 <a class="nav-link nav-link-icon" id="nav-link-icon2" href="#"><div class="logout-nav-icon" title="logout"></div></a>
                 </div>
              </li>
           </ul>
      </div>     
    </nav>

    <!-- ZAWARTOŚĆ  -->
    <!--col-md-10 col-lg-8 col-lg-8 offset-0 offset-md-1 offset-lg-2-->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="w-100 jumbotron-my">
                        <div class="jumbotron-text">
                            <h1 class="display-4">Haiku Connects Us!</h1>
                            <h3 class="my-4 font-weight-light">We are unique and that makes us different. <br/>Our work does not have to be underestimated and wait for greater publicity.</h3>
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
                    <hr class="mt-2">
                    <p id="show-filters">Show filters</p>
                    <p id="hide-filters">Hide filters</p>
                    <form id="filters-form">
                        <div class="filter-option">
                            <p>Sort by:</p>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="" id="sort1" checked /><label for="sort1"><span class="radio">From the newest</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="" id="sort2" /><label for="sort2"><span class="radio">From the oldest</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="" id="sort3" /><label for="sort3"><span class="radio">Popularity</span></label>
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="sort" value="" id="sort4" /><label for="sort4"><span class="radio">Randomness</span></label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <p>Quantity per page:</p>
                            
                            <div class="radio-container">
                            <input type="radio" name="quantity" value="" id="quantity1" checked /><label for="quantity1"><span class="radio">10 haiku per page</span></label><br />
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="quantity" value="" id="quantity2" /><label for="quantity2"><span class="radio">20 haiku per page</span></label><br />
                            </div>
                            
                            <div class="radio-container">
                            <input type="radio" name="quantity" value="" id="quantity3" /><label for="quantity3"><span class="radio">50 haiku per page</span></label><br />
                            </div>
                        </div>
                        <div class="filter-option">
                            <p>Or search for author:</p>
                            <input type="text" placeholder="Search..." />
                        </div>
                        <div class="filter-option">
                            <input type="submit" value="Submit" />
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-5 col-lg-4 offset-0 offset-md-1 offset-lg-0">
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Jakby co to ten</p>
                            <p class="post-haiku">działa tylko to</p>
                            <p class="post-haiku">zacne serducho.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <!--- POKAZOWE JAK DZIAŁA TRZEBA W PHP ZROBIĆ --->
                        <div class="post-like" id="post-like"><span id="post-like-counter" data-value="2222">2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4 offset-0 offset-md-0 offset-lg-0">
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                    <div class="posts">
                        <div class="posts-haiku">
                            <p class="post-haiku">Lorem ipsumadasd asdad</p>
                            <p class="post-haiku">Amet quos csss adaasda</p>
                            <p class="post-haiku">consequatur hic nulla.</p>
                            <p class="post-author">~ Taki Testowy</p>
                        </div>
                        <div class="post-like"><span>2222</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-4">
                    <nav aria-label="Page pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#">&laquo;&laquo; Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next &raquo;&raquo;</a>
                            </li>
                        </ul>
                    </nav>
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
                            <img class="logo-tooltip" src="icons/gear_normal.svg" title="Biblioteka w Nowym Targu">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="icons/gear_normal.svg" title="Zespół Szkół im. Władysława Orkana w Nowym Targu">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="icons/gear_normal.svg" title="FrostyCoders">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                     <div class="logo">
                        <a href="#">
                            <img class="logo-tooltip" src="icons/gear_normal.svg" title="Others">
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
