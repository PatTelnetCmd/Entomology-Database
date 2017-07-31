<?php require_once 'libs/database.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php include 'includes/head.php'; ?>
<?php
      /* if not logged in */
      if(!isset($_SESSION['userSession']) || $_SESSION['userSession'] = ""){
          header('Location: login.php');
          exit();
      }
      
      /* Fetching Family list */
      $family_list = $db->select('SELECT * FROM family');
      /*echo "<pre>"; print_r($family_list); echo "</pre>"; die(); */
      
      /* Fetching Genus list */
      $genus_list = $db->select('SELECT * FROM genus');
      
      /* Fetching Species List */
      $species_list = $db->select('SELECT * FROM species');
      
      if(isset($_POST['submit'])) {
            $_POST = array_map('stripslashes', $_POST);
            
            /* converting post data into variablest */
            extract($_POST);
            /*
            echo $family .'->'.$genus.'->'.$species.'<br />';
            echo "<pre>"; print_r($_POST); echo "</pre>"; */
            /*echo "<pre>"; print_r($_FILES); echo "</pre>";*/
            
            //variables for creating thumbnails and medium file sizes on upload
            $thumb_path = 'images/thumbs/';
            $medium_path = 'images/medium/';
            $thumb      = FALSE;
            $medium     = FALSE;
            
            $thumb_width   = '80';
            $thumb_height  = '80';
            $medium_width  = '300';
            $medium_height = '250';
                   
            
            $msg = '';
            
            if(count($_FILES['images']['name']) > 0 && !empty($_FILES['images']['name'][0])) {
                  $image       = $_FILES['images']['name'][0];
                  $image_tmp   = $_FILES['images']['tmp_name'][0];
                  
                  /*====Inserting into plant table=========*/
                  $message = '';
                  $sql_insert  = "INSERT INTO plants(family_ID, genus_ID, species_ID, locality, date_of_collection, habitat, region, ";
                  $sql_insert .= "gps_nothings, gps_eastings, image, description)";
                  $sql_insert .= "  VALUES({$db->escape_string($family)}, {$db->escape_string($genus)}, {$db->escape_string($species)}, ";
                  $sql_insert .= "'{$db->escape_string($locality)}', '{$db->escape_string($date)}', '{$db->escape_string($habitat)}', '{$db->escape_string($region)}', ";
                  $sql_insert .= "'{$db->escape_string($gps_north)}', '{$db->escape_string($gps_east)}', '{$image}', '{$db->escape_string($description)}')";
                  $run_query = $db->insert_get_id($sql_insert);
                  
                  //getting last_id
                  $last_id = $run_query;
                  //print_r($last_id); die();
                  
                  if($run_query) {
                      $message = 'Plant Record successfully added';
                      //redirect_to('insect_list.php', $message);
                  }
                  
                  //Loop through each file
                  for($i = 0; $i < count($_FILES['images']['name']); $i++) {
                      //Get temp file path
                      $tempFilePath = $_FILES['images']['tmp_name'][$i];
                      
                      //Make sure filePath is not enpty
                      if($tempFilePath != "") {
                          //save the file name
                          $fileName = $_FILES['images']['name'][$i];
                          $file_ext = explode(".", $fileName)[1];             //getting the file extension
                          $shortname = explode(".", $fileName)[0];            //file name without extension
                          $fileType = $_FILES['images']['type'][$i];
                          $fileSize = $_FILES['images']['size'][$i];
                          //save the url and the file
                          $filePath = "images/large/" . date('d-m-Y-H-i-s') .'-'. $_FILES['images']['name'][$i];
                          
                          //upload file to temp dir and upload dir
                          if(move_uploaded_file($tempFilePath, $filePath)) {
                              
                              $files[] = $shortname;
                              //insert into db 
                              //use $shortname for the filename
                              //use $filePath for the relative url to the file                        
                                                      
                              /*=========Inserting into image table==============*/
                              $sql = "INSERT INTO images(plant_ID, image_name, image_name_ext, image_type, image_size, image_url, uploaded) ";
                              $sql .= "VALUES($last_id, '{$shortname}', '{$fileName}', '{$fileType}', '{$fileSize}', '{$filePath}', NOW())";
                              
                              $msq = "";
                              $query = $db->insert($sql);
                              if($query){
                                  $msg = 'success';
                              }else{
                                  $msg = 'Failed';
                              }
                              
                              
                              /*========thumbnail and medium file creation============*/
                              $thumb    = TRUE;
                              $medium   = TRUE;
                              
                              //thumbnail creation
                              if($thumb == TRUE)
                              {
                                  $thumbnail = $thumb_path . date('d-m-Y-H-i-s') .'-'. $fileName;
                                  //print_r($thumbnail) . '<br />';
                                  list($width,$height) = getimagesize($filePath);
                                  $thumb_height = ($thumb_width/$width) * $height;			
                                  $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
                                  switch($file_ext){
                                      case 'jpg':
                                          $source = imagecreatefromjpeg($filePath);
                                          break;
                                      case 'jpeg':
                                          $source = imagecreatefromjpeg($filePath);
                                          break;
                                      case 'png':
                                          $source = imagecreatefrompng($filePath);
                                          break;
                                      case 'gif':
                                          $source = imagecreatefromgif($filePath);
                                          break;
                                      default:
                                          $source = imagecreatefromjpeg($filePath);
                                  }
                                  imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
                                  switch($file_ext){
                                      case 'jpg' || 'jpeg':
                                          imagejpeg($thumb_create,$thumbnail,100);
                                          break;
                                      case 'png':
                                          imagepng($thumb_create,$thumbnail,100);
                                          break;
                                      case 'gif':
                                          imagegif($thumb_create,$thumbnail,100);
                                          break;
                                      default:
                                          imagejpeg($thumb_create,$thumbnail,100);
                                  }
                              }
                              
                              
                              //medium creation
                              if($medium == TRUE)
                              {
                                  $mediumnail = $medium_path . date('d-m-Y-H-i-s') .'-'. $fileName;
                                  //echo $mediumnail. '<br />';
                                  list($width,$height) = getimagesize($filePath);
                                  $medium_height = ($medium_width/$width) * $height;			
                                  $medium_create = imagecreatetruecolor($medium_width,$medium_height);
                                  switch($file_ext){
                                      case 'jpg':
                                          $source = imagecreatefromjpeg($filePath);
                                          break;
                                      case 'jpeg':
                                          $source = imagecreatefromjpeg($filePath);
                                          break;
                                      case 'png':
                                          $source = imagecreatefrompng($filePath);
                                          break;
                                      case 'gif':
                                          $source = imagecreatefromgif($filePath);
                                          break;
                                      default:
                                          $source = imagecreatefromjpeg($filePath);
                                  }
                                  imagecopyresized($medium_create,$source,0,0,0,0,$medium_width,$medium_height,$width,$height);
                                  switch($file_ext){
                                      case 'jpg' || 'jpeg':
                                          imagejpeg($medium_create,$mediumnail,100);
                                          break;
                                      case 'png':
                                          imagepng($medium_create,$mediumnail,100);
                                          break;
                                      case 'gif':
                                          imagegif($medium_create,$mediumnail,100);
                                          break;
                                      default:
                                          imagejpeg($medium_create,$mediumnail,100);
                                  }
                              }
                              
                              /*========End thumnail and medium file creation=====*/
                              
                              
                          }
                      }
                  }
                  
                  redirect_to('plant_list.php', $message);    //redirecting to insect list page
            }else {
                  
                  $image       = "image_url";
                  $image_tmp   = "";
                  
                  /*====Inserting into plant table=========*/
                  $message = '';
                  $sql_insert  = "INSERT INTO plants(family_ID, genus_ID, species_ID, locality, date_of_collection, habitat, region, ";
                  $sql_insert .= "gps_nothings, gps_eastings, image, description)";
                  $sql_insert .= "  VALUES({$db->escape_string($family)}, {$db->escape_string($genus)}, {$db->escape_string($species)}, ";
                  $sql_insert .= "'{$db->escape_string($locality)}', NOW(), '{$db->escape_string($habitat)}', '{$db->escape_string($region)}', ";
                  $sql_insert .= "'{$db->escape_string($gps_north)}', '{$db->escape_string($gps_east)}', '{$image}', '{$db->escape_string($description)}')";
                  $run_query = $db->insert_get_id($sql_insert);
                  
                  //getting last_id
                  $last_id = $run_query;
                  //print_r($last_id); die();
                  
                  if($run_query) {
                      $message = 'Plant successfully added';
                      //redirect_to('insect_list.php', $message);
                  }
                  
                  redirect_to('plant_list.php', $message);    //redirecting to insect list page
                  
                  
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
                        <li><a href="#">Plants</a></li>
                        <li class="active">Add Plant Record</li>
                        <li class="pull-right"><a href="plant_list.php">General List</a></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            
            <!-- form -->
            <!-- end form -->
            <div class="row">
                  <div class="col-lg-8">
                        <!-- panel -->
                        <section class="panel">
                              <header class="panel-heading">
                                    Add Plant Record
                              </header>
                              <div class="panel-body">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" novalidate>
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="family">Family:</label>
                                                <div class="col-md-10">
                                                      <select id="family" name="family" class="form-control">
                                                            <option value="">Select Family</option>
                                                            <?php foreach($family_list as $family): ?>
                                                                  <option value="<?php echo $family->family_ID; ?>"><?php echo $family->family_name; ?></option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="genus">Genus:</label>
                                                <div class="col-md-10">
                                                      <select id="genus" name="genus" class="form-control">
                                                            <option value="">Select Genus</option>
                                                            <?php foreach($genus_list as $genus): ?>
                                                                  <option value="<?php echo $genus->genus_ID; ?>"><?php echo $genus->genus_name; ?></option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="species">Species:</label>
                                                <div class="col-md-10">
                                                      <select id="species" name="species" class="form-control">
                                                            <option value="">Select Species</option>
                                                            <?php foreach($species_list as $species): ?>
                                                                  <option value="<?php echo $species->species_ID; ?>"><?php echo $species->species_name; ?></option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="locality">Locality:</label>
                                                <div class="col-md-10">
                                                      <input type="text" id="locality" name="locality" class="form-control">
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="habitat">Habitat:</label>
                                                <div class="col-md-10">
                                                      <input type="text" id="habitat" name="habitat" class="form-control">
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="gps_east">Gps Eastings:</label>
                                                <div class="col-md-10">
                                                      <input type="text" id="gps_east" name="gps_east" class="form-control">
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="gps_north">Gps Northings:</label>
                                                <div class="col-md-10">
                                                      <input type="text" id="gps_north" name="gps_north" class="form-control">
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                              <label class="control-label col-md-2" for="dp1">Date of Collection</label>
                                              <div class="col-sm-10">
                                                  <input id="dp1" type="text" value="01/01/2017" size="16" class="form-control" name="date">
                                              </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="region">Region:</label>
                                                <div class="col-md-10">
                                                      <input type="text" id="region" name="region" class="form-control">
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="images">Image(s):</label>
                                                <div class="col-md-10">
                                                      <input type="file" id="images" name="images[]" class="form-control file" data-show-upload="false" data-show-caption="true" multiple>
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                <label class="col-md-2 control-label" for="description">Description:</label>
                                                <div class="col-md-10">
                                                      <textarea id="description" name="description" class="form-control" rows="10"></textarea>
                                                </div>
                                          </div>
                                          
                                          <div class="form-group">
                                                
                                                <div class="col-md-10 col-md-offset-2">
                                                      <input type="submit" name="submit" value="SAVE" class="btn btn-primary">
                                                      <input type="reset" name="cancel" value="CANCEL" class="btn btn-danger">
                                                </div>
                                          </div>
                                          
                                    </form>
                              </div>
                        </section>
                        <!-- endpanel -->
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