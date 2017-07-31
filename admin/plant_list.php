<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
    /* if not logged in */
    if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
        header('Location: login.php');
        exit();
    }
    
    if(isset($_GET['msg'])){
      $msg = $_GET['msg']; 
    }
     
    $plant_query        = 'SELECT p.plant_ID, f.family_name, g.genus_name, s.species_name, p.locality, p.habitat, p.region, '
                          .'p.date_of_collection, p.gps_nothings, p.gps_eastings, p.image, p.description'
                           .' FROM plants AS p'
                           .' JOIN family AS f ON p.family_ID = f.family_ID'
                           .' JOIN genus AS g ON p.genus_ID = g.genus_ID'
                           .' JOIN species AS s ON p.species_ID = s.species_ID';
    /* getting family list objects */
    $plant_objects_list =  $db->select($plant_query);
    /*echo "<pre>"; print_r($family_objects_list); echo "</pre>";*/
    /* count of plant records */
    $num_plant_records  =  $db->select_count('SELECT * FROM plants');

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
                        <li class="active">General Plant Records</li>
                        <li class="pull-right"><a href="add_plant.php">Add Record</a></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                General Plant Records
                                
                                <span class="label label-success pull-right">
                                    <?php echo $num_plant_records ? $num_plant_records . ' Plant Records' : 0 . ' Plant Records'; ?>
                                </span>                                
                            </header>
                                                        
                            <div class="panel-body">
                                <?php if(isset($msg) && !empty($msg)): ?>
                                    <div class='alert alert-success fade in'>
                                        <button data-dismiss="alert" class="close close-sm" type="button">
                                            <i class="icon-remove"></i>
                                        </button>
                                        <strong><?php echo $msg; ?></strong>
                                    </div>
                                <?php endif; ?>
                                <!-- table -->
                                    <table class="table table-striped border-top" id="sample_1">
                                        <thead>
                                            <tr>
<!--                                                <th style="width:8px;"> <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>-->
                                                <th>#</th>
                                                <th>Family</th>
                                                <th>Genus</th>
                                                <th>Species</th>
                                                <th>Locality</th>
                                                <th>D.O.C</th>
                                                <th>Habitat</th>
                                                <th>GPS Nothings</th>
                                                <th>GPS Eastings</th>
                                                <!--<th>Image</th>-->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php if($plant_objects_list): ?>
                                                <?php $plant_counter = 1; ?>
                                                <?php foreach($plant_objects_list as $plant): ?>
                                                    <tr class="odd gradeX">
<!--                                                        <td><input type="checkbox" class="checkboxes" value="--><?php //echo $plant->plant_ID; ?><!--" /></td>-->
                                                        <td><?php echo $plant_counter; ?></td>
                                                        <td><?php echo $plant->family_name; ?></td>
                                                        <td><?php echo $plant->genus_name; ?></td>
                                                        <td><?php echo $plant->species_name; ?></td>
                                                        <td><?php echo $plant->locality; ?></td>
                                                        <td><?php echo $plant->date_of_collection; ?></td>
                                                        <td><?php echo $plant->habitat; ?></td>
                                                        <td><?php echo $plant->gps_nothings ?></td>
                                                        <td><?php echo $plant->gps_eastings; ?></td>
                                                        <!--<td><?php //echo $plant->image; ?></td>-->
                                                        <td>
                                                            <div class="btn-group">                                                                
                                                                <a class="" title="View Details" href="view_plant_details.php?id=<?php echo $plant->plant_ID; ?>" style="color: green;"><i class="icon_check_alt2"></i></a>
                                                                <?php if($_SESSION['role'] == 1): ?>
                                                                    <a class="" title="Edit" href="edit_plant.php?id=<?php echo $plant->plant_ID; ?>" style="color: blue;"><i class="icon_plus_alt2"></i></a>
                                                                    <a class="" title="Delete" href="delete_record.php?id=<?php echo $plant->plant_ID; ?>" style="color: red;"><i class="icon_trash"></i></a>
                                                                <?php endif; ?>    
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $plant_counter++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="alert alert-warning">No Plant Records yet!</div>
                                            <?php endif; ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                <!-- end table -->
                            </div><!-- end Panel -->
                        </section>
                    </div>
                </div><!-- end row -->
                
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    
    <!-- footer start -->
        <?php include 'includes/footer.php'; ?>
    <!-- footer end -->