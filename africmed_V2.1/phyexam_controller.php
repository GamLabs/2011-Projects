<?php
require_once('includes/connect.php');
require_once 'includes/receptionFunctions.php';



$post = $_POST;
$pnumber = (isset($post['pnumberExam'])? $post['pnumberExam']: '');
$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
$date = (isset($post['phyexamdate'])?$post['phyexamdate']:date('Y-m-d'));
//$checkUpDate = (isset($post['checkUpDateExam'])?$post['checkUpDateExam']:date('Y-m-d'));


$temperature = mysql_real_escape_string($post['basic_temperature']);
$weight = mysql_real_escape_string($post['basic_weight']);
$height = mysql_real_escape_string($post['basic_height']);
$bp = mysql_real_escape_string($post['basic_bp']);
$pulse = mysql_real_escape_string($post['basic_pulse']);
$complains = mysql_real_escape_string($post['basic_complains']);

$temp_pallor = (isset($post['temp_pallor'])? $post['temp_pallor']: '');
$temp_hydration = (isset($post['temp_hydration'])? $post['temp_hydration']: '');
$temp_jaundice = (isset($post['temp_jaundice'])? $post['temp_jaundice']: ''); 
$temp_fingerClubbing = (isset($post['temp_fingerClubbing'])? $post['temp_fingerClubbing']: '');
$temp_skinRash = (isset($post['temp_skinRash'])? $post['temp_skinRash']: '');
$temp_lymphnodes = (isset($post['temp_lymphnodes'])? $post['temp_lymphnodes']: '');
$temp_others = (isset($post['temp_other'])? $post['temp_other']: '');
$chest_rr = (isset($post['chest_rr'])? $post['chest_rr']: '');
$chest_sp02 = (isset($post['chest_sp02'])? $post['chest_sp02']: '');
$chest_fev1 = (isset($post['chest_fev1'])? $post['chest_fev1']: '');
$chest_wheezing = (isset($post['chest_wheezing'])? $post['chest_wheezing']: '');
$chest_crepitation = (isset($post['chest_crepitation'])? $post['chest_crepitation']: '');
$chest_airEntry = (isset($post['chest_airentry'])? $post['chest_airentry']: '');
$abdoment_bs = (isset($post['abdoment_bs'])? $post['abdoment_bs']: '');
$abdoment_guarding = (isset($post['abdoment_guarding'])? $post['abdoment_guarding']: '');
$abdoment_rebound = (isset($post['abdoment_rebound'])? $post['abdoment_rebound']: '');
$abdoment_mass = (isset($post['abdoment_mass'])? $post['abdoment_mass']: '');
$abdoment_ascitis = (isset($post['abdoment_ascitis'])? $post['abdoment_ascitis']: '');
$abdoment_rectalExam = (isset($post['abdoment_rectalExam'])? $post['abdoment_rectalExam']: '');
$abdoment_viginalExam = (isset($post['abdoment_viginalExam'])? $post['abdoment_viginalExam']: '');
$cvs_bp = (isset($post['cvs_bp'])? $post['cvs_bp']: '');
$cvs_pluse = (isset($post['cvs_pluse'])? $post['cvs_pluse']: '');
$cvs_jvp = (isset($post['cvs_jvp'])? $post['cvs_jvp']: '');
$cvs_oedema = (isset($post['cvs_oedema'])? $post['cvs_oedema']: '');
$ftd_paranoia = (isset($post['ftd_paranoia'])? $post['ftd_paranoia']: '');
$ftd_delusions = (isset($post['ftd_delusions'])? $post['ftd_delusions']: '');
$ftd_hallucination = (isset($post['ftd_hallucinations'])? $post['ftd_hallucinations']: '');
$ftd_cognitionMemory = (isset($post['ftd_cognition'])? $post['ftd_cognition']: '');
$ftd_abnormalBeliefs = (isset($post['ftd_abnormalBeliefs'])? $post['ftd_abnormalBeliefs']: '');
$ftd_insight = (isset($post['ftd_insights'])? $post['ftd_insights']: '');
$mentalexam_AB = (isset($post['mentalexam_ab'])? $post['mentalexam_ab']: '');
$mentalexam_speech = (isset($post['mentalexam_speech'])? $post['mentalexam_speech']: '');
$mentalexam_homicidal = (isset($post['mentalexam_homicidal'])? $post['mentalexam_homicidal']: '');
$mentalexam_suicidal = (isset($post['mentalexam_suicidal'])? $post['mentalexam_suicidal']: '');
$neurology_cranialNerves = (isset($post['neurology_cranialNerves'])? $post['neurology_cranialNerves']: '');
$neurology_swallowingSpeech = (isset($post['neurology_swallowingSpeech'])? $post['neurology_swallowingSpeech']: '');
$neurology_reflexes = (isset($post['neurology_reflexes'])? $post['neurology_reflexes']: '');
$neurology_power = (isset($post['neurology_power'])? $post['neurology_power']: '');
$neurology_tones = (isset($post['neurology_tones'])? $post['neurology_tones']: '');
$neurology_sensation = (isset($post['neurology_sensation'])? $post['neurology_sensation']: '');
$neurology_babinsky = (isset($post['neurology_babinsky'])? $post['neurology_babinsky']: '');
$user = $post['checkupExamUser'];

$sql = "insert into phyexam values ('','$pnumber','$visitNumber','$date',$temperature,$weight,$height,'$bp','$pulse','$complains','$temp_pallor','$temp_hydration','$temp_jaundice',
'$temp_fingerClubbing','$temp_skinRash','$temp_lymphnodes','$temp_others','$chest_rr','$chest_sp02','$chest_fev1',
'$chest_wheezing','$chest_crepitation','$chest_airEntry','$abdoment_bs','$abdoment_guarding','$abdoment_rebound',
'$abdoment_mass','$abdoment_ascitis','$abdoment_rectalExam','$abdoment_viginalExam','$cvs_bp','$cvs_pluse','$cvs_jvp',
'$cvs_oedema','$ftd_paranoia','$ftd_delusions','$ftd_hallucination','$ftd_cognitionMemory','$ftd_abnormalBeliefs',
'$ftd_insight','$mentalexam_AB','$mentalexam_speech','$mentalexam_homicidal','$mentalexam_suicidal','$neurology_cranialNerves',
'$neurology_swallowingSpeech','$neurology_reflexes','$neurology_power','$neurology_tones','$neurology_sensation','$neurology_babinsky',
'$user',CURRENT_TIMESTAMP)";


$result = mysql_query($sql) or die(mysql_error());

if($result){
echo "Success";

}

	

?>