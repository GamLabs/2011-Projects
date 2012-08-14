<?php
require_once 'includes/session.php';

function addGeneralBooking($pnumber,$vnumber,$type,$amount,$date,$user){
	$str="INSERT INTO general_booking(pnumber,visitNumber,type,amount,date,user) 
			VALUES('$pnumber','$vnumber','$type','$amount','$date','$user')";
	$sql= mysql_query($str) or die(mysql_error());
	if ($sql){
		return true;
	}else{
		return false;
	}
}
function dbAll($sql){
	$arr=array();
	$r=mysql_query($sql) or die(mysql_error());
	while($t=mysql_fetch_array($r)){
		$arr[]=$t;
	}
	return $arr;
}
function getAddress($pn){
	$str="SELECT address from patientrecord where pnumber='$pn'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$addr=$row['address'];

	return $addr;
}
function getInsuranceAddress($pn){
	$str="SELECT address from patientrecord where pnumber='$pn'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$addr=$row['address'];

	return $addr;
}
function getStatus($pn){
	$str="SELECT status from patientrecord where pnumber='$pn'";
	$sql=mysql_query($str) or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$status=$row['status'];
	return $status;
}

function getStatusName($pn){
	$str="SELECT statusName from patientrecord where pnumber='$pn'";
	$sql=mysql_query($str) or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$status=$row['statusName'];
	return $status;
}
function getName($pnumber){
	$sql=mysql_query("select fname,lname from patientrecord where pnumber='$pnumber'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$fname=$row['fname'];
	$lname=$row['lname'];
	return $fname." ".$lname;

}
function getNameByVisit($vnumber){
	$sql=mysql_query("select fullname from visits where visitNumber='$vnumber'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$name=$row['fullname'];
	return $name;

}

function getTotals($sql){

	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
	$total=$row['total'];

	if(empty($total)){
		return 0;
	}else {
		return $total;
	}
}

function getTransactionTotal($visitNumber){
	$phar="select sum(amount) as total from pharbooking where visitNumber='$visitNumber' ";
	$pharTotal= getTotals($phar);
	$con="select sum(amount) as total from consultation where visitNumber='$visitNumber'";
	$conTotal= getTotals($con);
	$lab="select sum(amount) as total from labbooking where visitNumber='$visitNumber'";
	$labTotal= getTotals($lab);

	$net=$pharTotal+$conTotal+$labTotal;
	
// DISPLAY ALL THE GENERAL BOOKINGS FOR THIS PATIENT
	$str="select amount from general_booking where visitNumber='$visitNumber'";
	$sql=mysql_query($str);
	while ($row = mysql_fetch_array($sql)){
		$net +=$row['amount'];
	}
	return $net;
}
function updateVisits($vnumber){// completes patient visit
	mysql_query("UPDATE visits set transactionCompleted='YES' where visitNumber='$vnumber'")or die(mysql_error());
}
function displayTransaction($visitNumber){

	$phar="select sum(amount) as total from pharbooking where visitNumber='$visitNumber' ";
	$pharTotal= getTotals($phar);
	$con="select sum(amount) as total from consultation where visitNumber='$visitNumber'";
	$conTotal= getTotals($con);
	$lab="select sum(amount) as total from labbooking where visitNumber='$visitNumber'";
	$labTotal= getTotals($lab);

	$totalNetAmount=$pharTotal+$conTotal+$labTotal;
	$name=getNameByVisit($visitNumber);

	$html ="<center><div><table border='light' width='70%'><tr class='ui-widget-header'><td><span><font color='aqua'><i>All Transactions for <b>$name</b></i> </font></span></td><td><span><font color='aqua'><i>Amount</font></span></td></tr><br />";
	if ($conTotal != 0){
		$html .="<tr><td class='ui-widget-header'><span><i>Consultation</i></span></td><td class='ui-widget-header'><span><i>D$conTotal</i></span></td></tr><br />";
	}
	if ($pharTotal != 0){
		$html .="<tr><td class='ui-widget-header'><span><i>Drug</i></span></td><td class='ui-widget-header'><span><i>D$pharTotal</i></span></td></tr><br />";
	}
	if ($labTotal != 0){
		$html .="<tr><td class='ui-widget-header'><span><i>Laboratory Test</i></span></td><td class='ui-widget-header'><span><i>D$labTotal</i></span></td></tr><br />";
	}
	
	// DISPLAY ALL THE GENERAL BOOKINGS FOR THIS PATIENT
	$str="select type, amount from general_booking where visitNumber='$visitNumber'";
	$sql=mysql_query($str);
	while ($row = mysql_fetch_array($sql)){
		$html .="<tr><td class='ui-widget-header'><span><i>".$row['type']."</i></span></td><td class='ui-widget-header'><span><i>D".$row['amount']."</i></span></td></tr><br />";
		$totalNetAmount +=$row['amount'];
	}
	$html .="<tr><td class='ui-widget-header'><span><i><b>Total Net Amount</b></i></span></td><td class='ui-widget-header'><span><i><b>D$totalNetAmount</b></i></span></td></tr></div></center>";

	$html .="</div>";
	echo $html;
}

function getTotalFee($pn){
	//Booking for Pharmacy
	$visitNumber = getVisitNumber($pn);
	//echo $visitNumber;
	$pharsql="select sum(amount) as total from pharbooking where visitNumber='$visitNumber' ";
	$rphar=mysql_query($pharsql);
	$rowphar = mysql_fetch_array($rphar);
	$pharTotal= $rowphar['total'];
	//booking for Consulation
	$consql="select sum(amount) as total from consultation where visitNumber='$visitNumber'";
	$rcon=mysql_query($consql);
	$rowcon = mysql_fetch_array($rcon);
	$conTotal= $rowcon['total'];
	//echo $conTotal;
	//booking for lab
	$labsql="select sum(amount) as total from labbooking where visitNumber='$visitNumber'";
	$rlab=mysql_query($labsql);
	$rowlab = mysql_fetch_array($rlab);
	$labTotal= $rowlab['total'];
	
	$sum = ($conTotal+$pharTotal+$labTotal);
	return $sum;
}

function getTotalFeeByVn($pn){
	
	//Booking for Pharmacy 
	$visitNumber = getLastVisitNumber($pn);
	//echo $visitNumber;
	$pharsql="select sum(amount) as total from pharbooking where visitNumber='$visitNumber' ";
	$rphar=mysql_query($pharsql);
	$rowphar = mysql_fetch_array($rphar);
	$pharTotal= $rowphar['total'];
	//booking for Consulation
	$consql="select sum(amount) as total from consultation where visitNumber='$visitNumber'";
	$rcon=mysql_query($consql);
	$rowcon = mysql_fetch_array($rcon);
	$conTotal= $rowcon['total'];
	//echo $conTotal;
	//booking for lab
	$labsql="select sum(amount) as total from labbooking where visitNumber='$visitNumber'";
	$rlab=mysql_query($labsql);
	$rowlab = mysql_fetch_array($rlab);
	$labTotal= $rowlab['total'];
	
	$sum = ($conTotal+$pharTotal+$labTotal);
	return $sum;
}
function getAmount($str){
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	return $row['amount'];
}
function patientExist($pnumber){
	$sql=mysql_query("select pnumber from patientrecord where pnumber='$pnumber'") or die(mysql_error());
	if(mysql_num_rows($sql)>0){
		return true;
	}
	return false;

}

function insertPatientRecord($fn,$ln,$se,$bdate,$pobirth,$nation,$emai,$ph,$addr,$occup,$sta,$statusName,$statusId){
	$user = $_SESSION['username'];
	mysql_query("insert into patientrecord(fname,lname,gender,dob,pob,occupation,
	status,email,phone,address,nationality,statusName,statusId,user)
	values ('$fn','$ln','$se','$bdate','$pobirth','$occup','$sta','$emai','$ph',
	'$addr','$nation','$statusName','$statusId','$user')")
	or die("Fail to register patient! ".mysql_error());

	return true;

}
function insertPaidBills($pn,$vn,$total,$paidDate,$paidAmount,$bal,$pay_method,$checkNo,$drawerNumber){
	$str="INSERT INTO paid_private_bills(pnumber,visitNumber,drawerNumber,paidDate,totalAmount,paidAmount,balance,pay_method,chequeNumber)
	VALUES('$pn','$vn',$drawerNumber,'$paidDate','$total','$paidAmount','$bal','$pay_method','$checkNo')";
	$sql=mysql_query($str);
	if($sql){
		return true;
	}else{
		return false;
	}
}
function getPatientNumber(){
	$sel=mysql_query("select pnumber from patientrecord order by pnumber desc limit 1 ")
	or die("Error: ".mysql_error());
	$row=mysql_fetch_array($sel);
	$pn=$row['pnumber'];
	return $pn;
}

function confirm_query($result_set) {
	if (!$result_set) {
		echo '{success:false}';
	}else{
		echo '{success:true}';
	}
}

function update_by_sql($sql){
	$result = mysql_query($sql, $connection);
	confirm_query($result);
}

function query_by_sql($sql){
	$result = mysql_query($sql, $connection);
	confirm_query($result);
	return $result;

}


function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}
function bookingExist($vnumber){
	$str="select pnumber from consultation where visitNumber='$vnumber'";
	$sql=mysql_query($str) or die(mysql_error());
	if(mysql_affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}
function insertConsultationBooking($pnumber,$date,$visitNumber,$conType,$amount){
	mysql_query("INSERT INTO consultation(pnumber,visitNumber,conType,amount,date) VALUES('$pnumber','$visitNumber','$conType','$amount','$date')") or die("Cannot Insert Consultation ".mysql_error());
	payFee($pnumber, $visitNumber, $amount);
}

function updateFee($pnumber,$visitNumber,$amount){
	//$sql = "update patient_bills set "
	$updateSql = "UPDATE patient_bills set totalAmount = (SELECT (totalAmount+$amount) from (select * from patient_bills) as x where visitNumber='$visitNumber' and pnumber='$pnumber') 
	where visitNumber = '$visitNumber' and pnumber='$pnumber'";
	mysql_query($updateSql);
}

function payFee($pnumber,$visitNumber,$amount){
	$drawer = getDrawerNumber(); 
	$date = date('Y-m-d');
	$sql= "insert into patient_bills (pnumber,visitNumber,drawerNumber,totalAmount,
		date) values ('$pnumber','$visitNumber',$drawer,$amount,'$date' )";
	mysql_query($sql);
}
function displayInvestigations($vnumber,$cat){

	$sql= "select type from investigations where visitNumber='$vnumber' AND category='$cat' AND ready='NO'";
	$result=mysql_query($sql) or die("Cannot display Consultation: "+mysql_error());
	$pn=substr($vnumber,0,8);
	$name=getName($pn);// Get Name of Patient

	$html  = "<center><table border='1'><tr><th><i>Pending Investigation(s) for <i><b><font color=red >$name</font><b></th></tr>";
	while ($row=mysql_fetch_array($result)){
		$html .= "<tr>";
		$html .= "<td>".$row['type']."</td>";
		$html .= "</tr>";
	}
	$html .= "</table></center>";
	echo $html;


}

function getcurrentInvest($pnumber){
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = date('Y-m-d');
	$sqlquery = "select category,type,id from investigations where visitNumber ='".$visitNumber."' and pnumber='".$pnumber."'  and date = '".$date."' and ready ='NO'";
		//echo $sqlquery;
		$result = mysql_query($sqlquery) or die(mysql_error());

		$html = "<table width='300' border='0' class='ui-widget ui-widget-content'> ";
		$html .= "<tr  style='white-space: nowrap;' class='ui-widget-header'><th>category</th><th>Type</th><th>Edit</th></tr>";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .= "<td>".$row['category']."</td><td>".$row['type']."</td><td id='deleteInvestigation'><a  href='#' class='".$row['id']."'><img src='images/delete.png' /></a></td>";
			$html .= "</tr>";
		}
		$html .="<table>";
		echo $html;
}

function displayTestForPatient($vnumber,$cat){
	$sql  = "select type from investigations where visitNumber ='$vnumber' AND category='$cat' AND ready='NO'";
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		echo '<option value="'.$value["type"].'">'.$value["type"].'</option>';
	}
}

function inInvestQueue($vn,$category){
	$str="SELECT visitNumber from investqueue where visitNumber='$vn' AND category='$category' AND status='NOT READY'";
	$sql=mysql_query($str) or die(mysql_error());
	if (mysql_num_rows($sql) > 0){
		return true;
	}
	return false;
}

function displayConsultation($visitNumber){
	$sql= "select pnumber, conType, amount, date_format(date,'%e %M, %Y') as date from consultation where visitNumber='$visitNumber'";
	$result=mysql_query($sql) or die("Cannot display Consultation: "+mysql_error());


	$row=mysql_fetch_array($result);

	$html  = "<center><table class='tdtext' border='0'><tr style='white-space: nowrap;' class='ui-widget-header' ><th>Patient Number</th><th>Consultation</th><th>Amount</th><th>Date</th></tr>";
	$html .= "<tr>";
	$html .= "<td>".$row['pnumber']."</td>";
	$html .= "<td>".$row['conType']."</td>";
	$html .= "<td>".$row['amount']."</td>";
	$html .= "<td>".$row['date']."</td>";
	$html .= "</tr>";
	$html .= "</table></center>";
	echo $html;


}

function displayGeneralBooking($visitNumber){
	$sql= "select pnumber, type, amount, date_format(date,'%e %M, %Y') as date from general_booking where visitNumber='$visitNumber'";
	$result=mysql_query($sql) or die("Cannot display Consultation: "+mysql_error());


	

	$html  = "<center><table class='tdtext' border='0'><tr class='ui-widget-header'><th>Patient Number</th><th>Consultation</th><th>Amount</th><th>Date</th></tr>";
	while ($row=mysql_fetch_array($result)){
		$html .= "<tr class'tdStrip'>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".$row['type']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "</tr>";
	}
	$html .= "</table></center>";
	echo $html;
	
}


function getQueue($sql){
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		echo "<option >".$row['pnumber']."&nbsp&nbsp  Name:   ".$row['fullname']."&nbsp&nbsp Arrival Time:  ".$row['arrivaltime']."</option>";
	}
}
//use this to check patient status
function privatePatient($pn){
	$sql=mysql_query("SELECT status from patientrecord where pnumber='$pn'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$status=$row['status'];
	if($status=="PRIVATE"){
		return true;
	}
	else
	return false;
}
// call this function if the patient is leaving the hospital
function completeTransaction($pn){
	mysql_query("UPDATE visits set transactionCompleted='YES' where pnumber='$pn'");
}

function getVisitNumber($pn){
	
	$sql=mysql_query("select visitNumber from visits where pnumber='$pn' AND transactionCompleted='NO' order by timeStamp desc limit 1");
	
	$row=mysql_fetch_array($sql);
	if(mysql_affected_rows()>0){
		$visitNumber=$row['visitNumber'];
		return $visitNumber;
	}else{
		return;
			
	}
}

function getVirtualVisitNumber($pn){
	
	$sql=mysql_query("select visitNumber from visits where pnumber='$pn' AND transactionCompleted='DATA' order by timeStamp desc limit 1");
	
	$row=mysql_fetch_array($sql);
	if(mysql_affected_rows()>0){
		$visitNumber=$row['visitNumber'];
		return $visitNumber;
	}else{
		return generateVirtualVN($pn);
			
	}
}
function getLastVisitNumber($pn){
	
	$sql=mysql_query("select visitNumber from visits where pnumber='$pn' AND transactionCompleted='YES' order by timeStamp desc limit 1");
	
	$row=mysql_fetch_array($sql);
	if(mysql_affected_rows()>0){
		$visitNumber=$row['visitNumber'];
		return $visitNumber;
	}else{
		return;
			
	}
}

function hasVisitNumber($pn){
	$sql=mysql_query("select visitNumber from visits where pnumber='$pn' AND transactionCompleted='NO' order by timeStamp desc limit 1");
	//echo $sql;
	$row=mysql_fetch_array($sql);
	if(mysql_num_rows($sql)>0){
		
		return true;
	}else{
		return;
			
	}
}

function generateVN($pn){
	$name = getName($pn);
	$date = date('Y-m-d');
	$sql =	mysql_query("INSERT into visits(pnumber,date,fullname) values('$pn','$date','$name')");
	if(mysql_affected_rows() > 0){
		
		return "Successfully generated a Visit Number";
	}	
		
		
}

function generateVirtualVN($pn){
	$name = getName($pn);
	$date = date('Y-m-d');
	$sql =	mysql_query("INSERT into visits (pnumber,date,fullname,transactionCompleted) values('$pn','$date','$name','DATA')");
	if(mysql_affected_rows() > 0){
		
		return getVirtualVisitNumber($pn);
	}	
		
		
}
function queueStatus($pn){
	$sql=mysql_query("SELECT status from queue where pnumber='$pn'");
	$row=mysql_fetch_array($sql);
	$status=$row['status'];
	return $status;
}
function updateQueueStatus($status,$pn){
	mysql_query("UPDATE queue set status='$status' where pnumber='$pn'");
}
function addToQueue($pn,$date,$name){
	mysql_query("INSERT into queue(pnumber,date,fullname) values('$pn','$date','$name')")
	or die(mysql_error());
}
function addToVisits($pn,$date,$name){
	$vn=getVisitNumber($pn);
	if(empty($vn)){ // ONLY INSERT INTO VISITS IFF THE PATIENT FINISHES A TRANSACTION
		mysql_query("INSERT into visits(pnumber,date,fullname) values('$pn','$date','$name')")
		or die(mysql_error());
	}
}

function addToVirtualVisits($pn,$date,$name){
	$vn=getVisitNumber($pn);
	if(empty($vn)){ // ONLY INSERT INTO VISITS IFF THE PATIENT FINISHES A TRANSACTION
		mysql_query("INSERT into visits(pnumber,date,fullname,transactionCompleted) values('$pn','$date','$name','YES')")
		or die(mysql_error());
	}
}
function getPatientLastVisit($pnumber){

	$sqlPatient = "select * from patientrecord where pnumber='$pnumber'";
	$sqlCheckUp = "select * from checkup where pnumber='$pnumber' order by checkUpDate DESC";

	
	$resultPatient = mysql_query($sqlPatient);
	$resultCheckUp = mysql_query($sqlCheckUp);
	$recordsPatient = mysql_fetch_array($resultPatient);
	if(!$recordsPatient){
		echo "Patient does not Exist";
		return;
	}
	$recordsCheckUp = mysql_fetch_array($resultCheckUp);
	if(!$recordsCheckUp){
		$html  = "<p><b>This is  ".$recordsPatient['fname'] ."  ". $recordsPatient['lname']."'s first visit ";
		echo $html;
	}else{

		$html  = "<p><b> ".$recordsPatient['fname'] ."  ". $recordsPatient['lname']." last visited this Hospital On ".$recordsCheckUp['checkUpDate']."</b></p>";
		$html .= "<table  id='record'> <thead>";
		$html .= "<tr>";
		$html .= "<th>Hypertension</th><th>Diabetes</th><th>Allergy</th><th>Current Complains</th><th>History Of Complains</th>";
		$html .= "</tr> </thead><tbody>";
		$html .= "<tr>";
		$html .= "<td>".$recordsCheckUp['hypertension']."</td><td>".$recordsCheckUp['diabetic']."</td><td>".$recordsCheckUp['allergy']."</td><td>".$recordsCheckUp['complains']."</td><td>".$recordsCheckUp['complainHistory']."</td>";

		$html .= "</tr></tbody></table>";
		echo $html ;
	}
}

function getInvestigationType($cat,$forwho){
	$sql = "select distinct(name) from test_types where category='$cat' and forwho='$forwho'";
	$result = mysql_query($sql) or die(mysql_error());

	echo "<option>Select One</option>";
	while ($records = mysql_fetch_array($result)){
		echo "<option value='".$records['name']."'>".$records['name']."</option>";

	}
}

function getTreatmentType($type){
	$sql = "select name from drug_names where type='$type'";
	echo $sql;
	$result = mysql_query($sql) or die(mysql_error());

	echo "<option value=''>Select One</option>";
	while ($records = mysql_fetch_array($result)){
		echo "<option>".$records['name']."</option>";

	}
}

function getProductList($type,$code){
	$sql = "select name from products where type='$type' and code='$code'";
	
	$result = mysql_query($sql) or die(mysql_error());

	echo "<option value=''>Select One</option>";
	while ($records = mysql_fetch_array($result)){
		echo "<option>".$records['name']."</option>";

	}
}

function getProductPrice($name,$status,$code){
	$sql = "select price from products where name='$name' and type='$status' and code='$code' limit 1";
	
	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result) > 0){
		$records = mysql_fetch_array($result);
		echo $records['price'];
	}
	
	
	

	
}
function getCurrentTreat($pnumber){
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = date('Y-m-d');
	$sqlquery = "select id,category,type,prescription,quantity from treatments where visitNumber ='".$visitNumber."' and pnumber='".$pnumber."' and date = '".$date."' and ready ='NO'";
	//echo $sqlquery;
		$result = mysql_query($sqlquery) or die(mysql_error());

		$html = "<table border='0' class='ui-widget ui-widget-content'> ";
		$html .= "<tr class='ui-widget-header'><th>Category</th><th>Type</th><th>Prescription</th><th>Quantity</th><th>Action </th></tr>";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .="<td>".$row['category']."</td><td>".$row['type']."</td><td>".$row['prescription']."</td><td>".$row['quantity']."</td><td id='deleteInvestigation'><a  href='#' class='".$row['id']."'><img src='images/delete.png' /></a></td>";
			$html .= "</tr>";
		}
		$html .="<table>";
		echo $html;
	
	
}

function addTreatments($post){
	$pnumber = mysql_real_escape_string($post['treatmentPnumber']);
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = date('Y-m-d');
	$category = $post['treatmentCategory'];
	$type= $post['treatmentType'];
	$qty = $post['drugQuantity'];
	$prescription = mysql_real_escape_string($post['prescription']);
	$user = "lamin";
	$id=0;


	$sql = "insert into treatments  values ($id,'$pnumber','$visitNumber','$date','$category','$type','$prescription',$qty,'NO','$user',CURRENT_TIMESTAMP)";

	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		$sqlquery = "select id,category,type,prescription,quantity from treatments where visitNumber ='".$visitNumber."' and pnumber='".$pnumber."' and date = '".$date."' and ready ='NO'";

		$result = mysql_query($sqlquery) or die(mysql_error());

		$html = "<table border='0' class='ui-widget ui-widget-content'> ";
		$html .= "<tr class='ui-widget-header'><th>Category</th><th>Type</th><th>Prescription</th><th>Quantity</th><th>Action </th></tr>";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .="<td>".$row['category']."</td><td>".$row['type']."</td><td>".$row['prescription']."</td><td>".$row['quantity']."</td><td id='deleteInvestigation'><a  href='#' class='".$row['id']."'><img src='images/delete.png' /></a></td>";
			$html .= "</tr>";
		}
		$html .="<table>";
		echo $html;
	}
}


function addInvestigations($post){
	$for = $post['investFor'];
	$pnumber = $post['investPnumber'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = date('Y-m-d');
	$category = $post['investCategory'];
	$type= $post['investType'];
	$user = "lamin";
	$id=0;


	$sql = "insert into investigations  values ($id,'$pnumber','$visitNumber','$date','$for','$category','$type','NO','$user',CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		
		$sqlquery = "select category,type,id from investigations where visitNumber ='".$visitNumber."' and pnumber='".$pnumber."'  and date = '".$date."' and ready ='NO'";
		//echo $sqlquery;
		$result = mysql_query($sqlquery) or die(mysql_error());

		$html = "<table width='300' border='0' class='ui-widget ui-widget-content'> ";
		$html .= "<tr  style='white-space: nowrap;' class='ui-widget-header'><th>category</th><th>Type</th><th>Action</th></tr>";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .= "<td>".$row['category']."</td><td>".$row['type']."</td><td id='deleteInvestigation'><a  href='#' class='".$row['id']."'><img src='images/delete.png' /></a></td>";
			$html .= "</tr>";
		}
		$html .="<table>";
		echo $html;
	}
}






function  submitDiagnosis($post){
	$pnumber = $post['pnumberDiag'];
	$visitNumber = (hasVisitNumber($pnumber))?getVisitNumber($pnumber):getVirtualVisitNumber($pnumber);
	$date = $post['checkUpDateDiag'];
	$followUpDate = $post['assesfollowUpDate'];
	$assessment = $post['assessment'];

	$sql = "insert into finaldiagnosis values ('$pnumber','$visitNumber','$date','$followUpDate',CURRENT_TIMESTAMP,'$assessment')";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		echo 0;
	}
}

function getPatientInfo($pn){
	$sql = "select fname,lname,dob,occupation,address,nationality from patientrecord where pnumber='$pn' limit 1";
	$query = mysql_query($sql);
	$row=mysql_fetch_array($query);
	$name = $row['fname']."  ".$row['lname'];
	$age = getAge($row['dob']);
	$addr = $row['address'];
	$occupation = $row['occupation'];
	$nationality = $row['nationality'];
	//echo $row['dob'];
	$vn = getVisitNumber($pn);
	$sql = "select * from phyexam where pnumber ='$pn' and visitNumber = '$vn' order by timeStamp desc limit 1";
	$query = mysql_query($sql);
	$examResult = mysql_fetch_array($query);


	$html = "<fieldset  class=' ui-widget ui-widget-content ui-corner-all inputStyle '>"."<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header'>Patient Info</legend>";
	$html .= "<table style='color:cyan'>";
	$html .= "<tr><td>Patient Name: </td><td> $name </td></tr>";
	$html .= "<tr><td> Age:</td><td>  $age Years Old</td></tr>";
	$html .= "<tr><td>Occupation:</td><td> $occupation </td></tr>";
	$html .= "<tr><td>Address:</td><td>$addr  </td></tr>";
	$html .= "<tr><td>Nationality:</td><td> $nationality </td></tr>";
	
	$sql2 = "select * from checkup where pnumber ='$pn'  order by timeStamp desc limit 1";
	$query2 = mysql_query($sql2);
	$examResult2 = mysql_fetch_array($query2);
	$html .= "<tr><td>Hypertension: </td><td>". $examResult2['hypertension']." </td></tr>";
	$html .= "<tr><td> Diabetic:</td><td>  ".$examResult2['diabetic']."</td></tr>";
	$html .= "<tr><td>Allergy:</td><td>". $examResult2['allergy']." </td></tr>";
	$html .= "<tr><td>Smoking:</td><td>".$examResult2['ph_smoking']." </td></tr>";
	$html .= "<tr><td>Alcohol:</td><td>". $examResult2['ph_alcohol']." </td></tr>";
	$html .="</table></br></br>";

	$html .= "<table>";
	$html .= "<tr><td>";
	if(hasVisitNumber($pn)){
		
	$html .= "<table width='500' border='0' class='ui-widget ui-widget-content'> <caption> Todays Preliminary Checkup</caption>";
	$html .= "<thead><tr style='white-space: nowrap;' class='ui-widget-header'><th>Temperature(C)</th><th>Weight(Kg)</th><th>Height(cm)</th><th>BP</th><th>Pulse</th><th>Current Complains</th></tr></thead>";
	$html .= "<tr><td>".$examResult['temperature']."</td><td>".$examResult['weight']."</td><td>".$examResult['height']."</td><td>".$examResult['bp']."</td><td>".$examResult['pulse']."</td><td>".$examResult['complains']."</td></tr>";
	$html .= "</table>";
	}
	echo $html;

	$visitNumber=getVisitNumber($pn);
	
	echo getTestResults($visitNumber);
	
}

function admitPatient($pn){

	$visitN = getVisitNumber($pn);
	$sql = "update visits set admitted='YES' where pnumber='$pn' AND visitNumber=$visitN";
	$result = mysql_query($sql) or die(mysql_errno());



	$sql2 = "insert into inpatient (pnumber,visitNumber,dateIn) values ('$pn','$visitN',CURRENT_TIMESTAMP)";
	$result2 = mysql_query($sql2);
	if($result2){
		return true;
	}


}

function release($pn){
	$visitN = getVisitNumber($pn);
	$sql = "update visits set admitted='NO' where pnumber='$pn' AND visitNumber=$visitN";
	$result = mysql_query($sql) or die(mysql_errno());



	$sql2 = "update inpatient set isOut='YES',dateOut=CURRENT_TIMESTAMP where pnumber='$pn' and visitNumber = '$visitN'";
	$result2 = mysql_query($sql2);
	
}

function isAdmitted($vn){
	$sql = "select visitNumber from inpatient where visitNumber='$vn' AND isOut='NO'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		return true;
	}else{
		return false;
	}
}
function isReleased($vn){
	$sql = "select visitNumber from inpatient where visitNumber='$vn' AND isOut='YES'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		return true;
	}else{
		return false;
	}
}
function getTestNameById($id){
	$sql = "select testType from labbooking where id = $id limit 1";
	$result = mysql_query($sql);
	if(mysql_affected_rows()> 0){
		$row = mysql_fetch_array($result);
		return $row['testType'];
	}
}
function getTestResults($vn){
	$sql = "select * from investigation_results where visitNumber ='$vn'";
	
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >0){
			
		$html = "<br/><br/><table width='500' border='0' class='ui-widget ui-widget-content'> <caption> Test Results</caption>";
		$html .= "<thead><tr style='white-space: nowrap;' class='ui-widget-header'><th>Results</th></tr></thead>";
			
		while($row = mysql_fetch_array($query)){
			$testname = getTestNameById($row['investigation_id']);
			$html .= "<tr><td><b>".$testname."</b> :<i> ". $row['results']."</i></td></tr>";
		}
		$html .= "</table>";
		return $html;
	}else{
		return "";
	}

}

function getAge($date){

	list($y,$m,$d) = explode('-', $date);

	if (($m = (date('m') - $m)) < 0) {
		$y++;
	} elseif ($m == 0 && date('d') - $d < 0) {
		$y++;
	}

	return date('Y') - $y;

}
function getUserGroups(){
	$sql = "select groupname from groups";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >0){
		echo "<option></option>";
		while($row = mysql_fetch_array($query)){
			echo "<option value='".$row['groupname']."'>". ucfirst($row['groupname'])."</option>";
		}
	}
}

function getPnumberByName($name ,$page){
	//$fname="";
	//$lname="";
	$searcTerm = explode(' ', $name);
	$pnumber = $searcTerm[0];
	//if(count($fullname)>1){
	//	$lname= $fullname[1];
		
	//}
	$html = "";
	$sWhere = "WHERE ";
	$aColumns = array( 'pnumber', 'fname', 'lname', 'dob', 'phone','address' );
	
	
	
	$sql="";
	if (is_numeric($name)){
		$sql = "select fname ,lname,pnumber,dob,phone,address from patientrecord where pnumber='$pnumber' or phone like '$pnumber%' ";
	}else{
		$sWhere .= getWhereStat($aColumns,$name)."  ";
		$sql = "select fname ,lname,pnumber,dob,phone,address from patientrecord ".$sWhere." limit 50";
		
	}
	

	//===
	
	
	//===
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) >0){
		$html .= "<div style='overflow:auto;height:300;width:auto;font-size:13;'>";
		$html .= "<table  border='0' class='ui-widget ui-widget-content'>";
		$html .= "<thead><tr style='white-space: nowrap;' class='ui-widget-header'><th>Patient Num.</th><th>Full Name</th><th>Address</th><th>Telephone</th></tr></thead>";
		
		while($row = mysql_fetch_array($query)){
		$html .= "<tr style='white-space: nowrap;'><td><b><a style='font-size:14;' id='livePnumberQuery".$page."' href='#'>".$row['pnumber']."</a></b></td><td>".$row['fname']."  ".$row['lname']."</td><td>".$row['address']."</td><td>".$row['phone']."</td></tr>";
		
		}
		$html .= "</table>";
		$html .= "</div>";
	}else{
		   if (is_numeric($name)){
		   	if(strlen($name) == 8){
		   		if(!patientExist($name)){
		   		echo  "<p class='ui-widget-header' style='font-size:20;color:red; '>Patient Number Not  Found</p>";	
		   		}
		   	}
		   	
		   }elseif(!patientExist($name)){
			echo  "<p class='ui-widget-header' style='font-size:20;color:red; '>Patient Name Not Found</p>";
			return 1;
		}
	}
	return $html;
}

	function getWhereStat($aColumns,$searchT){
		$str = trim(mysql_real_escape_string( $searchT ));
		$val = explode(' ',$str);
		
		$val = array_unique($val);
		$lastEle = end($val);
		reset($val);
		$ret="";
		$col = count($aColumns);
		$last = false;
		foreach( $val as $v )
		{	
			$ret .= "( ";
			if($val[0] == $v){
			for ( $i=0 ; $i<$col ; $i++ )
			{
		
					if(($col-1) == $i){
						$ret .= $aColumns[$i]." LIKE "."'".$v."%'" . "  ";
					}else{
						$ret .= $aColumns[$i]." LIKE "."'".$v."%'" . " OR ";
					}
		
			}
			}else{
				for ( $i=0 ; $i<$col ; $i++ )
				{
		
						if(($col-1) == $i){
							$ret .= $aColumns[$i]." LIKE "."'%".$v."%'" . "  ";
						}else{
							$ret .= $aColumns[$i]." LIKE "."'%".$v."%'" . " OR ";
						}
		
				}			
			}
			$ret .= ") ";
			if($lastEle == $v){
				
			}else{
				$ret .= " AND ";
			}
		}
		$ret .= " ";
		return $ret;		
}

function getPnumberByName_old($name,$page){
	$fname="";
	$lname="";
	$fullname = explode(' ', $name);
	$fname = $fullname[0];
	if(count($fullname)>1){
		$lname= $fullname[1];

	}

	$html = "";
	$sql="";
	if (is_numeric($name)){
		$sql = "select fname ,lname,pnumber,dob,phone,address from patientrecord where pnumber='$name'";
	}else{
		$sql = "select fname ,lname,pnumber,dob,phone,address from patientrecord where fname like '$fname%' AND lname like '$lname%'";
	}
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >0){
		$html .= "<div style='overflow:auto;height:200;'>";
		$html .= "<table  border='0' class='ui-widget ui-widget-content'>";
		$html .= "<thead><tr style='white-space: nowrap;' class='ui-widget-header'><th>Patient Num.</th><th>Full Name</th><th>Address</th><th>Telephone</th></tr></thead>";
		
		while($row = mysql_fetch_array($query)){
			$html .= "<tr style='white-space: nowrap;'><td><a id='livePnumberQuery".$page."' href='#'>".$row['pnumber']."</a></td><td>".$row['fname']."  ".$row['lname']."</td><td>".$row['address']."</td><td>".$row['phone']."</td></tr>";

		}
		$html .= "</table>";
		return $html;
	}
	return "<p class='ui-widget-header' style='font-size:20;color:red; '>Patient Not Found</p>";

}

function addToInvestQueue($pn,$date,$name,$category){
	$vn = getVisitNumber($pn);
	mysql_query("INSERT into investQueue (pnumber,visitNumber,date,fullname,category,status) values('$pn','$vn','$date','$name','$category','LAB')")
	or die(mysql_error());
}

function existInInvestQueue($pnumber,$category){
	$sql=mysql_query("select pnumber,category from investQueue where pnumber='$pnumber' AND category='$category'");

	if(mysql_num_rows($sql) > 0){
		return true;
	}
	return false;

}

function getPatientTable($sql,$title){
	$sql=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($sql) > 0){
		//echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		echo "<label class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='background-color: blue;font-size:14;'><a href='#' style='text-decoration:none'>".$title."</a> </label><br><br>";
			

		$check=0;
		while($assoc = mysql_fetch_assoc($sql)){

			if($title == "Patient Record"){
				echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' >";
			}else{
				echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle collapsed' >";
			}
			echo "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='font-size:11;'><a href='#' style='text-decoration:none'>+".formatDate($assoc['Date'])."</a> </legend>";
			echo "<table border='0' style='color:aqua;font-size:13'>";
			foreach ($assoc as $key => $value){
				$value = trim($value);
				if($key == "pnumber"){
					echo "<tr>";
					echo "<td style='white-space:nowrap;vertical-align:top;text-align:right;color:cyan;'>Name:</td><td style='color:aqua;'> ".getName($value)."</td>";
					echo  "</tr>";
					continue;
				}
				if(!empty($value) && ($value != "0000-00-00")){
					echo "<tr>";
					echo "<td style='white-space:nowrap;vertical-align:top;text-align:right;color:cyan;'>" .$key.":</td><td style='color:aqua;'> ".ucfirst($value)."</td>";
					echo  "</tr>";
				}  
			}
			echo "</table>";
			echo "</fieldset>";
			echo "<br>";
			$check++;

		}


	}else{
		echo "<h4 style='color:red;'>Sorry: Patient Number not found in the records</h4>";
	}
}

function formatDate($date){
	list($Year,$Month,$Day) = explode('-',$date);
	$stampeddate = mktime(12,0,0,$Month,$Day,$Year);
	$realDate = date("F jS, Y",$stampeddate);
	return $realDate;
}
function getTestTypeByCode($code){
	if($code == "4001"){
		return "Laboratory";
	}elseif ($code == "4002"){
		return "X-Ray";
	}elseif ($code == "4003"){
		return "Scans";
	}elseif ($code == "4006"){
		return "E.C.G";
	}
}
function getPatientInvestigationTable($pn ,$tests){
	$sql = "select distinct date from investigations where pnumber='$pn' order by date desc";
	$resultsDate = mysql_query($sql);
	if(mysql_num_rows($resultsDate) > 0){
		//echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		echo "<label class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='background-color: blue;font-size:14;'><a href='#' style='text-decoration:none'>Investigation History</a> </label><br><br>";
			
		$count = mysql_num_rows($resultsDate);
		for ($z=0;$z < $count;$z++){
			$row = mysql_fetch_array($resultsDate);
			$date = $row['date'];
			
			echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle collapsed' >";
			echo "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='font-size:11;'><a href='#' style='text-decoration:none'>+".formatDate($date)."</a> </legend>";
			echo "<table border='0' style='color:aqua;font-size:13'>";
			for($x=0;$x<count($tests);$x++){
				$sql = "select * from investigations where category='". $tests[$x]."' and pnumber='$pn' and date = '$date' order by timeStamp desc";
				//echo $sql;
				$results=mysql_query($sql);
				if(mysql_num_rows($results) > 0){
					//$assoc = mysql_fetch_assoc($results);
//"<tr><td style='white-space:nowrap;vertical-align:top;text-align:right; color:aqua;'>".$tests[$x]." Test(s):  </td>
					echo "<td style='color:cyan;'>";
					echo "<u>".getTestTypeByCode($tests[$x])." Test(s)</u>";
					echo "<ul>";
					while ($row = mysql_fetch_array($results)){
						$value = trim($row['type']);
						if(!empty($value) && ($value != "0000-00-00")){
							echo "<li>".ucfirst($value)." <span style='color:aqua;'>[Results: ".getTestResultsById($row['id']) ."]</span><br> </li>";
						}
					}
					echo "</ul>";
					
					echo "</td>";
					echo  "</tr>";

				}else{
					//echo "<h4 style='color:red'>Sorry: Patient Number not found in the records</h4>";
				}
			}

			//====
			/*
			$sql = "select * from  investigation_results where pnumber='$pn' and timeStamp like  '$date%' order by timeStamp desc";
			//echo $sql;
			$results=mysql_query($sql);
			if(mysql_num_rows($results) > 0){
				echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right; color:aqua;'>Investigation Results:  </td><td style='color:black;'>";

				while ($row = mysql_fetch_array($results)){
					$value = trim($row['results']);
					if(!empty($value) && ($value != "0000-00-00")){
						echo trim($row['category']).": ";
						echo ucfirst($value)."<br> ";
					}
				}
				echo "</td>";
				echo  "</tr>";

			}
			*/
			//======

			echo "</table>";
			echo "</fieldset>";
		}
	}else{
		echo "<h4 style='color:red;'>Sorry: ".getName($pn)." Has No Investigations Yet</h4>";
	}

}

function getTestResultsById($id){
	$sql = "select results from investigation_results where investigation_id=$id";
	
	
	$result = mysql_query($sql);
	if(mysql_num_rows($result) >0 ){
		$row = mysql_fetch_array($result);
		return $row['results'];
	}else{
		return "Pending Result";
	}
}

function getPatientPrescriptionTable($pn){
	$sql = "select distinct date from treatments where pnumber='$pn' order by date desc";
	$resultsDate = mysql_query($sql);
	if(mysql_num_rows($resultsDate) > 0){
		//echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		echo "<label class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='background-color: blue;font-size:14;'><a href='#' style='text-decoration:none'>Prescription History</a> </label><br><br>";
			
		$count = mysql_num_rows($resultsDate);
		for ($z=0;$z < $count;$z++){
			$row = mysql_fetch_array($resultsDate);
			$date = $row['date'];
			
			echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle collapsed' >";
			echo "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='font-size:11;'><a href='#' style='text-decoration:none'>+".formatDate($date)."</a> </legend>";
			echo "<table border='0' style='color:aqua;font-size:13'>";
		
				$sql = "select * from treatments where  pnumber='$pn' and date = '$date' order by timeStamp desc";
				//echo $sql;
				$results=mysql_query($sql);
				if(mysql_num_rows($results) > 0){
					//$assoc = mysql_fetch_assoc($results);
			//<tr><td style='white-space:nowrap;vertical-align:top;text-align:right; color:aqua;'> Prescriptions:  
					echo "<td style='color:cyan;'>";
					echo "<u>Prescriptions</u>";
					echo "<ul>";
					while ($row = mysql_fetch_array($results)){
						$value = trim($row['type']);
						$type = trim($row['category']);
						$qty = trim($row['quantity']);
						if(!empty($value) && ($value != "0000-00-00")){
							echo "<li>".ucfirst($value). " ( $qty ".$type .") </li> ";
						}
					}
					echo "</ul>";
					echo "</td>";
					echo  "</tr>";


				}else{
					//echo "<h4 style='color:red'>Sorry: Patient Number not found in the records</h4>";
				}
		

			echo "</table>";
			echo "</fieldset>";
		}
	}else{
		echo "<h4 style='color:red;'>Sorry: ".getName($pn)." Has No Prescriptions Yet</h4>";
	}

}





function hasPaid($pn){
	$vn = getVisitNumber($pn);
	$sql = "select pnumber from paid_private_bills where visitNumber = '$vn'";
	$results = mysql_query($sql);
	if(mysql_num_rows($results)>0){
		return true;
	}else{
		return false;
	}

}

//From Jarra
	function editTableByPnumber($sql,$table,$pn){
	echo "<form id='commonEditorForm' action='editorFormController.php' method='post'>";
	echo "<input type='hidden' id='table' name='table' value='$table'>";
	echo "<input type='hidden' id='pn' name='pn' value='$pn'>";
	echo "<table border='0'>";
	$resultsArg = mysql_query($sql);
	$resultsInternal = mysql_query("select * from $table where pnumber='$pn'");
	
	if(mysql_num_rows($resultsArg) > 0){
		while($assoc = mysql_fetch_assoc($resultsArg)){
			$assocInternal = mysql_fetch_assoc($resultsInternal) or die(mysql_error());
			foreach ($assoc as $key => $value){
				$keyInt = key($assocInternal);
				next($assocInternal);
				echo "<tr>";
				echo "<td><label>".$key."</label></td><td><input type='text' id='".$keyInt."' name='".$keyInt."' value='".$value."'>  </td>";
				echo "</tr>";
			}
				
		}	
		
	}
	echo "<tr><td></td><td><input type='submit' id='commonEditorSubmit' value='Submit'></td</tr>";
	echo "</table>";
	echo "</form>";
	echo <<<HTM
		<script>
		//$('#commonEditorForm').formly({'onBlur':false, 'theme':'Dark'});
		$('#commonEditorForm').ajaxForm({
			success:function(response){
				$('#commonEditorForm').resetForm();
				$("#successMessage").html('<p><b><i><font size=4 color=aqua> Successfully Edited </p>').dialog('open');
			}
		});
		</script>
HTM;
}

function editTableById($assocCol,$table,$keyCol,$keyVal){

	echo "<form id='commonEditorForm' action='editorFormController.php' method='post'>";
	echo "<input type='hidden' id='table' name='table' value='$table'>";
	echo "<input type='hidden' id='id' name='$keyCol' value='$keyVal'>";
	echo "<table border='0'>";
	//$sql = "select ";
	$count = count($assocCol);
	$columns = array_keys($assocCol);
	$sWhere = " WHERE $keyCol=$keyVal";
	$sQuery = "
		SELECT ".str_replace(" , ", " ", implode(", ", $columns))."
		FROM   $table"
		.$sWhere;
		//$sOrder
		//$sLimit
	//echo $sQuery;
	
	$resultsArg = mysql_query($sQuery);

	if(mysql_num_rows($resultsArg) > 0){
		
			$row =  mysql_fetch_assoc($resultsArg);
			foreach ($row as $key => $value){
				$col = $key;
				$val = $value;
				$lbl = $assocCol[$key];
				if($lbl == "titleForm"){
					echo "<tr>";
					echo "<td></td><td><span style='font-size:19' class=' ui-widget-content ui-corner-all  ui-widget-header'>Editing $val </span> </td>";
					echo "</tr>";
					
				}else{
				echo "<tr>";
				echo "<td><label>".$lbl."</label></td><td><input class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' type='text' id='".$col."' name='".$col."' value='".$val."'>  </td>";
				echo "</tr>";
				}
		
				
			}	
			
		
	}
	echo "<tr><td></td><td><input type='submit' id='commonEditorSubmit' value='Submit'></td</tr>";
	echo "</table>";
	echo "</form>";
	echo "<div>";
	echo <<<HTM
		<script>
		$("#commonEditorSubmit").button();
		$('#commonEditorForm').ajaxForm({
			success:function(response){
				$('#commonEditorForm').resetForm();
				$("#successMessage").html('<p><b><i><font size=4 color=aqua> Successfully Edited </p>').dialog('open');
				
				
			}
		});
		</script>
HTM;

}
function saveTable($post){
	$table = $post['table'];
	$pn = $post['pn'];
	
	$sql ="Update $table set ";
	$count = count($post);
	$inc =1;
	foreach ($post as $key => $value){
		
		if($count > $inc){
			if($key == 'table'){$inc++;continue;}elseif ($key == 'pn'){$inc++;continue;}
		$sql .= "$key = '$value' ,";
		$inc++;
		continue;
		}else{
			$sql .= "$key = '$value' ";
		}
	}
	$sql .= " where pnumber = '$pn'";
	//echo $sql;
	$results = mysql_query($sql) or die(mysql_error());
}

function editTable($post,$table){

	$pn = $post['pnumber'];
	
	$sql ="Update $table set ";
	$count = count($post);
	$inc =1;
	//echo "POST:".$count;
	foreach ($post as $key => $value){
		
		if($inc == 1){
		if ($key == 'id'){$inc++;continue;}elseif ($key == 'oper'){$inc++;continue;}elseif ($key == 'pnumber'){continue;}
		$sql .= "$key = '$value' ";
		$inc++;
		}else{
		if ($key == 'id'){$inc++;continue;}elseif ($key == 'oper'){$inc++;continue;}elseif ($key == 'pnumber'){$inc++;continue;}
			$sql .= " , $key = '$value' ";
		}
	}
	$sql .= " where pnumber = '$pn'";
	echo $sql;
	$results = mysql_query($sql) or die(mysql_error());
}

function editTableByColumn($post,$table, $column){

	//$id = $post['id'];
	
	$sql ="Update $table set ";
	$count = count($post);
	$inc =1;
	//echo "POST:".$count;
	$oldKV;
	foreach ($post as $key => $value){
		
		if($inc == 1){
		if ($key == $column){$oldKV = $value;continue;}elseif ($key == "table"){continue;}
		$sql .= "$key = '$value' ";
		$inc++;
		}else{
		if ($key == $column){$inc++;$oldKV = $value; continue;}elseif ($key == "table"){$inc++;continue;}
			$sql .= "  , $key = '$value' ";
		}
	}
	$sql .= " where $column = $oldKV";
	
	//echo $sql;
	$results = mysql_query($sql) or die(mysql_error());
}



//===

//====


/*
function deleteRowByPnumber($sql){
	$query = mysql_query($sql);
	if(mysql_affected_rows()>0){
		return "Successfully Deleted";
	}else{
		return "Error: ".mysql_error();
	}
}
*/

function deleteRowByPnumber($pn,$table){
	$sql = "delete from $table where pnumber ='$pn'";
	$query = mysql_query($sql);
	if(mysql_affected_rows()>0){
		return "Successfully Deleted";
	}else{
		return "Error: ".mysql_error();
	}
}

function deleteRowByVnumber($vn,$table){
	$sql = "delete from $table where visitNumber ='$vn'";
	$query = mysql_query($sql);
	if(mysql_affected_rows()>0){
		return "Successfully Deleted";
	}else{
		return "Error: ".mysql_error().$sql;
	}
}

function insuranceInUsed($name){
	$name = trim($name);
	$sql = "select pnumber from patientrecord where statusName = '$name'";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >0){
		return 1;
	}else{
		return 9;
	}
	
}
function deleteRowByColumn($key,$table, $column){
	$sql = "delete from $table where $column =$key";
	$query = mysql_query($sql);
	if(mysql_affected_rows()>0){
		return 0;
	}else{
		return 1;
	}
}



function Strip($value)
{
	if(get_magic_quotes_gpc() != 0)
  	{
    	if(is_array($value))  
			if ( array_is_associative($value) )
			{
				foreach( $value as $k=>$v)
					$tmp_val[$k] = stripslashes($v);
				$value = $tmp_val; 
			}				
			else  
				for($j = 0; $j < sizeof($value); $j++)
        			$value[$j] = stripslashes($value[$j]);
		else
			$value = stripslashes($value);
	}
	return $value;
}

function getAmbulances(){
	

		$sqlquery = "select * from ambulance_gen where type='AMBULANCE'";
		//echo $sqlquery;
		$result = mysql_query($sqlquery) or die(mysql_error());
		$html = "";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .= "<td>".$row['id']."</td>";
			$html .= "<td>".$row['name']."</td><td>".$row['registration_num']."</td>";
			$html .= "<td id='deleteInvestigation'>";
			$html .= "<a class='addFuelLinkAmb' style='float: right;' href='#'><img src='images/F1.png'></img></a>";
			$html .= "<a class='addMaintenanceLinkAmb' style='float: right;' href='#'><img src='images/M1.png'></img></a>";
			$html .= "<a class='addDispatchLinkAmb' style='float: right;' href='#'><img src='images/D1.png'></img></a>";
			$html .= "</td>";
			$html .= "</tr>";
		}
		
		echo $html;
}

function getGenerators(){
	
	$sqlquery = "select * from ambulance_gen where type='GENERATOR'";
		//echo $sqlquery;
		$result = mysql_query($sqlquery) or die(mysql_error());
		$html = "";
		while($row = mysql_fetch_array($result)){
			$html .= "<tr>";
			$html .= "<td>".$row['id']."</td>";
			$html .= "<td>".$row['name']."</td><td>".$row['registration_num']."</td>";
			$html .= "<td id='deleteInvestigation'>";
			$html .= "<a class='addFuelLinkGen' style='float: right;' href='#'><img src='images/F1.png'></img></a>";
			$html .= "<a class='addMaintenanceLinkGen' style='float: right;' href='#'><img src='images/M1.png'></img></a>";
			$html .= "</td>";
			$html .= "</tr>";
		}
		
		echo $html;
}
function isMale($pn){

	$sql = "select gender from patientrecord where pnumber='$pn' and gender='Male'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		return true;
	}else{
		return false;
	}
}

function isPrivate($pn){
$sql = "select status from patientrecord where pnumber='$pn' and status='PRIVATE'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){	
		return true;
	}else{
		return false;
	}
}

function isInsurance($pn){
$sql = "select status from patientrecord where pnumber='$pn' and status='INSURANCE'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){	
		return true;
	}else{
		return false;
	}
}

function isCompany($pn){
$sql = "select status from patientrecord where pnumber='$pn' and status='COMPANY'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){	
		return true;
	}else{
		return false;
	}
}

function getBillDates($pn){
	
	$sql = "select visitNumber,date from visits where pnumber = '$pn' and transactionCompleted = 'YES' order by visitNumber desc";
	$result = mysql_query($sql) or die(mysql_error());
	$html ="";
		if(mysql_affected_rows() >0 ){
			$html  .= "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle'>";
			$html .= "<label>Choose Bill Date</label>";
			$html .= "<select class=' ui-widget ui-widget-content ui-corner-all inputStyle ui-widget-header' id='paymentBillsSelect'>";
			$html .=  "<option>Select Visit Date</option>";
			while ($records = mysql_fetch_array($result)){
				 $Vdate = $records['date'];
				 $todays_date = date("Y-m-d");
			     $today = strtotime($todays_date);
			     $date = strtotime($Vdate); 
			 	  if ($date == $today) 
			  		 {
			   			$html .= "<option value='".$records['visitNumber']."'>Today</option>";
			   		 }else{
			   		 	$html .= "<option value='".$records['visitNumber']."'>".formatDate($records['date'])."</option>";
			   		 }
				
		
			}
			$html .= "</select>";
			$html .= "</fieldset>";
		}else{
			$html .= "<h2 style='color:red'>Sorry, No Visits</h2>";
			
		}
		echo $html;
}
	
function getBillsTable($vn){
	
	$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,paid_date,
	pay_method from patient_bills where  visitNumber = '$vn' order by date desc limit 1";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Bills </legend>";
		$html .= "<center><table class=' ui-widget ui-widget-content ui-corner-all'>";
		$html .= "<tr style='font-size:19' class='ui-widget-header'><th>Visit Number</th><th>Name</th><th>Date</th><th>Amount</th><th>Balance</th><th>Action</th></tr>";
	while($row=mysql_fetch_array($result)){
		//$genTotal = getGenBookingFee($row['visitNumber']);
		$total = $row['totalAmount'];
		$bal = ($total == $row['paidAmount'])?0:($total-$row['paidAmount']);
		$action ="";
		if($bal == 0){
			$action ="PAID";
		}else{
			$action = "<a class='payPatientBillLink' href='#'><img src='images/pay.png'></img></a>";
		}
		
		$html .= "<tr style='font-size:19'>";
		$html .= "<td>".$row['visitNumber']."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$total."</td>";
		$html .= "<td>".$bal."</td>";
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
	}
	
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Transactions In this Visit<h2>";
		}
	//getTotalFee($pn);patient_bills
}

function getBillsPayments($vn){
	
	$sql = "select * from private_payments where  visitNumber = '$vn' order by receipt_no asc";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		
		$html = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Payments </legend>";
		$html .= "<center><table class=' ui-widget ui-widget-content ui-corner-all'>";
		$html .= "<tr style='font-size:19' class='ui-widget-header'><th>Date</th><th>Receipt Number</th><th>Payment Method</th><th>Cheque No.</th><th>Amount</th></tr>";
		$total = 0;
		while($row=mysql_fetch_array($result)){
		
		$html .= "<tr style='font-size:19'>";
		$html .= "<td>".formatDate($row['paid_date'])."</td>";
		$html .= "<td>".$row['receipt_no']."</td>";
		$html .= "<td>".$row['pay_method']."</td>";
		$html .= "<td>".$row['cheque_no']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header ui-corner-bottom' style='font-size:19'><td>Total</td><td></td><td></td><td></td><td>$total</td></tr>";
	
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>No Payment for this  Visit Yet<h2>";
		}
	//getTotalFee($pn);patient_bills
}

function getGenBookingFee($vn){
$sql = "select amount from general_booking where visitNumber='$vn'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){	
		$row = mysql_fetch_array($result);
		return $row['amount'];
	}else{
		return 0;
	}
	
}

function getPatientStatus($pn){
	$sql = "select * from patientrecord where pnumber='$pn'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){	
		$row = mysql_fetch_array($result);
			echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle collapsed' >";
			echo "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='font-size:14;'><a href='#' style='text-decoration:none'>Current Patient's Status</a> </legend>";
			echo "<table border='0' style='color:aqua;font-size:14'>";
					
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Full Name:</td><td> ".getName($row['pnumber'])."</td></tr>";
					
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Gender:</td><td> ".$row['gender']."</td></tr>";
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Occupation:</td><td> ".$row['occupation']."</td></tr>";
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Registration Status:</td><td> ".$row['status']."</td></tr>";
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Registered With :</td><td> ".$row['statusName']."</td></tr>";
					echo "<tr><td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>Registration ID:</td><td> ".$row['statusId']."</td></tr>";
					
			echo "</table></fieldset>";
		
	}
}

function getEquipmentName($id){
	$sql = "select name from ambulance_gen where id=$id limit 1";
	//echo $sql;
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) > 0 ){	
		$row = mysql_fetch_array($result);
		return $row['name'];
	}else{
		return ;
	}
	
}

function getuserCombo(){

	$sql = "select firstname,lastname,username from users";
	$result = mysql_query($sql);
	$html = "<option value=''>Select User</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$fullname = $row['firstname']." ".$row['lastname'];
			$html .= "<option value='".$row['username']."'>".$fullname ."</option>";
		}
		echo $html;
	}
}

function getConFeeCombo(){

	$sql = "select id,conType from consultationconfig";
	$result = mysql_query($sql);
	$html = "<option value=''>Select Type</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$type = $row['conType'];
			$html .= "<option value='".$row['id']."'>".$type ."</option>";
		}
		echo $html;
	}
}

function getPackagingCombo(){

	$sql = "select name from pharmacy_packaging";
	$result = mysql_query($sql);
	$html = "<option value=''>Select Type</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$type = $row['name'];
			$html .= "<option value='".$row['name']."'>".$type ."</option>";
		}
		echo $html;
	}
}

function getUserStatus($username){

	$sql = "select active from users where username='$username' limit 1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		$row = mysql_fetch_array($result);
		$status = $row['active'];
		return $status;
		
	}
}

?>