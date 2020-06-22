<?php
    require_once "../crypt/encryption.php";
    // VALIDATE PASSWORDS
    function validate_passwords($n, $r)
    {
        if(empty($n) || empty($r))
        {
            return 1;
        }
        if(strcmp($n, $r) !== 0)
        {
            return 2;
        }
        $uppercase = preg_match('@[A-Z]@', $n);
        $lowercase = preg_match('@[a-z]@', $n);
        $number = preg_match('@[0-9]@', $n);
        $special = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $n);
        if(!$uppercase || !$lowercase || !$number || !$special || strlen($n) < 8)
        {
            return 3;
        }
        return 0;
    }
    // UPDATE PASSWORD IN DB
    function update_password($pass, $user, $key_id, $conn)
    {
        $stmt = $conn->prepare("UPDATE users SET password = :new_pass WHERE user_id = :user_id");
        $stmt->bindParam(":new_pass", $pass);
        $stmt->bindParam(":user_id", $user);
        $stmt2 = $conn->prepare("UPDATE forgot_password SET used = 1 WHERE request_id = :id");
        $stmt2->bindParam(":id", $_SESSION['key_id']);
        try
        {
            $stmt2->execute();
            $stmt->execute();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    // MAIN
    session_start();
    if (!isset($_POST['new_pass']) || !isset($_POST['repeat_pass']))
    { 		
        header('Location: index.php');
        exit();
    }
    $n_password = $_POST['new_pass'];
    $r_password = $_POST['repeat_pass'];
    switch(validate_passwords($n_password, $r_password))
    {
        case 0:
        {
            require_once "../connect.php";
            $n_password = encrypt_pass($n_password, $ckey2);
            if(update_password($n_password, $_SESSION['user_id'], $_SESSION['key_id'], $conn))
            {
                $_SESSION['result'] = "Password changed!";
            }
            else
            {
                $_SESSION['result'] = "Error occured! Passwort hasn't changed.";
            }
            break;
        }
        case 1:
        {
            $_SESSION['result'] = "You have to fill both inputs!";
            break;
        }
        case 2:
        {
            $_SESSION['result'] = "Passwords don't match!";
            break;
        }
        case 3:
        {
            $_SESSION['result'] = "Your new password doesn't meet the requirements!";
            break;
        }
    }
    header('Location: index.php'); 		
    exit();
?>