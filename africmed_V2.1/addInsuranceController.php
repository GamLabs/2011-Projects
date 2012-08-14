<?php
require_once 'includes/connect.php';
$post = $_POST;

$name= mysql_real_escape_string(trim(ucfirst($post['addinsurance'])));
$addr= mysql_real_escape_string(trim(ucfirst($post['insAddr'])));
$contact= mysql_real_escape_string(trim($post['inscontact']));
$email = mysql_real_escape_string(trim($post['insemail']));



	$sql = "insert into insurance_config(name,address,contact,email) values('$name','$addr','$contact','$email')";
	
	$result = mysql_query($sql);
	if($result){
		echo 1;
	}else{
		echo 0;
	}
	
?>
	
	