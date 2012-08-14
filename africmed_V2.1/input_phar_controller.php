<?php
require_once 'includes/session.php';
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';

if(isset($_POST['addpharmed'])){
	$user = $_SESSION['username'];
$drugname = mysql_real_escape_string(trim($_POST['pname']));
$drugtype = mysql_real_escape_string(trim($_POST['ptype']));
$drugquantity = mysql_real_escape_string(trim($_POST['pquantity']));
$dexpirydate = mysql_real_escape_string(trim($_POST['pdate']));

if(insertInPhar($drugname, '', $drugquantity, $user, $drugtype))
{
updateQuantity($drugname, $drugquantity);
}
}
?>