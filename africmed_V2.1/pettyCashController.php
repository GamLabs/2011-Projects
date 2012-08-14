<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';

if (isset($_POST['pettyCashDateFilter'])){
	$date=$_POST['pettyCashDateFilter'];
	getPettyCashByDate($date);
}else if(isset($_POST['pettyCashMonthFilter'])){
	$month = $_POST['pettyCashMonthFilter'];
	$year = $_POST['year'];
	getPettyCashByMonth($month, $year);
}else if(isset($_POST['pettyCashYearFilter'])){
	$year = $_POST['pettyCashYearFilter'];
	getPettyCashByYear($year);
}

?>