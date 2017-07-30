<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    /* inserting insect species */
    
    if(isset($_POST['submit'])) {
        
        $species = $_POST['insect_species'];
        
        $msg = '';
        
        if(empty($species)){
            $msg = 'Please insert species field!';
            //echo $msg;
        }
        else{
            
            $sql_select = "SELECT * FROM Species WHERE species_name = '{$species}'";
            $run_query = $db->select($sql_select);
            
            if($run_query){
                $msg = "{$species} already exists";
            }else {
                $message = '';
                $sql_insert = "INSERT INTO Species(species_name) VALUES('{$species}')";
                $run_query = $db->insert($sql_insert);
                
                if($run_query) {
                    $message = 'Species successfully added';
                    redirect_to('species_list.php', $message);
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
        Species
        <small>Kind of insect</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Insects</a></li>
        <li><a href="#">Species</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class='row'>
            <div class='col-md-12'>
                
                <fieldset>
                    <legend>Add New Insect Species</legend>
                    
                    <form action='add_species.php' method='post' role='form'>
                        
                        <div class='box box-primary'>
                            <div class='box-body'>
                                
                                <?php if(!empty($msg)): ?>
                                    <div class='alert alert-warning'>
                                        <?php echo $msg; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class='form-group'>
                                    <label class='control-label' for='insect_species'>Insect Species</label>
                                    <input type='text' class='form-control' id='insect_species' name='insect_species' placeholder='Enter Insect Species'>
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

  