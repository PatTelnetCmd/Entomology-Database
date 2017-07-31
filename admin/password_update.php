<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php
    
    $c_password_err = "";
    $answer_err    = "";
    
    if(isset($_SESSION['userSession']) != ""){
        header('Location: dashboard.php');
        exit();
    }

    if(isset($_POST['update'])){
        $user          = trim($_POST['username']);
        $user_password = trim($_POST['password']);
        $new_password  = trim($_POST['new_password']);
        $answer        = ucfirst(trim($_POST['answer']));
        $answer_given  = ucfirst(trim($_POST['answer_given']));

        if(empty($answer)) {
            $answer_err = "Please provide an answer to the question";
        }else {
            $answer_verify = $db->select_one("SELECT answer FROM user WHERE username = '$user'");

            //verify answer to the security question
            if($answer != $answer_given) {
                $answer_err = "Wrong answer provided to the question!";
            }else {

                //password fields must not be empty
                if(empty($user_password) || empty($new_password)) {
                    $c_password_err = "Please fill all the password fields!";
                }else {

                    //verifying that password values match
                    if($user_password != $new_password) {
                        $c_password_err = 'Passwords fields donot match!';
                    }else{
                        //verifying username and password
                        $verify_query = $db->select_one("SELECT * FROM user WHERE username = '$user'");
                        //$row = $verify_query->fetch_array();

                        //$verify_pass = password_verify($user_password, $row['password']);

                        if($verify_query){
                            //encrypting password
                            $hash_passwd = password_hash($user_password, PASSWORD_DEFAULT);
                            $update_pass = $db->update("UPDATE user SET password = '$hash_passwd' WHERE username = '$user'");

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
</head>

  <body class="login-body">

    <div class="container animated fadeInLeft">

      <form class="login-form" action="" method="post">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <?php
                if(isset($msg)){
                    echo $msg;
                }
            ?>
            <p id="login_her">HERBARIUM DATABASE RECORDS</p>
            <p id="login_her">USER PASSWORD UPDATE</p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" id="user" class="form-control" placeholder="Username" name="username" autocomplete="off">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" id="question" class="form-control" placeholder="Security Question" name="question" autocomplete="off">
            </div>
            <div class="input-group hidden">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" id="answer_given" class="form-control"  name="answer_given" autocomplete="off">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" id="answer" class="form-control" placeholder="Provide answer to security question"  name="answer" autocomplete="off">
            </div><div class="help-block with-errors"><?php echo $answer_err; ?></div>

            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="New Password" name="password">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Confirm Password" name="new_password">                
            </div><div class="help-block with-errors"><?php echo $c_password_err; ?></div>
            
            <label class="checkbox">
                <!--<input type="checkbox" value="remember-me"> Remember me-->
                <span class="pull-right"> <a href="login.php"> Login Page </a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="update">Update</button>
            <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
            <!--<a href="register.php"><i class="icon-signin"></i>New to Herbarium Database? Register.</a>-->
        </div>
      </form>

    </div>

    <!-- Javascripts -->
    <script src="assets/js/jquery-3.js"></script>
    <script>

        $(document).ready(function(){
            $('#user').on('keyup change',function(){
                var user = $(this).val();
                //console.log(user);
                /*$.get('getuser_security_details.php?user='+user+'',function(data){
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