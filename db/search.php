<?php
header('Content-type: application/json');
require_once('connection.php'); 
  
	  
	   $q=$_GET["q"];
		
	 $query_search = "SELECT * FROM `projects` where CSO_Name like '%".$q."%' or locality like '%".$q."%' or Street LIKE '%".$q."%' or Building LIKE '%".$q."%' or CSOTypeName LIKE '%".$q."%' or `Name` LIKE '%".$q."%' or CSO_ID LIKE '%".$q."%' or Street LIKE '%".$q."%' or Building LIKE '%".$q."%' or RegistrationNum LIKE '%".$q."%' or Respondent LIKE '%".$q."%'; ;";
	 //$query_search = "SELECT * FROM population WHERE province='EASTERN'";
	 $result = mysql_query($query_search)or die(mysql_error());
	 	 
      $return_arr= array();
	 while($row = mysql_fetch_array($result)){
   
		
			
			$row_array['name']=$row['CSO_Name'];
			$row_array['locality']=$row['Locality'];
			$row_array['Longitude']=$row['Longitude'];
			$row_array['Latitude']=$row['Latitude'];
			$row_array['mail']=$row['Email'];
			$row_array['box']=$row['MailAddress'];
			$row_array['simu']=$row['Cell Phone'];
			$row_array['street']=$row['Street'];
			$row_array['building']=$row['Building'];
			$row_array['site']=$row['Website'];
			$row_array['tarehe']=$row['Date'];
			$row_array['res']=$row['Respondent'];
			$row_array['regn']=$row['RegistrationNum'];
			$row_array['fone']=$row['Telephone'];
			$row_array['typo']=$row['CSOTypeName'];
			
			 array_push($return_arr,$row_array);
			
			 }
			 
			 
 echo json_encode($return_arr); 
     
	 

	 
?>