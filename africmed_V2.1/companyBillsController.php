<?php
require_once 'includes/requireFile.php';

if(isset($_POST['generateCompanyBills'])){
	$comp = $_POST['generateCompanyBills'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	
	generateCompanyBill($comp,$month,$year);
}else if(isset($_POST['displayCompanyBills'])){
	$comp = $_POST['displayCompanyBills'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	getCompBillToPay($comp,$month,$year);
	//payBill($comp, $month, $year, $amount)
}
?>