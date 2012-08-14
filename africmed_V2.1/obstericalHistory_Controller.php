<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

if(isset($_POST['obstericalHistorySubmit'])){

	
	$post = $_POST;
	
	$pnumber   = $post['pnumberObstericalHistory'];          
	$visitNumber  = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);   
	$date   = $post['dateObstericalHistory'];            
	$delivery_date  = (!empty($post['delivery_date'])?$post['delivery_date']:'');  
	$pregnancy_duration  = (!empty($post['pregnancy_duration'])?$post['pregnancy_duration']:0);
	$antenaltal_care  = (!empty($post['antenaltal_care'])?$post['antenaltal_care']:'');  
	$birth_weight = (!empty($post['birth_weight'])?$post['birth_weight']:0);      
	$delivery_type  = (!empty($post['delivery_type'])?$post['delivery_type']:'');    
	$delivery_place = (!empty($post['delivery_place'])?$post['delivery_place']:'');   
	$delivery_att = (!empty($post['delivery_att'])?$post['delivery_att']:'');     
	$comments = (!empty($post['comments'])?$post['comments']:'');        
	$user = "lamin";         
	
	$sql = "insert into obsterical_history values ('$pnumber','$visitNumber','$date','$delivery_date',$pregnancy_duration,
	'$antenaltal_care',$birth_weight,'$delivery_type','$delivery_place','$delivery_att','$comments','$user',CURRENT_TIMESTAMP)";
	//echo $visitNumber.$sql;
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo "Sucess";
	}else{
		echo "Sorry:  ".mysql_error();
	}
}
?>
