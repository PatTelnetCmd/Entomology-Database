<?PHP
        session_start();
	
        require_once '../libs/config.php';
        require_once '../libs/database.php';
        require_once 'includes/functions.php';
        
        $db = new database();              //instantiating database object
        
        /* fetching genus list from the databse */
        /*$sql_select_insects = "SELECT * FROM Insects";*/
        $sql_select_insects = "SELECT i.insect_Id, o.order_name, f.family_name, s.species_name, g.genus_name, ";
        $sql_select_insects .= "CONCAT(s.species_name, '-', g.genus_name) AS SpeciesGenus, ";
        $sql_select_insects .= "i.auth, i.AC_NO, i.country, i.location, i.coordinates, i.collector, i.identifier ";
        $sql_select_insects .= "FROM Insects AS i ";
        $sql_select_insects .= "JOIN `Order` AS o ON i.order_Id = o.order_Id ";
        $sql_select_insects .= "JOIN Family AS f ON i.family_Id = f.family_Id ";
        $sql_select_insects .= "JOIN Species AS s ON i.species_Id = s.species_Id ";
        $sql_select_insects .= "JOIN Genus AS g ON i.genus_Id = g.genus_id ";
        $sql_select_insects .= "ORDER BY i.insect_Id";
        $insect_list = $db->select($sql_select_insects);
	
	$insect_records = array();
	if($insect_list) {
		if($insect_list->num_rows){
		  while($insect_record = $insect_list->fetch_assoc()){
		    $insect_records[] = $insect_record;
		  }
		  //print_r($insect_records);
		  $insect_list->free();
		}
	}
	//print_r($insect_list);

        function cleanData(&$str)
        {
          $str = preg_replace("/\t/", "\\t", $str);
          $str = preg_replace("/\r?\n/", "\\n", $str);
          if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }
      
        // filename for download
        $filename = "insect_data_" . date('Ymd') . ".xls";
      
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        
        //header("Content-Type: text/plain");

      
        $flag = false;
        $result = $insect_list;
        //while(false !== ($row = $result->fetch_assoc())) {
	foreach($insect_records as $row) {
          if(!$flag) {
            // display field/column names as first row
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
          }
          array_walk($row, __NAMESPACE__ . '\cleanData');
          echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
?>