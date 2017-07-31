<?php require_once 'libs/database.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
    /* if not logged in */
    if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
        header('Location: login.php');
        exit();
    }
    
    /* count of plant records */
    $num_plant_records  =  $db->select_count('SELECT * FROM plants');
    
    /* family categories */
    $family_categories = 'SELECT COUNT(p.family_ID) AS family_num, f.family_name '
                         .'FROM plants AS p'
                         .' JOIN family AS f ON p.family_ID  = f.family_ID'
                         .' GROUP BY f.family_name';
    $family_categories_list = $db->select($family_categories);
    
    /* genus categories */
    $genus_categories = 'SELECT COUNT(p.genus_ID) AS genus_num, g.genus_name '
                         .'FROM plants AS p'
                         .' JOIN genus AS g ON p.genus_ID  = g.genus_ID'
                         .' GROUP BY g.genus_name';
    $genus_categories_list = $db->select($genus_categories);
    
    /* species categories */
    $species_categories = 'SELECT COUNT(p.species_ID) AS species_num, s.species_name '
                         .'FROM plants AS p'
                         .' JOIN species AS s ON p.species_ID  = s.species_ID'
                         .' GROUP BY s.species_name';
    $species_categories_list = $db->select($species_categories); 
    
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
                    <div class="pull-left">
                        <img src="assets/logos/naro.png" alt="naro" />
                    </div>

                    <div class="col-md-6 col-md-offset-2">
                        <h2>HERBARIUM DATABASE RECORDS</h2>
                    </div>

                    <div class="pull-right">
                        <img src="assets/logos/naroforest.png" alt="naroforest" />
                    </div>
                </div>
                
                <div class="row">
                  <div class="col-lg-12">
                      <p style="padding: 3px;"></p>  
                      <!--breadcrumbs start -->
                      <ul class="breadcrumb">
                          <li><a href="dashboard.php"><i class="icon_house_alt"></i> Home</a></li>
                          <li class="active">Dashboard</li>
                      </ul>
                      <!--breadcrumbs end -->
                  </div>
              </div>        
                
                              
                  <div class="row">
                        <div class="col-sm-6 col-md-3 margin-b-30">
                              <div class="tile">
                                  <div class="tile-title clearfix">
                                      Plant Records
                                      <span class="pull-right"><i class="icon-sort-up"></i> </span>
                                  </div><!--.tile-title-->
                                  <div class="tile-body clearfix">
                                      <i class="icon-group"></i>
                                      <h4 class="pull-right"><?php echo $num_plant_records ? $num_plant_records : 0; ?></h4>
                                  </div><!--.tile-body-->
                                  <div class="tile-footer">
                                      <a href="plant_list.php">View Details...</a>
                                  </div><!--.tile footer-->
                              </div><!-- .tile-->
                        </div><!--end .col-->
                  </div><!--end row-->
                  
                  
                  <!-- Summary Statistics -->
                        <div class="row">
                              <div class="col-md-12">
                                    
                                    <section class="panel">
                                          <header class="panel-heading">
                                                Summary Plant Statistics
                                          </header>
                                        <div class="panel-body">
                                                <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                      <div class="panel-control">
                                                            <button class="btn btn-default" data-click="panel-collapse"><i class="icon-collapse"></i></button>
                                                      </div>
                                                      Family Summary
                                                  </div>
                                                  <div class="panel-body">
                                                      
                                                      <?php if($family_categories_list): ?>
                                                            <div class="row small-spacing">
                                                                  <?php foreach($family_categories_list as $family_category): ?>
                                                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                                                              <div class="box-content bg-info text-white">
                                                                                  <div class="statistics-box with-icon">
                                                                                      <i class="ico small fa icon-apple"></i>
                                                                                      <p class="text text-white"><strong><?php echo $family_category->family_name; ?></strong></p>
                                                                                      <h2 class="counter"><?php echo $family_category->family_num; ?></h2>
                                                                                  </div>
                                                                              </div>
                                                                              <!-- /.box-content -->
                                                                        </div>
                                                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                                                  <?php endforeach; ?>
                                                            </div>                                                            
                                                      <?php endif; ?>
                                                      
                                                  </div>
                                                </div>          
                                                <div class="panel panel-success">
                                                  <div class="panel-heading">
                                                      <div class="panel-control">
                                                            <button class="btn btn-default" data-click="panel-collapse"><i class="icon-collapse"></i></button>
                                                      </div>
                                                      Genus Summary
                                                  </div>
                                                  <div class="panel-body">
                                                      
                                                      <?php if($genus_categories_list): ?>
                                                            <div class="row small-spacing">
                                                                  <?php foreach($genus_categories_list as $genus_category): ?>
                                                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                                                              <div class="box-content bg-success text-white">
                                                                                  <div class="statistics-box with-icon">
                                                                                      <i class="ico small fa icon-apple"></i>
                                                                                      <p class="text text-white"><strong><?php echo $genus_category->genus_name; ?></strong></p>
                                                                                      <h2 class="counter"><?php echo $genus_category->genus_num; ?></h2>
                                                                                  </div>
                                                                              </div>
                                                                              <!-- /.box-content -->
                                                                        </div>
                                                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                                                  <?php endforeach; ?>
                                                            </div>                                                            
                                                      <?php endif; ?>
                                                      
                                                  </div>
                                                </div>
                                                <div class="panel panel-warning">
                                                  <div class="panel-heading">
                                                      <div class="panel-control">
                                                            <button class="btn btn-default" data-click="panel-collapse"><i class="icon-collapse"></i></button>
                                                      </div>
                                                      Species Summary
                                                  </div>
                                                  <div class="panel-body">
                                                      
                                                      <?php if($species_categories_list): ?>
                                                            <div class="row small-spacing">
                                                                  <?php foreach($species_categories_list as $species_category): ?>
                                                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                                                              <div class="box-content bg-warning text-white">
                                                                                  <div class="statistics-box with-icon">
                                                                                      <i class="ico small fa icon-apple"></i>
                                                                                      <p class="text text-white"><strong><?php echo $species_category->species_name; ?></strong></p>
                                                                                      <h2 class="counter"><?php echo $species_category->species_num; ?></h2>
                                                                                  </div>
                                                                              </div>
                                                                              <!-- /.box-content -->
                                                                        </div>
                                                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                                                  <?php endforeach; ?>
                                                            </div>                                                            
                                                      <?php endif; ?>
                                                      
                                                  </div>
                                                </div>                                       
                                          </div>
                                    </section>
                                    
                              </div>
                        </div>
                  <!-- End Summary Statistics -->
                          
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    
    <!-- footer start -->
        <?php include 'includes/footer.php'; ?>
    <!-- footer end -->