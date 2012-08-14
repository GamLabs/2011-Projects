<?php
require_once 'includes/connect.php';
$post = $_POST;

$apptDate = mysql_real_escape_string(trim(ucfirst($post['apptDate'])));
$apptComplaint = mysql_real_escape_string(trim(ucfirst($post['apptComplaint'])));
$apptDoctor = mysql_real_escape_string(trim($post['apptDoctor']));
$apptDepartment  = mysql_real_escape_string(trim($post['apptDepartment']));
$apptStatus = mysql_real_escape_string(trim($post['apptStatus']));
$apptFollowUp = mysql_real_escape_string(trim(ucfirst($post['apptFollowUp'])));
$apptTime = mysql_real_escape_string(trim($post['apptTime']));



	$sql = "insert into appointments values('','$apptDate','$apptComplaint','$apptDoctor','$apptDepartment',
	'$apptTime','$apptFollowUp','$apptStatus','User',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	