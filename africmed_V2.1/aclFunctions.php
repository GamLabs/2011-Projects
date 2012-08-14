<?php
require_once 'includes/connect.php';

function getCategoryGroup($username){
	$sql = "select category from users where username ='$username'";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >0){
		$row = mysql_fetch_array($query);
		return  $row['category'];
	}
}


function getNavLink($group){
	if($group == "reception"){
		
	?>
 <h2><a href="#">Reception</a></h2>
  
  	<div class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="registration">Registration</a></div>
    <div class="ui-state-default ">
    <a href="#" id="conFee">Consultation Fee</a></div>
    <div class="ui-state-default ">
    <a href="#" id="privateBills">Bill Payment</a></div>
	<div class="ui-state-default ">
    <a href="#" id="visits">Visits</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="search">Search</a></div>
    <div class="ui-state-default "><a href="#" id="cashDrawer">Cash Drawer</a></div>
	</div>
	<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
<?php }elseif($group == "consultation"){?>
	 <h2 class="remove" id="consultationLink"><a href="#">Consultation</a></h2>
  
  	<div class="remove" id="consultationDiv" class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="checkup">Nurse Examination</a></div>
  	<div class="ui-state-default ">
    <a href="#" id="diagnosis">Diagnosis</a></div>
    
	</div>
	<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
  	
 <?php }elseif ($group == "pharmacy"){?>
  <h2><a href="#">Pharmacy</a></h2>
 <div class="ui-widget">
 				<!--  <div class="ui-state-default ">
				    <a href="#" id="inputStoreDrugs">Input Store Drugs</a></div> 
				    <div class="ui-state-default ">
				    <a href="#" id="viewStoreDrugs">View Store Drugs</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="inputPhar">Input Phar. Drugs</a></div>
				     <div class="ui-state-default ">
				    <a href="#" id="viewPharDrugs">View Phar. Drugs</a></div>-->
				  
				  <div class="ui-state-default  ">
				    <a href="#" id="inputPhar">Input Drugs</a></div>
				  	<div class="ui-state-default ">
				    <a href="#" id="bookPhar">Request Drugs</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="pharSales">Daily Sales</a></div>
 		</div>
 		<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
 		 <?php }elseif ($group == "laboratory"){?>
  <h2><a href="#">Laboratory</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLab">Input Test</a></div>
				  <div class="ui-state-default  ">
				   <a href="#" id="RequestTest">Request Test</a></div>
				   <div class="ui-state-default  ">
				   <a href="#" id="labResults">Lab Test Results</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSales">Daily Sales</a></div>
 		</div>
 		<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
 <?php }elseif ($group == "labour"){?>
<h2><a href="#">Labour</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="bioSocialData">BioSocial Data</a></div>
				  <div class="ui-state-default ">
				    <a href="#" id="obstericalHistory">Obsterical History</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="antenatalRecord">Antenatal Record</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labourTreatments">Treatments</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labourDelivery">Delivery</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="postpartumCare">Postpartum care</a></div>
				   <!--   <div class="ui-state-default ">
				    <a href="#" id="nurseLabour">View Patients Under Nurse</a></div>-->
			</div>
			<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
<?php }elseif ($group == "theater"){?>
<h2><a href="#">Theater</a></h2>
  <div>Theater.</div>
 <?php }elseif ($group == "finance"){?>
<h2><a href="#">Finance</a></h2>
		<div class="ui-widget">
				<div class="ui-state-default  ">
				    <a href="#" id="monthlyExpense">Expense</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="dayBooks">Day Books</a></div>
				   <div class="ui-state-default "><a href="#" id="cash_sales">Cash Sales</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="debtors">Debtors</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="pettyCash">Petty Cash</a></div>
				  
				    <div class="ui-state-default ">
				    <a href="#" id="companyBills">Company Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="insuranceBills">Insurance Bills</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="financePayments">Payments</a></div>
			</div>
			<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
 <?php }elseif ($group == "ambulance"){?>
	<h2><a href="#">Ambulance</a></h2>
  <div>Ambulance Services</div>
   <?php }elseif ($group == "estate"){?>
  <h2><a href="#">Estate Services</a></h2>
  <div>Estate Services</div>
   <?php }elseif ($group == "administrator"){?>
   <h2><a href="#">Reception</a></h2>
  
  	<div class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="registration">Registration</a></div>
    <div class="ui-state-default ">
    <a href="#" id="conFee">Consultation Fee</a></div>
    <div class="ui-state-default ">
    <a href="#" id="privateBills">Bill Payment</a></div>
	<div class="ui-state-default ">
    <a href="#" id="visits">Visits</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="search">Search</a></div>
    <div class="ui-state-default "><a href="#" id="cashDrawer">Cash Drawer</a></div>
	</div>
	<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>

	 <h2 class="remove" id="consultationLink"><a href="#">Consultation</a></h2>
  
  	<div class="remove" id="consultationDiv" class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="checkup">Nurse Examination</a></div>
  	<div class="ui-state-default ">
    <a href="#" id="diagnosis">Diagnosis</a></div>
    
	</div>
  	

  <h2><a href="#">Pharmacy</a></h2>
 <div class="ui-widget">
 				  <div class="ui-state-default ">
				    <a href="#" id="inputStoreDrugs">Input Store Drugs</a></div> 
				    <div class="ui-state-default ">
				    <a href="#" id="viewStoreDrugs">View Store Drugs</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="inputPhar">Input Phar. Drugs</a></div>
				     <div class="ui-state-default ">
				    <a href="#" id="viewPharDrugs">View Phar. Drugs</a></div>
				  
				  <div class="ui-state-default  ">
				    <a href="#" id="inputPhar">Input Drugs</a></div>
				  	<div class="ui-state-default ">
				    <a href="#" id="bookPhar">Request Drugs</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="pharSales">Daily Sales</a></div>
 		</div>
 		
  <h2><a href="#">Laboratory</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLab">Input Test</a></div>
				  <div class="ui-state-default  ">
				   <a href="#" id="RequestTest">Request Test</a></div>
				   <div class="ui-state-default  ">
				   <a href="#" id="labResults">Lab Test Results</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSales">Daily Sales</a></div>
 		</div>

<h2><a href="#">Labour</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="bioSocialData">BioSocial Data</a></div>
				  <div class="ui-state-default ">
				    <a href="#" id="obstericalHistory">Obsterical History</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="antenatalRecord">Antenatal Record</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labourTreatments">Treatments</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labourDelivery">Delivery</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="postpartumCare">Postpartum care</a></div>
				   <!--   <div class="ui-state-default ">
				    <a href="#" id="nurseLabour">View Patients Under Nurse</a></div>-->
			</div>

<h2><a href="#">Theater</a></h2>
  <div>Theater.</div>

<h2><a href="#">Finance</a></h2>
		<div class="ui-widget">
				<div class="ui-state-default  ">
				    <a href="#" id="monthlyExpense">Expense</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="dayBooks">Day Books</a></div>
				    <div class="ui-state-default "><a href="#" id="cash_sales">Cash Sales</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="debtors">Debtors</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="pettyCash">Petty Cash</a></div>
				  
				    <div class="ui-state-default ">
				    <a href="#" id="companyBills">Company Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="insuranceBills">Insurance Bills</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="financePayments">Payments</a></div>
			</div>

	<h2><a href="#">Ambulance</a></h2>
  <div>Ambulance Services</div>

  <h2><a href="#">Estate Services</a></h2>
  <div>Estate Services</div>
  <h2><a href="#"> Administration</a></h2>
	<div class="ui-widget">
	<div class="ui-state-default  ">
				    <a href="#" id="addUser">Add User</a></div>
		</div>
		
   
    <?php }?>
    
<?php 
}
?>