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

    $order_record = $db->select_one("SELECT order_name FROM order WHERE order_Id = {$id} LIMIT 1");

    if(isset($_POST['update'])) {

        $_POST = array_map('stripslashes', $_POST);

        /* getting post data */
        extract($_POST);
        $orderErr = "";
        $msg = "";

        if(empty($order)) {
            $orderErr = "Please fill this field!";
        }else {
            $orderErr = validate_name($order);
        }

        if(empty($orderErr)) {
            $order = ucfirst(strtolower($db->escape_string($order)));
            $update = "UPDATE order SET order_name = '{$order}' WHERE order_Id = $id";
            $query = $db->update($update);

            if($query) {
                $msg ='<div class="alert alert-success">' . $order . ' order has been updated</div>';
                $order = $orderErr = '';
            }else {
                $msg  = '';
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
            Order
            <small>Describe order of species</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Insects</a></li>
            <li><a href="order_list.php">Order</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='row'>
            <div class='col-md-12'>

                <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>

                <fieldset>
                    <legend>Edit Insect Order</legend>

                    <form action='' method='post' role='form'>

                        <div class='box box-primary'>
                            <div class='box-body'>

                                <div class='form-group'>
                                    <label class='control-label' for='order'>Insect Order</label>
                                    <input type='text' class='form-control' id='order' name='order' value="<?php echo $order_record->order_name; ?>">
                                    <div class="help-block with-errors"><?php if(isset($orderErr) && !empty($orderErr)) echo $orderErr; ?></div>
                                </div>

                                <div class='form-group'>
                                    <input type='submit' name='update' class='btn btn-success' value='UPDATE'>
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

