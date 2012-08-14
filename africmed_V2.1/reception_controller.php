
<?php require_once 'includes/connect.php';
	  require_once 'includes/receptionFunctions.php';
if (isset($_POST['InsuranceVal'])){
	$sql  = "SELECT name from insurance_config";
		
		$record= dbAll($sql);
		echo "<option value=''>Select Insurance</option>";
		foreach ($record as $value) {
			echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
		}
}elseif (isset($_POST['CompanyVal'])){
		$sql  = "SELECT name from company_config";
		
		$record= dbAll($sql);
		echo "<option value=''>Select Employer</option>";
		foreach ($record as $value) {
			echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
		}
}else{
				$fname = mysql_real_escape_string($_POST["fname"]); 
				$lname = mysql_real_escape_string($_POST["lname"]); 
				$sex = mysql_real_escape_string($_POST["sex"]); 
				$dob = mysql_real_escape_string($_POST["dob"]); 
				$pob = mysql_real_escape_string($_POST["pob"]); 
				$nationality = mysql_real_escape_string($_POST["nationality"]); 
				$email = mysql_real_escape_string($_POST["email"]); 
				$phone = mysql_real_escape_string($_POST["phone"]); 
				$address = mysql_real_escape_string($_POST["address"]); 
				$occupation = mysql_real_escape_string($_POST["occupation"]); 
				$status = mysql_real_escape_string($_POST["status"]);
				$statusName="";
				$statusId="";
				if($status=="INSURANCE"){
					$statusName = mysql_real_escape_string((isset($_POST["insurance"])?$_POST["insurance"]:""));
					$statusId = mysql_real_escape_string((isset($_POST["policyId"])?$_POST["policyId"]:"0")); 
				}elseif ($status=="COMPANY"){
					$statusName = mysql_real_escape_string((isset($_POST["company"])?$_POST["company"]:""));
					$statusId = mysql_real_escape_string((isset($_POST["companyno"])?$_POST["companyno"]:"0"));
				}
				
				//$statusName
				
		$pnumber= insertPatientRecord($fname,$lname,$sex,$dob,$pob,$nationality,$email,$phone,$address,$occupation,$status,$statusName,$statusId);
		if ($pnumber){
			$pNumber=getPatientNumber();
			echo $pNumber;
		}
}
?>
	
				