<?php
    session_start();
    if(!isset($_SESSION['logged_user']))
    {
        die(json_encode([false, "Error, you need to login in order to add haiku!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";

        if(!isset($_POST['author']) || !isset($_POST['content']) || !isset($_POST['content_native']) || !isset($_FILES['bg_image']) || !isset($_FILES['hw_image']))
        {
            die(json_encode([false, "Error, missing data, fill all required inputs!"]));
        }
        else
        {
            $author = $_POST['author'];

            if(empty($author) || !is_numeric($author))
            {
                die(json_encode([false, "Error, you must choose haiku author from search list!"]));
            }

            $content = $_POST['content'];

            if(empty($content))
            {
                die(json_encode([false, "Error, fill all required data!"]));
            }

            if(count(json_decode($_POST['content_native'])) == 0) $c_native = json_encode(["N", "O"]);
            else $c_native = $_POST['content_native'];

            $allowed_ext = array("jpg", "png", "jpeg", "bmp");

            $handwriting = $_FILES['hw_image'];

            if($handwriting['error'] !== 0 && $handwriting['error'] !== 4)
            {
                die(json_encode([false, "Error, problem with handwriting image, check it and try again!"]));
            }
            else if($handwriting['error'] === 4)
            {
                $hw_new_name = "no_hw.jpg";
            }
            else
            {
                $hw_ext = explode('.', $handwriting['name']);
                $hw_ext = end($hw_ext);
                $hw_ext = strtolower($hw_ext);
                if(!in_array($hw_ext, $allowed_ext))
                {
                    die(json_encode([false, "Error, you cannot add this type of file in handwriting image!"]));
                }

                if($handwriting['size'] > 10485760)
                {
                    die(json_encode([false, "Error, size of uploaded handwriting image file is too big!"]));
                }

                $hw_tmp_name = $handwriting['tmp_name'];
                $hw_new_name = uniqid('', true) . "." . $hw_ext;
                $hw_destination = HW_DIR . $hw_new_name;

                if(file_exists($hw_destination))
                {
                    saveToLog(1, "File already exist: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                    die(json_encode([false, "Error, something went wrong during file upload, try again!"]));
                }

                if(!move_uploaded_file($hw_tmp_name, $hw_destination))
                {
                    saveToLog(0, "Cannot move uploaded file: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                    die(json_encode([false, "Error, cannot add haiku, try later!"]));
                }
            }

            $background = $_FILES['bg_image'];

            if($background['error'] !== 0 && $background['error'] !== 4)
            {
                die(json_encode([false, "Error, problem with background image, check it and try again!"]));
            }
            else if($background['error'] === 4)
            {
                $bg_new_name = "default.png";
            }
            else
            {
                $bg_ext = explode('.', $background['name']);
                $bg_ext = end($bg_ext);
                $bg_ext = strtolower($bg_ext);
                if(!in_array($bg_ext, $allowed_ext))
                {
                    die(json_encode([false, "Error, you cannot add this type of file in background image!"]));
                }

                if($background['size'] > 10485760)
                {
                    die(json_encode([false, "Error, size of uploaded background image file is too big!"]));
                }

                $bg_tmp_name = $background['tmp_name'];
                $bg_new_name = uniqid('', true) . "." . $bg_ext;
                $bg_destination = BG_DIR . $bg_new_name;

                if(file_exists($bg_destination))
                {
                    saveToLog(1, "File already exist: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                    die(json_encode([false, "Error, something went wrong during file upload, try again!"]));
                }

                if(!move_uploaded_file($bg_tmp_name, $bg_destination))
                {
                    saveToLog(0, "Cannot move uploaded file: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                    die(json_encode([false, "Error, cannot add haiku, try later!"]));
                }
            }
        }   

        $author_exists = $conn->prepare("SELECT * FROM authors WHERE id = :aid");
        try
        {
            $author_exists->bindParam(":aid", $author);
            $author_exists->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot check that author exist: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot add haiku due to the connection error, try later!"]));
        }

        if($author_exists->rowCount() == 0)
        {
            die(json_encode([false, "Error, cannot find given author!"]));
        }
        
        $current_time = date('Y-m-d H:i:s');

        $query = $conn->prepare("INSERT INTO haiku VALUES
                                (NULL, :aid, :content, :c_native, 0, :bg, :hw, :time);
        ");

        $content = json_decode($content);
        if(json_last_error() != 0)
        {
            saveToLog(0, "Problem with json decoding: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
        }
        $c_native = json_decode($c_native);
        if(json_last_error() != 0)
        {
            saveToLog(0, "Problem with json decoding: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
        }
        $content = nl2br(implode('', $content));
        $c_native = nl2br(implode('', $c_native));

        try 
        {
            $query->bindParam(":aid", $author);
            $query->bindParam(":content", $content);
            $query->bindParam(":c_native", $c_native);
            $query->bindParam(":bg", $bg_new_name);
            $query->bindParam(":hw", $hw_new_name);
            $query->bindParam(":time", $current_time);
            $query->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot add new haiku to DB: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot add haiku due to the connection error, try later!"]));
        }
        
        echo json_encode([true, "New haiku added succsessfully."]);
    }
?>