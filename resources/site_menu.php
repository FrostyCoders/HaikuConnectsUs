<?php
    session_start();
    if(isset($_SESSION['logged_user']))
    {
        $menu_positions = array(
            'Start' => 'index.php',
            'Authors List' => 'authors_list.php',
            'Authors Map' => 'authors_map.php',
            'About The Project' => 'about_the_project.php',
            'Reports' => 'reports_list.php',
            'Add Haiku' => 'add_haiku.php'
        );

        $user = '
        <li class="nav-item nav-icon" id="nav-icons">
            <a class="nav-link"><div class="avatar-nav-icon"></div></a>
            <div id="nav-link-icon-container">
            <a class="nav-link nav-link-icon" id="nav-link-icon1" href="settings.php"><div class="gear-nav-icon" title="settings"></div></a>
            <a class="nav-link nav-link-icon" id="nav-link-icon2" href="../resources/user_logout.php"><div class="logout-nav-icon" title="logout"></div></a>
            </div>
        </li>
        ';
    }
    else
    {
        $menu_positions = array(
            'Start' => 'index.php',
            'Authors List' => 'authors_list.php',
            'Authors Map' => 'authors_map.php',
            'About The Project' => 'about_the_project.php'
        );

        $user = '
        <li class="nav-item nav-icon" id="nav-icons">
            <a class="nav-link" href="login.php"><div class="avatar-nav-icon"></div></a>
        </li>
        ';
    }

    foreach ($menu_positions as $name => $link) {
        echo '<li class="nav-item active"><a class="nav-link nav-text" href="' . $link . '">' . $name . '</a></li>';
    }

    echo $user;
?>