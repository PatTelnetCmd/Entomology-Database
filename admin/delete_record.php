<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
    
    /* if not logged in */
    if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
        header('Location: login.php');
        exit();
    }
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    if(isset($_POST['delete'])) {
        $plant_images = $db->select("SELECT p.plant_ID, i.image_name, i.image_name_ext, i.image_type, i.image_size, i.image_url, i.uploaded
                                    FROM plants p
                                    JOIN images i ON p.plant_ID = i.plant_ID
                                    WHERE p.plant_ID = {$id}");
        //if($plant_image) $image = explode("/", $plant_image->image_url)[2];
        // echo "<pre>"; print_r($image); echo "</pre>";
        // echo '<img src="images/medium/'. $image .'" />';
        //echo "<pre>"; print_r($plant_images); echo "</pre>"; die();
        if($plant_images) {
            foreach($plant_images as $plant_image) {
                $image = explode("/", $plant_image->image_url)[2];
                //deleting images from the folders
                unlink($plant_image->image_url);
                unlink("images/medium/$image");
                unlink("images/thumbs/$image");
            }
            
            $delete_query = $db->delete("DELETE FROM images WHERE plant_ID = {$id}");
        }
        
        $delete_query = $db->delete("DELETE FROM plants WHERE plant_ID = {$id}");
        
        if($delete_query) {
            $message = "Plant Record with ID = {$id} deleted from database";
            redirect_to('plant_list.php', $message);    //redirecting to insect list page
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
                    <div class="col-lg-12">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="icon_house_alt"></i> Home</a></li>
                            <li><a href="#">Plants</a></li>
                            <li class="active">Delete Plant Record</li>
                            <li class="pull-right"><a href="plant_list.php">General List</a></li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel panel-danger">
                            <div class="panel-heading">
                                Confirm Delete
                            </div>
                            
                            <div class="panel-body">
                                <div class="alert alert-danger">
                                    Are you sure you want to delete record?
                                </div>
                                
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <button class="btn btn-danger" type="submit" name="delete"><span class="icon-trash"></span> DELETE</button>
                                            <a class="btn btn-default" href="plant_list.php" title=""><span class="icon_target"></span> CANCEL</a></td>
                                        </div>                                        
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    
    <!-- footer start -->
        <?php include 'includes/footer.php'; ?>
    <!-- footer end -->