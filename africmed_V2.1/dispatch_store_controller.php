<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';


function transactDLog($drugname,$drugtype,$drugquantity,$trType,$dexpirydate,$drugreorder){
	$sql = "INSERT INTO phar_transaction (dname, dtype, quantity,transact_type, expiry_date,reorder_level ) VALUES ('$drugname', '$drugtype', $drugquantity,'$trType', '$dexpirydate' ,$drugreorder)";
	//echo $sql;
	$query = mysql_query($sql);
}


$drugname = $_POST['ddrugname'];
$drugtype = $_POST['ddrugtype'];

//$drugtype = getDrugTypeName($drugname);
$drugquantity = $_POST['ddrugquantity'];

$drugreorder = getDrugReorderLevel($drugname,$drugtype);
$dexpirydate = getDrugExpiry($drugname,$drugtype);
$sellingprice = getDrugSellingPrice($drugname,$drugtype);

$qInStore = getQuantityInStore($drugname,$drugtype);
if($drugquantity > $qInStore){
	echo "Not Enough Quantity In Store";
	
}else if(!drugInStore($drugname,$drugtype)){
	
		echo "Out of Stock";

}else{
	$updateStore = "UPDATE phar_store_config set quantity = (SELECT (quantity-$drugquantity) from (select * from phar_store_config) as x where dname='$drugname' and  dtype='$drugtype') 
	where dname = '$drugname' and dtype='$drugtype'";
	//echo $updateStore;
	$query = mysql_query($updateStore);
	//echo $updateStore;
	transactDLog($drugname,$drugtype,$drugquantity,"DISPATCHED",$dexpirydate,$drugreorder);
		if(mysql_affected_rows() >0){
			echo 0;
		}else{
			echo "Update Error".mysql_error();
		}
}
?>