<?php
    // Website url address (e.g. https://mypage.com)
    define('SITE_URL', 'http://localhost/haiku');
    
    // DB info 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'haiku');

    // ENCRYPTION KEYS
    define('CKEY1', '<[!m]_XW(N\|@c>ET4l-GKO/Sj~}1D?Y'."'".'Ufit.g#aqp&^L"bvwCxH0k7JM2$hR%+Z)AVo93{8,Q:e*Ps;d`nz6IB=yru5F');
    define('CKEY2', '%-\&RAk}?frljv/oy46#u@NQ=C2Wx~|hYesdXSbw."m5+V]$M`>(F!DG)_UIc[P^<z,'."'".'*9a8H;O:0JnTpt1BZ{iK3gE7Lq');

    // FILE UPLOADS DIRECTORIES
    define('HW_DIR', realpath("../uploads/handwriting/") . '\\');
    define('BG_DIR', realpath("../uploads/background/") . '\\');

    // ERR LOG DIRECTORY
    define('ERR_DIR', "../logs/");
?>