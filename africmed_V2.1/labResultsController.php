<?php
include_once 'includes/requireFile.php';

if(isset($_POST['PNumberKeyUp'])){
	
	$pn=$_POST['PNumberKeyUp'];
	if (patientExist($pn)){
		$vn=getVisitNumber($pn);
		if (!empty($vn)){
			if (!inInvestQueue($vn,"Laboratory")){
				showTest($vn);
			}else{
				echo 0; // ZERO 4 WHEN PATIENT IS IN QUEUE
			}
		}else{
			echo 1;  // ONE 4 WHEN PATIENT IS NOT VISITING
		}
		
	}else {
		echo 2; // TWO 4 WHEN PATIENT DOESNT EXIST
	}
}elseif (isset($_POST['labResultsPN'])){
	
	$pn=$_POST['labResultsPN'];
	$vn=getVisitNumber($pn);
	showTest($vn);
}else if (isset($_POST['AddResults'])){
	print_r($_POST);
	$pn=$_POST['AddResults'];
	$results=$_POST['resultsValue'];
	$vn=getVisitNumber($pn);
	updateInvestQueue($pn,"Laboratory","READY");
	if (numberOfInvest($vn)==numberOfCompletedInvest($vn)){
		updateInvestQueue($pn,"Laboratory","DOCTOR");
	}
	echo insertResults($pn,$vn,$results,'user');
}
?>