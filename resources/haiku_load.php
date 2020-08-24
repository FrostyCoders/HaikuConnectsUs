<?php
    require_once "../config/config.php";
    require_once "../utils/decryption.php";
    require_once "db_connect.php";
    
    if(!isset($_POST['page']) || empty($_POST['page'])) $result = array(false, "Error, missing or wrong data, try later!");
    else
    {
        if(!isset($_POST['order']) || empty($_POST['order'])) $query_order = " ORDER BY haiku_add_time DESC";
        else
        {
            switch($_POST['order'])
            {
                case "newest":
                {
                    $query_order = " ORDER BY haiku.add_time DESC";
                    break;
                }
                case "oldest":
                {
                    $query_order = " ORDER BY haiku.add_time ASC";
                    break;
                }
                case "popularity":
                {
                    $query_order = " ORDER BY haiku.like_counter DESC";
                    break;
                }
                case "random":
                {
                    $query_order = " ORDER BY RAND()";
                    break;
                }
                default:
                {
                    $query_order = " ORDER BY haiku.add_time DESC";
                    break;
                }
            }
        }

        if(!isset($_POST['ammount']) || empty($_POST['ammount'])) $query_ammount = 10;
        else $query_ammount = $_POST['ammount'];

        if(isset($_POST['author']) && $_POST['author'] != 0) $query_author = " WHERE author = " . $_POST['author'];
        else $query_author = "";

        $query = $conn->prepare("SELECT haiku.*, authors.name, authors.surname, authors.country
                                FROM haiku
                                INNER JOIN authors ON authors.id = haiku.author"
                                . $query_author
                                . $query_order);
                                
        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, '<p class="load-error">Error, cannot load haiku data!</p>');
            $query_ok = false;
            saveToLog(0, "Cannot get haiku from DB: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
        }
        
        if($query_ok == true)
        {
            $pages_ammount = ceil($query->rowCount()/$query_ammount);
            $page_range_begin = ($_POST['page'] - 1) * $query_ammount;
            $page_range_end = $_POST['page'] * $query_ammount;
            
            $haiku = $query->fetchAll();
            $current_haiku = 0;
            $exported_haiku = array();

            foreach($haiku as $h)
            {
                if($current_haiku >= $page_range_begin && $current_haiku < $page_range_end)
                {
                    $full_name = decrypt_data($h['name'], CKEY4) . " " . @decrypt_data($h['surname'], CKEY5);
                    array_push($exported_haiku, array(
                        'id' => $h['id'],
                        'author' => $full_name,
                        'country' => $h['country'],
                        'content' => $h['content'],
                        'content_native' => $h['content_native'],
                        'likes' => $h['like_counter'],
                        'bg' => $h['background'],
                        'hw' => $h['handwriting']
                    ));
                }
                $current_haiku++;
            }
            $result = array(true, $pages_ammount, $exported_haiku);
        }
    }
    echo json_encode($result);
?>