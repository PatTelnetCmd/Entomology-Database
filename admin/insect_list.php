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
    /*$sql_select_insects = "SELECT * FROM Insects";*/
    $sql_select_insects = "SELECT i.insect_Id, o.order_name, f.family_name, s.species_name, g.genus_name, ";
    $sql_select_insects .= "CONCAT(g.genus_name, ' ', s.species_name) AS Name, ";
    $sql_select_insects .= "i.AC_NO, i.country, i.location, i.coordinates, i.collector, i.doc ";
	$sql_select_insects .= "FROM Insects AS i ";
    $sql_select_insects .= "JOIN `Order` AS o ON i.order_Id = o.order_Id ";
    $sql_select_insects .= "JOIN Family AS f ON i.family_Id = f.family_Id ";
    $sql_select_insects .= "JOIN Species AS s ON i.species_Id = s.species_Id ";
    $sql_select_insects .= "JOIN Genus AS g ON i.genus_Id = g.genus_id ";
    $sql_select_insects .= "ORDER BY i.insect_Id";
    $insect_list = $db->select($sql_select_insects);

?>
<!-- header -->
<?php include 'includes/header.php'; ?>

  <!-- =============================================== -->

<!-- siderbar navigation -->

<?php include 'includes/sidebar_nav.php'; ?> 

  <!-- =============================================== -->

<!-- Insect Modal -->
<?php include 'insect_modal.php'; ?>
 <!-- ================================================ -->
 
 <!-- Delete confirm Modal -->
<?php include "insect_del_modal.php"; ?>
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
        <li class="active"> List</li>
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
            <div class="col-md-12">
                
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Insect Lists</h3>
                        <a href="add_insect.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus fa-fw"></i> Add Insect</a>&nbsp;&nbsp;
						<a href="export_excel.php" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus fa-fw"></i> Export Excel</a>
                    </div>
                    
                    <div class='box-body'>
                        
                        <table class="table table-responsive table-bordered table-condensed" id="content_list">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>AC_NO</th>
                                    <th>Country</th>
                                    <th>Location</th>
                                    <th>Co-ordinates</th>
                                    <th>Order</th>
                                    <th>Family</th>
                                    <th>Genus</th>
                                    <th>Species</th>
                                    <th>Name</th>
                                    <!--<th>Collector</th>-->
                                    <th>D.O.C</th>
                                    <th>Actions</th>
                                </tr>                      
                                
                            </thead>
                            
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php while($insect = $insect_list->fetch_array()): ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $insect['AC_NO']; ?></td>
                                        <td><?php echo $insect['country']; ?></td>
                                        <td><?php echo $insect['location']; ?></td>
                                        <td><?php echo $insect['coordinates']; ?></td>
                                        <td><?php echo $insect['order_name']; ?></td>
                                        <td><?php echo $insect['family_name']; ?></td>
                                        <td><?php echo $insect['genus_name']; ?></td>
                                        <td><?php echo $insect['species_name']; ?></td>
                                        <td><i><?php echo $insect['Name']; ?></i></td>
                                        <!--<td><?php //echo $insect['collector']; ?></td>-->
                                        <td><?php echo $insect['doc']; ?></td>

                                        <td>
                                            <center>
                                                <a href="insect_detail.php?id=<?php echo $insect['insect_Id']; ?>" title="View Details" data-remote="false" data-toggle="modal" data-target="#insectModal"><i class="fa fa-comment fa-fw"></i></a>
                                                <?php if($_SESSION['role'] == 1): ?>
                                                    <a href="edit_insect.php?id=<?php echo $insect['insect_Id']; ?>" title="Edit Record"><i class="fa fa-edit fa-fw"></i></a>
                                                    <a class="delete_insect" data-id="<?php echo $insect['insect_Id']; ?>" href="JavaScript:void(0)" title="Delete"><i class="fa fa-trash fa-fw"></i></a>
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

  