<?php
header('Content-type: application/json');
include('connection.php');
  // mysql_select_db($database_localhost,$localhost);
	  
	 $i = $_GET['i'];
	 //$r = $_GET['f'];
	// $f = str_replace('-','', $r);
	 $query_search = "SELECT * FROM movements WHERE simu = '352738052634804' order by id desc limit 20";
	 $result = mysql_query($query_search)or die(mysql_error()); 
     $return_arr= array();
	 while($row = mysql_fetch_array($result)){
     
	   $row_array['simu']=$row['simu'];
	   $row_array['point_x']=$row['point_x'];
	   $row_array['point_y']=$row['point_y'];
	   $row_array['point_z']=$row['point_z'];
	   $row_array['curkmph']=$row['curkmph'];
	   $row_array['curmps']=$row['curmps'];
	   $row_array['avgkmph']=$row['avgkmph'];
	   $row_array['avgmps']=$row['avgmps'];
	   $row_array['topkmph']=$row['topkmph'];
	   $row_array['topmps']=$row['topmps'];
	   $row_array['saa']=$row['saa'];
	   $row_array['tarehe']=$row['tarehe'];
	   
	   array_push($return_arr,$row_array);
     }
	 echo json_encode($return_arr);
	 
?>