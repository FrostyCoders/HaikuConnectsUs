<?php
    if(!isset($_POST['search']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
        $phrase = $_POST['search'];

        if(empty($phrase))
        {
            die(json_encode([false, "Type to search author."]));
        }

        $query = $conn->prepare("SELECT * FROM authors");

        try
        {
            $query->execute();
            $query_ok = true;
        }
        catch(Exception $e)
        {
            $result = array(false, "Error, Cannot load authors data!");
            $query_ok = false;
        }

        if($query_ok == true)
        {
            $authors = $query->fetchAll();
            $authors_list = array();
            foreach($authors as $a)
            {
                $full_name = decrypt_data($a['name'], CKEY4) . " " . decrypt_data($a['surname'], CKEY5);
                if(strstr($full_name, $phrase))
                {   
                    array_push($authors_list, array(
                        "id" => $a['id'],
                        "fname" => $full_name,
                        "country" => $a['country']
                    ));
                }
            }

            //array_multisort($authors_list, SORT_REGULAR, );

            if(count($authors_list) == 0)
            {
                $result = array(false, "Nobody was found!");
            }
            else
            {
                $result = array(true, $authors_list);
            }
        }
    }
    echo json_encode($result);
?>