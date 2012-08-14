<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
$post = $_POST;


$post = $_POST;

$testname= mysql_real_escape_string(trim(strtoupper($post['packagingName'])));




	$sql = "insert into  pharmacy_packaging values ('','$testname')";
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		
		echo "Sorry:  ".mysql_error();
	
		
	}


?>