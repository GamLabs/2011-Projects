<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';

$post = $_POST;
$bal = $post['insurancepaymentBalance'];
$id = $post['insurancepaymentId'];
$amount = $post['insurancepaymentAmount'];
$date = date('Y-m-d');
$method= mysql_real_escape_string(trim($post['insurepaymentMethod']));
$chno= mysql_real_escape_string(trim($post['insurepaymentChNo']));
$user = $_SESSION['username'];


if($amount > $bal){
	echo 3;
	exit(3);
}else if($amount <0){
	echo 4;
	exit(4);
}

$sqlPayments = "INSERT into insurance_payments  values('','$id','$date','$method','$chno',$amount,'$user',CURRENT_TIMESTAMP)";
mysql_query($sqlPayments);

$updateSql = "UPDATE insurance_bills set paid_amount = (SELECT (paid_amount+$amount) from (select * from insurance_bills) as x where id=$id) 
	,paidDate = '$date',pay_method='$method',check_no='$chno' where id = $id";
	mysql_query($updateSql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		echo mysql_error();
	}

?>