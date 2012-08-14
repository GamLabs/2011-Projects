<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
if(isset($_POST['antenatalRecordSubmit'])){
	
	$post = $_POST;
	
	$pnumber = $post['pnumberAntenatalRecord'];       
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['dateAntenatalRecord'];
	$weight = (!empty($post['weight'])?$post['weight']:0);
	$bp = (!empty($post['bp'])?$post['bp']:'');
	$oedema = (!empty($post['oedema'])?$post['oedema']:'');
	$obe_fundal_ht = (!empty($post['obe_fundal_ht'])?$post['obe_fundal_ht']:'');
	$obe_press_poss= (!empty($post['obe_press_poss'])?$post['obe_press_poss']:'');
	$obe_fh  = (!empty($post['obe_fh'])?$post['obe_fh']:'');
	$li_urine = (!empty($post['li_urine'])?$post['li_urine']:'');
	$li_hb= (!empty($post['li_hb'])?$post['li_hb']:'');
	$li_vdrl= (!empty($post['li_vdrl'])?$post['li_vdrl']:'');
	$li_sickle= (!empty($post['li_sickle'])?$post['li_sickle']:'');
	$vaccination_dosses= (!empty($post['vaccination_dosses'])?$post['vaccination_dosses']:'');
	$medications= (!empty($post['medications'])?$post['medications']:'');
	$followup_date= (!empty($post['followup_date'])?$post['followup_date']:'');
	$user = 'lamin';
	
	$sql = "insert into antenatal_record values ('$pnumber','$visitNumber','$date','$weight','$bp','$oedema','$obe_fundal_ht',
	'$obe_press_poss','$obe_fh','$li_urine','$li_hb','$li_vdrl','$li_sickle','$vaccination_dosses',
	'$medications','$followup_date','$user',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo "Sucess";
	}else{
		echo "Error".mysql_error();
	}
}
?>
