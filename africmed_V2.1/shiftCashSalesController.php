<?php 
require_once 'includes/requireFile.php';

if (isset($_POST['getShifts'])){
	$date = $_POST['getShifts'];
	getShiftsByDate($date);
}else if (isset($_POST['getShiftsCashSales'])){
	$shift = $_POST['getShiftsCashSales'];
	$date = $_POST['date'];
	getShiftSales($shift,$date);
}



?>