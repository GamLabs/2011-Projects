<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
$post = $_POST;

$resultid = mysql_real_escape_string(trim($post['labResultId']));
$resultname= mysql_real_escape_string(trim($post['labResultName']));
$pnumber= mysql_real_escape_string(trim($post['labResultPnumber']));
$result = mysql_real_escape_string(trim($post['labResultsDiagText']));
$vn = getVisitNumber($pnumber);
$category = getTestTypeByName($resultname);
updateInvestigationById($resultid);




	$sql = "insert into investigation_results values('','$resultid','$pnumber','$vn','$category','$resultname' , '$result','user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	