<?php require_once 'libs/database.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
    /* if not logged in */
    if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
        header('Location: login.php');
        exit();
    }

    $species_query        = 'SELECT * FROM species';
    /* getting species list objects */
    $species_objects_list =  $db->select($species_query);
    /*echo "<pre>"; print_r($species_Objects_list); echo "</pre>";*/

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
                        <li><a href="#">Species</a></li>
                        <li class="active">Species List</li>
                        <li class="pull-right"><a href="add_species.php">Add Species</a></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <section class="panel">
                            <header class="panel-heading">
                                Species List
                            </header>
                            
                            <div class="panel-body">
                                <!-- table -->
                                    <table class="table table-striped border-top" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th style="width:8px;"> <input type="checkbox" class="group-checkable sr-only" data-set="#sample_1 .checkboxes" /> </th>
                                                <th>#</th>
                                                <th>Species Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php if($species_objects_list): ?>
                                                <?php $species_counter = 1; ?>
                                                <?php foreach($species_objects_list as $species): ?>
                                                    <tr class="odd gradeX">
                                                        <td><input type="checkbox" class="checkboxes sr-only" value="<?php echo $species->species_ID; ?>" /></td>
                                                        <td><?php echo $species_counter; ?></td>
                                                        <td><?php echo $species->species_name ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php if($_SESSION['role'] == 1): ?>
                                                                    <a class="" title="Edit" href="edit_species.php?id=<?php echo $species->species_ID; ?>" style="color: blue;"><i class="icon_plus_alt2"></i></a>
                                                                    <a class="" title="Delete" href="delete_species.php?id=<?php echo $species->species_ID; ?>" style="color: red;"><i class="icon_trash"></i></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <!--<td>Action</td>-->
                                                    </tr>
                                                    <?php $species_counter++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="alert alert-warning">No Species Records yet!</div>
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