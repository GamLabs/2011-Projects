<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';
$post = $_POST;

$con= mysql_real_escape_string(trim(ucfirst($post['addConFee'])));
$addConFeeNominalCode= mysql_real_escape_string(trim(ucfirst($post['addConFeeNominalCode'])));
$amount= mysql_real_escape_string(trim(ucfirst($post['addConFeeAmount'])));
$user = $_SESSION['username'];

$sql = "insert into consultationconfig(conType,nominal_code,amount,user) values('$con','$addConFeeNominalCode','$amount','$user')";
	
	$result = mysql_query($sql);
	if($result){
		echo 1;
	}else{
		echo 0;
	}
	
?>
	
	