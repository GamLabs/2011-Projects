<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
$post = $_POST;
//genBookDate  genBookStatus genBookProduct genBookAmount;
$code = mysql_real_escape_string(trim($post['genBookCode']));
$genBookPn = mysql_real_escape_string(trim($post['genBookPn']));
$genBookProduct = mysql_real_escape_string(trim($post['genBookProduct']));
$genBookStatus = mysql_real_escape_string(trim($post['genBookStatus']));
$genBookDate = mysql_real_escape_string(trim($post['genBookDate']));
$genBookAmount  = mysql_real_escape_string(trim($post['genBookAmount']));
$visitNumber = getVisitNumber($genBookPn);
$user = $_SESSION['username'];
$drw = getDrawerNumber();
if(!isset($drw)){
	echo 4;
	exit();
}



	$sql = "insert into general_booking values('','$genBookPn','$visitNumber',$drw,'$genBookProduct','$code',$genBookAmount,'$genBookDate',
	'$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() >0){
		updateFee($genBookPn, $visitNumber, $genBookAmount);
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	