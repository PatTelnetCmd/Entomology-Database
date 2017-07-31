<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php

    if($_SESSION['role'] != 1) {
        redirect_to("dashboard.php", base64_encode("You have no privilege to access the registration page!"));
    }

    $user_roles = $db->select("SELECT * FROM role");
    /*echo "<pre>"; print_r($user_roles); echo "</pre>"; die();*/
    
    $usernameErr = $fullnameErr = $emailErr = $passErr = $roleErr = $questionErr = $answerErr = "";
    if(isset($_POST['submit'])) {
        $_POST = array_map('stripslashes', $_POST);
            
            /* getting post data */
            extract($_POST);
            //*echo $family;
            //echo "<pre>"; print_r($_POST); echo "</pre>"; die();
        
        
            //$user_code = $db->real_escape_string(trim($_POST['user_id']));
        if(empty($username)){
            $usernameErr = "*Username is required";
        }else{
            $username = $db->escape_string($username);
            //check if username contains only letters and whitespace
            $usernameErr = validate_name($username);
        }
        
        if(empty($fullname)){
            $fullnameErr = "*Fullname is required";
        }else{
            $fullname = $db->escape_string($fullname);
            //check if fullname contains only letters and whitespace
            $fullnameErr = validate_name($fullname);
        }
        
        if(empty($email)) {
            $emailErr = "*Email is required";
        }else {
            $email    = $db->escape_string($email);
            // check if e-mail address is well-formed
            $emailErr    = validate_email($email);
        }
        
        if(empty($password)) {
            $passErr = "*Fill in password please!";
        }else {
            $password = $db->escape_string($password);
        }
        
        if(empty($role)) {
            $roleErr = "*Role not selected";
        }else {
            $role  = $db->escape_string($role);
        }

        if(empty($question)){
            $questionErr = "*Select security question";
        }else{
            $question = $db->escape_string($question);
            //check if question contains only letters and whitespace
            //$usernameErr = validate_name($username);
        }

        if(empty($answer)){
            $answerErr = "*Please provide your answer to the question";
        }else{
            $answer = $db->escape_string($answer);
            //check if question contains only letters and whitespace
            //$usernameErr = validate_name($username);
        }
        //var_dump($_POST);
        
        //checking if input boxes are empty
        if(empty($username) || empty($fullname) || empty($email) || empty($password) || empty($role)) {
            $msg = "<div class='alert alert-danger'>
                          <span class='glyphicon glyphicon-info-sign'></span> &nbsp; All fields must be filled!
                         </div>";
        }else {
            
            if(empty($usernameErr) && empty($fullnameErr) && empty($emailErr) && empty($passErr) && empty($roleErr) && empty($questionErr) && empty($answerErr)) {
                
                $count = 0;                
        
                //encrypting password
                $hash_passwd = password_hash($password, PASSWORD_DEFAULT);
        
                //checking if username and email already exists
                $check_user_email = $db->select_count("SELECT username, email FROM user WHERE username = '$username'
                  OR email = '$email'");
                if($check_user_email):
                  $count = $check_user_email;
                endif;
        
                if($count == 0){
                    //registering users into the database
                    $insert_query = "INSERT INTO user(username, full_name, email, password, role, question, answer)
                      VALUES('$username', '$fullname', '$email', '$hash_passwd', $role, '$question', '$answer')";
        
                    $query = $db->insert($insert_query);
        
                    if($insert_query){
                        $msg = "<div class='alert alert-success'>
                                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully registered !
                                 </div>";
                        $username = $fullname = $email = $password = $role = $question = $answer = "";
        
                    }else{
                        $msg = "<div class='alert alert-danger'>
                                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while registering !
                                 </div>";
                    }
        
                }else{
                    $msg = "<div class='alert alert-danger'>
                             <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry username or email already taken !
                            </div>";
        
                }
                
            }else {
                $msg = "<div class='alert alert-danger'>
                             <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Form has errors!
                            </div>";
            }
            
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

    <title>Register</title>

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
</head>

<body class="login-img2-body">

<div class="container">

    <form class="login-form" action="" method="post" novalidate>
        <div class="login-wrap">
            <p class="login-img"><img src="assets/logos/naro.png" alt="naro" /></p>
<!--            <p class="login-img"><i class="icon_lock_alt"></i></p>-->
            <p id="login_her"><a href="dashboard.php">HERBARIUM DATABASE RECORDS</a></p>
            <p id="login_reg">Register New Member</p>
            <hr>
            
            <?php
                if(isset($msg)){
                    echo $msg;
                }
                else{
                    ?>
                    <div class='alert alert-info'>
                        <span class='glyphicon glyphicon-asterisk'></span> &nbsp; All the fields are mandatory !
                    </div>
                    <?php
                }
            ?>
            
            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_mail"></i></span>
                <input type="email" class="form-control" placeholder="Email" name="email" autofocus>                
            </div><div class="help-block with-errors"><?php echo $emailErr; ?></div>
            
            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_group"></i></span>
                <select class="form-control" name="role">
                    <option value="">Select Role</option>
                    <?php foreach($user_roles as $role): ?>
                        <option value="<?php echo $role->role_ID; ?>"><?php echo $role->role; ?></option>
                    <?php endforeach; ?>
                </select>                
            </div><div class="help-block with-errors"><?php echo $roleErr; ?></div>
            
            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" class="form-control" placeholder="Full name" name="fullname" autofocus>                
            </div><div class="help-block with-errors"><?php echo $fullnameErr; ?></div>
            
            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" class="form-control" placeholder="Username" name="username" autofocus>                
            </div><div class="help-block with-errors"><?php echo $usernameErr; ?></div>
            
            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">                
            </div><div class="help-block with-errors"><?php echo $passErr; ?></div>

            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_group"></i></span>
                <select class="form-control" id="question" name="question">
                    <!--------Getting option list from json object---------->
                </select>
            </div><div class="help-block with-errors"><?php echo $questionErr; ?></div>

            <div class="input-group has-feedback">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="answer" class="form-control" placeholder="Answer to your security question" name="answer">
            </div><div class="help-block with-errors"><?php echo $answerErr; ?></div>
            
            <!--<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="recoverpw.html"> Forgot Password?</a></span>
            </label>-->
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Register</button>
            <!--<a href="login-2.html"><i class="icon-signin"></i> Already have account? Login.</a>-->
        </div>
    </form>

</div>

<!-- Javascripts -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/questions.js"></script>

</body>

</html>