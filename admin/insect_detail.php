<?php
	session_start();
	
    require_once '../libs/config.php';
    require_once '../libs/database.php';
    require 'includes/functions.php';
    
    $db = new database();              //instantiating database object
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    /*  Fetching insect */
    //$sql_select_insect = "SELECT * FROM Insects WHERE insect_Id = {$id}";
    $sql_select_insect = "SELECT i.*, o.order_name, f.family_name, s.species_name, g.genus_name ";
	$sql_select_insect .= "FROM Insects AS i ";
    $sql_select_insect .= "JOIN `Order` AS o ON i.order_Id = o.order_Id ";
    $sql_select_insect .= "JOIN Family AS f ON i.family_Id = f.family_Id ";
    $sql_select_insect .= "JOIN Species AS s ON i.species_Id = s.species_Id ";
    $sql_select_insect .= "JOIN Genus AS g ON i.genus_Id = g.genus_id AND i.insect_Id = {$id}";
    //ORDER BY i.insect_Id"
    $insect = $db->select($sql_select_insect);
    $insect_record = $insect->fetch_array();
     
?>


<div class="media">
    <div class="media-left">
      <a href="#">
        <img class="media-object img-thumbnail" src="../insect_images/<?php echo $insect_record['image']; ?>" width = '300px' alt="...">
      </a>
    </div>
    <div class="media-body">
      <h2 class="media-heading"><?php echo $insect_record['image']; ?></h2>
      <p>Order:  <?php echo $insect_record['order_name']; ?></p>
      <p>Family:  <?php echo $insect_record['family_name']; ?></p>
      <p>Genus:  <?php echo $insect_record['genus_name']; ?></p>
      <p>Species:  <?php echo $insect_record['species_name']; ?></p>
      <p>Date Collected:  <?php echo $insect_record['doc']; ?></p>
    </div>
 </div>