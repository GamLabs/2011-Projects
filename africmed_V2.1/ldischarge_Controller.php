<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

$post = $_POST;
	
	$pnumber = $post['pnumberLabourDeliveryD'];
	$visitNumber= getVisitNumber($pnumber);
	$date = $post['dateLabourDeliveryD'];
	$bp = mysql_real_escape_string($post['delivery_bp']);
	$pulse = mysql_real_escape_string($post['delivery_pulse']);
	$bleeding = mysql_real_escape_string($post['delivery_bleeding']);
	$episiotomy = mysql_real_escape_string($post['delivery_episiotomy']);
	$user="lamin";
	
	$sql = "insert into labour_discharge values('$pnumber','$visitNumber','$date',$bp,'$pulse','$bleeding','$episiotomy',
	'$user',CURRENT_TIMESTAMP )";
	
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
?>