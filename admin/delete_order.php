<?php
session_start();

require_once '../libs/config.php';
require_once '../libs/database.php';
require 'includes/functions.php';

$db = new database();              //instantiating database object

/* if not logged in */
if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
    header('Location: login.php');
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

if(isset($_POST['delete'])) {

    $delete_query = $db->delete("DELETE FROM `order` WHERE order_Id = {$id}");

    if($delete_query) {
        $message = "Order Record with ID = {$id} deleted from database";
        redirect_to('order_list.php', $message);    //redirecting to insect list page
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
            Order
            <small>Describe order of species</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Insects</a></li>
            <li><a href="order_list.php">Order</a></li>
            <li class="active">Delete</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='row'>
            <div class='col-md-12'>

                <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>

                <fieldset>
                    <legend>Insect Genus</legend>

                    <form action='' method='post' role='form'>

                        <div class='box box-danger'>
                            <div class="box-header">
                                Confirm Delete
                            </div>
                            <div class='box-body'>

                                <div class="alert alert-danger">
                                    Are you sure you want to delete record?
                                </div>

                                <div class='form-group'>
                                    <input type='submit' name='delete' class='btn btn-danger' value='DELETE'>
                                    <a class="btn btn-info" href="order_list.php" title=""> CANCEL </a>
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

