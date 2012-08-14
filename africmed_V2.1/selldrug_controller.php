<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
$post = $_POST;
$selldrugDate = mysql_real_escape_string(trim(ucfirst($post['selldrugDate'])));
$selldrugFName = mysql_real_escape_string(trim(ucfirst($post['selldrugFName'])));
$sellDrugPkgName = mysql_real_escape_string(trim(ucfirst($post['sellDrugPkgName'])));
$sellDrugDName = mysql_real_escape_string(trim($post['sellDrugDName']));
$sellDrugQty  = mysql_real_escape_string(trim($post['sellDrugQty']));
$sellDrugPresc  = mysql_real_escape_string(trim($post['sellDrugPresc']));
$user = $_SESSION['username'];
$price = getMedPrice($sellDrugPkgName,$sellDrugDName)  * $sellDrugQty;
	$sql = "insert into phar_sell_drugs values('','$selldrugDate' ,'$selldrugFName','$sellDrugPkgName','$sellDrugDName',
	'$sellDrugQty',$price ,'$sellDrugPresc','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	