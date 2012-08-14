<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
$post = $_POST;


$post = $_POST;
$testTypeFor = mysql_real_escape_string(trim($post['testTypeFor']));
$testname= mysql_real_escape_string(trim(strtoupper($post['testTypeName'])));
$testcategory= mysql_real_escape_string(trim(ucfirst($post['testTypeCategory'])));
//$testamount= mysql_real_escape_string(trim(ucfirst($post['testTypeAmount'])));



	$sql = "insert into  test_types values ('','$testTypeFor','$testname','$testcategory','')";
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{		
		echo "Sorry:  ".mysql_error();	
	}


?>