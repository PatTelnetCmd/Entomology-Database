<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php

    if(isset($_SESSION['userSession']) != ""){
        header('Location: dashboard.php');
        exit();
    }

    if(isset($_POST['login'])){
        $_POST = array_map('stripslashes', $_POST);
            
        /* getting post data */
        extract($_POST);
        //*echo $family;
        //echo "<pre>"; print_r($_POST); echo "</pre>"; die();
                
        $user_password = $db->escape_string($password);
        //echo $user_password;
        
        if(!empty($user_password) && !empty($username)) {
            //verifying username and password
            $verify_query = $db->select_one("SELECT * FROM user WHERE username = '$username'");
            //$row = $verify_query;
            //echo "<pre>"; print_r($verify_query); echo "</pre>"; die();
            
            if($verify_query) {
                $verify_pass = password_verify($user_password, $verify_query->password);
    
                if($verify_pass){
                    $_SESSION['userSession'] = $verify_query->user_ID;
                    $_SESSION['fullname']    = $verify_query->full_name;
                    $_SESSION['role']        = $verify_query->role;
                    $_SESSION['logged']      = 1;
                    header('Location: dashboard.php');
                }else{
                    $msg = "<div class='alert alert-danger'>
                              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Wrong username or password !
                             </div>";
                }
            }else {
                $msg = "<div class='alert alert-danger'>
                              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Wrong username or password combination !
                             </div>";
            }    
            
        }else {
            $msg = "<div class='alert alert-danger'>
                          <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Please provide both your username and password !
                         </div>";
        }
        
    }    

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Byadmin - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="Bylancer">
    <meta name="keyword" content="Byadmin, Dashboard, Herbarium Database Record, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <style>
        .login-body{
            background: url('images/weather/weather/weather.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

  <body class="login-body">

    <div class="container animated fadeInLeft">

      <form class="login-form" action="" method="post">        
        <div class="login-wrap">
            <div class="row">
                <div class="pull-right"><img src="assets/logos/naroforest.png" alt="naro" /></div>
                <div class="pull-left"><img src="assets/logos/naro.png" alt="naro" /></div>
                <p class="login-img"><i class="icon_lock_alt"></i></p> 
            </div>                       
            
            <div class="row">
                <div class="col-md-12"><p style="padding: 5px;"></p></div>                
            </div>
            <?php
                if(isset($msg)){
                    echo $msg;
                }
            ?>
            <p id="login_her">HERBARIUM DATABASE RECORDS</p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <label class="checkbox">
                <!--<input type="checkbox" value="remember-me"> Remember me-->
                <span class="pull-right"> <a href="password_update.php"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
            <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
            <!--<a href="register.php"><i class="icon-signin"></i>New to Herbarium Database? Register.</a>-->
        </div>
      </form>

    </div>


  </body>

</html>