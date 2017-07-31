<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    /* inserting insect family */
    
    if(isset($_POST['submit'])) {
        
        $family = $_POST['insect_family'];
        $family = ucfirst(strtolower($db->escape_string($family)));
        
        $msg = '';
        
        if(empty($family)){
            $msg = 'Please insert family field!';
            //echo $msg;
        }
        else{
            
            $sql_select = "SELECT * FROM Family WHERE family_name = '{$family}'";
            $run_query = $db->select($sql_select);
            
            if($run_query){
                $msg = "{$family} already exists";
            }else {
                $message = '';
                $sql_insert = "INSERT INTO Family(family_name) VALUES('{$family}')";
                $run_query = $db->insert($sql_insert);
                
                if($run_query) {
                    $message = 'Family successfully added';
                    redirect_to('family_list.php', $message);
                }
            }           
            
        }
        
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
        Family
        <small>Collection of insect species</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Insects</a></li>
        <li><a href="#">Family</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class='row'>
            <div class='col-md-12'>
                
                <fieldset>
                    <legend>Add New Insect Family</legend>
                    
                    <form action='add_family.php' method='post' role='form'>
                        
                        <div class='box box-primary'>
                            <div class='box-body'>
                                
                                <?php if(!empty($msg)): ?>
                                    <div class='alert alert-warning'>
                                        <?php echo $msg; ?>
                                    </div>
                                <?php endif; ?>     
                                
                                <div class='form-group'>
                                    <label class='control-label' for='insect_family'>Insect Family</label>
                                    <input type='text' class='form-control' id='insect_family' name='insect_family' placeholder='Enter Insect Family'>
                                </div>
                            
                                <div class='form-group'>
                                    <input type='submit' name='submit' class='btn btn-success' value='SAVE'>
                                     <input type='reset' name='cancel' class='btn btn-danger' value='CANCEL'>
                                </div>
                            </div>      
                        </div>
                                          
                        
                    </form>
                </fieldset>
                
            </div>
        </div>        

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
    <!-- =================================================================== -->

<?php include 'includes/footer.php'; ?>

  