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
    $sql_select_genus = "SELECT * FROM Genus";
    $genus_list = $db->select($sql_select_genus);

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
        <li class="active">LIST</li>
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
                        <h3 class="box-title">Genus Lists</h3>
                        <a href="add_genus.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus fa-fw"></i> Add Genus</a>
                    </div>
                    
                    <div class='box-body'>
                        
                        <table class="table table-responsive table-bordered" id="content_list">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Genus Name</th>
                                    <th></th>
                                </tr>                      
                                
                            </thead>
                            
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php while($row = $genus_list->fetch_array()): ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $row['genus_name']; ?></td>
                                        <td>
                                            <center>
                                                <a title="Edit" href="edit_genus.php?id=<?php echo $row['genus_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit fa-fw"></i></a>
                                                <a title="Delete" href="delete_genus.php?id=<?php echo $row['genus_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-fw"></i></a>
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

  