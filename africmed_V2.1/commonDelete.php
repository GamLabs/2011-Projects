<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;
$pn = trim($_POST['searchEditPnumber']);
		$sql = "delete from patientrecord where pnumber='$pn'";
		//echo $sql;
		echo deleteRowByPnumber($sql);

?>
