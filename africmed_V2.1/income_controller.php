<?php
require_once 'includes/connect.php';
require_once 'includes/financeFunctions.php';
$post = $_POST;
$expCode = mysql_real_escape_string(trim($post['incomeCode']));
$incomeDesc= mysql_real_escape_string(trim(ucfirst($post['incomeDesc'])));
$incomeComment= mysql_real_escape_string(trim(ucfirst($post['incomeComment'])));
$incomeDate= mysql_real_escape_string(trim($post['incomeDate']));
$incomeAmount = mysql_real_escape_string(trim($post['incomeAmount']));
$incomeType = mysql_real_escape_string(trim($post['incomeType']));
$incomeChNo = mysql_real_escape_string(trim($post['incomeChNo']));
$incomeBankCode  = mysql_real_escape_string(trim($post['incomeBankCode']));
$user = $_SESSION['username'];
function accountTransact($date,$reason,$code,$amount,$user){
	
	$sql = "INSERT INTO account_transaction (date,reason, type, account_code,amount, user ) VALUES ('$date','$reason', 'IN', $code,'$amount', '$user' )";
	//echo $sql;
	$query = mysql_query($sql);
}

if(isset($post['incomeType']) && $post['incomeType'] == "Cheque"){
	accountTransact($incomeDate,$incomeDesc,$incomeBankCode,$incomeAmount,$user);
	
}elseif (isset($post['incomeType']) && $post['incomeType'] == "Cash"){
	accountTransact($incomeDate,$incomeDesc,'1207',$incomeAmount,$user);
	
}

	$sql = "insert into income values('','$expCode','$incomeDesc','$incomeComment','$incomeDate',$incomeAmount,
	'$incomeType','$incomeBankCode','$incomeChNo','User',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo mysql_error();
	}
	
?>
	
	