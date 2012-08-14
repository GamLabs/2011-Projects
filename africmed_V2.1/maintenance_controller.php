<?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 
 $post = $_POST;

 $maintDate= mysql_real_escape_string(trim(ucfirst($post['maintDate'])));
 $maintType= mysql_real_escape_string(trim(ucfirst($post['maintType'])));
 $maintCost= mysql_real_escape_string(trim(ucfirst($post['maintCost'])));
 $maintMainBy = mysql_real_escape_string(trim(ucfirst($post['maintMainBy'])));
 $maintAuthBy = mysql_real_escape_string(trim(ucfirst($post['maintMainBy'])));
 $machineId =  $post['machineId'];

	$sql = "insert into maintenance values('','$maintDate','$maintType',$maintCost,'$machineId','$maintMainBy',
	'$maintAuthBy', CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}

 
 
 ?>