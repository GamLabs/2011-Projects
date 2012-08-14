<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
if(isset($_POST['pnumberLabourRegistration'])){
	
	$post = $_POST;
	
	$pnumber = $post['pnumberLabourRegistration'];
	$visitNumber= (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['dateLabourRegistration'];
	$height = (!empty($post['height'])?$post['height']:0);
	$marital_status = (!empty($post['marital_status'])?$post['marital_status']:'');
	$compound_name = (!empty($post['compound_name'])?$post['compound_name']:'');
	$gr = (!empty($post['gr'])?$post['gr']:'');
	$fmMethod = (!empty($post['fmMethod'])?$post['fmMethod']:'');
	$para = (!empty($post['para'])?$post['para']:'');
	$none = (!empty($post['none'])?$post['none']:'');
	$user = $post['biosocialRegUser'];
	
	
	$sql = "insert into biosocial_data values('$pnumber','$visitNumber','$date',$height,'$marital_status','$compound_name','$gr',
	'$fmMethod','$para','$none','$user',CURRENT_TIMESTAMP )";
	
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
}

if(isset($_POST['pnumberLabourHistory'])){

	$post = $_POST;
	
	$pnumber= $post['pnumberLabourHistory'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['dateLabourHistory'];
	$fh_tb  = (!empty($post['fh_tb'])?$post['fh_tb']:'');
	$fh_diabetes = (!empty($post['fh_diabetes'])?$post['fh_diabetes']:'');
	$fh_multiple_birth = (!empty($post['fh_multiple_birth'])?$post['fh_multiple_birth']:'');
	$fh_other = (!empty($post['fh_other'])?$post['fh_other']:'');
	$ph_anaemia = (!empty($post['ph_anaemia'])?$post['ph_anaemia']:'');
	$ph_toxemia = (!empty($post['ph_toxemia'])?$post['ph_toxemia']:'');
	$ph_high_bp = (!empty($post['ph_high_bp'])?$post['ph_high_bp']:'');
	$ph_tb = (!empty($post['ph_tb'])?$post['ph_tb']:'');
	$ph_sickle_cell = (!empty($post['ph_sickle_cell'])?$post['ph_sickle_cell']:'');
	$ph_pid = (!empty($post['ph_pid'])?$post['ph_pid']:'');
	$ph_diabetes = (!empty($post['ph_diabetes'])?$post['ph_diabetes']:' ');
	$ph_others = (!empty($post['ph_others'])?$post['ph_others']:' ');
	$mh_lmp = (!empty($post['mh_lmp'])?$post['mh_lmp']:'');
	$mh_regular = (!empty($post['mh_regular'])?$post['mh_regular']:' ');
	$edd = (!empty($post['edd'])?$post['edd']:'');
	$delivery_place = (!empty($post['delivery_place'])?$post['delivery_place']:' ');
	$user = $post['biosocialHistUser'];
	
	$sql = "insert into labour_history values ('$pnumber','$visitNumber','$date','$fh_tb','$fh_diabetes','$fh_multiple_birth','$fh_other',
	'$ph_anaemia','$ph_toxemia','$ph_high_bp','$ph_tb','$ph_sickle_cell','$ph_pid','$ph_diabetes','$ph_others','$mh_lmp','$mh_regular','$edd','$delivery_place',
	'$user',CURRENT_TIMESTAMP )";
	
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo "Sucess";
	}else{
		echo "Error";
	}
}

?>