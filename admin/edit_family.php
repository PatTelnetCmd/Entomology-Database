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

    $family_record = $db->select_one("SELECT family_name FROM family WHERE family_Id = {$id} LIMIT 1");

    if(isset($_POST['update'])) {

        $_POST = array_map('stripslashes', $_POST);

        /* getting post data */
        extract($_POST);
        /*echo $family;
        echo "<pre>"; print_r($_POST); echo "</pre>"; die();*/
        $familyErr = "";
        $msg = "";

        if(empty($family)) {
            $familyErr = "Please fill this field!";
        }else {
            $familyErr = validate_name($family);
        }

        if(empty($familyErr)) {
            $family = ucfirst(strtolower($db->escape_string($family)));
            $update = "UPDATE family SET family_name = '{$family}' WHERE family_Id = $id";
            $query = $db->update($update);

            if($query) {
                $msg ='<div class="alert alert-success">' . $family . ' family has been updated</div>';
                $family = $familyErr = '';
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
            Family
            <small>Collection of insect species</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Insects</a></li>
            <li><a href="family_list.php">Family</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='row'>
            <div class='col-md-12'>

                <?php echo isset($msg) && !empty($msg) ? $msg : ''; ?>

                <fieldset>
                    <legend>Edit Insect Family</legend>

                    <form action='' method='post' role='form'>

                        <div class='box box-primary'>
                            <div class='box-body'>

                                <div class='form-group'>
                                    <label class='control-label' for='insect_family'>Insect Family</label>
                                    <input type='text' class='form-control' id='insect_family' name='family' value="<?php echo $family_record->family_name; ?>">
                                    <div class="help-block with-errors"><?php if(isset($familyErr) && !empty($familyErr)) echo $familyErr; ?></div>
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

