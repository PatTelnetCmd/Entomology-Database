<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    /*  Fetching order list */
    $sql_select_order = "SELECT * FROM `Order`";
    $order_list = $db->select($sql_select_order);
    
    /*  Fetching family list */
    $sql_select_family = "SELECT * FROM Family";
    $family_list = $db->select($sql_select_family);
    
    /*  Fetching genus list */
    $sql_select_genus = "SELECT * FROM Genus";
    $genus_list = $db->select($sql_select_genus);
    
    /*  Fetching species list */
    $sql_select_species = "SELECT * FROM Species";
    $species_list = $db->select($sql_select_species);
    
    
    /* inserting insects */
    
    if(isset($_POST['submit'])) {
        
        $cb          = $_POST['cb'];
        $stb         = $_POST['stb'];        
        $order       = $_POST['insect_order'];
        $family      = $_POST['insect_family'];
        $genus       = $_POST['insect_genus'];
        $species     = $_POST['insect_species'];
        $sub_fam     = $_POST['sub_fam'];
        $auth        = $_POST['auth'];
        $ac_no       = $_POST['ac_no'];
        $country     = $_POST['country'];
        $location    = $_POST['location'];
        $coordinates = $_POST['coordinates'];
        $doc         = $_POST['date'];
        $collector   = $_POST['collector'];
        $identifier  = $_POST['identifier'];
        $preserv     = $_POST['preserv'];
        $others      = $_POST['others'];
        
        //var_dump($_POST);      
        
        $image       = $_FILES['imagefile']['name'];
        $image_tmp   = $_FILES['imagefile']['tmp_name'];
        
        
        $msg = '';
        
        //if(empty($order)){
        //    $msg = 'Please insert order field!';
        //    //echo $msg;
        //}
        //else{
            
            //$sql_select = "SELECT * FROM Insects WHERE order_name = '{$order}'";
            //$run_query = $db->select($sql_select);
            
            //if($run_query){
            //    $msg = "{$order} already exists";
            //}else {
            
                move_uploaded_file($image_tmp, "../insect_images/$image");
                $message = '';
                $sql_insert  = "INSERT INTO Insects(CB, STB, order_Id, family_Id, genus_id, species_Id, sub_family, auth, AC_NO, country, location, ";
                $sql_insert .= "coordinates, doc, collector, identifier, image, preserv, others)";
                $sql_insert .= "  VALUES({$cb}, {$stb}, {$order}, {$family}, {$genus}, {$species}, '{$sub_fam}', '{$auth}', '{$ac_no}', '{$country}', ";
                $sql_insert .= "'{$location}', '{$coordinates}', '{$doc}', '{$collector}', '{$identifier}', '{$image}', '{$preserv}', '{$others}')";
                $run_query = $db->insert($sql_insert);
                
                if($run_query) {
                    $message = 'Insect successfully added';
                   redirect_to('insect_list.php', $message);
                }
        //    }           
        //    
        //}
    }

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
        Insects
        <!--<small>it all starts here</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Insects</a></li>
        <li class="active"> Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            
            <div class="col-md-9">
                
                <fieldset>
                    <legend>Add New Insect</legend>
                    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Insect Form</h3>
                        </div>
                        <div class="box-body">
                            
                            <?php if(!empty($msg)): ?>
                                <div class='alert alert-warning'>
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>
                            
                            <form class="form-horizontal" action="add_insect.php" method="post" role="form" id="insect_form" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cb">CB</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="cb" name="cb" class="form-control" placeholder="CB">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="stb">STB</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stb" name="stb" class="form-control" placeholder="STB">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="insect_order">Order</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="insect_order" name="insect_order">
                                            <option>Select Order</option>
                                            <?php while($order = $order_list->fetch_array()): ?>
                                                <option value="<?php echo $order['order_Id']; ?>"><?php echo $order['order_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="insect_family">Family</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="insect_family" name="insect_family">
                                            <option>Select Family</option>
                                            <?php while($family = $family_list->fetch_array()): ?>
                                                <option value="<?php echo $family['family_Id']; ?>"><?php echo $family['family_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="insect_genus">Genus</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="insect_genus" name="insect_genus">
                                            <option>Select Genus</option>
                                            <?php while($genus = $genus_list->fetch_array()): ?>
                                                <option value="<?php echo $genus['genus_id']; ?>"><?php echo $genus['genus_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="insect_species">Species</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="insect_species" name="insect_species">
                                            <option>Select Species</option>
                                            <?php while($species = $species_list->fetch_array()): ?>
                                                <option value="<?php echo $species['species_Id']; ?>"><?php echo $species['species_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="sub_fam">Sub Family</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="sub_fam" name="sub_fam" class="form-control" placeholder="Sub Family">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="auth">Auth</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="auth" name="auth" class="form-control" placeholder="Auth">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="ac_no">AC_NO</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="ac_no" name="ac_no" class="form-control" placeholder="AC_NO">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="country">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="country" name="country" class="form-control" placeholder="Country">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="location">Location</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="location" name="location" class="form-control" placeholder="Location">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="coordinates">Co-ordinates</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="coordinates" name="coordinates" class="form-control" placeholder="Co-ordinates">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="coordinates">Date of Collection</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="dp1" name="date" class="form-control" placeholder="01/01/2017(DD/MM/YYYY)">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="collector">Collector</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="collector" name="collector" class="form-control" placeholder="Collector">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="identifier">Identifier</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="identifier" name="identifier" class="form-control" placeholder="Identifier">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="file">Insect Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="file" name="imagefile" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="preserv">Preserv</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="preserv" name="preserv" class="form-control" placeholder="Preserv">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="others">Others</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="others" name="others" class="form-control" placeholder="Others">
                                    </div>
                                </div>
                                
                            </form>
                            
                        </div><!-- box-body -->
                        
                        <div class="box-footer">
                            
                            <div class="col-sm-9 col-sm-offset-3">
                                <button class="btn btn-danger" type="reset" form="insect_form">CANCEL</button>
                                <button class="btn btn-info pull-right" type="submit" name="submit" form="insect_form">SAVE</button>
                            </div>
                            
                        </div><!-- box-footer -->
                        
                    </div><!-- box -->
                </fieldset>
                
            </div><!-- col-md-12 -->
            
        </div><!-- row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
    <!-- =================================================================== -->

<?php include 'includes/footer.php'; ?>

  