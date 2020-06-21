<?php
    // ----------------------------------------
    // DECRYPTION FUNCTIONS V. 1.0.0
    // SCRIPT CONTAINS:
    // - email decryption
    // - password decryption
    // ----------------------------------------
    // WARNING: Script requires file with encryption keys!
    // ----------------------------------------
    require_once "keys.php";
    // EMAIL DECRYPTION
    function decrypt_email($code, $key)
    {
        // CHECK KEY AND CODE
        if(strlen($key) != 94 || empty($code)){return false;}
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
        // PHASE 1
        $length = strlen($code);
        $key_table = array();
        for($i=33; $i<=126; $i++)
        {
            $key_table[$i] = $key[$i-33];
        }
        $key = $key_table;
        unset($key_table);
        $normal_chars = array();
        for($i=33; $i<=126; $i++)
        {
            $normal_chars[$i] = chr($i);
        }
        $code = str_split($code);
        $new_code = array();
        $k = 0;
        foreach($code as $char)
        {
            for($i=33; $i<=126; $i++)
            {
                if($key[$i] === $char)
                {
                    $new_code[$k] = $normal_chars[$i];
                    $k++;
                }
            }
        }
        $code = $new_code;
        // PHASE 2
        $new_code = array();
        $shifter = 1;
        for($i = 0; $i < $length; $i++)
        {
            if($shifter > 20)
            {
                $shifter = 1;
            }
            $code[$i] = chr(ord($code[$i]) - $shifter);
            $shifter++;
        }
        // PHASE 3
        $new_code = array();
        $j = 0;
        for($i = 0; $i < $length; $i+=2)
        {
            $new_code[$j] = chr(hexdec($code[$i] . $code[$i+1]));
            $j++;
        }
        $code = $new_code;
        // PHASE 4
        $new_code = array();
        $k = 0;
        foreach($code as $char)
        {
            for($i=33; $i<=126; $i++)
            {
                if($key[$i] === $char)
                {
                    $new_code[$k] = $normal_chars[$i];
                    $k++;
                }
            }
        }
        $code = $new_code;
        // PHASE 5
        $length = strlen(implode("", $code));
        $power = 0;
        $code_table = array(array());
        do
        {
            $power++;
            $size = $power*$power;
        }
        while($size < $length);
        $l = 0;
        for($i=0; $i<$power; $i++)
        {
            for($j=0; $j<$power; $j++)
            {
                if($l < $length)
                {
                    $code_table[$i][$j] = "1";
                }
                else
                {
                    $code_table[$i][$j] = "0";
                }
                $l++;
            }
        }
        $l = 0;
        for($j=0; $j<$power; $j++)
        {
            for($i=0; $i<$power; $i++)
            {
                if($code_table[$i][$j] === "1")
                {
                    $code_table[$i][$j] = $code[$l];
                    $l++;
                }
                else
                {
                    unset($code_table[$i][$j]);
                }
                
            }
        }
        $code = "";
        for($j=0; $j<$power; $j++)
        {
            for($i=0; $i<$power; $i++)
            {
                if(isset($code_table[$j][$i]))
                {
                    $code .= $code_table[$j][$i];
                }   
            }
        }
        // PHASE 6
        $code = str_split($code);
        if($code[sizeof($code)-3] != "|")
        {
            $email_length = $code[sizeof($code)-1];
        }
        else
        {
            $email_length = $code[sizeof($code)-2] . $code[sizeof($code)-1];
        }
        for($i=0; $i<$length; $i++)
        {
            if($i >= $email_length)
            {
                unset($code[$i]);
            }
        }
        // PHASE 7
        $new_code = array();
        $k = 0;
        foreach($code as $char)
        {
            for($i=33; $i<=126; $i++)
            {
                if($key[$i] === $char)
                {
                    $new_code[$k] = $normal_chars[$i];
                    $k++;
                }
            }
        }
        $code = implode("", $new_code);
        return $code;
    }
    // DECRYPT PASSWORD
    function decrypt_pass($code, $key)
    {
        if(strlen($key) != 94 || empty($code) || strlen($code) != 128){return false;}
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
        $length = strlen($code);
        $key_table = array();
        for($i=33; $i<=126; $i++)
        {
            $key_table[$i] = $key[$i-33];
        }
        $key = $key_table;
        unset($key_table);
        $normal_chars = array();
        for($i=33; $i<=126; $i++)
        {
            $normal_chars[$i] = chr($i);
        }
        $code = str_split($code);
        $new_code = array();
        $k = 0;
        foreach($code as $char)
        {
            for($i=33; $i<=126; $i++)
            {
                if($key[$i] === $char)
                {
                    $new_code[$k] = $normal_chars[$i];
                    $k++;
                }
            }
        }
        $code = $new_code;
        $order = "";
        for($i = 127; $i >= 0; $i--)
        {
            $order .= $code[$i];
        }
        $code = $order;
        $length = strlen($code);
        $code = str_split($code);
        $code_table = array(array());
        $power = 1;
        do
        {
            $power++;
            $size = $power*$power;
        }
        while($size < $length);
        $l = 0;
        for($i=0; $i<$power; $i++)
        {
            for($j=0; $j<$power; $j++)
            {
                if($l < $length)
                {
                    $code_table[$i][$j] = "1";
                }
                else
                {
                    $code_table[$i][$j] = "0";
                }
                $l++;
            }
        }
        $l = 0;
        for($j=0; $j<$power; $j++)
        {
            for($i=0; $i<$power; $i++)
            {
                if($code_table[$i][$j] === "1")
                {
                    $code_table[$i][$j] = $code[$l];
                    $l++;
                }
                else
                {
                    unset($code_table[$i][$j]);
                }
                
            }
        }
        $code = "";
        for($j=0; $j<$power; $j++)
        {
            for($i=0; $i<$power; $i++)
            {
                if(isset($code_table[$j][$i]))
                {
                    $code .= $code_table[$j][$i];
                }   
            }
        }
        $code = str_replace('@', ".", $code);
        $code = str_replace('*', "/", $code);
        $code = "$2y$10$" . substr($code, 40, -35);
        return $code;
    }
?>