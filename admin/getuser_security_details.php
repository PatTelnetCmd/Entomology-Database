<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php

    $user = $_REQUEST['user'];
    //$user = 'admin';
    $security_details = $db->select_one("SELECT question, answer FROM user WHERE username = '". $user ."' ");
    //print_r($security_details);
    header('Content-Type: application/json');
    echo json_encode($security_details);
    //print_r(json_encode($security_details));
    die;

?>
