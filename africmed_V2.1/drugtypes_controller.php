<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
$post = $_POST;


//$post = $_POST;

$drugname= mysql_real_escape_string(trim(strtoupper($post['drugTypeName'])));
$drugType= mysql_real_escape_string(trim(ucfirst($post['drugTypeType'])));

if(drugTypeExist($drugname,$drugType)){
	echo 3;
	exit(0);
}


	$sql = "insert into  drug_names values ('','$drugname','$drugType','')";
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		
		echo "Sorry:  ".mysql_error();
	
		
	}


?>