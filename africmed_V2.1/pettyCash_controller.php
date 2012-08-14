<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';
$post = $_POST;
$code =  mysql_real_escape_string(trim($post['pettyCashCode']));
$pettyCashDesc= mysql_real_escape_string(trim(ucfirst($post['pettyCashDesc'])));
$pettyCashComment= mysql_real_escape_string(trim(ucfirst($post['pettyCashComment'])));
$pettyCashDate= mysql_real_escape_string(trim($post['pettyCashDate']));
$pettyCashAmount = mysql_real_escape_string(trim($post['pettyCashAmount']));
$pettyCashType = mysql_real_escape_string(trim($post['pettyCashType']));
$pettyCashChNo = mysql_real_escape_string(trim($post['pettyCashChNo']));
$pettyCashBankCode  = mysql_real_escape_string(trim($post['pettyCashBankCode']));
$user = $_SESSION['username'];


function accountTransact($date,$reason,$code,$amount,$user){
	
	$sql = "INSERT INTO account_transaction (date,reason, type, account_code,amount, user ) VALUES ('$date','$reason', 'OUT', $code,'$amount', '$user' )";
	//echo $sql;
	$query = mysql_query($sql);
}

if(isset($post['pettyCashType']) && $post['pettyCashType'] == "Cheque"){
	accountTransact($pettyCashDate,$pettyCashDesc,$pettyCashBankCode,$pettyCashAmount,$user);	
}elseif (isset($post['pettyCashType']) && $post['pettyCashType'] == "Cash"){
	accountTransact($pettyCashDate,$pettyCashDesc,'1207',$pettyCashAmount,$user);	
}


	$sql = "insert into petty_cash values('','$code','$pettyCashDesc','$pettyCashComment','$pettyCashDate',$pettyCashAmount,
	'$pettyCashType','$pettyCashBankCode','$pettyCashChNo','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo mysql_error();
	}
	
?>
	
	
	