<?php
    session_start();
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require_once 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    }
    
    /* fetching genus list from the databse */
    $sql_select_species = "SELECT * FROM Species";
    $species_list = $db->select($sql_select_species);

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
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if(isset($msg)): ?>
            <div class='alert alert-success'>
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-9">
                
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Species Lists</h3>
                        <a href="add_species.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus fa-fw"></i> Add Species</a>
                    </div>
                    
                    <div class='box-body'>
                        
                        <table class="table table-responsive table-bordered" id="content_list">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Species Name</th>
                                    <th></th>
                                </tr>                      
                                
                            </thead>
                            
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php while($row = $species_list->fetch_array()): ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $row['species_name']; ?></td>
                                        <td>
                                            <center>
                                                <?php if($_SESSION['role'] == 1): ?>
                                                    <a title="Edit" href="edit_species.php?id=<?php echo $row['species_Id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit fa-fw"></i></a>
                                                    <a title="Delete" href="delete_species.php?id=<?php echo $row['species_Id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-fw"></i></a>
                                                <?php endif; ?>
                                        </center>
                                        </td>
                                    </tr>
                                    <?php $counter++; ?>
                                <?php endwhile; ?>
                            </tbody>
                            
                        </table>
                        
                    </div><!-- box-body -->
                </div><!-- box -->
                
            </div><!-- col-md-12 -->
        </div><!-- row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- footer -->
    <!-- =================================================================== -->

<?php include 'includes/footer.php'; ?>

  