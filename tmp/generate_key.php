<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Key</title>
    <style>
        body
        {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    NEW KEY: <br>
    <?php
        $numbers = array();
        $value = 0;
        for($i = 0; $i < 94; $i++)
        {
                $value = rand(33, 126);
                if(!in_array($value, $numbers, true))
                {
                    $numbers[$i] = $value;
                }
                else
                {
                    $i--;
                    continue;
                }
        }
        for($i = 0; $i < 94; $i++)
        {
            if($numbers[$i] == 39)
                {
                    echo "'." . '"' . "'" . '"' . ".'";
                }
                else
                {
                    echo "&#" . $numbers[$i];
                }
        }
    ?>
    <br>
    <br>
    If you want to generate new key just <a href="" onclick="location.reload();">refresh</a> this site.
    <br>
    <br>
    Now you can copy this key and paste into keys file (/php/core/keys.php).
    After using this file it is recommended to delete this file.
</body>
</html>
