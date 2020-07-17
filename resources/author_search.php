<?php
    if(!isset($_POST['search']))
    {
        $result = array(false, "Error, missing or wrong data, try later!");
    }
    else
    {
        require_once "../config/condif.php";
        require_once "../utils/decryption.php";
        require_once "db_connect.php";
        $phrase = $_POST['search'];

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
            $authors = $query->fetch();
            $authors_list = array();
            foreach($authors as $a)
            {
                $full_name = $name . " " . $surname;
                if(strstr($full_name, $phrase))
                {   
                    array_push($authors_list, array(
                        "id" => $a['id'],
                        "fname" => $full_name,
                        "country" => $a['country']
                    ));
                }
            }

            usort($authors_list, "fname");

            if(count($authors_list == 0))
            {
                $result = array(false, "Cannot find this author!");
            }
            else
            {
                $result = array(true, $authors_list);
            }
        }
    }
    echo json_encode($result);
?>