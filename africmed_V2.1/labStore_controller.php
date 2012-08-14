<?php
require_once 'includes/connect.php';
$post = $_POST;

$labItemDate= mysql_real_escape_string(trim($post['labItemDate']));
$labItemName = mysql_real_escape_string(trim(ucfirst($post['labItemName'])));
$labItemQuant = mysql_real_escape_string(trim($post['labItemQuant']));
$labItemUnit = mysql_real_escape_string(trim($post['labItemUnit']));



	$sql = "insert into lab_items values('','$labItemDate','$labItemName',$labItemQuant,$labItemUnit,CURRENT_TIMESTAMP,'RECEIVED')";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	