<?php
    require_once "../config/config.php";
    require_once "../utils/encryption.php";
    require_once "db_connect.php";

    $sql = 'SELECT author_name, author_surname, author_country FROM authors;';
    $result = $conn->query($sql);
    

    if($result == NULL)
    {
        echo '<table class="table table-hover table-striped table-bordered">';
        echo '<thead><tr><th>Firstname</th><th>Surname</th><th>Country</th></tr></thead>';
        echo '<tbody><tr><td></td><td></td><td></td></tr></tbody></table>';
    }
    else
    {
        echo '<table class="table table-hover table-striped table-bordered">';
        echo '<thead><tr><th>Firstname</th><th>Surname</th><th>Country</th></tr></thead>';
        echo '<tbody>';
        while($show = $result -> fetch())
        {
            echo '<tr><td>'.$show['author_name'].'</td><td>'.$show['author_surname'].'</td><td>'.$show['author_country'].'</td></tr>';
        }
        echo '</tbody></table>';
    }
?>