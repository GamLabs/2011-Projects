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
	getInvestigationType($_POST['investigation'],$_POST['forwho']);
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
	if(!isAdmitted($vn) && !isReleased($vn)){
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
		getPatientTable($sql,"Health History");
	}elseif ($table == "patientrecord"){
		$sql = "select fname as 'First Name',lname as 'Surname',gender as 'Gender',dob as 'Date of Birth',occupation as Occupation,
		status as 'Group',statusName as 'Group Name',statusId as 'Group ID',email as Email,phone as Phone,address as Address,nationality as Nationality,
		date_format(timeStamp,'%Y-%m-%d') as Date from $table where pnumber='$pn' order by timeStamp desc";
		//echo $sql;
		getPatientTable($sql,"Patient Record");
	}elseif ($table =='finaldiagnosis'){
		$sql = "select assessment as 'Final Assessment',followUpDate as 'Follow Up Date',date_format(timeStamp,'%e %M, %Y') as Date from $table where pnumber='$pn' order by timeStamp desc";
		getPatientTable($sql,"Diagnosis History");
	}elseif ($table =="phyexam"){
		$sql = "select temperature as Temperature, weight as Weight, height as Height,bp as 'Blood Pressure', pulse as Pulse,
		complains as Complains,date as Date from $table where pnumber='$pn' order by date desc";
		getPatientTable($sql,"Physical Examination History");
	}elseif ($table == "investigation"){
		getPatientInvestigationTable($pn,array("4001","4002","4003","4006"));
	}elseif ($table == "pharbooking"){
		getPatientPrescriptionTable($pn);
	}elseif ($table == "biosocial_data"){
		$sql = "select pnumber,date as 'Date',height as Height,marital_status as 'Marital Status',compound_name as 'Compound Name',
		gr as GR,fmMethod as 'Family Planning Method',para as Para,none as None from ".$table." where pnumber='$pn'";
		getPatientTable($sql,"Biosocial Data: Registration");
	}elseif ($table == "labour_history"){
		$sql = "select pnumber,date as Date,fh_tb as 'Family History:TB',fh_diabetes as 'Family History: Diabetes',fh_multiple_birth as 'Family History: Multiple bIrth',
			fh_other as 'Family History: Other',ph_anaemia as 'Personal History: Anaemia',ph_toxemia as 'Personal History: Toxemia',ph_high_bp as 'Personal History: High BP',
			ph_tb as 'Personal History: TB',ph_sickle_cell as 'Personal History: Sickle Cell',ph_pid as 'Personal History: PID',ph_diabetes as 'Personal History: Diabetes',
			ph_others as 'Personal History: Others',mh_lmp as 'Menstrual History: LMP',mh_regular as 'Menstrual History: Regular',edd as EDD,delivery_place as 'Delivery Place' from ".$table." where pnumber='$pn'";
			getPatientTable($sql, "Biosocial History");
	}elseif ($table == "obsterical_history"){
		$sql = "select pnumber,date as Date,delivery_date as 'Delivery Date',pregnancy_duration as 'Pregnancy Duration',antenaltal_care as 'Antenatal Care',
		birth_weight as 'Birth Weight',delivery_type as 'Delivery Type',delivery_place as 'Delivery Place',delivery_att as 'Delivery Attendant',
		comments as 'Comments' from ".$table." where pnumber = '$pn'";
		getPatientTable($sql, "Obsterical History");
	}elseif ($table == "labour_treatment"){
		$sql = "select pnumber ,date as Date,mip_ipt1_dose as 'IPT 1 Dose',mip_ipt1_date as 'IPT 1 Dose Date',mip_ipt2_dose as 'IPT 2 Dose',
		mip_ipt2_date as 'IPT 2 Date',mip_received_lln as 'Received LLN',mip_received_date as 'Received LLN Date',tm_date as 'Treatment Date',
		tm_drug as 'Treatment Drug',sti_vd as 'STI VD',sti_gud as 'STI GUD',sti_lap as 'STI LAP',sti_date_index_treated as 'STI Date Treated',
		sti_date_partner_treated as 'STI Date Partner Treated' from ".$table." where pnumber = '$pn'";
		getPatientTable($sql, "Labour Treatments History");
	}elseif ($table == "antenatal_record"){
		$sql = "select pnumber,date as Date,weight as Weight,bp as BP,oedema as Oedema,obe_fundal_ht as 'Observation: Fundamental HT',
		obe_press_poss as 'Observation: Pres. Pos',obe_fh as 'Observation: FH',li_urine as 'Lab Test Urine',li_hb as 'Lab Test HB',
		li_vdrl as 'Lab Test VDRL',li_sickle as 'Lab Test Sickle Cell',vaccination_dosses as 'Vaccination Doses',medications as 'Medications',
		followup_date as 'Followup Date' from ".$table." where pnumber = '$pn'";
		getPatientTable($sql, "Antenatal Records History");
	}elseif ($table == "delivery"){
		$sql = "select pnumber,date as Date,time as 'Date & Time',place as Place,delivered_by as 'Delivered By',designation as Destination,
		delivery_mode as 'Delivery Mode',outcome as Outcome,baby_weight as 'Baby Weight',apgar_score as 'Apgar Score' from ".$table." where pnumber ='$pn'";
		getPatientTable($sql, "Delivery History");
	}elseif ($table == "postpartum_care"){
		$sql = "select pnumber,date as Date,immediate as Immediate,immediate_date as 'Immediate Date',after1_week as 'After 1 Week',
		after1_week_date as 'After 1 Week Date',at6_week as 'At 6 Week',at6_week_date as 'At 6 Week Date' from ".$table." where pnumber = '$pn'";
		getPatientTable($sql, "Postpartum Care History");
	}elseif ($table == "theatre"){
		$sql = "select pnumber ,date as Date,surgery_name as 'Name Of Surgery',surgery_type as 'Type Of surgery',
		nurse as 'Nurse In Attendance',surgeon as Surgeon,assistant_surgeon as 'Assistant Surgeon',anesthetic_name as 'Name Of Aneathestic',
		 anesthetic_type as 'Aneasthetic TYpe' from ".$table." where pnumber = '$pn'";
		getPatientTable($sql, "Surgery/Operations History");
	}
}elseif (isset($_POST['searchEditPnumber'])){
		$pn = trim($_POST['searchEditPnumber']);
		$sql = "select * from patientrecord where pnumber='$pn'";
		createEditorDialog($sql,'patientrecord',$pn);
}elseif (isset($_POST['deleteInvestigationById'])){
	deleteRowByColumn($_POST['deleteInvestigationById'],'investigations','id');
	getcurrentInvest($_POST['pn']);
}elseif (isset($_POST['deleteTreatmentById'])){
	deleteRowByColumn($_POST['deleteTreatmentById'],'treatments','id');
	getCurrentTreat($_POST['pn']);
}elseif (isset($_POST['getDrugType'])){
	 getDrugType($_POST['getDrugType']);
}elseif (isset($_POST['getDrugProp'])){
	
	getDrugProperties($_POST['getDrugProp'],$_POST['ddDrugType']);
}elseif (isset($_POST['isMale'])){
	if(isMale($_POST['isMale'])){
		echo 0; //is male
	}else{
		echo 1; //is female
	}
}elseif (isset($_POST['hasVisitNum'])){
	if(hasVisitNumber($_POST['hasVisitNum'])){
		echo 0;
	}else{
		echo 1;
	}
}elseif (isset($_POST['isNotPrivate'])){
	if(!isPrivate($_POST['isNotPrivate'])){
		echo 0;
	}else{
		echo 1;
	}
}elseif (isset($_POST['CompleteNonPrivateTransact'])){
	$vn = getVisitNumber($_POST['CompleteNonPrivateTransact']);
	updateVisits($vn);
	echo 0;
	
	
}elseif (isset($_POST['getCompanyList'])){
	if($_POST['getCompanyList'] == "COMPANY"){
		getCompanys();
	}
}elseif (isset($_POST['getStatusForP'])){
	$pn = $_POST['getStatusForP'];
	getPatientStatus($pn);
}elseif (isset($_POST['isAdmitted'])){
	$pn = $_POST['isAdmitted'];
	$vn = getVisitNumber($pn);
	if(isAdmitted($vn)){
		echo 0; //admitted
	}else{
		echo 1; //not admitted
	}
}elseif (isset($_POST['releasePn'])){
	$pn = $_POST['releasePn'];
	
	release($pn);
	echo 0;
}elseif (isset($_POST['editUserStatusId'])){
	$id = $_POST['editUserStatusId'];
	$cs = $_POST['cStatus'];
	$sql = "";
	if($cs=="YES"){
		$sql = "update users set active='NO' where id=$id";
	}else{
		$sql = "update users set active='YES' where id=$id";
	}
	//echo $sql;
	$result = mysql_query($sql);
	if(mysql_affected_rows()>0){
		if($cs == "YES"){
			echo 3; //deactivated
		}else{
			echo 4;//actived
		}
	}
}elseif (isset($_POST['getDrugNameForSellDrug'])){
	getTreatmentType($_POST['getDrugNameForSellDrug']);
}elseif (isset($_POST['getDrugNameFordispToWard'])){
	getTreatmentType($_POST['getDrugNameFordispToWard']);
}elseif (isset($_POST['genGetProductList'])){
	getProductList($_POST['genGetProductList'],$_POST['productCode']);
}elseif (isset($_POST['genGetProductPrice'])){
	getProductPrice($_POST['genGetProductPrice'],$_POST['status'],$_POST['productCode']);
}


?>