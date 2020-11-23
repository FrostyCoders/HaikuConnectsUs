<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new user</title>
</head>
<body>
    <p>Add new admin to app script. Remember to always delete whole /tmp directory after using it.</p>
    <form action="add_user_script.php" method="post">
        <table>
            <tr>
                <td>Username:</td><td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>User e-mail:</td><td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td>User password:</td><td><input type="password" name="pass1" required></td>
            </tr>
            <tr>
                <td>Type password again:</td><td><input type="password" name="pass2" required></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" value="Add new admin" name="add"></td>
            </tr>
        </table>
    </form>
</body>
</html>