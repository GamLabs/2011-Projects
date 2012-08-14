<?php
require_once 'includes/connect.php';
$post = $_POST;
$pnumber = $post['pnPostTheatreInput'];
$postTheatreDate = mysql_real_escape_string(trim(ucfirst($post['postTheatreDate'])));
$postTheatreSampleType = mysql_real_escape_string(trim(ucfirst($post['postTheatreSampleType'])));
$postTheatreFollowupDate= mysql_real_escape_string(trim($post['postTheatreFollowupDate']));
$postTheatreSurgNotes= mysql_real_escape_string(trim($post['postTheatreSurgNotes']));
$postTheatrePostOpCare  = mysql_real_escape_string(trim($post['postTheatrePostOpCare']));



	$sql = "insert into post_theatre values('','$pnumber','$postTheatreDate','$postTheatreSampleType','$postTheatreFollowupDate','$postTheatreSurgNotes',
	'$postTheatrePostOpCare',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	