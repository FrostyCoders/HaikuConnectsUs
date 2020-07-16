<?php
    session_start();
    $_SESSION['logged_user'] = true;
    if(!isset($_SESSION['logged_user']))
    {
        die(json_encode([false, "Error, you need to login in order to add haiku!"]));
    }
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";

        if(!isset($_POST['author']) || !isset($_POST['title']) || !isset($_POST['content']) || !isset($_POST['content_native']) || !isset($_FILES['content_native']))
        {
            die(json_encode([false, "Error, missing data, fill all required inputs!"]));
        }
        else
        {
            $author = $_POST['author'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $c_native = $_POST['content_native'];
            $bg_image = $_FILES['background'];

            if(empty($title) || empty($content) || empty($c_native))
            {
                die(json_encode([false, "Error, fill all required data!"]));
            }

            if($bg_image['error'] !== 0 || $bg_image['size'] == 0)
            {
                die(json_encode([false, "Error, cannot add haiku, try later!"]));
            }

            $allowed_ext = array("jpg", "png", "jpeg", "bmp");
            $file_ext = strtolower(end(explode('.', $bg_image['name'])));

            if(!in_array($file_ext, $allowed_ext))
            {
                die(json_encode([false, "Error, you cannot add this type of file!"]));
            }

            if($bg_image['size'] < 10485760)
            {
                die(json_encode([false, "Error, size of uploaded file is too big!"]));
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
            die(json_encode([false, "Error, cannot add haiku due to the connection error, try later!"]));
        }

        if($author_exists->rowCount() == 0)
        {
            die(json_encode([false, "Error, cannot find given author!"]));
        }

        $file_tmp_name = $bg_image['tmp_name'];
        $file_new_name = uniqid('', true) . "." . $file_ext;
        $file_destination = "../uploads/" . $file_new_name;

        if(!move_uploaded_file($file_tmp_name, $file_destination))
        {
            die(json_encode([false, "Error, cannot add haiku, try later!"]));
        }
        
        $query = $conn->prepare("INSERT INTO haiku VALUES
                                (NULL, :aid, :title, :content, :c_native, 0, :bg, NULL);
        ");

        $content = json_decode($content);
        if(json_last_error() != 0)
        {
            die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
        }
        $c_native = json_decode($c_native);
        if(json_last_error() != 0)
        {
            die(json_encode([false, "Error, cannot add haiku in right way, try later!"]));
        }
        $content = nl2br(implode('', $content));
        $c_native = nl2br(implode('', $c_native));

        try 
        {
            $query->bindParam(":aid", $author);
            $query->bindParam(":title", $title);
            $query->bindParam(":content", $content);
            $query->bindParam(":c_native", $c_native);
            $query->bindParam(":bg", $file_new_name);
            $query->execute();
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, cannot add haiku due to the connection error, try later!"]));
        }
        
        echo json_encode(true, "New haiku added succsessfully.");
    }
?>