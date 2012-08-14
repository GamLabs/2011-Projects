<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';


$post = $_POST;



$pnumber = $post['pnPreAss'];
$visistNumber =(hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
$date = $post['dtPreAss'];
$assesment = $post['preassesment'];
$user ='lamin';


$sql = "insert into preassesment values ('$pnumber','$visistNumber','$date','$assesment','$user',CURRENT_TIMESTAMP)";

$result = mysql_query($sql) or die(mysql_error());
if($result){
echo "Success";
}





?>