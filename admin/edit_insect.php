<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
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
    
    /*  Fetching insect */
    $sql_select_insect = "SELECT * FROM Insects WHERE insect_Id = {$id}";
    $insect = $db->select($sql_select_insect);
    $insect_record = $insect->fetch_array();
    
    
    /* inserting insects */
    
    if(isset($_POST['update'])) {
        
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
        $collector   = $_POST['collector'];
        $identifier  = $_POST['identifier'];
        $preserv     = $_POST['preserv'];
        $others      = $_POST['others'];
        
        //var_dump($_POST);      
        
        $image       = $_FILES['imagefile']['name'];
        $image_tmp   = $_FILES['imagefile']['tmp_name'];
        
        //var_dump($_FILES);
        
        
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
            
            if(empty($image)) {
                
                $message = '';
                $sql_update = "UPDATE Insects SET CB = {$cb}, STB = {$stb}, order_Id = {$order}, family_Id = {$family}, genus_id = {$genus}, species_Id = {$species},
                               sub_family = '{$sub_fam}', auth = '{$auth}', AC_NO = '{$ac_no}', country = '{$country}', location = '{$country}',
                               coordinates = '{$coordinates}', collector = '{$collector}', identifier = '{$identifier}', preserv = '{$preserv}',
                               others = '{$others}' WHERE insect_Id = {$id}";
                
                $run_query = $db->insert($sql_update);
                
                if($run_query) {
                    //deleting image on updating
                    //unlink('../insect_images/'.$insect_record['image']);
                    $message = 'Insect successfully updated';
                    redirect_to('insect_list.php', $message);
                }
            }else {
                
                move_uploaded_file($image_tmp, "../insect_images/$image");
                $message = '';
                $sql_update = "UPDATE Insects SET CB = {$cb}, STB = {$stb}, order_Id = {$order}, family_Id = {$family}, genus_id = {$genus}, species_Id = {$species},
                               sub_family = '{$sub_fam}', auth = '{$auth}', AC_NO = '{$ac_no}', country = '{$country}', location = '{$country}',
                               coordinates = '{$coordinates}', collector = '{$collector}', identifier = '{$identifier}', image = '{$image}', preserv = '{$preserv}',
                               others = '{$others}' WHERE insect_Id = {$id}";
                
                $run_query = $db->insert($sql_update);
                
                if($run_query) {
                    //deleting previous image on updating
                    unlink('../insect_images/'.$insect_record['image']);
                    $message = 'Insect successfully updated';
                    redirect_to('insect_list.php', $message);
                }
                
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
        <li class="active"> Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            
            <div class="col-md-9">
                
                <fieldset>
                    <legend>Edit Insect</legend>
                    
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
                            
                            <form class="form-horizontal" action="edit_insect.php?id=<?php echo $id ?>" method="post" role="form" id="insect_form" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cb">CB</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="cb" name="cb" class="form-control" placeholder="CB" value="<?php echo $insect_record['CB']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="stb">STB</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stb" name="stb" class="form-control" placeholder="STB" value="<?php echo $insect_record['STB']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="insect_order">Order</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="insect_order" name="insect_order">
                                            
                                            <?php while($order = $order_list->fetch_array()): ?>                                                
                                                    <?php
                                                        if($order['order_Id'] == $insect_record['order_Id']) {
                                                            echo "<option value=" .'"'. $order['order_Id'] .'"' ." selected='selected'>";
                                                                echo $order['order_name'];
                                                            echo "</option>";
                                                            break;
                                                        }
                                                    ?>
                                                
                                            <?php endwhile; ?>
                                            
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
                                            
                                            <?php while($family = $family_list->fetch_array()): ?>                                                
                                                    <?php
                                                        if($family['family_Id'] == $insect_record['family_Id']) {
                                                            echo "<option value=" .'"'. $family['family_Id'] .'"' ." selected='selected'>";
                                                                echo $family['family_name'];
                                                            echo "</option>";
                                                            break;
                                                        }
                                                    ?>
                                                
                                            <?php endwhile; ?>
                                            
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
                                            
                                            <?php while($genus = $genus_list->fetch_array()): ?>                                                
                                                    <?php
                                                        if($genus['genus_id'] == $insect_record['genus_Id']) {
                                                            echo "<option value=" .'"'. $genus['genus_id'] .'"' ." selected='selected'>";
                                                                echo $genus['genus_name'];
                                                            echo "</option>";
                                                            break;
                                                        }
                                                    ?>
                                                
                                            <?php endwhile; ?>
                                            
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
                                            
                                            <?php while($species = $species_list->fetch_array()): ?>                                                
                                                    <?php
                                                        if($species['species_Id'] == $insect_record['species_Id']) {
                                                            echo "<option value=" .'"'. $species['species_Id'] .'"' ." selected='selected'>";
                                                                echo $species['species_name'];
                                                            echo "</option>";
                                                            break;
                                                        }
                                                    ?>
                                                
                                            <?php endwhile; ?>
                                            
                                            <?php while($species = $species_list->fetch_array()): ?>
                                                <option value="<?php echo $species['species_Id']; ?>"><?php echo $species['species_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="sub_fam">Sub Family</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="sub_fam" name="sub_fam" class="form-control" placeholder="Sub Family" value="<?php echo $insect_record['sub_family']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="auth">Auth</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="auth" name="auth" class="form-control" placeholder="Auth" value="<?php echo $insect_record['auth']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="ac_no">AC_NO</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="ac_no" name="ac_no" class="form-control" placeholder="AC_NO" value="<?php echo $insect_record['AC_NO']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="country">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="country" name="country" class="form-control" placeholder="Country" value="<?php echo $insect_record['country']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="location">Location</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="location" name="location" class="form-control" placeholder="Location" value="<?php echo $insect_record['location']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="coordinates">Co-ordinates</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="coordinates" name="coordinates" class="form-control" placeholder="Co-ordinates" value="<?php echo $insect_record['coordinates']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="collector">Collector</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="collector" name="collector" class="form-control" placeholder="Collector" value="<?php echo $insect_record['collector']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="identifier">Identifier</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="identifier" name="identifier" class="form-control" placeholder="Identifier" value="<?php echo $insect_record['identifier']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="file">Insect Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="file" name="imagefile" class="form-control" value="<?php echo $insect_record['image']; ?>">
                                         <img src="../insect_images/<?php echo $insect_record['image']; ?>" width="100px" height="100px" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="preserv">Preserv</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="preserv" name="preserv" class="form-control" placeholder="Preserv" value="<?php echo $insect_record['preserv']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="others">Others</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="others" name="others" class="form-control" placeholder="Others" value="<?php echo $insect_record['Others']; ?>">
                                    </div>
                                </div>
                                
                            </form>
                            
                        </div><!-- box-body -->
                        
                        <div class="box-footer">
                            
                            <div class="col-sm-9 col-sm-offset-3">
                                <a href="insect_list.php" class="btn btn-danger">CANCEL</a>
                                <button class="btn btn-info pull-right" type="submit" name="update" form="insect_form">EDIT</button>
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

  