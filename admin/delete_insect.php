<?php

    session_start();
    //checking if user is logged in
    //if(isset($_SESSION['userSession']) != ""){
    //    header("Location: dashboard.php");
    //}
    
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();
    
    //if(isset($_GET['id'])) {
    //    $id = $_GET['id'];
    //}
    
    if($_REQUEST['delete']) {
        
        $id = $_REQUEST['delete'];
        
        $table = 'Insects';
        $message = "";
        
        $sql_select_insect = "SELECT * FROM Insects WHERE insect_Id = {$id}";
        $insect = $db->select($sql_select_insect);
        $insect_record = $insect->fetch_array();
        
        //deleting previous image on deleting
        unlink('../insect_images/'.$insect_record['image']);
                
        $sql_delete = "DELETE FROM {$table} WHERE insect_Id={$id}";
        $run_query = $db->delete($sql_delete);
        
        if($run_query) {
            $message = 'Insect with ID '. $id. ' deleted';
            echo $message;
            //redirect_to("insect_list.php", "{$message}");
        }
        
    }
    
    

?>