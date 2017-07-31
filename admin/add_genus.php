<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require_once 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    /* inserting insect genus */
    
    if(isset($_POST['submit'])) {
        
        $genus = $_POST['insect_genus'];
        $genus = ucfirst(strtolower($db->escape_string($genus)));
        
        $msg = '';
        
        if(empty($genus)){
            $msg = 'Please insert genus field!';
            //echo $msg;
        }
        else{
            
            $sql_select = "SELECT * FROM Genus WHERE genus_name = '{$genus}'";
            $run_query = $db->select($sql_select);
            
            if($run_query){
                $msg = "{$genus} already exists";
            }else {
                $message = '';
                $sql_insert = "INSERT INTO Genus(genus_name) VALUES('{$genus}')";
                $run_query = $db->insert($sql_insert);
                
                if($run_query) {
                    $message = 'Genus successfully added';
                    redirect_to('genus_list.php', $message);
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
        Genus
        <small>General kind of Insect species</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Insects</a></li>
        <li><a href="#">Genus</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class='row'>
            <div class='col-md-12'>
                
                <fieldset>
                    <legend>Add New Insect Genus</legend>
                    
                    <form action='' method='post' role='form'>
                        
                        <div class='box box-primary'>
                            <div class='box-body'>
                                
                                <?php if(!empty($msg)): ?>
                                    <div class='alert alert-warning'>
                                        <?php echo $msg; ?>
                                    </div>
                                <?php endif; ?>                                
                                
                                <div class='form-group'>
                                    <label class='control-label' for='insect_genus'>Insect Genus</label>
                                    <input type='text' class='form-control' id='insect_genus' name='insect_genus' placeholder='Enter Insect Genus'>
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

  