<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;

$pnumber = $post['pnBasicCheck'];
$visitNumber = getVisitNumber($pnumber);
$date = date('Y-m-d');
$temperature = mysql_real_escape_string($post['basic_temperature']);
$weight = mysql_real_escape_string($post['basic_weight']);
$height = mysql_real_escape_string($post['basic_height']);
$bp = mysql_real_escape_string($post['basic_bp']);
$pulse = mysql_real_escape_string($post['basic_pulse']);
$complains = mysql_real_escape_string($post['basic_complains']);
$user = 'lamin';



$sql = "insert into basic_examination values ('$pnumber','$visitNumber','$date','$temperature','$weight','$height','$bp','$pulse','$complains','$user',CURRENT_TIMESTAMP)";

$result = mysql_query($sql) or die(mysql_error());

if($result){
echo "Success";

}
?>