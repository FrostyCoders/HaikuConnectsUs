<?php
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
?>