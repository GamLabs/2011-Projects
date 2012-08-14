<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
if(isset($_POST['labourDeliverySubmit'])){
	$post = $_POST;
	
	$pnumber = $post['pnumberLabourDelivery'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date  = $post['dateLabourDelivery'];
	$time = (!empty($post['time'])?$post['time']:'');
	$place = (!empty($post['place'])?$post['place']:'');
	$delivered_by = (!empty($post['delivered_by'])?$post['delivered_by']:'');
	$designation = (!empty($post['designation'])?$post['designation']:'');
	$delivery_mode = (!empty($post['delivery_mode'])?$post['delivery_mode']:'');
	$outcome = (!empty($post['outcome'])?$post['outcome']:'');
	$baby_weight = (!empty($post['baby_weight'])?$post['baby_weight']:'');
	$apgar_score = (!empty($post['apgar_score'])?$post['apgar_score']:'');
	$neonatal_complications = (!empty($post['neonatal_complications'])?$post['neonatal_complications']:'');
	$user = 'lamin';
	
	$sql = "insert into delivery values ('$pnumber','$visitNumber','$date','$time','$place','$delivered_by','$designation',
	'$delivery_mode','$outcome','$baby_weight','$apgar_score','$neonatal_complications','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
	
	
}
?>
