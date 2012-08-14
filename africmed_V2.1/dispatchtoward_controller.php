<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
$post = $_POST;
$dispToWardDate  = mysql_real_escape_string(trim(ucfirst($post['dispToWardDate'])));
$dispToWardName = mysql_real_escape_string(trim(ucfirst($post['dispToWardName'])));
$dispToWardPkgName = mysql_real_escape_string(trim(ucfirst($post['dispToWardPkgName'])));
$dispToWardDName = mysql_real_escape_string(trim($post['dispToWardDName']));
$dispToWardQty  = mysql_real_escape_string(trim($post['dispToWardQty']));
$user = $_SESSION['username'];
$price = getMedPrice($dispToWardPkgName,$dispToWardDName)  * $dispToWardQty;
	$sql = "insert into drugs_to_wards values('','$dispToWardDate' ,'$dispToWardName','$dispToWardPkgName','$dispToWardDName',
	'$dispToWardQty',$price,'$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	