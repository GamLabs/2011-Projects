<?php
require_once 'includes/requireFile.php';

if (isset($_POST['pharPNumber'])){
	$pn= $_POST['pharPNumber'];
	if(patientExist($pn)){
			$vnber=getVisitNumber($pn);
			displayTreatments($vnber);
	}
}elseif (isset($_POST['showLabel'])){
		$des=$_POST['showLabel'];
		$html="";
		if ($des == "Non Tablets"){
			$html .="Non Tablets  <br>";
			$html .="<input name=\"nonTabs\" id=\"nonTabs\" />";
			echo $html;
		}elseif ($des == "Tablets" || $des == ""){
			$html .="Tablets <br>";
			$html .="<input name=\"tabs\" id=\"tabs\" />";
			echo $html;
		}		
}elseif (isset($_POST['keyUpPnumber'])){
	$pn=$_POST['keyUpPnumber'];
	if (patientExist($pn)){
		$vn=getVisitNumber($pn);
		if (!empty($vn)){
			//check if the patient is queuing first, b4 displaying anything
			if (!isQueuing($pn,"PHAR")){
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
}elseif (isset($_POST['Description']) && isset($_POST['Number'])){
	
		$pn=$_POST['Number'];
		$category=$_POST['Description'];
		$vnumber=getVisitNumber($pn);
		// This will display the prescribed drugs only.
		displayTreatmentForPatient($vnumber,$category); 
		
}elseif (isset($_POST['showAllDetails'])){
	
		$category=$_POST['showAllDetails'];
		$tblName="";
		if ($category == "Tablets"){
			$tblName="tablet_config";
		}else if ($category == "Non Tablets"){
			$tblName="nontablet_config";
		}
		displayAllDrugs($tblName);
}
elseif (isset($_POST['numberOfNonTabs'])){// WHEN NON TABS VALUE IS ENTERED
	$des="";
	$numberOfNonTabs=$_POST['numberOfNonTabs'];
	$type=$_POST['Details'];
	
	if ($_POST['Description2'] == "null"){
		$des = $_POST['Description3'];
	}elseif ($_POST['Description3'] == "null"){
		$des = $_POST['Description2'];
	}else{
		//(isset($_POST["policyId"])?$_POST["policyId"]:"0"); 
		$des=$_POST['Description2'];
	}
	if (!empty($des)){
		$availableStock=availableStock($des, $type);
		if ($numberOfNonTabs > $availableStock){
			echo 3; // If value is more than what is available
		}else{
			if($des=="Tablets"){
			$tableName="tablet_config";
			}else if ($des=="Non Tablets"){
				$tableName="nontablet_config";
			}
			
			$query="select amount from $tableName where type='$type'";
			$amt= getAmount($query);
			$res=($amt * $numberOfNonTabs);
			echo $res;
		}
	}else{
		echo 0;
	}
	
}
elseif (isset($_POST['numberOfTabs'])){// WHEN TABS VALUE IS ENTERED
	$des="";
	$numberOfTabs=$_POST['numberOfTabs'];
	$type=$_POST['Details'];
	
	if ($_POST['Description2'] == "null"){
		$des = $_POST['Description3'];
	}elseif ($_POST['Description3'] == "null"){
		$des = $_POST['Description2'];
	}else{
		//(isset($_POST["policyId"])?$_POST["policyId"]:"0"); 
		$des=$_POST['Description2'];
	}
	if (!empty($des)){
		$availableStock=availableStock($des, $type);
		if ($numberOfTabs > $availableStock){
			echo 3; // If value is more than what is available
		}else{
			if($des=="Tablets"){
			$tableName="tablet_config";
			}else if ($des=="Non Tablets"){
				$tableName="nontablet_config";
			}
			
			$query="select amount from $tableName where type='$type'";
			$amt= getAmount($query);
			$res=($amt * $numberOfTabs);
			echo $res;
		}
	}else{
		echo 0;
	}
	
}

elseif (isset($_POST['addPrescToBookingPn'])){
			
		$pn=$_POST['addPrescToBookingPn'];
		$date=date('Y-m-d');
		$vnumber=getVisitNumber($pn);
		$drugName= $_POST['dname'];;
		$drugType=$_POST['type'];
		$amount=$_POST['amount'];
		$id = $_POST['id'];
		//echo $cat;
		insertPharBooking($pn,$vnumber,$date,$drugName,$drugType,$amount);
		updateTreatmentById($id);
		displayPharBooking($vnumber);
		//updateAvailabbleStock($numberOfNonTabs, $des, $type);
}elseif(isset($_POST['DescriptionPnumber'])){
			
			/* POPULATE DESCRIPTION DROP DOWN IF QUEUE IS USED */
			$pn=$_POST['DescriptionPnumber'];
			$vnber=getVisitNumber($pn);
			$sql="SELECT distinct(category) as cat from treatments where visitNumber='$vnber'";
			$record= dbAll($sql);
			echo "<option value=''></option>";
			foreach ($record as $value) {
				echo '<option value="'.$value["cat"].'">'.$value["cat"].'</option>';
			}
}elseif(isset($_POST['DescriptionKeyUp'])){
			
			/* POPULATE DESCRIPTION DROP DOWN IF KEY UP IS USED*/
			$pn=$_POST['DescriptionKeyUp'];
			$vnber=getVisitNumber($pn);

			$html = "<option value=''></option>";
			$html .= "<option value='Tablets'>Tablets</option>";
			$html .= "<option value='Non Tablets'>Non Tablets</option>";
			echo $html;
			
}


elseif (isset($_POST['completePharBooking'])){
	$pn=$_POST['completePharBooking'];
	$vnumber=getVisitNumber($pn);
	$date=date('Y-m-d');
	$val=updateTreamentStatus($vnumber);
	$totalAmount=getTransactionTotal($vnumber);
	bookingCompleted("pharbooking",$vnumber);
	if (!isAdmitted($vnumber)){
		if (getStatus($pn)=="COMPANY"){
			insertCompanyBills($pn,$vnumber,$totalAmount,$date,"user");
			updateQueueStatus("DONE",$pn);
			updateVisits($vnumber);
		}else if (getStatus($pn)=="INSURANCE"){
			insertInsuranceBills($pn,$vnumber,$totalAmount,$date,"user");
			updateQueueStatus("DONE",$pn);
			updateVisits($vnumber);
		}else{
				updateQueueStatus("PAY",$pn);// PRIVATE PATIENT
		}
		echo $val;
	}else if(isReleased($vnumber)){
	
		if (getStatus($pn)=="COMPANY"){
			insertCompanyBills($pn,$vnumber,$totalAmount,$date,"user");
			updateQueueStatus("DONE",$pn);
			updateVisits($vnumber);
		}else if (getStatus($pn)=="INSURANCE"){
			insertInsuranceBills($pn,$vnumber,$totalAmount,$date,"user");
			updateQueueStatus("DONE",$pn);
			updateVisits($vnumber);
		}else{
				updateQueueStatus("PAY",$pn);// PRIVATE PATIENT
		}
		echo $val;
	}
}
?>