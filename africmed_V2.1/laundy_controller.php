<?php
require_once 'includes/connect.php';
$post = $_POST;

$laundryDate  = mysql_real_escape_string(trim(ucfirst($post['laundryDate'])));
$laundryRecBy = mysql_real_escape_string(trim(ucfirst($post['laundryRecBy'])));
$laundryItemType = mysql_real_escape_string(trim($post['laundryItemType']));
$laundryItemQty  = mysql_real_escape_string(trim($post['laundryItemQty']));
$laundryUsedMaterial  = mysql_real_escape_string(trim($post['laundryUsedMaterial']));
$laundryUsedMaterialQty  = mysql_real_escape_string(trim($post['laundryUsedMaterialQty']));
$laundryIroning  = mysql_real_escape_string(trim($post['laundryIroning']));

$laundryTimeReturned  = mysql_real_escape_string(trim($post['laundryTimeReturned']));
$laundryComment  = mysql_real_escape_string(trim($post['laundryComment']));


	$sql = "insert into laundry values('','$laundryDate','$laundryRecBy','$laundryItemType','$laundryItemQty','$laundryUsedMaterial',
	$laundryUsedMaterialQty,'$laundryIroning','$laundryTimeReturned','$laundryComment','User',CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	