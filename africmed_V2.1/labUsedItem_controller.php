<?php
require_once 'includes/connect.php';
$post = $_POST;

$usedLabItemDate = mysql_real_escape_string(trim($post['usedLabItemDate']));
$usedLabItemName = mysql_real_escape_string(trim(ucfirst($post['usedLabItemName'])));
$usedLabItemQuant = mysql_real_escape_string(trim($post['usedLabItemQuant']));
$usedLabItemUnit = mysql_real_escape_string(trim($post['usedLabItemUnit']));


	$sql = "insert into lab_items values('','$usedLabItemDate','$usedLabItemName',$usedLabItemQuant,$usedLabItemUnit,CURRENT_TIMESTAMP,'USED')";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	