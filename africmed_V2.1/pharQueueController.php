<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

if (isset($_POST['labqueue'])){
	$sql = "select pnumber,date,fullname, date_format(arrivaltime, '%H: %i %p') as arrivaltime from queue where status='PHAR'";
	getQueue($sql);
}
?>
