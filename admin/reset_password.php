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


    if(isset($_SESSION['userSession']) != ""){
        header('Location: dashboard.php');
        exit();
    }

    if(isset($_POST['update'])){
        $user          = trim($_POST['username']);
        $user_password = trim($_POST['password']);
        $new_password  = trim($_POST['confirmpass']);
        $answer        = ucfirst(trim($_POST['answer']));
        $answer_given  = ucfirst(trim($_POST['answer_given']));

        if(empty($answer)) {
            $answerErr = "Please provide an answer to the question";
        }else {
            $answer_verify = $db->select_one("SELECT answer FROM users WHERE username = '$user'");

            //verify answer to the security question
            if($answer != $answer_given) {
                $answerErr = "Wrong answer provided to the question!";
            }else {

                //password fields must not be empty
                if(empty($user_password) || empty($new_password)) {
                    $confirmpassErr = "Please fill all the password fields!";
                }else {

                    //verifying that password values match
                    if($user_password != $new_password) {
                        $confirmpassErr = 'Passwords fields donot match!';
                    }else{
                        //verifying username and password
                        $verify_query = $db->select_one("SELECT * FROM users WHERE username = '$user'");
                        //$row = $verify_query->fetch_array();

                        //$verify_pass = password_verify($user_password, $row['password']);

                        if($verify_query){
                            //encrypting password
                            $hash_passwd = password_hash($user_password, PASSWORD_DEFAULT);
                            $update_pass = $db->update("UPDATE users SET password = '$hash_passwd' WHERE username = '$user'");

                            if($update_pass) {
                                $msg = "<div class='alert alert-success'>
                              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Your password has been updated. Please you can proceed to login
                             </div>";
                            }

                        }else{
                            $msg = "<div class='alert alert-danger'>
                              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; User does not exit!
                             </div>";
                        }
                    }

                }

            }
        }

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
                <input type="text" class="form-control" id="user" name="username" value="<?php echo $username; ?>" placeholder="Username" autocomplete="off">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <div class="help-block with-errors"><?php echo $usernameErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="question" class="form-control" name="question" placeholder="Security question">
                <div class="help-block with-errors"><?php echo $questionErr; ?></div>
            </div>
            <div class="form-group has-feedback">
                <input type="hidden" class="form-control" id="answer_given" name="answer_given">
                <span class="glyphicon glyphicon-question-sign form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer to your security question" autocomplete="off">
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
                    <button type="submit" name="update" class="btn btn-primary btn-block btn-flat">Update</button>
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
<script>

    $(document).ready(function(){
        $('#user').on('keyup change',function(){
            var user = $(this).val();
            /*console.log(user);
            $.get('getuser_security_details.php?user='+user+'',function(data){
             if(data)
             {
             console.log(data);
             }
             });*/
            $.ajax({
                url : "getuser_security_details.php",
                dataType: 'json',
                type: 'POST',
                //async : false,
                data : { user : user},
                success : function(result) {
                    //console.log(result);
                    $('#question').val(result.question);
                    $('#answer_given').val(result.answer);
                }
            });

        });
    });

</script>
</body>
</html>