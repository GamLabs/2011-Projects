<?php
require_once 'includes/requireFile.php';

if(isset($_POST['generateInsuranceBills'])){
	$comp = $_POST['generateInsuranceBills'];
	$month = $_POST['month'];
	$year = $_POST['year'];
		if(isBillGenerated($comp,"insurance_bills", $month, $year)){
			echo "<h2 style='color:red'> Bill already Generated For  ".getMonthName($month)."<h2>";
			exit(0);
		}else{
			generateInsuranceBill($comp,$month,$year);
		}
	
}else if(isset($_POST['displayInsuranceBills'])){
	$comp = $_POST['displayInsuranceBills'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	getInsuranceBillToPay($comp,$month,$year);
	//payBill($comp, $month, $year, $amount)
}
?>