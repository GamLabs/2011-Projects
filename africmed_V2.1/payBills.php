<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';

$post = $_POST;
$bal = $post['paymentBalance'];
$visitNumber = $post['paymentvisitNum'];
$amount = $post['paymentAmount'];
$date = date('Y-m-d');
$method= mysql_real_escape_string(trim($post['paymentMethod']));
$chno= mysql_real_escape_string(trim($post['paymentChNo']));
$user = $_SESSION['username'];


if($amount > $bal){
	echo 3;
	exit(3);
}else if($amount <0){
	echo 4;
	exit(4);
}
$sqlPayments = "INSERT into private_payments  values('','$visitNumber','$date','$method','$chno',$amount,'$user',CURRENT_TIMESTAMP)";
mysql_query($sqlPayments);

$updateSql = "UPDATE patient_bills set paidAmount = (SELECT (paidAmount+$amount) from (select * from patient_bills) as x where visitNumber='$visitNumber') 
	,paid_date = '$date',pay_method='$method',check_no='$chno' where visitNumber = '$visitNumber'";
	mysql_query($updateSql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		echo mysql_error();
	}

?>