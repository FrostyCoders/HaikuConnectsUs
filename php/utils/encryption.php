<?php
    // ----------------------------------------
    // ENCRYPTION FUNCTIONS V. 1.0.0
    // SCRIPT CONTAINS:
    // - email encryption
    // - password encryption
    // - user data encryption
    // ----------------------------------------
    // WARNING: Script requires file with encryption keys!
    // ----------------------------------------
    require_once "../utils/random.php";
    // USER DATA ENCRYPTION
    function encrypt_data($data, $key)
    {
        // CHECK KEY AND DATA
        if(empty($data) || strlen($key) != 94) return false;
        // PHASE 1
        $data_len = strlen($data);
        if($data_len < 10) $data = $data . random_series(64 - ($data_len + 2)) . "|" . $data_len;
        else $data = $data . random_series(64 - ($data_len + 3)) . "|" . $data_len;
        // PHASE 2
        $key_table = array();
        for($i=33; $i<=126; $i++)
        {
            $key_table[$i] = $key[$i-33];
        }
        $data_len = strlen($data);
        $data = str_split($data);
        for($i = 0; $i < $data_len; $i++)
        {
            $data[$i] = ord($data[$i]);
            $data[$i] = $key_table[$data[$i]];
        }
        // PHASE 3
        $phase3 = array();
        for($i = 0; $i < $data_len; $i += 2)
        {
            $phase3[$i] = $data[$i+1];
            $phase3[$i+1] = $data[$i];
        }
        $data = $phase3;
        $data = implode("", $data);
        // PHASE 4
        $length = strlen($data);
        $power = 1;
        do
        {
            $power++;
        }
        while($power*$power < $length);
        $data = str_split($data);
        $changed_order = array(array());
        $k = 0;
        for($i=0; $i<$power; $i++)
        {
            for($j=0; $j<$power; $j++)
            {
                if(isset($data[$k])){$changed_order[$i][$j] = $data[$k];}
                else{$changed_order[$i][$j] = "";}
                $k++;
            }
        }
        $data = "";
        for($i=0; $i<$power; $i++)
        {
            for($j=0; $j<$power; $j++)
            {
                 $data .= $changed_order[$j][$i];
            }
        }
        // PHASE 5
        $data_len = strlen($data);
        $data = str_split($data);
        for($i = 0; $i < $data_len; $i++)
        {
            $data[$i] = ord($data[$i]);
            $data[$i] = $key_table[$data[$i]];
        }
        $data = implode("", $data);
        return $data;
    }
    // EMAIL ENCRYPTION
    function encrypt_email($email, $key)
    {
        // CHECK KEY AND EMAIL
        if(strlen($key) != 94 || empty($email)) return false;
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
        if(strlen($key) != 94 || empty($pass)) return false;
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