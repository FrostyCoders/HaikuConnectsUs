<?php
    // Website url address (e.g. https://mypage.com)
    define('SITE_URL', 'localhost');
    
    // DB info 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'haiku');

    // ENCRYPTION KEYS
    define('CKEY1', 'pK*wZk`"IQxy?|7oFX2Bmn;fu6cUE]-s9Jt5N@#YDLz=R.^O_d'."'".'i$31hP%>S()gq+CG{TvA0}<!/HjVe~&8\Mar4:,blW[');
    define('CKEY2', 'P}8h|G]0*j1[6D!W\+o_r:%x(iMem$425>~HdRAVup"UtY#9zLvcy<3/{NO@g=C-fSEk.7;lBsI&)X^Z`wJTK,?q'."'".'naQbF');

    // FILE UPLOADS DIRECTORIES
    define('HW_DIR', realpath("../uploads/handwriting/") . '/');
    define('BG_DIR', realpath("../uploads/background/") . '/');

    // ERR LOG DIRECTORY
    define('ERR_DIR', realpath("../logs/") . '/');

    // MAIL OPTIONS
    define('MAIL_FROM', "");
?>