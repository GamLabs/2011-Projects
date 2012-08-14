<?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 
 $post = $_POST;

 $dispDate= mysql_real_escape_string(trim(ucfirst($post['dispDate'])));
 $dispRecName= mysql_real_escape_string(trim(ucfirst($post['dispRecName'])));
 $dispCallName= mysql_real_escape_string(trim(ucfirst($post['dispCallName'])));
 $dispCallAddress= mysql_real_escape_string(trim(ucfirst($post['dispCallAddress'])));
 $dispCallPhone= mysql_real_escape_string(trim(ucfirst($post['dispCallPhone'])));
 $dispDrivName= mysql_real_escape_string(trim(ucfirst($post['dispDrivName'])));
 $dispCalloutType= mysql_real_escape_string(trim(ucfirst($post['dispCalloutType'])));
 $dispAccompBy= mysql_real_escape_string(trim(ucfirst($post['dispAccompBy'])));
 $dispComment= mysql_real_escape_string(trim(ucfirst($post['dispComment'])));
 $dispOutcome= mysql_real_escape_string(trim(ucfirst($post['dispOutcome'])));
 $ambulance =  $post['generatorID'];

	$sql = "insert into ambulance_dispatch values('','$dispDate','$dispRecName','$dispDrivName','$dispCallName','$dispCallAddress',
	'$dispCallPhone','$dispCalloutType','$ambulance','$dispAccompBy','$dispComment','$dispOutcome', CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}

 
 
 ?>