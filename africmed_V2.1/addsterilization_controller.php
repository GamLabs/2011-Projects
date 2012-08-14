<?php
require_once 'includes/connect.php';
$post = $_POST;

$steriDate = mysql_real_escape_string(trim(($post['steriDate'])));
$steriInstrument = mysql_real_escape_string(trim(ucfirst($post['steriInstrument'])));
$steriQuantity = mysql_real_escape_string(trim($post['steriQuantity']));
$steriState  = mysql_real_escape_string(trim($post['steriState']));
$steriPreClean  = mysql_real_escape_string(trim($post['steriPreClean']));
$steriStarted  = mysql_real_escape_string(trim($post['steriStarted']));
$steriCompleted  = mysql_real_escape_string(trim($post['steriCompleted']));


	$sql = "insert into sterilization values('','$steriDate','$steriInstrument',$steriQuantity,'$steriState',
	'$steriPreClean','$steriStarted','$steriCompleted','User',CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
?>
	
	