<?php require_once 'libs/database.php'; ?>
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
    /* getting details of a particular plant record according to its id */
    $plant_record = $db->select_one("SELECT p.plant_ID, f.family_name, f.family_ID, g.genus_name, g.genus_ID, s.species_name, s.species_ID, p.locality, p.habitat, p.region, "
                      ."p.date_of_collection, p.gps_nothings, p.gps_eastings, p.image, p.description"
                       ." FROM plants AS p"
                       ." JOIN family AS f ON p.family_ID = f.family_ID"
                       ." JOIN genus AS g ON p.genus_ID = g.genus_ID"
                       ." JOIN species AS s ON p.species_ID = s.species_ID WHERE plant_ID = {$id}");
    //echo "<pre>"; print_r($plant_record); echo "</pre>"; 
    
    $plant_image = $db->select_one("SELECT p.plant_ID, i.image_name, i.image_name_ext, i.image_type, i.image_size, i.image_url, i.uploaded
                                    FROM plants p
                                    JOIN images i ON p.plant_ID = i.plant_ID
                                    WHERE p.plant_ID = {$id}
                                    LIMIT 1");
    if($plant_image) $image = explode("/", $plant_image->image_url)[2];
    //echo "<pre>"; print_r($image); echo "</pre>";
    // echo '<img src="images/medium/'. $image .'" />';
    // echo "<pre>"; print_r($plant_image); echo "</pre>"; die();

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
                                <li class="active">Particular Plant Details</li>
                                <li class="pull-right"><a href="plant_list.php">General List</a></li>
                            </ul>
                            <!--breadcrumbs end -->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Plant Details
                                </header>
                                <div class="panel-body">
                                    <!--media object-->
                                        <div class="media">                                            
                                            <div class="pull-left">
                                                <a href="#">
                                                    <?php if($plant_image): ?>
                                                        <img class="media-object" src="images/medium/<?php echo $image; ?>" alt="" />
                                                    <?php else: ?>
                                                        <img class="media-object" src="images/noimage.jpg" alt="" />
                                                    <?php endif; ?>
                                                </a>
                                            </div>                                            
                                            
                                            <div class="media-body">
<!--                                                --><?php //if($plant_image): ?>
<!--                                                    <h4 class="media-heading">-->
<!--                                                        --><?php //echo $plant_image->image_name; ?>
<!--                                                    </h4>-->
<!--                                                    <hr>-->
<!--                                                    <h3>Image Description</h3>-->
<!--                                                    <hr>-->
<!--                                                    <p><strong>Image type:</strong>    --><?php //echo $plant_image->image_type; ?><!--</p>-->
<!--                                                    <p><strong>Image size:</strong>     --><?php //echo $plant_image->image_size; ?><!--</p>-->
<!--                                                    <p><strong>Uploaded:</strong>       --><?php //echo $plant_image->uploaded; ?><!--</p>-->
<!--                                                    <hr>-->
<!--                                                --><?php //endif; ?><!--   -->
                                                
                                                <h3>Plant Description</h3>
                                                <hr>
                                                <p><strong>Family:</strong>   <?php echo $plant_record->family_name; ?></p>
                                                <p><strong>Genus:</strong>    <?php echo $plant_record->genus_name; ?></p>
                                                <p><strong>Species:</strong>   <?php echo $plant_record->species_name; ?></p>
                                                <p><strong>Locality:</strong>  <?php echo $plant_record->locality; ?></p>
                                                <p><strong>Habitat:</strong>   <?php echo $plant_record->habitat; ?></p>
                                                <p><strong>Region:</strong>    <?php echo $plant_record->region; ?></p>
                                                <p><strong>Date of Collection:</strong>   <?php echo $plant_record->date_of_collection; ?></p>
                                                <p><strong>Gps Nothings:</strong>         <?php echo $plant_record->gps_nothings; ?></p>
                                                <p><strong>Gps Eastings:</strong>         <?php echo $plant_record->gps_eastings; ?></p>
                                            </div>
                                        </div>
                                    <!--end media object -->
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