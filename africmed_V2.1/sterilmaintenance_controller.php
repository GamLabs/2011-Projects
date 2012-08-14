<?php
require_once 'includes/connect.php';
$post = $_POST;

$sterilMaintDate = mysql_real_escape_string(trim(ucfirst($post['sterilMaintDate'])));
$sterilMaintProblem = mysql_real_escape_string(trim(ucfirst($post['sterilMaintProblem'])));
$sterilMaintSpare = mysql_real_escape_string(trim($post['sterilMaintSpare']));
$sterilMaintEngineer  = mysql_real_escape_string(trim($post['sterilMaintEngineer']));
$sterilMaintEngineerCont  = mysql_real_escape_string(trim($post['sterilMaintEngineerCont']));
$sterilMaintEmployee  = mysql_real_escape_string(trim($post['sterilMaintEmployee']));
$sterilMaintComment   = mysql_real_escape_string(trim($post['sterilMaintComment']));


	$sql = "insert into sterilization_maintenance values('','$sterilMaintDate','$sterilMaintProblem','$sterilMaintSpare','$sterilMaintEngineer',
	'$sterilMaintEngineerCont','$sterilMaintEmployee','$sterilMaintComment','User',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	