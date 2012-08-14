<?php
require_once('includes/connect.php');
require_once('includes/requireFile.php');


if(isset($_POST['pnumber'])){
$pn = $_POST['pnumber'];

if(patientExist($pn)){
	$var = getVisitNumber($pn);
	if (!isQueuing($pn, "CHECKUP")){
		if (!empty($var)){
			echo 0; // vn exist
		}else{
			echo 1; // not yet booked for consultation
		}
	}else{
		echo 2; // patient is in queue
	}
}else{
	echo 3; // patient doesnt exist
}

}elseif(isset($_POST['pnumberDiagnosis'])){
$pn = $_POST['pnumberDiagnosis'];

if(patientExist($pn)){
	$var = getVisitNumber($pn);
	if (!isQueuing($pn, "DOCTOR")){
		if (!empty($var)){
			echo 0; // vn exist
		}else{
			echo 1; // not yet booked for consultation
		}
	}else{
		echo 2; // patient is in queue
	}
}else{
	echo 3; // patient doesnt exist
}

}elseif (isset($_POST['investigation'])){
	getInvestigationType($_POST['investigation']);
}elseif (isset($_POST['treatment'])){
	getTreatmentType($_POST['treatment']);
}elseif (isset($_POST['treatmentCategory'])){
	addTreatments($_POST);
	updateQueueStatus('PHAR',$_POST['treatmentPnumber']);
}elseif (isset($_POST['investCategory'])){
	addInvestigations($_POST);
	updateQueueStatus('INVEST',$_POST['investPnumber']);
	$pnumber = $_POST['investPnumber'];
	$date = date('Y-m-d');
	$name = getName($pnumber);
	$cat = $_POST['investCategory'];
	
	if (!existInInvestQueue($pnumber,$cat))
		addToInvestQueue($pnumber,$date,$name,$cat);
	
	
	
}elseif (isset($_POST['queue'])){
	getQueue();
}elseif (isset($_POST['getInfoPn'])){
	getPatientInfo($_POST['getInfoPn']);
}elseif (isset($_POST['admittedPn'])){
	$pn = $_POST['admittedPn'];
	$vn = getVisitNumber($pn);
	if(!isAdmitted($vn)){
		admitPatient($_POST['admittedPn']);
		echo 0;
	}else{
		echo 1;
	}
}elseif (isset($_POST['referalsPn'])){
	$location = $_POST['referLoc'];
	if($location == "Investigations"){
		
	}elseif ($location == "Labour"){
		updateQueueStatus('LABOUR',$_POST['referalsPn']);
	}elseif ($location == "Doctor"){
		updateQueueStatus('DOCTOR',$_POST['referalsPn']);
	}
	
	
}elseif (isset($_POST['doctorPn'])){
	updateQueueStatus('DOCTOR',$_POST['doctorPn']);
}elseif (isset($_POST['pnLastVisit'])){
	getPatientLastVisit($_POST['pnLastVisit']);
}elseif (isset($_POST['getUserGroups'])){
	getUserGroups();
	//echo $_POST['getCategoryGroup'];
}elseif (isset($_GET['liveSearchPnumber'])){
	$page = $_GET['page'];
	echo getPnumberByName($_GET['liveSearchPnumber'],$page);
	
}elseif (isset($_POST['patientInfoPN'])){
	$pn = $_POST['patientInfoPN'];
	$table = $_POST['patientInfoTable'];
	
	if($table == "checkup"){
		$sql = "select lastMensDate as 'Last Menstrual date',hypertension as Hypertension,diabetic as Diabetic,allergy as Allergy,
		mentalHealth as 'Mental Health Status',currentMedication as 'Current Medication',weight as Weight,height as Height,
		ph_smoking as 'Personal History: Smoking',ph_alcohol as 'Personal History: Alcohol',fh_diabetes as 'Family History: Diabetes',
		fh_hypertension as 'Family History: Hypertension',fh_cancer as 'Family History: Cancer',fh_hearthproblem as 'Family History: Heart Problem',
		fh_sicklecell as 'Family History: Sickle Cell',fh_asthma as 'Family History: Asthma',pmh_asthma as 'Past Medical History: Asthma ',
		pmh_asthma_date as 'Past Medical History: Asthma(Date Attack)',pmh_admission as 'Past Medical History: Admission',
		pmh_admission_date as 'Past Medical History: Admission (Date Admitted)',pmh_surgery as 'Past Medical History: Surgery',
		pmh_surgery_date as 'Past Medical History: Surgery (Date)',pmh_cholesterol as 'Past Medical History: Cholesterol',
		pmh_cholesterol_level as 'Past Medical History: Cholesterol (Level)',date as Date from $table where pnumber='$pn' order by date desc";
		getPatientTable($sql);
	}elseif ($table == "patientrecord"){
		$sql = "select fname as 'First Name',lname as 'Surname',gender as 'Gender',dob as 'Date of Birth',occupation as Occupation,
		status as 'Group',statusName as 'Group Name',statusId as 'Group ID',email as Email,phone as Phone,address as Address,nationality as Nationality,
		date_format(timeStamp,'%e %M, %Y') as Date from $table where pnumber='$pn' order by timeStamp desc";
		//echo $sql;
		getPatientTable($sql);
	}elseif ($table =='finaldiagnosis'){
		$sql = "select assessment as 'Final Assessment',followUpDate as 'Follow Up Date',date_format(timeStamp,'%e %M, %Y') as Date from $table where pnumber='$pn' order by timeStamp desc";
		getPatientTable($sql);
	}elseif ($table =="phyexam"){
		$sql = "select temperature as Temperatur, weight as Weight, height as Height,bp as 'Blood Pressure', pulse as Pulse,
		complains as Complains,date as Date from $table where pnumber='$pn' ";
		getPatientTable($sql);
	}elseif ($table == "investigation"){
		getPatientInvestigationTable($pn,array("Laboratory","Ultrasound","X Ray"));
	}elseif ($table == "pharbooking"){
		getPatientPrescriptionTable($pn,array("Tablets"));
	}
}elseif (isset($_POST['searchEditPnumber'])){
		$pn = trim($_POST['searchEditPnumber']);
		$sql = "select * from patientrecord where pnumber='$pn'";
		createEditorDialog($sql,'patientrecord',$pn);
}


?>