<?php 
//session_start();
   require_once('connection.php'); 
   mysql_select_db($database_localhost,$localhost);
   
   
	 
	$simu = $_POST['simu'];
	$topmps = $_POST['topmps'];
	$topkmps = $_POST['topkmph'];
	$lat = $_POST['xkod'];
	$lon = $_POST['ykod'];
	$alti = $_POST['zkod'];
	$curmps = $_POST['curmps'];
	$curkmph = $_POST['curkmph'];
	$avgmps = $_POST['avgmps'];
	$avgkmph = $_POST['avgkmph'];
	
	
			$target_path = "../images2/";
/* Add the original filename to our target path.
Result is "uploads/filename.extension" */
         $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
		
		//$picture=$_POST['picture'];
		//$status_update=$_POST['status_update'];
		
		$url =  basename( $_FILES['uploadedfile']['name']);
    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		
	}
	//$masaa =echo  $CURTIME();
	 $query_search = "insert into  movements (simu,  point_y, point_x, curkmph, curmps, avgkmph, avgmps, topkmph, topmps, saa, tarehe, point_z, pic_url)
	 values('".$simu."','".$lat."','".$lon."','".$curkmph."','".$curmps."','".$avgkmph."','".$avgmps."','".$topkmps."','".$topmps."',now(),curdate(), '".$alti."', '".$url."')";
	 $query_exec = mysql_query($query_search) or die(mysql_error());
	 $rows = mysql_num_rows($query_exec);
	// echo $descr;
	 if($rows --> 0)
	 {
	 echo "Y";
	 }
	else
	{
	echo "N";
	}
	

	?>