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

$species_record = $db->select_one("SELECT species_name FROM species WHERE species_Id = {$id} LIMIT 1");

if(isset($_POST['update'])) {

    $_POST = array_map('stripslashes', $_POST);

    /* getting post data */
    extract($_POST);
    $speciesErr = "";
    $msg = "";

    if(empty($species)) {
        $speciesErr = "Please fill this field!";
    }else {
        $speciesErr = validate_name($species);
    }

    if(empty($speciesErr)) {
        $species = ucfirst(strtolower($db->escape_string($species)));
        $update = "UPDATE species SET species_name = '{$species}' WHERE species_Id = $id";
        $query = $db->update($update);

        if($query) {
            $msg ='<div class="alert alert-success">' . $species . ' species has been updated</div>';
            $species = $speciesErr = '';
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
            Species
            <small>Kind of insect</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Insects</a></li>
            <li><a href="species_list.php">Species</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='row'>
            <div class='col-md-12'>

                <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>

                <fieldset>
                    <legend>Edit Insect Species</legend>

                    <form action='' method='post' role='form'>

                        <div class='box box-primary'>
                            <div class='box-body'>

                                <div class='form-group'>
                                    <label class='control-label' for='species'>Insect species</label>
                                    <input type='text' class='form-control' id='species' name='species' value="<?php echo $species_record->species_name; ?>">
                                    <div class="help-block with-errors"><?php if(isset($speciesErr) && !empty($speciesErr)) echo $speciesErr; ?></div>
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

