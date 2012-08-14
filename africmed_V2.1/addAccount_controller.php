<?php
require_once 'includes/connect.php';
$post = $_POST;

$accName= mysql_real_escape_string(trim($post['accName']));
$accCode = mysql_real_escape_string(trim($post['accCode']));



	$sql = "insert into accounts values('','$accCode','$accName',0)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	