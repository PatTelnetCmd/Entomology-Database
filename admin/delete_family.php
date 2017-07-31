<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php include 'includes/head.php'; ?>
<?php

/* if not logged in */
if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
    header('Location: login.php');
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

if(isset($_POST['delete'])) {

    $delete_query = $db->delete("DELETE FROM family WHERE family_ID = {$id}");

    if($delete_query) {
        $message = "Family Record with ID = {$id} deleted from database";
        redirect_to('family_list.php', $message);    //redirecting to insect list page
    }
}



?>

<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->
    <?php include 'includes/header.php'; ?>
    <!--header end-->

    <!--sidebar start-->
    <?php include 'includes/sidebar_nav.php'; ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard.php"><i class="icon_house_alt"></i> Home</a></li>
                        <li><a href="#">Family</a></li>
                        <li class="active">Delete Family Record</li>
                        <li class="pull-right"><a href="Family_list.php">Family List</a></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel panel-danger">
                        <div class="panel-heading">
                            Confirm Delete
                        </div>

                        <div class="panel-body">
                            <div class="alert alert-danger">
                                Are you sure you want to delete record?
                            </div>

                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" name="delete"><span class="icon-trash"></span> DELETE</button>
                                        <a class="btn btn-default" href="plant_list.php" title=""><span class="icon_target"></span> CANCEL</a></td>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>
<!-- container section end -->

<!-- footer start -->
<?php include 'includes/footer.php'; ?>
<!-- footer end -->