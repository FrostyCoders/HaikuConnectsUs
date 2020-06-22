<?php
    // CHECK THAT USER EXIST
    function user_exist($id, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->bindParam(":id", $id);
        try
        {
            $stmt->execute();
        }
        catch(Excaption $e)
        {
            return false;
        }
        if($stmt->rowCount() == 0)
        {
            return false;
        }
        elseif($stmt->rowCount() == 1)
        {
            return true;
        }
    }
    // CHECK THAT USER WITH NEW EMAIL EXIST
    function email_exist($email, $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        try
        {
            $stmt->execute();
        }
        catch(Excaption $e)
        {
            return NULL;
        }
        if($stmt->rowCount() != 0)
        {
            return false;
        }
        elseif($stmt->rowCount() == 1)
        {
            return true;
        }
    }    
    // MAIN
    session_start();
    if (!isset($_POST['new_email']))
    { 		
        header('Location: index.php');
        exit();
    }
    $new_email = $_POST['new_email'];
    $user_id = $_SESSION['user_id'];
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['result'] = "Invalid email address entered!";
    }
    else
    {
        require_once "connect.php";
        if(!user_exist($user_id, $conn)){$_SESSION['result'] = "Error occured!"};
        else
        {
            if(email_exist($new_email, $conn) == NULL){$_SESSION['result'] = "Error occured!";}
            elseif(email_exist($new_email, $conn) == true){$_SESSION['result'] = "Your new email is already in use by another user!";}
            else
            {
                
            }
        }
    }
?>