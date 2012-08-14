<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
if(isset($_POST['labourTreatmentsSubmit'])){
	
	
	$post = $_POST;
	
	$pnumber = $post['pnumberLabourTreatments'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['dateLabourTreatments'];
	$mip_ipt1_dose = (!empty($post['mip_ipt1_dose'])?$post['mip_ipt1_dose']:'');
	$mip_ipt1_date = (!empty($post['mip_ipt1_date'])?$post['mip_ipt1_date']:'');
	$mip_ipt2_dose = (!empty($post['mip_ipt2_dose'])?$post['mip_ipt2_dose']:'');
	$mip_ipt2_date = (!empty($post['mip_ipt2_date'])?$post['mip_ipt2_date']:'');
	$mip_received_lln = (!empty($post['mip_received_lln'])?$post['mip_received_lln']:'');
	$mip_received_date = (!empty($post['mip_received_date'])?$post['mip_received_date']:'');
	$tm_date = (!empty($post['tm_date'])?$post['tm_date']:'');
	$tm_drug = (!empty($post['tm_drug'])?$post['tm_drug']:'');
	$sti_vd = (!empty($post['sti_vd'])?$post['sti_vd']:'');
	$sti_gud = (!empty($post['sti_gud'])?$post['sti_gud']:'');
	$sti_lap = (!empty($post['sti_lap'])?$post['sti_lap']:'');
	$sti_date_index_treated = (!empty($post['sti_date_index_treated'])?$post['sti_date_index_treated']:'');
	$sti_date_partner_treated = (!empty($post['sti_date_partner_treated'])?$post['sti_date_partner_treated']:'');
	$user = 'lamin';
	
	$sql = "insert into labour_treatment values('$pnumber','$visitNumber','$date','$mip_ipt1_dose','$mip_ipt1_date',
	'$mip_ipt2_dose','$mip_ipt2_date','$mip_received_lln','$mip_received_date','$tm_date','$tm_drug',
	'$sti_vd','$sti_gud','$sti_lap','$sti_date_index_treated','$sti_date_partner_treated','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
}
?>
