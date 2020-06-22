<?php
    // ----------------------------------------
    // ENCRYPTION FUNCTIONS V. 1.0.0
    // SCRIPT CONTAINS:
    // - random series generator (without special characters and with special characters)
    // - email encryption
    // - password encryption
    // ----------------------------------------
    // WARNING: Script requires file with encryption keys!
    // ----------------------------------------
    require_once "keys.php";
    // RANDOM SERIES WITHOUT SPECIAL CHARS
    function random_series($chars)
    {
        $final_series = "";
        $series = array();
        for($i=0; $i<$chars; $i++)
        {
            do
            {
                $series[$i] = rand(48, 122);
            }while(($series[$i] > 57) && ($series[$i] < 65) || ($series[$i] > 90) && ($series[$i] < 97));
            $final_series .= chr($series[$i]);
        }
        return $final_series;
    }
    // RANDOM SERIES WITH SPECIAL CHARS
    function random_series_ws($chars)
    {
        $series = array();
        for($i=0; $i<$chars; $i++)
        {
            $series[$i] = chr(rand(33, 126));
        }
        $final_series = implode("", $series);
        return $final_series;
    }
    // EMAIL ENCRYPTION
    function encrypt_email($email, $key)
    {
        // CHECK KEY AND EMAIL
        if(strlen($key) != 94 || empty($email)){return false;}
        $key = str_split($key);
        foreach($key as $k => $char)
        {
            for($i=0; $i<94; $i++)
            {
                if($k == $i){continue;}
                else
                {
                    if($char === $key[$i])
                    {
                        return false;
                    }
                }
            }
        }
        do
        {
            // PHASE 1
            $length = strlen($email);
            $email = str_split($email);
            $key_table = array();
            for($i=33; $i<=126; $i++)
            {
                $key_table[$i] = $key[$i-33];
            }
            $key = $key_table;
            unset($key_table);
            for($i = 0; $i < $length; $i++)
            {
                $email[$i] = ord($email[$i]);
                $email[$i] = $key[$email[$i]];
            }
            $email = implode("", $email);
            // PHASE 2
            if($length < 10){$series = random_series_ws(30-$length);}
            else{$series = random_series_ws(29-$length);}
            $email .= $series . "|" . strval($length);
            // PHASE 3
            $length = strlen($email);
            $power = 1;
            do
            {
                $power++;
            }
            while($power*$power < $length);
            $email = str_split($email);
            $changed_order = array(array());
            $k = 0;
            for($i=0; $i<$power; $i++)
            {
                for($j=0; $j<$power; $j++)
                {
                    if(isset($email[$k])){$changed_order[$i][$j] = $email[$k];}
                    else{$changed_order[$i][$j] = "";}
                    $k++;
                }
            }
            $email = "";
            for($i=0; $i<$power; $i++)
            {
                for($j=0; $j<$power; $j++)
                {
                     $email .= $changed_order[$j][$i];
                }
            }
            // PHASE 4
            $email = str_split($email);
            for($i = 0; $i < $length; $i++)
            {
                $email[$i] = ord($email[$i]);
                $email[$i] = $key[$email[$i]];
            }
            // PHASE 5
            for($i = 0; $i < $length; $i++)
            {
                $email[$i] = ord($email[$i]);
                $email[$i] = dechex($email[$i]);
            }
            $email = implode("", $email);
            // PHASE 6
            $length = strlen($email);
            $email = str_split($email);
            $shifter = 1;
            for($i = 0; $i < $length; $i++)
            {
                if($shifter > 20)
                {
                    $shifter = 1;
                }
                $email[$i] = chr(ord($email[$i]) + $shifter);
                $shifter++;
            }
            // PHASE 7
            for($i = 0; $i < $length; $i++)
            {
                $email[$i] = ord($email[$i]);
                $email[$i] = $key[$email[$i]];
            }
            $email = implode("", $email);
        }
        while(strlen($email) < 64);
        return $email;
    }
    // ENCRYPT PASSWORD
    function encrypt_pass($pass, $key)
    {
        if(strlen($key) != 94 || empty($pass)){return false;}
        $key = str_split($key);
        foreach($key as $k => $char)
        {
            for($i=0; $i<94; $i++)
            {
                if($k == $i){continue;}
                else
                {
                    if($char === $key[$i])
                    {
                        return false;
                    }
                }
            }
        }
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $pass = random_series(40) . substr($pass, 7).random_series(35);
        $pass = str_replace('.', "@", $pass);
        $pass = str_replace('/', "*", $pass);
        $count = 0;
        $change = array();
        for($i = 0; $i < 12; $i++)
        {
            for($j = 0; $j < 12; $j++)
            {
                if($count > 127)
                {
                    $change[$i][$j] = "";
                }
                else
                {
                    $change[$i][$j] = $pass[$count];
                }
                $count++;
            }
        }
        $pass = "";
        for($i = 0; $i < 12; $i++)
        {
            for($j = 0; $j < 12; $j++)
            {
                $pass .= $change[$j][$i];
            }
        }
        $crypt_pass = "";
        for($k = 127; $k >= 0; $k--)
        {
            $crypt_pass .= $pass[$k];
        }
        $length = strlen($crypt_pass);
        $key_table = array();
        for($i=33; $i<=126; $i++)
        {
            $key_table[$i] = $key[$i-33];
        }
        $key = $key_table;
        unset($key_table);
        $crypt_pass = str_split($crypt_pass);
        for($i = 0; $i < $length; $i++)
        {
            $crypt_pass[$i] = ord($crypt_pass[$i]);
            $crypt_pass[$i] = $key[$crypt_pass[$i]];
        }
        $crypt_pass = implode("", $crypt_pass);
        return $crypt_pass;
    }
?>