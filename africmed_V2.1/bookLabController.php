<?php
require_once 'includes/requireFile.php';

if(isset($_POST['CheckPnumber'])){
	$pn= $_POST['CheckPnumber'];
	if(patientExist($pn)){
		$vnumber=getVisitNumber($pn);
		displayInvestigations($vnumber,'Laboratory');
		
	}
}elseif (isset($_POST['keyUpPnumber'])){
	$pn=$_POST['keyUpPnumber'];
	if (patientExist($pn)){
		$vn=getVisitNumber($pn);
		if (!empty($vn)){
			//check if the patient is queuing first, b4 displaying anything
			if (!inInvestQueue($vn,"Laboratory")){
				displayAllTest();
			}else{
				echo 0;// patient in queue, so force for them to choose frm queue
			}
		}else{
			echo 2; // This Patient isnt visiting i.e empty visit number
		}
	}else{
		echo 1; // if patient doesnt exist
	}
}
if(isset($_POST['displayPtest'])){
	
	$pn=$_POST['displayPtest'];
	$vnumber=getVisitNumber($pn);
	displayTestForPatient($vnumber,'Laboratory');
	
}
elseif (isset($_POST['Test'])){
	$test=$_POST['Test'];
	$sql="select amount from lab_config where type='$test'";
	echo getAmount($sql);
	//echo getTestAmount($_POST['Test']);
}elseif (isset($_POST['addLabTestToBookingPn'])){
		$pn=$_POST['addLabTestToBookingPn'];
		$vnumber=getVisitNumber($pn);
		$date=date('Y-m-d');
		$test=$_POST['tname'];
		$amount=getTestPrice($test,$_POST['forwho'],$_POST['category']);
		$id = $_POST['id'];
		insertLabBooking($pn,$vnumber,$test,$amount,$date,$_POST['category']);
		//updateInvestigationById($id);
		displayLabBooking($pn);
}elseif (isset($_POST['completePnumber'])){
	$pn=$_POST['completePnumber'];
	$vnumber=getVisitNumber($pn);
	$val= completeInvestigation($vnumber,'Laboratory');
	if ($val){
		updateInvestQueue($pn,"Laboratory","PENDING");
		bookingCompleted("labbooking",$vnumber);
		echo 1;
	}else{
		echo 0;
	}
}
?>