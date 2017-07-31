<?php
	session_start();
	
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require_once 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    }
    
    /* fetching insect list from the databse */
    $insect_records = array();
    
    $sql_select_insects = "SELECT * FROM Insects";
    $insects = $db->select($sql_select_insects);
    
    if($insects) {
      if($insects->num_rows){
        while($insect_record = $insects->fetch_object()){
          $insect_records[] = $insect_record;
        }
        //print_r($insect_records);
        $insects->free();
      }
    }
    
    /* fetching family categories */
    $sql_select_family_categories = "SELECT COUNT(i.family_Id) AS Families, f.family_name ";
	  $sql_select_family_categories .= "FROM Insects AS i ";
    $sql_select_family_categories .= "JOIN Family AS f ON i.family_Id = f.family_Id ";
    $sql_select_family_categories .= "GROUP BY f.family_name";
    
    $sql_select_family_count       = $db->select($sql_select_family_categories);

    /* fetching genus categories */
    $sql_select_genus_categories = "SELECT COUNT(i.genus_Id) AS Genus, g.genus_name ";
    $sql_select_genus_categories .= "FROM Insects AS i ";
    $sql_select_genus_categories .= "JOIN genus AS g ON i.genus_Id = g.genus_id ";
    $sql_select_genus_categories .= "GROUP BY g.genus_name";

    $sql_select_genus_count       = $db->select($sql_select_genus_categories);
    
    /* fetching order categories */
    $sql_select_order_categories = "SELECT COUNT(i.order_Id) AS Orders, o.order_name ";
	  $sql_select_order_categories .= "FROM Insects AS i ";
    $sql_select_order_categories .= "JOIN `Order` AS o ON i.order_Id = o.order_Id ";
    $sql_select_order_categories .= "GROUP BY o.order_name";
    
    $sql_select_order_count       = $db->select($sql_select_order_categories);
    
    /* fetching species categories */
    $sql_select_species_categories = "SELECT COUNT(i.species_Id) AS Species, s.species_name ";
	  $sql_select_species_categories .= "FROM Insects AS i ";
    $sql_select_species_categories .= "JOIN Species AS s ON i.species_Id = s.species_Id ";
    $sql_select_species_categories .= "GROUP BY s.species_name";
    
    $sql_select_species_count       = $db->select($sql_select_species_categories);

?>

<!-- header -->
<?php include 'includes/header.php'; ?>

  <!-- =============================================== -->

<!-- siderbar navigation -->

<?php include 'includes/sidebar_nav.php'; ?> 

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!--<small>it all starts here</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="#">Examples</a></li>-->
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          
          <div class="box box-info">
            <div class="box-body">
              <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3><?php echo count($insect_records); ?></h3>
        
                      <p>Insects</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bug"></i>
                    </div>
                    <a href="insect_list.php" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div><?php //echo $_SESSION['fullname']; ?>
                </div>
                <!-- ./col -->
                
                <!--<div class="col-lg-3 col-xs-6">-->
                  <!-- small box -->
                  <!--<div class="small-box bg-green">
                    <div class="inner">
                      <h3>53<sup style="font-size: 20px">%</sup></h3>
        
                      <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>-->
                <!-- ./col -->
                
                <!--<div class="col-lg-3 col-xs-6">-->
                  <!-- small box -->
                  <!--<div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>44</h3>
        
                      <p>User Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>-->
                <!-- ./col -->
                
                <!--<div class="col-lg-3 col-xs-6">-->
                  <!-- small box -->
                  <!--<div class="small-box bg-red">
                    <div class="inner">
                      <h3>65</h3>
        
                      <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>-->
                <!-- ./col -->
              </div><!-- row -->        
                
                
            </div><!-- box-body -->
         </div><!-- box -->
        </div>
        
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->

        <!-- Orders -->
        <div class="row">
            <div class="col-md-12 col-xs-6">

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Insect Orders</h3>
                    </div>

                    <div class="box-body">

                        <?php if($sql_select_order_count -> num_rows): ?>
                            <?php while($order_count = $sql_select_order_count->fetch_array()): ?>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-yellow"><i class="fa fa-bug"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo $order_count['order_name']; ?></span>
                                            <span class="info-box-number"><?php echo $order_count['Orders']; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div><!-- box-body -->

                </div><!-- box -->

            </div><!-- col-md-12 -->
        </div><!--row -->

        <!-- end orders -->
        <!-- ========================================================================================= -->
      
      <!-- Families -->
      <div class="row">
        <div class="col-md-12">
          
          <div class="box box-success">
            <div class="box-header with-border">              
                <h3 class="box-title">Families</h3>
            </div>
              
              <div class="box-body">
                
                <?php if($sql_select_family_count -> num_rows): ?>
                  <?php while($family_count = $sql_select_family_count->fetch_array()): ?>
                  
                   <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-paw"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text"><?php echo $family_count['family_name']; ?></span>
                        <span class="info-box-number"><?php echo $family_count['Families']; ?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                      
                  <?php endwhile; ?>
                <?php endif; ?>
                
              </div><!-- box-body -->
              
            </div><!--box -->
          </div><!-- col-md-12 -->     
          
        </div><!-- row -->
        
        <!-- end families -->
        <!-- ========================================================================================= -->

        <!-- Genus -->
        <div class="row">
            <div class="col-md-12">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Genus</h3>
                    </div>

                    <div class="box-body">

                        <?php if($sql_select_genus_count -> num_rows): ?>
                            <?php while($genus_count = $sql_select_genus_count->fetch_array()): ?>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-blue"><i class="fa fa-paw"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo $genus_count['genus_name']; ?></span>
                                            <span class="info-box-number"><?php echo $genus_count['Genus']; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div><!-- box-body -->

                </div><!--box -->
            </div><!-- col-md-12 -->

        </div><!-- row -->

        <!-- end Genus -->
        <!-- ========================================================================================= -->

      <!-- Species -->
      <div class="row">
        <div class="col-md-12 col-xs-6">
          
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Insect Species</h3>
            </div>
            
            <div class="box-body">
              
              <?php if($sql_select_species_count -> num_rows): ?>
                  <?php while($species_count = $sql_select_species_count->fetch_array()): ?>
                  
                   <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="fa fa-bug"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text"><?php echo $species_count['species_name']; ?></span>
                        <span class="info-box-number"><?php echo $species_count['Species']; ?></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                      
                  <?php endwhile; ?>
                <?php endif; ?>
              
            </div><!-- box-body -->
            
          </div><!-- box -->
          
        </div><!-- col-md-12 -->
      </div><!--row -->
      
      <!-- end species -->
      <!-- ========================================================================================= -->
      
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
    <!-- =================================================================== -->

<?php include 'includes/footer.php'; ?>

  