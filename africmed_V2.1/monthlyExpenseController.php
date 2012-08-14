<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';

if (isset($_POST['expenseDateFilter'])){
	$date=$_POST['expenseDateFilter'];
	getExpensesByDate($date);
}else if(isset($_POST['expenseMonthFilter'])){
	$month = $_POST['expenseMonthFilter'];
	$year = $_POST['year'];
	getExpenseByMonth($month, $year);
}else if(isset($_POST['expenseYearFilter'])){
	$year = $_POST['expenseYearFilter'];
	getExpensesByYear($year);
}

?>