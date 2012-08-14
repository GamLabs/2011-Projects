<?php
require_once('includes/connect.php');
require_once("includes/receptionFunctions.php");


$post = $_POST;

$pnumber = (isset($post['pnumberGeneral'])? $post['pnumberGeneral']: '');

$sqlQuery = "select * from checkup where pnumber='$pnumber' order by date DESC limit 1";	
$result = mysql_query($sqlQuery);
$count = mysql_num_rows($result);

$row = mysql_fetch_array($result);
if($count >0){
$date = mysql_real_escape_string((!empty($post['gencheckupDate'])?$post['gencheckupDate']:$row['date']));
//$checkUpDate = mysql_real_escape_string((!empty($post['checkUpDateGeneral'])?$post['checkUpDateGeneral']:$row['checkUpDate']));
$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
$weight = mysql_real_escape_string((!empty($post['weight'])?$post['weight']:$row['weight']));
$height = mysql_real_escape_string((!empty($post['height'])?$post['height']:$row['height']));
$lastMensDate = mysql_real_escape_string((!empty($post['lastMensDate'])?$post['lastMensDate']:$row['lastMensDate']));
$hypertension = mysql_real_escape_string((!empty($post['hypertension'])?$post['hypertension']:$row['hypertension']));
$diabetic = mysql_real_escape_string((!empty($post['diabetic'])?$post['diabetic']:$row['diabetic']));
$allergy = mysql_real_escape_string((!empty($post['allergy'])?$post['allergy']:$row['allergy']));
//$complains = mysql_real_escape_string((!isset($post['complains'])?$post['complains']:$row['complains']));
//$complainHistory = mysql_real_escape_string((!isset($post['complainHistory'])?$post['complainHistory']:$row['complainHistory']));
$ph_smoking = mysql_real_escape_string((!empty($post['ph_smoking'])?$post['ph_smoking']:$row['ph_smoking']));
$ph_alcohol = mysql_real_escape_string((!empty($post['ph_alcohol'])?$post['ph_alcohol']:$row['ph_alcohol']));
$fh_diabetic = mysql_real_escape_string((!empty($post['fh_diabetic'])?$post['fh_diabetic']:$row['fh_diabetes']));
$fh_hypertension = mysql_real_escape_string((!empty($post['fh_hypertension'])?$post['fh_hypertension']:$row['fh_hypertension']));
$fh_cancer = mysql_real_escape_string((!empty($post['fh_cancer'])?$post['fh_cancer']:$row['fh_cancer']) );
$fh_heartProblem = mysql_real_escape_string((!empty($post['fh_heartProblem'])?$post['fh_heartProblem']:$row['fh_hearthproblem']) );
$fh_sicklecell = mysql_real_escape_string((!empty($post['fh_sicklecell'])?$post['fh_sicklecell']:$row['fh_sicklecell']) );
$fh_asthma = mysql_real_escape_string((!empty($post['fh_asthma'])?$post['fh_asthma']:$row['fh_asthma']) );
$pmh_asthma =  mysql_real_escape_string((!empty($post['pmh_asthma'])?$post['pmh_asthma']:$row['pmh_asthma']) );
$pmh_asthma_date =  mysql_real_escape_string((!empty($post['pmh_asthma_date'])?$post['pmh_asthma_date']:$row['pmh_asthma_date']) );
$pmh_admission = mysql_real_escape_string((!empty($post['pmh_admission'])?$post['pmh_admission']:$row['pmh_admission']) );
$pmh_admission_date = mysql_real_escape_string((!empty($post['pmh_admission_date'])?$post['pmh_admission_date']:$row['pmh_admission_date']) );
$pmh_surgery =  mysql_real_escape_string((!empty($post['pmh_surgery'])?$post['pmh_surgery']:$row['pmh_surgery'])) ;
$pmh_surgery_date =  mysql_real_escape_string((!empty($post['pmh_surgery_date'])?$post['pmh_surgery_date']:$row['pmh_surgery_date'])) ;
$pmh_cholesterol = mysql_real_escape_string((!empty($post['pmh_cholesterol'])?$post['pmh_cholesterol']:$row['pmh_cholesterol']));
$pmh_cholesterol_level = mysql_real_escape_string((!empty($post['pmh_cholesterol_level'])?$post['pmh_cholesterol_level']:$row['pmh_cholesterol_level']));
$mentalHealth = mysql_real_escape_string((!isset($post['mentalHealth'])?$post['mentalHealth']:$row['mentalHealth']));
$currentMedication = mysql_real_escape_string((!isset($post['currentMedication'])?$post['currentMedication']:$row['currentMedication']));
$user = $post['checkupGeneralUser'];
}else{
$date = $date = mysql_real_escape_string((!empty($post['gencheckupDate'])?$post['gencheckupDate']:''));	
//$checkUpDate = mysql_real_escape_string((isset($post['checkUpDateGeneral'])?$post['checkUpDateGeneral']:''));
$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
$weight = mysql_real_escape_string((!empty($post['weight'])?$post['weight']:0));
$height = mysql_real_escape_string((!empty($post['height'])?$post['height']:0));
$lastMensDate = mysql_real_escape_string((isset($post['lastMensDate'])?$post['lastMensDate']:''));
$hypertension = mysql_real_escape_string((isset($post['hypertension'])?$post['hypertension']:''));
$diabetic = mysql_real_escape_string((isset($post['diabetic'])?$post['diabetic']:''));
$allergy = mysql_real_escape_string((isset($post['allergy'])?$post['allergy']:''));
//$complains = mysql_real_escape_string((isset($post['complains'])?$post['complains']:''));
//$complainHistory = mysql_real_escape_string((isset($post['complainHistory'])?$post['complainHistory']:''));
$ph_smoking = mysql_real_escape_string((isset($post['ph_smoking'])?$post['ph_smoking']:''));
$ph_alcohol = mysql_real_escape_string((isset($post['ph_alcohol'])?$post['ph_alcohol']:''));
$fh_diabetic = mysql_real_escape_string((isset($post['fh_diabetic'])?$post['fh_diabetic']:''));
$fh_hypertension = mysql_real_escape_string((isset($post['fh_hypertension'])?$post['fh_hypertension']:''));
$fh_cancer = mysql_real_escape_string((isset($post['fh_cancer'])?$post['fh_cancer']:'') );
$fh_heartProblem = mysql_real_escape_string((isset($post['fh_heartProblem'])?$post['fh_heartProblem']:'') );
$fh_sicklecell = mysql_real_escape_string((isset($post['fh_sicklecell'])?$post['fh_sicklecell']:'') );
$fh_asthma = mysql_real_escape_string((isset($post['fh_asthma'])?$post['fh_asthma']:'') );
$pmh_asthma =  mysql_real_escape_string((isset($post['pmh_asthma'])?$post['pmh_asthma']:'') );
$pmh_asthma_date =  mysql_real_escape_string((isset($post['pmh_asthma_date'])?$post['pmh_asthma_date']:'') );
$pmh_admission = mysql_real_escape_string((isset($post['pmh_admission'])?$post['pmh_admission']:'') );
$pmh_admission_date = mysql_real_escape_string((isset($post['pmh_admission_date'])?$post['pmh_admission_date']:'') );
$pmh_surgery =  mysql_real_escape_string((isset($post['pmh_surgery'])?$post['pmh_surgery']:'') );
$pmh_surgery_date =  mysql_real_escape_string((isset($post['pmh_surgery_date'])?$post['pmh_surgery_date']:'') );
$pmh_cholesterol = mysql_real_escape_string((isset($post['pmh_cholesterol'])?$post['pmh_cholesterol']:''));
$pmh_cholesterol_level = mysql_real_escape_string((isset($post['pmh_cholesterol_level'])?$post['pmh_cholesterol_level']:''));
$mentalHealth = mysql_real_escape_string((isset($post['mentalHealth'])?$post['mentalHealth']:''));
$currentMedication = mysql_real_escape_string((isset($post['currentMedication'])?$post['currentMedication']:''));

$user = $post['checkupGeneralUser'];	
}


$sql = "insert into checkup values ('','$visitNumber','$pnumber','$date','$lastMensDate','$hypertension',
'$diabetic','$allergy','$mentalHealth','$currentMedication',
$weight,$height,'$ph_smoking','$ph_alcohol','$fh_diabetic','$fh_hypertension','$fh_cancer','$fh_heartProblem','$fh_sicklecell','$fh_asthma',
'$pmh_asthma','$pmh_asthma_date','$pmh_admission','$pmh_admission_date','$pmh_surgery','$pmh_surgery_date','$pmh_cholesterol','$pmh_cholesterol_level','$user',CURRENT_TIMESTAMP)";

$result = mysql_query($sql) or die(mysql_error());
if($result){
echo "Success";

}



?>