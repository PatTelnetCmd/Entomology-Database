<?php
session_start();
//checking if user is logged in
//if(isset($_SESSION['userSession']) != ""){
//    header("Location: dashboard.php");
//}

require_once '../libs/config.php';
require_once '../libs/database.php';
require 'includes/functions.php';

$db = new database();

$usernameErr = $confirmpassErr = $passErr = $roleErr = $questionErr = $answerErr = "";
$username = $confirmpass = $password = $role = $question = $answer =  "";

if(isset($_POST['register'])){
    //$user_code = $db->real_escape_string(trim($_POST['user_id']));
    if(empty($_POST['username'])){
        $usernameErr = "*Username is required";
    }else{
        $username = test_input($_POST['username']);
        //check if username contains only letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }

    if(empty($_POST['password'])) {
        $passErr = "*Fill in password please!";
    }else {
        $password = test_input($_POST['password']);
    }

    if(empty($_POST['confirmpass'])) {
        $confirmpassErr = "*Confirm password please!";
    }else {
        $confirmpass = test_input($_POST['confirmpass']);
    }

    if(empty($_POST['question'])) {
        $questionErr = '*Select question please';
    }else {
        $question = test_input($_POST['question']);
    }

    if(empty($_POST['answer'])) {
        $answerErr = '*Fill in answer for the question';
    }else {
        $answer = test_input($_POST['answer']);
    }

    //var_dump($_POST);

    //checking if input boxes are empty
    if(empty($_POST['username']) || empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['role']) || empty($_POST['question']) || empty($_POST['answer'])) {
        $msg = "<div class='alert alert-danger'>
                          <span class='glyphicon glyphicon-info-sign'></span> &nbsp; All fields must be filled!
                         </div>";
    }else {

        if(empty($usernameErr) && empty($fullnameErr) && empty($emailErr) && empty($passErr) && empty($roleErr) && empty($questionErr) && empty($answerErr)) {

            $count = 0;

            //encrypting password
            $hash_passwd = password_hash($password, PASSWORD_DEFAULT);

            //checking if username and email already exists
            $check_user_email = $db->select("SELECT username, email FROM users WHERE username = '$username'
                  AND email = '$email'");
            if($check_user_email):
                $count = $check_user_email->num_rows;
            endif;

            if($count == 0){
                //registering users into the database
                $insert_query = "INSERT INTO users(username, full_name, email,password, role, question, answer)
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

    //$db->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Reset</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/square/blue.css">
    <!-- Custom Css styles -->
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <div><a href="#"><img src="../assets/logos/naro.png" class="image-responsive pull-left" /></a></div>
        <div><a href="#"><img src="../assets/logos/naroforest.png" class="image-responsive pull-right" /></a></div>
        <div class="clearfix"></div>
        <div><h5 style="padding: 0px;">NATIONAL FORESTRY RESOURCES RESEARCH INSTITUTE</h5></div>
        <div><h6 style="padding: 0px;">ENTOMOLOGY DATABASE</h6></div>
        <small>RESET PASSWORD</small>

    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Update Your Password</p>
        <hr />

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

        <form action="" method="post">

            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <div class="help-block with-errors"><?php echo $usernameErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="question" placeholder="Security question">
                <div class="help-block with-errors"><?php echo $questionErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="answer" placeholder="Answer to your security question">
                <span class="glyphicon glyphicon-question-sign form-control-feedback"></span>
                <div class="help-block with-errors"><?php echo $answerErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div class="help-block with-errors"><?php echo $passErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="confirmpass" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div class="help-block with-errors"><?php echo $confirmpassErr; ?></div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <a href="login.php" class="btn btn-success btn-sm">Login</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" name="register" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../assets/plugins/iCheck/icheck.min.js"></script>
<script src="../assets/js/questions.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>