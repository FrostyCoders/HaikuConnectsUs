<?php
    // VALIDATE PASSWORDS
    function validate_passwords($pass1, $pass2)
    {
        if(empty($pass1) || empty($pass2))
        {
            $result = array(false, "Error, enter both passwords!");
        }
        else
        {
            if(strcmp($pass1, $pass2) !== 0)
            {
                $result = array(false, "Error, passwords are diffrent!");
            }
            else
            {
                $uppercase = preg_match('@[A-Z]@', $pass1);
                $lowercase = preg_match('@[a-z]@', $pass1);
                $number = preg_match('@[0-9]@', $pass1);
                $special = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pass1);
                if(!$uppercase || !$lowercase || !$number || !$special || strlen($pass1) < 8)
                {
                    $result = array(false, "Error, passwords don't meet requriments!");
                }
                else
                {
                    $result = array(true, "Passwords correct.");
                }
            }
        }
        return $result;
    }
?>