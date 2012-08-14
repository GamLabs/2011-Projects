<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';

if (isset($_GET['liveSearchPnumber'])){
	echo getPnumberByName($_GET['liveSearchPnumber'],$_GET['page']);
}else if (isset($_POST['conType'])){
		$conType=$_POST['conType'];
		$conType=mysql_real_escape_string(trim(ucfirst($conType)));
		$sql="select amount from consultationconfig where conType='$conType'" or die(mysql_error());
		echo getAmount($sql);
}elseif (isset($_POST['checkIfDrawerIsOpen'])){
$id=getDrawerNumber(); // GETS THE UNIQUE ID FOR THE DRAWER CURRENTLY OPENED
	if (empty($id)){
		echo 0; // FALSE
	}else{
		echo 1; // TRUE
	}
}

else if (isset($_POST['addConType']) && isset($_POST['addAmount'])&& isset($_POST['addPnumber'])){	
		$pn=$_POST['addPnumber'];
		$date=date('Y-m-d');
		$name=getName($pn);
		$conT=$_POST['addConType'];
		$amt=$_POST['addAmount'];
		addToVisits($pn,$date,$name);
		$vnumber=getVisitNumber($pn); //Generate Visit Number
		
		//echo $strg;
		if(!bookingExist($vnumber)){
			 
			 insertConsultationBooking($pn,$date,$vnumber,$conT,$amt);
			 displayConsultation($vnumber);
			 addToQueue($pn,$date,$name);
			 bookingCompleted("consultation",$vnumber); // args: tabelName, visitNumber
		}else{
			//echo $vnumber;
			echo 0 ;
		}
}else{
	$sql  = "SELECT conType from consultationconfig";
	
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		echo '<option value="'.$value["conType"].'">'.$value["conType"].'</option>';
	}

}
?>
