<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';


function transactLog($drugname,$drugtype,$drugquantity,$trType,$dexpirydate,$drugreorder){
	$sql = "INSERT INTO phar_transaction (dname, dtype, quantity,transact_type, expiry_date,reorder_level ) VALUES ('$drugname', '$drugtype', $drugquantity,'$trType', '$dexpirydate' ,$drugreorder)";
	//echo $sql;
	$query = mysql_query($sql);
}


$drugname = mysql_real_escape_string(trim($_POST['dname']));
$drugtype = mysql_real_escape_string(trim($_POST['dtype']));
$drugquantity = mysql_real_escape_string(trim($_POST['dquantity']));


$drugreorder = mysql_real_escape_string(trim($_POST['dreorder']));
$dexpirydate = mysql_real_escape_string(trim($_POST['edate']));
//$sellingprice = mysql_real_escape_string(trim($_POST['dselling']));


if(!drugInStore($drugname,$drugtype)){
	
		$insertStore = "INSERT INTO phar_store_config (dname, dtype, quantity, expiry_date, reorder_level) VALUES ('$drugname', '$drugtype', '$drugquantity', '$dexpirydate', '$drugreorder')";
		$query = mysql_query($insertStore);
		transactLog($drugname,$drugtype,$drugquantity,"RECEIVED",$dexpirydate,$drugreorder);
		if(mysql_affected_rows() >0){
			echo 0;
		}else{
			echo "Insert Error".mysql_error();
		}

}else{
	$updateStore = "UPDATE phar_store_config set quantity = (SELECT (quantity+$drugquantity) from (select * from phar_store_config) as x where dname='$drugname' and dtype='$drugtype') 
	where dname = '$drugname' and dtype='$drugtype'";
	//echo $updateStore;
	$query = mysql_query($updateStore) or mysql_error();
	transactLog($drugname,$drugtype,$drugquantity,"RECEIVED",$dexpirydate,$drugreorder);
		if(mysql_affected_rows() >0){
			echo 0;
		}else{
			echo "Update Error".mysql_error();
		}
}
?>