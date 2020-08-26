<?php
    if(!isset($_POST['hid']) || !isset($_POST['image']))
        die(json_encode([false, "Error, missing or wrong data, try again!"]));
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";
        require_once "../utils/logs.php";

        $haiku = $_POST['hid'];
        $image = $_POST['image'];

        $check = $conn->prepare("SELECT background, handwriting FROM haiku WHERE id = :id");

        try
        {
            $check->bindParam(":id", $haiku);
            $check->execute();
        }
        catch(Exception $e)
        {
            saveToLog(0, "Cannot check that haiku exist: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
            die(json_encode([false, "Error, cannot delete haiku image, try later!"]));
        }

        if($check->rowCount() == 0)
            die(json_encode([false, "Error, incorrect data, try later!"]));
        else
        {
            $current = $check->fetchAll();
            $action = false;
            if($image == "bg")
            {
                $curr_bg = $current[0]['background'];
                if($curr_bg != "default.png")
                {   
                    $action = true;
                    $sql = "UPDATE haiku SET background = 'default.png' WHERE id = :id";
                }   
            }
            else if($image == "hw")
            {
                $curr_hw = $current[0]['handwriting'];
                if($curr_hw != "now_hw.jpg")
                {   
                    $action = true;
                    $sql = "UPDATE haiku SET handwriting = 'no_hw.jpg' WHERE id = :id";
                } 
            }
            else
                die(json_encode([false, "Error, incorrect data, try later!"]));

            if($action == true)
            {
                $update = $conn->prepare($sql);
                try
                {
                    $update->bindParam(":id", $haiku);
                    $update->execute();
                    $query_ok = true;
                }
                catch(Exception $e)
                {
                    saveToLog(0, "Cannot update haiku image: " . $e, realpath(".") . "\\" .  basename(__FILE__), __LINE__);
                    die(json_encode([false, "Error, cannot delete haiku image, try later!"]));
                }
                
                if($query_ok == true)
                {
                    if($image == "bg")
                    {
                        if(file_exists(BG_DIR . $curr_bg))
                            unlink(BG_DIR . $curr_bg);
                    }
                    else if($image == "hw")
                    {
                        if(file_exists(HW_DIR . $curr_hw))
                            unlink(HW_DIR . $curr_hw);
                    }
                }
            }

            unset($conn);
            die(json_encode([true, "Image deleted successfully!"]));
        }
    }
?>