<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();

    if(isset($_SESSION['userSession']) != ""){
        header('Location: dashboard.php');
        exit();
    }

    if(isset($_POST['login'])){
        $user          = trim($_POST['username']);
        $user_password = trim($_POST['password']);

        //verifying username and password
        $verify_query = $db->select("SELECT * FROM users WHERE username = '$user'");
        $row = $verify_query->fetch_array();

        $verify_pass = password_verify($user_password, $row['password']);

        if($verify_pass){
            $_SESSION['userSession'] = $row['user_ID'];
            $_SESSION['fullname']    = $row['full_name'];
            header('Location: dashboard.php');
        }else{
            $msg = "<div class='alert alert-danger'>
                      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Wrong username or password !
                     </div>";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div><img src="../assets/logos/naro.png" class="image-responsive pull-left" /></div>
    <div><img src="../assets/logos/naroforest.png" class="image-responsive pull-right" /></div>
    <div class="clearfix"></div>
    <div><h5 style="padding: 0px;">NATIONAL FORESTRY RESOURCES RESEARCH INSTITUTE</h5></div>
    <div><h6 style="padding: 0px;">ENTOMOLOGY DATABASE</h6></div>
    <a href="#"><small>User Login</small> | <small>NARO ED</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Log in to start your session</p>
    <hr />
    <?php
        if(isset($msg)){
            echo $msg;
        }
    ?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">LogIn</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    

    <!--<a href="#">I forgot my password</a>--><br>
    <!--<a href="register.php" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../assets/plugins/iCheck/icheck.min.js"></script>
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