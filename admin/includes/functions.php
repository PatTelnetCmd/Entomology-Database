<?php

    function redirect_to($location, $msg) {
        header("location: {$location}?msg={$msg}");
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;    
    }

    /* name validation no digits allowed */
    function validate_name($name) {
        $nameErr = '';
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }

        return $nameErr;
    }

?>