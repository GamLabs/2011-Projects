<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
if(isset($_POST['postpartumCareSubmit'])){
	$post = $_POST;
	
	$pnumber = $post['pnumberPostpartumCare'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['datePostpartumCare'];
	$immediate = (!empty($post['immediate'])?$post['immediate']:'');
	$immediate_date = (!empty($post['immediate_date'])?$post['immediate_date']:'');
	$after1_week = (!empty($post['after1_week'])?$post['after1_week']:'');
	$after1_week_date = (!empty($post['after1_week_date'])?$post['after1_week_date']:'');
	$at6_week = (!empty($post['at6_week'])?$post['at6_week']:'');
	$at6_week_date = (!empty($post['at6_week_date'])?$post['at6_week_date']:'');
	$user = 'lamin';
	
	$sql = "insert into postpartum_care values ('$pnumber','$visitNumber','$date','$immediate','$immediate_date','$after1_week',
	'$after1_week_date','$at6_week','$at6_week_date','$user',CURRENT_TIMESTAMP)";
	
	
	$result = mysql_query($sql);
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
}
?>
