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

    $genus_record = $db->select_one("SELECT genus_name FROM genus WHERE genus_id = {$id} LIMIT 1");

    if(isset($_POST['update'])) {

        $_POST = array_map('stripslashes', $_POST);

        /* getting post data */
        extract($_POST);
        $genusErr = "";
        $msg = "";

        if(empty($genus)) {
            $genusErr = "Please fill this field!";
        }else {
            $genusErr = validate_name($genus);
        }

        if(empty($genusErr)) {
            $genus = ucfirst(strtolower($db->escape_string($genus)));
            $update = "UPDATE genus SET genus_name = '{$genus}' WHERE genus_id = $id";
            $query = $db->update($update);

            if($query) {
                $msg ='<div class="alert alert-success">' . $genus . ' genus has been updated</div>';
                $genus = $genusErr = '';
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
            Genus
            <small>General kind of Insect species</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Insects</a></li>
            <li><a href="genus_list.php">Genus</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='row'>
            <div class='col-md-12'>

                <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>

                <fieldset>
                    <legend>Edit Insect Genus</legend>

                    <form action='' method='post' role='form'>

                        <div class='box box-primary'>
                            <div class='box-body'>

                                <div class='form-group'>
                                    <label class='control-label' for='genus'>Insect Genus</label>
                                    <input type='text' class='form-control' id='genus' name='genus' value="<?php echo $genus_record->genus_name; ?>">
                                    <div class="help-block with-errors"><?php if(isset($genusErr) && !empty($genusErr)) echo $genusErr; ?></div>
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

