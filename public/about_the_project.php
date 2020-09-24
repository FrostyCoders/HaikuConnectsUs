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
                            <h1 class="display-4">About the project</h1>
                            <h3 class="my-4 font-weight-light">Some information about the project.</h3>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 first-row">
                    <h4>Information:</h4>
                    <hr class="mt-3">
                    <p class="information">The project on website <q>International Picture Postcard Project</q> aims to bring together haiku writers from around the world.</p>
                    <hr class="hr-big">
                    <h4>English:</h4>
                    <hr class="mt-3">
                    <p class="info-about">About the project <q>Haiku Connects Us</q>:</p>
                    <p class="info-about">The idea of a project of sending postcards from your local place with a word haiku - handwritten on the reverse side - has been on my mind for some time. However, I did not have courage to make it real. When I finally made a decision, I was only thinking about my close friends I was in touch with.</p>
                    <p class="info-about">Yet, fate was different. Human kindness and the pandemic overlapped with one another.</p>
                    <p class="info-about"> My friends popularized the project worldwide without my knowledge. The first postcard came on February the 1st, later on came many more. Since March there has been a breakdown due to the pandemic. I get postcards that were on their way for 100 days, they are tattered and worn out but victorious.</p>
                    <p class="info-about">I wonder how many of them are there left in post bags?</p>
                    <p class="info-about">Sending a postcard seems to be a simple act but in fact it isn&#39;t. Apart from financial aspect there is also time devoted to it and finally finding a postbox. Sometimes buying a postcard may be a challenge! For me the most interesting was a human factor. Who would be eager to give a litttle heart, thought or emphaty? I wasn&#39;t let down. The postcards I received speak to me with their image and handwritten haiku. Handwriting, stamp, postmark, sometimes earmarks are all precious to me, they make me become mentally closer to their sender. I can tell a lot about each and every postcad and I am very moved. Man is victorious, haiku is victorious, in the end we are all victorious and for that I thank you cordially.</p>
                    <p class="info-about-author">Author: Krzysztof Kokot</p>
                    <p class="info-about-author">Translation: Dariusz Klich</p>
                    <hr class="hr-big">
                    <h4>Polish:</h4>
                    <hr class="mt-3">
                    <p class="info-about">O projekcie <q>Łączy nas haiku</q>:</p>
                    <p class="info-about">Pomysł projektu, polegającego na wysyłaniu widokówek ze swojego miejsca zamieszkania z dodanym na rewersie własnym – odręcznie napisanym - haiku chodził mi po głowie od dłuższego czasu. Nie miałem jednak odwagi na jego realizację. Kiedy podjąłem decyzję, myślałem tylko o bliskich znajomych z którymi utrzymywałem bieżący kontakt.</p>
                    <p class="info-about">Los chciał inaczej. Nałożyły się na siebie życzliwość ludzka i pandemia koronawirusa.</p>
                    <p class="info-about">Bez moich próśb, przyjaciele rozpropagowali projekt na cały świat. Pierwsza kartka nadeszła 1 lutego, potem następne. W marcu nastąpiło załamanie spowodowane pandemią, które trwa do dziś. Przychodzą kartki, które w drodze były 100 dni, zmęczone, biedne, ale zwycięskie.</p>
                    <p class="info-about">Ile ich jeszcze tkwi w pocztowych workach?</p>
                    <p class="info-about">Wysłanie pocztówki, to prosta czynność, jednak to się tylko tak wydaje. Prócz wydatku natury finansowej dochodzi jeszcze poświęcony czas na napisanie i znalezienie skrzynki pocztowej. Czasem sam zakup widokówki jest wyzwaniem! Mnie najbardziej interesował aspekt ludzki. Komu się będzie chciało przekazać mi odrobinę swego serca, myśli, swojej empatii? Nie zawiodłem się. Otrzymane widokówki przemawiają do mnie swoim obrazem, napisanym odręcznie haiku. Charakter pisma, znaczek i stempel pocztowy, czasem pozaginane rogi są dla mnie cenne, zbliżają mentalnie z nadawcą. O każdej pojedynczej kartce mogę sporo powiedzieć i zawsze bardzo się wzruszam. Wygrał człowiek, wygrało haiku, a ostatecznie wygraliśmy wszyscy, za co Wam serdecznie dziękuję.</p>
                    <p class="info-about-author">Autor: Krzysztof Kokot</p>
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
