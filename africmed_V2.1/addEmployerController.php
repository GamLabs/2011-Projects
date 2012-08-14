<?php
require_once 'includes/connect.php';
$post = $_POST;

$name= mysql_real_escape_string(trim(ucfirst($post['addemployer'])));
$addr= mysql_real_escape_string(trim(ucfirst($post['empAddr'])));
$contact= mysql_real_escape_string(trim($post['empcontact']));
$email = mysql_real_escape_string(trim($post['empemail']));

$sql = "insert into company_config(name,address,contact,email) values('$name','$addr','$contact','$email')";
	
	$result = mysql_query($sql);
	if($result){
		echo 1;
	}else{
		echo 0;
	}
	
?>
	
	