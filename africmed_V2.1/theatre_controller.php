<?php
require_once 'includes/connect.php';
$post = $_POST;
$pnumber = trim($post['pnTheatreInput']);
$theartreDate= mysql_real_escape_string(trim($post['theartreDate']));
$theatreSurgeryName= mysql_real_escape_string(trim(ucfirst($post['theatreSurgeryName'])));
$theatreSurType= mysql_real_escape_string(trim($post['theatreSurType']));
$theatreScaNurse = mysql_real_escape_string(trim($post['theatreScaNurse']));
$theatreSurgeon = mysql_real_escape_string(trim($post['theatreSurgeon']));
$theatreAssSurgeon= mysql_real_escape_string(trim($post['theatreAssSurgeon']));
$theatreAnesthetic = mysql_real_escape_string(trim($post['theatreAnesthetic']));
$theatreAnestheticType = mysql_real_escape_string(trim($post['theatreAnestheticType']));


	$sql = "insert into theatre values('','$pnumber','$theartreDate','$theatreSurgeryName','$theatreSurType','$theatreScaNurse','$theatreSurgeon',
	'$theatreAssSurgeon','$theatreAnesthetic','$theatreAnestheticType',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	