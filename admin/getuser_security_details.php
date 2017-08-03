<?php require_once '../libs/config.php'; ?>
<?php require_once '../libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php

    $db = new database();

    $user = $_REQUEST['user'];
    //$user = 'kenneth';
    $security_details = $db->select_one("SELECT question, answer FROM users WHERE username = '". $user ."' ");
    //print_r($security_details); die();
    header('Content-Type: application/json');
    echo json_encode($security_details);
    //print_r(json_encode($security_details));
    die;

?>
