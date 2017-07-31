<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
      /* if not logged in */
    if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
        header('Location: login.php');
        exit();
    }

      if(isset($_POST['submit'])) {
            
            $_POST = array_map('stripslashes', $_POST);
            
            /* getting post data */
            extract($_POST);
            /*echo $family;
            echo "<pre>"; print_r($_POST); echo "</pre>"; die();*/
            $familyErr = "";
            $msg = "";
            
            if(empty($family)) {
                  $familyErr = "Please fill this field!";
            }else {
                  $familyErr = validate_name($family);
            }
            
            if(empty($familyErr)) {
                  $family = ucfirst(strtolower($db->escape_string($family)));
                  /* checking whether record already exists */
                  $check_query = $db->select("SELECT family_name FROM family WHERE family_name = '{$family}'");
                  if($check_query){
                        $familyErr = "Record Already exists!";
                  }else {
                        $insert = "INSERT INTO family(family_name) "
                                 ."VALUES('{$family}')";
                        $query = $db->insert($insert);
                        
                        if($query) {
                              $msg ='<div class="alert alert-success">' . $family . ' family has been added</div>';
                              $family = $familyErr = '';
                        }else {
                              $msg  = '';
                        }
                  }
            }
            
      }

?>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
        <?php include 'includes/header.php'; ?>
      <!--header end-->

      <!--sidebar start-->
        <?php include 'includes/sidebar_nav.php'; ?>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
                <div class="row">
                <div class="col-lg-8">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard.php"><i class="icon_house_alt"></i> Home</a></li>
                        <li><a href="#">Family</a></li>
                        <li class="active">Add Family</li>
                        <li class="pull-right"><a href="family_list.php">Family List</a></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
              <!-- page end-->              
              
              <!-- form -->              
                <div class="row">
                  <div class="col-lg-8">
                      <section class="panel">
                          <header class="panel-heading">
                              Add Family
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                    <p style="padding: 2px;"></p>                    
                                    <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="" novalidate>
                                      <div class="form-group has-feedback">
                                          <label for="family" class="control-label col-lg-2">Family Name<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="family" name="family" minlength="5" type="text" value="<?php echo isset($family) && !empty($family) ? $family : ''; ?>" />
                                               <div class="help-block with-errors"><?php if(isset($familyErr) && !empty($familyErr)) echo $familyErr; ?></div>
                                          </div>
                                      </div>                               
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                              <button class="btn btn-default" type="reset" name="cancel">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </section>
                  </div>
              </div>             
              <!-- end form-->
              
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    
    <!-- footer start -->
        <?php include 'includes/footer.php'; ?>
    <!-- footer end -->