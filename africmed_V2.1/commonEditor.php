<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;
$pn = trim($_POST['searchEditPnumber']);
		$sql = "select * from patientrecord where pnumber='$pn'";
		editTableByPnumber($sql,'patientrecord',$pn);

?>
