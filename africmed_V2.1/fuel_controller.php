<?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 
 $post = $_POST;

 $fuelDate= mysql_real_escape_string(trim(ucfirst($post['fuelDate'])));
 $fuelType= mysql_real_escape_string(trim(ucfirst($post['fuelType'])));
 $fuelVolume= mysql_real_escape_string(trim(ucfirst($post['fuelVolume'])));
 $fuelReqBy= mysql_real_escape_string(trim(ucfirst($post['fuelReqBy'])));
 $fuelAuthBy= mysql_real_escape_string(trim(ucfirst($post['fuelAuthBy'])));
 $usedIn =  $post['usedIn'];

	$sql = "insert into fuel values('','$fuelDate','$fuelType',$fuelVolume,'$usedIn','$fuelReqBy',
	'$fuelAuthBy', CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}

 
 
 ?>