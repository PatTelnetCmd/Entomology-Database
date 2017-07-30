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

?>