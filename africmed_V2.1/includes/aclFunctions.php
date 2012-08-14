<?php
require_once 'includes/connect.php';

/**
 * <b>This function fetches the category of the specified user from the mysql
 * database<b> 
* @param type $username
 * @return type
 */
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
    <div class="ui-state-default  ">
    <a href="#" id="search">Search</a></div>
    <div class="ui-state-default "><a href="#" id="cashDrawer">Cash Drawer</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="generalBooking">General Booking</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="pendingVisitors">In-Patient Visitors</a></div>
	</div>
	
<?php }elseif($group == "doctor"){?>
	 <h2 class="remove" id="consultationLink"><a href="#">Consultation</a></h2>
  
  	<div class="remove" id="consultationDiv" class="ui-widget">
 
  	<div class="ui-state-default ">
    <a href="#" id="diagnosis">Doctors Diagnosis</a></div>
    <div class="ui-state-default ">
    <a href="#" id="consultationViewRecords">View Records</a></div>
    
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
    <a href="#" id="consultationViewRecords">View Records</a></div>
    
	</div>
	
  	
 <?php }elseif ($group == "pharmacystore"){?>
  <h2><a href="#">Pharmacy</a></h2>
 <div class="ui-widget">
 				  <div class="ui-widget">
 				  <div class="ui-state-default  ">
					<a href="#" id="addPharPackaging">Pharmacy Packaging</a></div>
 				  <div class="ui-state-default "><a href="#" id="pharDrugTypes"> Drug Types</a></div>
				  <div class="ui-state-default "><a href="#" id="inputStoreDrugs"> Drugs Store</a></div>
				  <div class="ui-state-default "><a href="#" id="inputStoreDrugsTransact"> Drugs Store Transaction</a></div>
					<!--  <div class="ui-state-default  "><a href="#" id="inputPhar">Input Phar.Drugs</a></div> -->
					
				  
 </div>
 </div>
 		
 		 <?php }elseif ($group == "pharmacy"){?>
  <h2><a href="#">Pharmacy</a></h2>
 <div class="ui-widget">
 				  <div class="ui-widget">
 				 <div class="ui-state-default ">
				  <a href="#" id="bookPhar">Drugs Prescribe</a></div>
				   <div class="ui-state-default "><a href="#" id="sellDrugs">Sell Drugs</a></div>
				   <div class="ui-state-default "><a href="#" id="dispDrugsWard">Dispatch Drugs To ward</a></div>
				  <div class="ui-state-default "><a href="#" id="pharSales">Daily Transactions</a></div>
				  
 </div>
 </div>
 		
 		 <?php }elseif ($group == "laboratory"){?>
  <h2><a href="#">Laboratory</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLab">Test Types</a></div>
				    <div class="ui-state-default  ">
				    <a href="#" id="labStoreLink">Lab Store</a></div>
				     <div class="ui-state-default  ">
				    <a href="#" id="labStoreTransLink">Lab Store Transaction</a></div>
				  <div class="ui-state-default  ">
				   <a href="#" id="RequestTest">Test Patient</a></div>
				   <div class="ui-state-default  ">
				   <a href="#" id="labResults">Submit Test Results</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSales">Daily Sales</a></div>
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
				    <div class="ui-state-default ">
				    <a href="#" id="editsearchLabourRecords">Edit Labour Records</a></div>
			</div>
		
<?php }elseif ($group == "theater"){?>
<h2><a href="#">Theater</a></h2>
  <div class="ui-widget">
	<div class="ui-state-default">
		<a href="#" id="Theatre">Theatre</a>
	</div>
	<div class="ui-state-default">
		<a href="#" id="postTheatre">Post Theatre</a>
	</div>
</div>
 <?php }elseif ($group == "finance"){?>
<h2><a href="#">Finance</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="addCodes">Add Codes</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="Expense">Expenses</a></div>
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
				    <a href="#" id="viewPrivateBills">Private Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="financePrinting">Printing</a></div>
				    <div class="ui-state-default  ">
		<a href="#" id="pricing">Pricing</a></div>
		</div>
			<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>
 <?php }elseif ($group == "ambulance"){?>
	<h2><a href="#">Ambulance</a></h2>
  <div class="ui-widget">
	<div class="ui-state-default  ">
				    <a href="#" id="ambulanceMenu">Ambulance</a>
		</div>
		<div class="ui-state-default  ">
				    <a href="#" id="expambulance">Ambulance Expenses</a>
		</div>
</div>
   <?php }elseif ($group == "estate"){?>
  <h2><a href="#">Estate Services</a></h2>
  <div>Estate Services</div>
   <?php }elseif ($group == "dataentry"){?>
  <h2><a href="#">Data Entry</a></h2>
	 <div class="ui-widget">
		<div class="ui-state-default  ">
   		 <a href="#" id="registration">Registration</a></div>
		<div class="ui-state-default  ">
   		 <a href="#" id="checkup">Nurse Examination</a></div>
		<div class="ui-state-default  ">
		<a href="#" id="patientInfoMenu">Get patient Info</a></div>
		<div class="ui-state-default  ">
		<a href="#" id="entryRecords">Entry Records</a></div>
	</div>
   <?php }elseif ($group == "administrator"){?>
   <h2><a href="#">Reception</a></h2>
  
  	<div class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="registration">Registration</a></div>
    <div class="ui-state-default ">
    <a href="#" id="conFee">Consultation Fee</a></div>
    <div class="ui-state-default ">
    <a href="#" id="privateBills">Bill Payment</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="search">Search</a></div>
    <div class="ui-state-default "><a href="#" id="cashDrawer">Cash Drawer</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="generalBooking">Extra Charges</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="pendingVisitors">In-Patient Visitors</a></div>
	</div>
	<h2><a href="#"> Patient Info</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="patientInfoMenu">Get patient Info</a></div>
		</div>

	 <h2 class="remove" id="consultationLink"><a href="#">Consultation</a></h2>
  
  	<div class="remove" id="consultationDiv" class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="checkup">Vital Signs</a></div>
  	<div class="ui-state-default ">
    <a href="#" id="diagnosis">Doctors Examination</a></div>
    <div class="ui-state-default ">
    <a href="#" id="consultationViewRecords">View Records</a></div>
    
	</div>
  	

  <h2><a href="#">Pharmacy</a></h2>
 <div class="ui-widget">
 				 <div class="ui-widget">
 				 <div class="ui-state-default  ">
					<div class="ui-state-default ">
				  <a href="#" id="bookPhar">Drugs Prescribe</a></div>
				   <div class="ui-state-default "><a href="#" id="sellDrugs">Sell Drugs</a></div>
				   <div class="ui-state-default "><a href="#" id="dispDrugsWard">Dispatch Drugs To ward</a></div>
				  <div class="ui-state-default "><a href="#" id="pharSales">Daily Transactions</a></div>
				  <!--  <div class="ui-state-default "><a href="#" id="inputStoreDrugsTransact"> Drugs Store Transaction</a></div>   -->
				  
 </div>
 		</div>
 
</div>

  <h2><a href="#">Pharmacy Store</a></h2>
 <div class="ui-widget">
 				 <div class="ui-widget">
 				 <div class="ui-state-default  ">
				<a href="#" id="addPharPackaging">Pharmacy Packaging</a></div>
 				  <div class="ui-state-default "><a href="#" id="pharDrugTypes"> Drug Types</a></div>
				  <div class="ui-state-default "><a href="#" id="inputStoreDrugs"> Drugs Store</a></div>
				  <div class="ui-state-default "><a href="#" id="inputStoreDrugsTransact"> Drugs Store Transaction</a></div>
					
				  
 </div>
 		</div>
 		
  <h2><a href="#">Laboratory</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLab">Test Types</a></div>
				    <div class="ui-state-default  ">
				    <a href="#" id="labStoreLink">Lab Store</a></div>
				     <div class="ui-state-default  ">
				    <a href="#" id="labStoreTransLink">Lab Store Transaction</a></div>
				  <div class="ui-state-default  ">
				   <a href="#" id="RequestTest">Test Patient</a></div>
				   <div class="ui-state-default  ">
				   <a href="#" id="labResults">Submit Test Results</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSales">Daily Sales</a></div>
 		</div>
 		 <h2><a href="#">Radiology</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLabR">Radiology: Test Types</a></div>
				    <div class="ui-state-default  ">
				    <a href="#" id="labStoreLinkR">Radiology  Store</a></div>
				  <div class="ui-state-default  ">
				   <a href="#" id="RequestTestR">Radiology:Test Patient</a></div>
				   <div class="ui-state-default  ">
				   <a href="#" id="labResultsR">Radiology:Submit Test Results</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSalesR">Radiology:Daily Sales</a></div>
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
				    <div class="ui-state-default ">
				    <a href="#" id="editsearchLabourRecords">Edit Labour Records</a></div>
			</div>

<h2><a href="#">Theatre</a></h2>
  <div class="ui-widget">
   <div class="ui-state-default">
		<a href="#" id="Theatre">Theatre</a>
	</div>
	<div class="ui-state-default">
		<a href="#" id="postTheatre">Post Theatre</a>
	</div>
  </div>

<h2><a href="#">Finance</a></h2>
		<div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="addCodes">Add Codes</a></div>
				    <div class="ui-state-default  ">
				    <a href="#" id="addProducts">Add Products</a></div>
				    <div class="ui-state-default  ">
				    <a href="#" id="addAccounts">Accounts</a></div>
				     <div class="ui-state-default  ">
				    <a href="#" id="addIncome">Income</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="Expense">Expenses</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="dayBooks">Day Books</a></div>
				    <div class="ui-state-default "><a href="#" id="cash_sales">Cash Sales</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSalesFinance">Daily Lab Sales</a></div>
				    <div class="ui-state-default "><a href="#" id="pharSalesFinance">Daily Pharmacy Transactions</a></div>
				     <div class="ui-state-default "><a href="#" id="extraChargesSalesFinance">Daily Extra Charges Sales</a></div>
				<div class="ui-state-default  ">
				    <a href="#" id="debtors">Debtors</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="pettyCash">Petty Cash</a></div>
				  
				    <div class="ui-state-default ">
				    <a href="#" id="companyBills">Company Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="insuranceBills">Insurance Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="viewPrivateBills">Private Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="financePrinting">Printing</a></div>
				    <div class="ui-state-default  ">
		<a href="#" id="pricing">Pricing</a></div>
		</div>
<h2><a href="#">Appointments</a></h2>
		<div class="ui-widget">
				
				  <div class="ui-state-default  ">
				    <a href="#" id="scheduleAppointment">Appointments</a>
				  </div>
				  <div class="ui-state-default  ">
				    <a href="#" id="viewAppointment">View Appointments</a>
				  </div>			  
		</div>
  <h2><a href="#">Ambulance</a></h2>
  <div class="ui-widget">
		<div class="ui-state-default  ">
				    <a href="#" id="ambulanceMenu">Ambulance</a>
		</div>
		<div class="ui-state-default  ">
				    <a href="#" id="expambulance">Ambulance Expenses</a>
		</div>
	</div>

 
  <h2><a href="#"> Administration</a></h2>
	<div class="ui-widget">
		<div class="ui-state-default  ">
			<a href="#" id="addUser">Add User</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="addEmployer">Add Company</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="addInsurance">Add Insurance</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="addConsultFees">Add Con. Fees</a>
		</div>
		<div class="ui-state-default  ">
		<a href="#" id="entryRecords">Entry Records</a></div>
		<div class="ui-state-default  ">
		<a href="#" id="createBackup">Create Backup</a></div>
		
		
	</div>
	<h2><a href="#">Generator/Solar</a></h2>
	<div class="ui-widget">
  		<div class="ui-state-default  ">
					<a href="#" id="generatorMenu">Generator & Solar</a>
		</div>
		<div class="ui-state-default  ">
					<a href="#" id="expgenerator"> Generator/Solar Expenses</a>
		</div>
	</div>
  <h2><a href="#">Sterilization</a></h2>
  <div class="ui-widget">
		<div class="ui-state-default  ">
			<a href="#" id="addSterilization">Add Sterilzation</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="addSterilMaint"> Steril.. Maintenance</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="viewSteril"> View Sterilization</a>
		</div>
	</div>
  <h2><a href="#"> Laundry</a></h2>
	<div class="ui-widget">
		<div class="ui-state-default  ">
			<a href="#" id="addLaundry">Add Laundry</a>
		</div>
		<div class="ui-state-default  ">
			<a href="#" id="viewLaundry">View Laundry</a>
		</div>
	</div>
 <h2><a href="#">Maintainance</a></h2>
  <div>Maintainance Services</div>
   <h2><a href="#">Estate Services</a></h2>
  <div>Estate Services</div>
  <h2><a href="#">Miscellaneous</a></h2>
  <div>Miscellaneous Services</div>
		
   
    <?php }?>
    
<?php 
}
?>