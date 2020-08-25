<?php
    session_start();
    if(!isset($_SESSION['logged_user']))
    {
        die(json_encode([false, "Error, you need to login before edit haiku!"]));
    }
    else if(!isset($_POST['haiku_id']) || !is_numeric($_POST['haiku_id']))
    {   
        die(json_encode([false, "Error, missing or wrong data required to edit haiku!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "../utils/logs.php";
        require_once "db_connect.php";
        
        $haiku_exist = $conn->prepare("SELECT *
                                        FROM haiku
                                        WHERE id = :hid");
        try
        {
            $haiku_exist->bindParam(":hid", $_POST['haiku_id']);
            $haiku_exist->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot get info about haiku: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot edit haiku, try later!"]));
        }

        if($haiku_exist->rowCount() != 1)
        {
            die(json_encode([false, "Error, cannot find searched haiku to edit!"]));
        }

        $old_data = $haiku_exist->fetch();
        
        if(isset($_POST['haiku_author']))
        {
            if($_POST['haiku_author'] != $old_data['author']) $new_author = $_POST['haiku_author'];
            else $new_author = $old_data['author'];
        }
        else $new_author = $old_data['author'];

        if(isset($_POST['haiku_content']))
        {
            $content = json_decode($_POST['haiku_content']);
            if(json_last_error() != 0)
            {
                die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
            }
            if(count($content) != 0)
                $new_content = nl2br(implode('', $content));
            else
                $new_content = $old_data['content'];
        }
        else 
            $new_content = $old_data['content'];

        if(isset($_POST['haiku_c_native']))
        {
            $c_native = json_decode($_POST['haiku_c_native']);
            if(json_last_error() != 0)
            {
                die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
            }
            if(count($c_native) != 0)
                $new_c_native = nl2br(implode('', $c_native));
            else
                $new_c_native = "NO";
        }
        else $new_c_native = $old_data['content_native'];

        $allowed_ext = array("jpg", "png", "jpeg", "bmp");
        if(isset($_FILES['bg_image']) && $_FILES['bg_image']['error'] !== 4)
        {
            $background = $_FILES['bg_image'];
            if($background['error'] !== 0 || $background['size'] == 0)
            {
                die(json_encode([false, "Error, problem with background image, check it and try later!"]));
            }
            
            $bg_ext = explode('.', $background['name']);
            $bg_ext = end($bg_ext);
            $bg_ext = strtolower($bg_ext);

            if(!in_array($bg_ext, $allowed_ext))
            {
                die(json_encode([false, "Error, you cannot add this type of file for background image!"]));
            }

            if($background['size'] > 10485760)
            {
                die(json_encode([false, "Error, size of uploaded background image file is too big!"]));
            }

            $bg_tmp_name = $background['tmp_name'];
            $bg_new_name = uniqid('', true) . "." . $bg_ext;
            $bg_destination = BG_DIR . $bg_new_name;

            if(!move_uploaded_file($bg_tmp_name, $bg_destination))
            {
                saveToLog(0, "Cannot move uploaded file: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                die(json_encode([false, "Error, cannot update haiku, try later!"]));
            }

            if(file_exists(BG_DIR . $old_data['background']) && $old_data['background'] != "default.png") unlink(BG_DIR . $old_data['background']);
        }
        else 
            $bg_new_name = $old_data['background'];
            

        if(isset($_FILES['hw_image']) && $_FILES['hw_image']['error'] !== 4)
        {
            $handwriting = $_FILES['hw_image'];
            if($handwriting['error'] !== 0 || $handwriting['size'] == 0)
            {
                die(json_encode([false, "Error, cannot update haiku, try later!"]));
            }

            $hw_ext = explode('.', $handwriting['name']);
            $hw_ext = end($hw_ext);
            $hw_ext = strtolower($hw_ext);

            if(!in_array($hw_ext, $allowed_ext))
            {
                die(json_encode([false, "Error, you cannot add this type of file for handwriting image!"]));
            }

            if($handwriting['size'] > 10485760)
            {
                die(json_encode([false, "Error, size of uploaded handwriting image file is too big!"]));
            }

            $hw_tmp_name = $handwriting['tmp_name'];
            $hw_new_name = uniqid('', true) . "." . $hw_ext;
            $hw_destination = HW_DIR . $hw_new_name;

            if(!move_uploaded_file($hw_tmp_name, $hw_destination))
            {
                saveToLog(0, "Cannot move uploaded file: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                die(json_encode([false, "Error, cannot update haiku, try later!"]));
            }

            if(file_exists(HW_DIR . $old_data['handwriting']) && $old_data['handwriting'] != "no_hw.jpg") unlink(HW_DIR . $old_data['handwriting']);
        }
        else
            $hw_new_name = $old_data['handwriting'];

        $query_update = $conn->prepare("UPDATE haiku SET
                                        author = :aid,
                                        content = :content,
                                        content_native = :c_native,
                                        background = :bg,
                                        handwriting = :hw
                                        WHERE id = :hid
                                        ");

        try
        {
            $query_update->bindParam(":aid", $new_author);
            $query_update->bindParam(":content", $new_content);
            $query_update->bindParam(":c_native", $new_c_native);
            $query_update->bindParam(":hid", $_POST['haiku_id']);
            $query_update->bindParam(":bg", $bg_new_name);
            $query_update->bindParam(":hw", $hw_new_name);
            $query_update->execute();
            echo json_encode([true, "Haiku updated successfully!"]);
        }
        catch(Exception $e)
        {   
            saveToLog(0, "Cannot modify haiku: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot update haiku content, try later!"]));
        }
    }
?>