<?php
    require_once "../config/config.php";
    require_once "../resources/db_connect.php";
    require_once "../utils/encryption.php";
    require_once "../utils/decryption.php";
    require_once "../utils/password.php";

    if(isset($_POST['add']));
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $OK = true;

        if(strlen($username) < 3)
        {
            $OK = false;
            echo "Minimal lenght of username is 3 characters!<br>";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $OK = false;
            echo "Email is not valid!<br>";
        }

        $passwords = validate_passwords($pass1, $pass2);
        if($passwords[0] != true)
        {
            $OK = false;
            echo $passwords[1] . "<br>";
        }

        if($OK == true)
        {
            $check = "SELECT email FROM users";
            $check = $conn->prepare($check);
            try
            {
                $check->execute();
            }
            catch(Exception $e)
            {
                die("There is problem with DB connection, user not added!");
            }

            $check = $check->fetchAll();

            foreach($check as $user)
            {
                if(decrypt_email($user['email'], CKEY1) == $email)
                die("User with that email already exist!");
            }

            $add_user = "INSERT INTO users VALUES (NULL, :username, :email, :password, '0000-00-00')";
            $add_user = $conn->prepare($add_user);
            $email = encrypt_email($email, CKEY1);
            $add_user->bindParam(":email", $email);
            $add_user->bindParam(":username", $username);
            $pass1 = encrypt_pass($pass1, CKEY2);
            $add_user->bindParam(":password", $pass1);

            try
            {
                $add_user->execute();
            }
            catch(Exception $e)
            {
                die("There is problem with DB connection, user not added!");
            }

             echo "User added successfully";

            unset($conn);
        }
    }

    echo '<br><a href="create_new_user.php">Go back</a>';
?>