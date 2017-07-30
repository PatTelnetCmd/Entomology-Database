<?php
    session_start();

    if(!isset($_SESSION['userSession'])){
        header('Location: login.php');
    }else if(isset($_SESSION['userSession']) !=""){
        header('Location: dashboard.php');
    }

    session_destroy();
    unset($_SESSION['userSession']);
    unset($_SESSION['fullname']);
    header('Location: login.php');

?>