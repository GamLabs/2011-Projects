<?php

require_once 'includes/connect.php';
$post = $_POST;

$username = mysql_real_escape_string(trim($post['opUserName']));
$newpassword= mysql_real_escape_string(trim($post['newpasswordopr']));



	$sql = "update  users  set password='$newpassword' where  username='$username' ";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() >0){
		echo 0;
	}else{
		echo 1;
	}
	
?>