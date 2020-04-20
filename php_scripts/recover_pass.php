<?php
    function check_rk($recovery_key)
    {
        $key_lenght = 20;
        $recovery_key = preg_replace("/[^a-zA-Z0-9]/", "", $recovery_key);
        if(strlen($recovery_key) != 20)
        {
            return false;
        }
        else
        {
            return $recovery_key;
        }
    }
    // GET USER DATA
    function get_data($key, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM forgot_password WHERE key_series = :key_series AND expire_time > NOW() AND used = 0");
        $stmt->bindParam(":key_series", $key);
        try
        {
            $stmt->execute();
        }
        catch(Exception $e)
        {
            return false;
        }
        if($stmt->rowCount() == 0)
        {
            return 1;
        }
        else
        {
            return $stmt->fetch();
        }
    }
    session_start();
    if(!isset($_GET['rk']))
    {
        header("Location: test_forgot.php");
        exit();
    }
    $recovery_key = $_GET['rk'];
    $recovery_key = check_rk($recovery_key);
    if($recovery_key === false)
    {
        $site = 'Your recovery link is incorrect, try <a href="test_forgot.php">send recovery request</a> once again.';
    }
    else
    {
        require_once "connect.php";
        $recover_data = get_data($recovery_key, $conn);
        switch($recover_data)
        {
            case false:
            {
                $site = "Error occured!";
                break;
            }
            case 1:
            {
                $site = 'Your key might be incorrect or expired. Try create new password reset link.';
                break;
            }
            default:
            {
                $_SESSION['key_id'] = $recover_data['request_id'];
                $_SESSION['user_id'] = $recover_data['user_id'];
                $site = 
                '<form action="change_pass.php" method="post">
                    Nowe hasło: <input type="password" name="new_pass">
                    Powtórz hasło: <input type="password" name="repeat_pass">
                    <input type="submit" value="Zmień">
                </form>';
            }
        }
    }

    echo $site . '<br>';
    unset($conn);
?>