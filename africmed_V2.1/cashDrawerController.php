<?php
require_once 'includes/session.php';
require_once 'includes/requireFile.php';

if (isset($_POST['CheckStatus'])){
	$date=date('Y-m-d');
	$status=getDrawerStatus();
	if ($status=="OPEN"){
		echo 0;	// ZERO MEANS DRAWER IS OPEN
	}elseif ($status=="CLOSED"){
		echo 1;	// 1 MEANS DRAWER IS CLOSE
	}
}elseif (isset($_POST['Shift'])){
	$shift=$_POST['Shift'];
	$name=$_POST['Name'];
	$date=date('Y-m-d');
	$val=insertOpenCashDrawer($shift,$name,$date,"OPEN");
	echo $val;

}elseif (isset($_POST['CashSales'])){
	$dnum=getDrawerNumber();
	displayCashDrawer($dnum);
}elseif (isset($_POST['RecepName'])){
	$fullName="";
$sql="SELECT firstname, lastname from users where category='reception'";
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		$fullName=$value['firstname']." ".$value['lastname'];
		echo '<option value="'.$fullName.'">'.$fullName.'</option>';
	}
}
elseif (isset($_POST['ClosingShift'])){
	$id=getDrawerNumber();
	$total=getCashSaleTotal($id);
	$expense=getTotalExpenses($id);
	$val=insertCloseCashDrawer($total,$expense,"CLOSED");
	echo $val;
	
}elseif (isset($_POST['Reason'])){
	$reason=$_POST['Reason'];
	$amt=$_POST['ExpAmount'];
	$id=getDrawerNumber();
	$user = $_SESSION['username'];
	echo addExpense($id,$amt,$reason,$user);
	
}elseif (isset($_POST['CashSalesForFinanceDrw'])){
	$drw=$_POST['CashSalesForFinanceDrw'];
	displayCashDrawer($drw);
	
}


?>