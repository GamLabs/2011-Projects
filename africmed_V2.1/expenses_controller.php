<?php
require_once 'includes/connect.php';
require_once 'includes/financeFunctions.php';
$post = $_POST;
$expCode = mysql_real_escape_string(trim($post['expenseCode']));
$expenseDesc= mysql_real_escape_string(trim(ucfirst($post['expenseDesc'])));
$expenseComment= mysql_real_escape_string(trim(ucfirst($post['expenseComment'])));
$expenseDate= mysql_real_escape_string(trim($post['expenseDate']));
$expenseAmount = mysql_real_escape_string(trim($post['expenseAmount']));
$expenseType = mysql_real_escape_string(trim($post['expenseType']));
$expenseChNo = mysql_real_escape_string(trim($post['expenseChNo']));
$expenseBankCode  = mysql_real_escape_string(trim($post['expenseBankCode']));
$user = $_SESSION['username'];
function accountTransact($date,$reason,$code,$amount,$user){
	
	$sql = "INSERT INTO account_transaction (date,reason, type, account_code,amount, user ) VALUES ('$date','$reason', 'OUT', $code,'$amount', '$user' )";
	//echo $sql;
	$query = mysql_query($sql);
}

if(isset($post['expenseType']) && $post['expenseType'] == "Cheque"){
	accountTransact($expenseDate,$expenseDesc,$expenseBankCode,$expenseAmount,$user);
	
}elseif (isset($post['expenseType']) && $post['expenseType'] == "Cash"){
	accountTransact($expenseDate,$expenseDesc,'1207',$expenseAmount,$user);
	
}

	$sql = "insert into expenses values('','$expCode','$expenseDesc','$expenseComment','$expenseDate',$expenseAmount,
	'$expenseType','$expenseBankCode','$expenseChNo','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo mysql_error();
	}
	
?>
	
	