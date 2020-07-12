<?php
    require_once "../config/config.php";
    require_once "../utils/decryption.php";
    require_once "db_connect.php";
    
    if(!isset($_POST['page']) || empty($_POST['page'])) $result = array(false, "Error, missing or wrong data, try later!");
    else
    {
        if(!isset($_POST['order']) || empty($_POST['order'])) $query_order = "ORDER BY haiku_add_time DESC";
        else
        {
            switch($_POST['order'])
            {
                case "newest":
                {
                    $query_order = "ORDER BY haiku_add_time DESC";
                    break;
                }
                case "oldest":
                {
                    $query_order = "ORDER BY haiku_add_time ASC";
                    break;
                }
                case "popularity":
                {
                    $query_order = "ORDER BY haiku_likes ASC";
                    break;
                }
                case "random":
                {
                    $query_order = "ORDER BY RAND()";
                    break;
                }
                default:
                {
                    $query_order = "ORDER BY haiku_add_time DESC";
                    break;
                }
            }
        }

        if(!isset($_POST['ammount']) || empty($_POST['ammount']) || $_POST['ammount'] != 10 || $_POST['ammount'] != 20 || $_POST['ammount'] != 50) $query_ammount = 10;
        else $query_ammount = $_POST['ammmount'];

        if(isset($_POST['author']) && $_POST['author'] != 0) $query_author = "WHERE haiku_author = " . $_POST['author'];
        else $query_author = "";

        $query = $conn->prepare("SELECT haiku.*, authors.name, authors.surname, authors.country
                                FROM haiku
                                INNER JOIN authors ON author.id = haiku.author"
                                . $query_author
                                . $query_order);
        
        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, Cannot load haiku data!");
            $query_ok = false;
        }
        
        if($query_ok == true)
        {
            $pages_ammount = round($query->rowCount()/$query_ammount, 0, PHP_ROUND_HALF_UP);
            $haiku = $query->fetch();
            $how_many = 0;
            $exported_haiku = array();
            foreach($haiku as $h)
            {
                if($how_many < $query_ammount)
                {
                    array_push($exported_haiku, array(
                        $h['haiku.id'],
                        decrypt_data($h['authors.name'], CKEY4) . " " . decrypt_data($h['authors.surname'], CKEY5),
                        $h['author.country'],
                        $h['haiku.title'],
                        $h['haiku.content'],
                        $h['haiku.content_native'],
                        $h['haiku.like_counter'],
                        $h['haiku.background']
                    ));
                }
                else break;
            }
            $result = array(true, $pages_ammount, $exported_haiku);
        }
    }
    echo json_encode($result);
?>