<?php
require_once 'includes/connect.php';
$post = $_POST;

$productCode= mysql_real_escape_string($post['productCode']);
$productDesc= mysql_real_escape_string(trim(ucfirst($post['productDesc'])));
$productType= mysql_real_escape_string($post['productType']);
$productPrice= mysql_real_escape_string($post['productPrice']);




	$sql = "insert into products values('','$productCode','$productType','$productDesc',$productPrice)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
