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
        require_once "db_connect.php";
        
        $haiku_exist = $conn->prepare("SELECT *
                                        FROM haiku
                                        WHERE haiku.id = :hid");
        try
        {
            $haiku_exist->bindParam(":hid", $_POST['haiku_id']);
            $haiku_exist->execute();
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, cannot edit haiku, try later!"]));
        }

        if($haiku_exist->rowCount() != 1)
        {
            die(json_encode([false, "Error, cannot find searched haiku to edit!"]));
        }

        $edit_haiku = $haiku_exist->fetch();
        
        if(isset($_POST['haiku_author']))
        {
            if($_POST['haiku_id'] != $edit_haiku['id']) $new_author = $_POST['haiku_id'];
            else $new_author = $edit_haiku['id'];
        }
        else $new_author = $edit_haiku['id'];

        if(isset($_POST['haiku_title']))
        {
            if($_POST['haiku_title'] != $edit_haiku['title']) $new_title = $_POST['haiku_title'];
            else $new_title = $edit_haiku['title'];
        }
        else $new_title = $edit_haiku['title'];

        if(isset($_POST['haiku_content']) && !empty($_POST['haiku_content']))
        {
            $content = json_decode($_POST['haiku_content']);
            if(json_last_error() != 0)
            {
                die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
            }
            $new_content = nl2br(implode('', $content));
        }
        else $new_content = $edit_haiku['content'];

        if(isset($_POST['haiku_c_native']) && !empty($_POST['haiku_c_native']))
        {
            $c_native = json_decode($_POST['haiku_c_native']);
            if(json_last_error() != 0)
            {
                die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
            }
            $new_content = nl2br(implode('', $c_native));
        }
        else $new_c_native = $edit_haiku['content_native'];

        $allowed_ext = array("jpg", "png", "jpeg", "bmp");
        if(isset($_FILES['haiku_bg']) && $_FILES['haiku_bg']['error'] != 4)
        {
            $background = $_FILES['haiku_bg'];
            if($background['error'] !== 0 || $background['size'] == 0)
            {
                die(json_encode([false, "Error, cannot add haiku, try later!"]));
            }

            
            $bg_ext = strtolower(end(explode('.', $background['name'])));

            if(!in_array($bg_ext, $allowed_ext))
            {
                die(json_encode([false, "Error, you cannot add this type of file for background image!"]));
            }

            if($background['size'] < 10485760)
            {
                die(json_encode([false, "Error, size of uploaded background image file is too big!"]));
            }

            $bg_tmp_name = $background['tmp_name'];
            $bg_new_name = $edit_haiku['background'];
            $bg_destination = BG_DIR . $bg_new_name;
            
            if(file_exists("../uploads/" . $edit_haiku['background'])) unlink("../uploads/" . $edit_haiku['background']);

            if(!move_uploaded_file($bg_tmp_name, $bg_destination))
            {
                die(json_encode([false, "Error, cannot update haiku, try later!"]));
            }
        }

        if(isset($_FILES['haiku_hw']) && $_FILES['haiku_hw']['error'] != 4)
        {
            $handwriting = $_FILES['haiku_hw'];
            if($handwriting['error'] !== 0 || $handwriting['size'] == 0)
            {
                die(json_encode([false, "Error, cannot add haiku, try later!"]));
            }

            
            $hw_ext = strtolower(end(explode('.', $handwriting['name'])));

            if(!in_array($hw_ext, $allowed_ext))
            {
                die(json_encode([false, "Error, you cannot add this type of file for handwriting image!"]));
            }

            if($handwriting['size'] < 10485760)
            {
                die(json_encode([false, "Error, size of uploaded handwriting image file is too big!"]));
            }

            $hw_tmp_name = $handwriting['tmp_name'];
            $hw_new_name = $edit_haiku['handwriting'];
            $hw_destination = HW_DIR . $hw_new_name;
            
            if(file_exists("../uploads/" . $edit_haiku['handwriting'])) unlink("../uploads/" . $edit_haiku['handwriting']);

            if(!move_uploaded_file($hw_tmp_name, $hw_destination))
            {
                die(json_encode([false, "Error, cannot update haiku, try later!"]));
            }
        }

        $query_update = $conn->prepare("UPDATE haiku SET
                                        author = :aid,
                                        title = :title,
                                        content = :content,
                                        content_native = :c_native
                                        WHERE id = :hid
                                        ");

        try
        {
            $query_update->bindParam(":aid", $new_author);
            $query_update->bindParam(":title", $new_title);
            $query_update->bindParam(":content", $new_content);
            $query_update->bindParam(":c_native", $new_c_native);
            $query_update->bindParam(":hid", $_POST['haiku_id']);
            $query_update->execute();
            echo json_encode([false, "Haiku updated successfully!"]);
        }
        catch(Exception $e)
        {   
            die(json_encode([false, "Error, cannot update haiku content, try later!"]));
        }
    }
?>