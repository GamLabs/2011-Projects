<?php
include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;

if(isset($post['oper']) && $post['oper'] =='edit'){
$table = $_GET['table'];
editTable($post, $table);
}elseif (isset($post['oper']) && $post['oper'] =='del'){
	deleteRowByPnumber($post['id'],$table);
}elseif (isset($_POST['deleteCompany'])){
	$key = $_POST['deleteCompany'];
	$table = "company_config";
	$column = "id";
	$name= $_POST['name'];
	if(insuranceInUsed($name) == 1){
		echo 2;
	}else{
		deleteRowByColumn($key,$table, $column);
		echo 0;
	}
	
}elseif (isset($_POST['deleteInsurance'])){
	$key = $_POST['deleteInsurance'];
	$table = "insurance_config";
	$column = "id";
	$name= $_POST['name'];
	if(insuranceInUsed($name) == 1){
		echo 2;
	}else{
		deleteRowByColumn($key,$table, $column);
		echo 0;
	}
	
}

?>