<?php
require_once 'includes/connect.php';
$post = $_POST;

$codeNumber= mysql_real_escape_string($post['codeNumber']);
$codeType= mysql_real_escape_string($post['codeType']);
$codeDesc= mysql_real_escape_string(trim(ucfirst($post['codeDesc'])));



	$sql = "insert into codes values('','$codeNumber','$codeType','$codeDesc')";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	