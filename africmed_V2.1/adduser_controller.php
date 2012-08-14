<?php
require_once 'includes/connect.php';
$post = $_POST;

$firstname= mysql_real_escape_string(trim(ucfirst($post['addfirstname'])));
$lastname= mysql_real_escape_string(trim(ucfirst($post['addlastname'])));
$username= mysql_real_escape_string(trim($post['addusername']));
$password = mysql_real_escape_string(trim($post['addpassword']));
$group = mysql_real_escape_string(trim($post['addusergroups']));


	$sql = "insert into users values('','$firstname','$lastname','$username','$password','$group')";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	