<?php require_once("includes/session.php"); ?>
<?php require_once 'includes/connect.php';?>
<?php require_once("includes/receptionFunctions.php"); ?>
<?php require_once 'includes/aclFunctions.php';?>
<?php confirm_logged_in(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>AfricMed | Modern Record System Application</title>


<link type="text/css"
	href="js/jqueryui/css/dark-hive.new2/jquery-ui-1.8.20.custom.css"
	rel="stylesheet" />
<link type="text/css" href="css/validationEngine.jquery.css"
	rel="stylesheet" />
<link rel="stylesheet" href="css/formly.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.liveSearch.css" type="text/css" />
<link rel="stylesheet" href="jquery.jqGrid-3.8.2/css/ui.jqgrid.css" type="text/css" />



<script type="text/javascript" src="js/jquery-1.5.2.js"></script>
<script type="text/javascript"
	src="js/jqueryui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="js/ui.tabs.closable.min.js"></script>
<script type="text/javascript"
	src="js/jqueryui/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript"
	src="js/jqueryui/development-bundle/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="js/jquery.layout-latest.js"></script>
<script type="text/javascript"
	src="js/jqueryui/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="DataTables/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="jquery.dataTables.editable.1.3/jquery.dataTables.editable.js"></script>
<script type="text/javascript" src="jquery.dataTables.editable.1.3/jquery.jeditable.js"></script>
<script type="text/javascript" src="DataTables-TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" src="DataTables-TableTools/media/js/ZeroClipboard.js"></script>




	
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.colorize-2.0.0.js"></script>
<script type="text/javascript" src="js/formly.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery.collapsible-v.2.1.3.js"></script>
<script type="text/javascript" src="js/jquery.liveSearch.js"></script>
<script type="text/javascript" src="jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="jquery.jqGrid-3.8.2/js/i18n/grid.locale-en.js"></script>
<script type="text/javascript" src="jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js"></script>




<style type="text/css">
#myAccordion .ui-accordion-content {
	padding: 6 0 15 15;
}

label { color:white;font-size:12px;}
span { color:white;}
.editLinks {color:red;}

.DataTables_sort_wrapper {
	font-size:14px;
	}

.header {
	background: url('images/bg-body.gif') top left repeat-x;
}
.inputStyle {border: 3px solid #00FF00;font-size:12px;}

.errorStyle { color: red}

.tdStrip { backgroud: yellow }



</style>
<script>
    $(document).ready(function () {

    	
    $('body').layout({ applyDefaultStyles: true });
	$("#myAccordion").accordion({
		autoHeight: true,
		animated: "bounceslide"
	});

	
	$("#successMessage").dialog({ autoOpen:false,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
	$("#errorMessage").dialog({ autoOpen:false,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
	$("#queueDialog").dialog({ autoOpen:false,minWidth: 600,modal:true ,buttons: { "Close": function() { $(this).dialog("close"); } } });
	 $("#pnumberError").dialog({ autoOpen:false,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
	 $("#changePasswordDiv").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close");$('form').validationEngine('hideAll'); } } });
	 $("#dispatchDialog").dialog({ autoOpen:false,width:600,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });
	 $("#fuelDialog").dialog({ autoOpen:false,width:600,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });
	 $("#maintenanceDialog").dialog({ autoOpen:false,width:600,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });

	
	   
	var mainTab = $("#contentTab").tabs({closable: true,spinner: 'Loading...'});
	
		//$(".remove").remove();
		$("#logout").button();
		$("#chagngePassword").button();
		
		//$('#changePasswordForm').formly({'onBlur':false, 'theme':'Dark'});
		$("#chagngePassword").click(function(){
			$("#changePasswordDiv").dialog('open');
		});
/*
		$('#changePasswordForm').ajaxForm({
			//target:"#content",
			beforeSubmit: ,
			
			success:function(response) { 
				//alert(response);
					 if(response == "Sucess"){
						
					$("#successMessage").html("<p>Password Successfully Changed  </p>").dialog('open');
					 $('#changePasswordForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
		
		*/

	
	function tabNameExists(name){
		returnVal = false;
		$('#contentTab ul li a').each(function(i) {
				if (this.text == name) {
					returnVal = true;
				}
		});
		return returnVal;
	}

	function getTabName(name){
		inc = 0;
		returnVal = 0;
		$('#contentTab ul li a').each(function(i) {
			
				if (this.text == name) {
					//alert(returnVal);	
					inc =  returnVal;	
				}
				returnVal++;
		});
		return inc;
				
	}
	/*
	$("div#myAccordion div.ui-widget a").click(function(){
		alert($(this).attr('id'));	
	});
	*/
	$("#checkup").click(function(){
	 
		if(!tabNameExists("Examination")){
			//code to insert new tab here
			mainTab.tabs('add','consultation.php','Examination');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{
			
			var index = getTabName("Examination");
			//alert(index);
			mainTab.tabs('select', index);
						
		}
	    //======
	});
$("#cashDrawer").click(function(){
	if(!tabNameExists("Cash Drawer")){
		mainTab.tabs('add','cashDrawer.php','Cash Drawer');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Cash Drawer");
		//alert(index);
		mainTab.tabs('select', index);
					
	}
	});

	$("#addEmployer").click(function(){
		 
		if(!tabNameExists("Add Company")){
			mainTab.tabs('add','addEmployer.php','Add Company');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Add Company");
			mainTab.tabs('select', index);				
		}
	
	});
	
	$("#entryRecords").click(function(){
		 
		if(!tabNameExists("Show Entry Records")){
			mainTab.tabs('add','dataEntry.php','Show Entry Records');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Show Entry Records");
			mainTab.tabs('select', index);				
		}
	
	});
	$("#addLaundry").click(function(){
		 
		if(!tabNameExists("Add Laundry")){
			mainTab.tabs('add','addLaundry.php','Add Laundry');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Add Laundry");
			mainTab.tabs('select', index);				
		}
	
	});

	$("#viewLaundry").click(function(){
		 
		if(!tabNameExists("View Laundry")){
			mainTab.tabs('add','viewLaundry.php','View Laundry');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("View Laundry");
			mainTab.tabs('select', index);				
		}
	
	});
	
	$("#Theatre").click(function(){
		 
		if(!tabNameExists("Theatre")){
			mainTab.tabs('add','theatre.php','Theatre');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Theatre");
			mainTab.tabs('select', index);				
		}
	});
	
	$("#postTheatre").click(function(){
		 
		if(!tabNameExists("Post Theatre")){
			mainTab.tabs('add','postTheatre.php','Post Theatre');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Post Theatre");
			mainTab.tabs('select', index);			
		}
	});

	$("#generatorMenu").click(function(){
		 
		if(!tabNameExists("Generator")){
			mainTab.tabs('add','addGenerator.php','Generator');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Generator");
			mainTab.tabs('select', index);				
		}
	
	});
	$("#expgenerator").click(function(){
		 
		if(!tabNameExists("Expenses On Generator")){
			mainTab.tabs('add','expGenerator.php','Expenses On Generator');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Expenses On Generator");
			mainTab.tabs('select', index);				
		}
	
	});
	
	$("#ambulanceMenu").click(function(){
		 
		if(!tabNameExists("Ambulance")){
			mainTab.tabs('add','addAmbulance.php','Ambulance');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Ambulance");
			mainTab.tabs('select', index);				
		}
	
	});
	$("#expambulance").click(function(){
		 
		if(!tabNameExists("Expesnes On Ambulance")){
			mainTab.tabs('add','expAmbulance.php','Expesnes On Ambulance');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Expesnes On Ambulance");
			mainTab.tabs('select', index);				
		}
	
	});
	
	$("#addConsultFees").click(function(){
		 
		if(!tabNameExists("Add Consultation Fees")){
			mainTab.tabs('add','addConFee.php','Add Consultation Fees');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Add Consultation Fees");
			mainTab.tabs('select', index);				
		}
	
	});

	$("#addInsurance").click(function(){
		 
		if(!tabNameExists("Add Insurance")){
			mainTab.tabs('add','addInsurance.php','Add Insurance');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Add Insurance");
			mainTab.tabs('select', index);				
		}
	
	});
	
	$("#addUser").click(function(){
		 
		if(!tabNameExists("Add User")){
			mainTab.tabs('add','adduser.php','Add User');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{	
			var index = getTabName("Add User");
			mainTab.tabs('select', index);				
		}
	
	});

	$("#showUser").click(function(){
		 
		if(!tabNameExists("Show User")){
			mainTab.tabs('add','showuser.php','Show User');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{		
			var index = getTabName("Show User");
			mainTab.tabs('select', index);						
		}	   
	});
	
	
		$("#registration").click(function(){
			if(!tabNameExists("Registration")){
			mainTab.tabs('add','registration.php','Registration');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("Registration");
				mainTab.tabs('select', index);

			}
		});

		$("#pendingVisitors").click(function(){
			if(!tabNameExists("In-Patient Visitors")){
			mainTab.tabs('add','pendingVisitors.php','In-Patient Visitors');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("In-Patient Visitors");
				mainTab.tabs('select', index);

			}
		});
		
	$("#conFee").click(function(){
		if(!tabNameExists("Consultation Fee")){
		mainTab.tabs('add','conFee.php','Consultation Fee');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Consultation Fee");
			mainTab.tabs('select', index);
		}
	});

	$("#financePrinting").click(function(){
		if(!tabNameExists("Printing")){
		mainTab.tabs('add','finance_print.php','Printing');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Printing");
			mainTab.tabs('select', index);
		}
	});
	

	$("#addSterilization").click(function(){
		if(!tabNameExists("Add Sterilzation")){
		mainTab.tabs('add','sterilization.php','Add Sterilzation');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Add Sterilzation");
			mainTab.tabs('select', index);
		}
	});
	$("#viewSteril").click(function(){
		if(!tabNameExists("View Sterilzation")){
		mainTab.tabs('add','view_sterilization.php','View Sterilzation');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("View Sterilzation");
			mainTab.tabs('select', index);
		}
	});
	
	$("#addSterilMaint").click(function(){
		if(!tabNameExists("Sterilization Maintenance")){
		mainTab.tabs('add','sterilization_maintenance.php','Sterilization Maintenance');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Sterilization Maintenance");
			mainTab.tabs('select', index);
		}
	});
	
	
	$("#visits").click(function(){
		if(!tabNameExists("Visits")){
	mainTab.tabs('add','visits.php','Visits');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Visits");
			mainTab.tabs('select', index);
		}
	});

	$("#labResults").click(function(){
		if(!tabNameExists("Submit Test Results")){
		mainTab.tabs('add','labResults.php','Submit Test Results');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Submit Test Results");
			mainTab.tabs('select', index);
		}
	});
	$("#labResultsR").click(function(){
		if(!tabNameExists("Radiology:Submit Test Results")){
		mainTab.tabs('add','labResultsR.php','Radiology:Submit Test Results');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Radiology:Submit Test Results");
			mainTab.tabs('select', index);
		}
	});
	

	$("#RequestTest").click(function(){
		if(!tabNameExists("Test Patient")){
		mainTab.tabs('add','bookLab.php','Test Patient');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Test Patient");
			mainTab.tabs('select', index);
		}
	});

	$("#RequestTestR").click(function(){
		if(!tabNameExists("Radiology:Test Patient")){
		mainTab.tabs('add','bookLabR.php','Radiology:Test Patient');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Radiology:Test Patient");
			mainTab.tabs('select', index);
		}
	});
	
	$("#cash_sales").click(function(){
		if(!tabNameExists("Cash Sales Transaction")){
		mainTab.tabs('add','shiftCashSales.php','Cash Sales Transaction');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Cash Sales Transaction");
			mainTab.tabs('select', index);
		}
	});
	$("#privateBills").click(function(){
		if(!tabNameExists("Pay Bills")){
		mainTab.tabs('add','privateBills2.php','Pay Bills');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Pay Bills");
			mainTab.tabs('select', index);
		}
	});

	$("#addPharPackaging").click(function(){
		if(!tabNameExists("Pharmacy Packaging")){
		mainTab.tabs('add','pharpackage.php','Pharmacy Packaging');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Pharmacy Packaging");
			mainTab.tabs('select', index);
		}
	});

	

	$("#consultationViewRecords").click(function(){
		if(!tabNameExists("View Consul Records")){
		mainTab.tabs('add','viewConsultationRecords.php','View Consul Records');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("View Consul Records");
			mainTab.tabs('select', index);
		}
	});
	$("#editsearchLabourRecords").click(function(){
		if(!tabNameExists("Edit Labour Records")){
		mainTab.tabs('add','editLabour.php','Edit Labour Records');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Edit Labour Records");
			mainTab.tabs('select', index);
		}
	});
	
	$("#search").click(function(){
		if(!tabNameExists("Search")){
		mainTab.tabs('add','searchGen.php','Search');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Search");
			mainTab.tabs('select', index);
		}
		});
	$("#generalBooking").click(function(){
		if(!tabNameExists("Extra Charges")){
		mainTab.tabs('add','generalBooking.php','Extra Charges');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Extra Charges");
			mainTab.tabs('select', index);
		}
	});
	
	$("#diagnosis").click(function(){
		if(!tabNameExists("Diagnosis")){
		mainTab.tabs('add','diagnosis.php','Diagnosis');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Diagnosis");
			mainTab.tabs('select', index);
		}
	});
	
		
			$("#inputStoreDrugs").click(function(){
				if(!tabNameExists("Drugs Store")){
			mainTab.tabs('add','inputStoreDrugs.php','Drugs Store');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Drugs Store");
					mainTab.tabs('select', index);
				}
		});
			$("#inputStoreDrugsTransact").click(function(){
				if(!tabNameExists("Drugs Store Transactions")){
			mainTab.tabs('add','pharStoreTrans.php','Drugs Store Transactions');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Drugs Store Transactions");
					mainTab.tabs('select', index);
				}
		});

			$("#pricing").click(function(){
				if(!tabNameExists("Pricing")){
			mainTab.tabs('add','pricing.php','Pricing');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Pricing");
					mainTab.tabs('select', index);
				}
		});
			

			$("#pharDrugTypes").click(function(){
				if(!tabNameExists("Drug Types")){
			mainTab.tabs('add','drugTypes.php','Drug Types');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Drug Types");
					mainTab.tabs('select', index);
				}
		});
			$("#addCodes").click(function(){
				if(!tabNameExists("Add Codes")){
			mainTab.tabs('add','addCodes.php','Add Codes');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Add Codes");
					mainTab.tabs('select', index);
				}
		});
			$("#addProducts").click(function(){
				if(!tabNameExists("Add Products")){
			mainTab.tabs('add','addProducts.php','Add Products');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Add Products");
					mainTab.tabs('select', index);
				}
		});

			

			$("#addAccounts").click(function(){
				if(!tabNameExists("Accounts")){
			mainTab.tabs('add','addAccounts.php','Accounts');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Accounts");
					mainTab.tabs('select', index);
				}
		});

			$("#addIncome").click(function(){
				if(!tabNameExists("Income")){
			mainTab.tabs('add','addIncome.php','Income');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Income");
					mainTab.tabs('select', index);
				}
			});
			
			
			
		
		$("#viewStoreDrugs").click(function(){
			if(!tabNameExists("View Store Drugs")){
			mainTab.tabs('add','viewStoreStock.php','View Store Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("View Store Drugs");
				mainTab.tabs('select', index);
			}
		});
		
		$("#inputPhar").click(function(){
			if(!tabNameExists("Input Pharmacy Drugs")){
			mainTab.tabs('add','inputPhar.php','Input Pharmacy Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("Input Pharmacy Drugs");
				mainTab.tabs('select', index);
			}
		});
		
		$("#viewPharDrugs").click(function(){
			if(!tabNameExists("View Pharmacy Drugs")){
			mainTab.tabs('add','viewPhar.php','View Pharmacy Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("View Pharmacy Drugs");
				mainTab.tabs('select', index);
			}
		});
	
		
		//END FFROM JARRA
	$("#bookPhar").click(function(){
		if(!tabNameExists("Drugs Prescribe")){
		mainTab.tabs('add','bookPhar.php','Drugs Prescribe');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Drugs Prescribe");
			mainTab.tabs('select', index);
		}
		});

	$("#pharSales").click(function(){
		if(!tabNameExists("Daily Pharmacy Sales")){
		mainTab.tabs('add','pharSales.php','Daily Pharmacy Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Daily Pharmacy Sales");
			mainTab.tabs('select', index);
		}
		});

	$("#extraChargesSalesFinance").click(function(){
		if(!tabNameExists("Daily Extra Charges Sales")){
		mainTab.tabs('add','extraChargeSales.php','Daily Extra Charges Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Daily Extra Charges Sales");
			mainTab.tabs('select', index);
		}
		});

	

	$("#pharSalesFinance").click(function(){
		if(!tabNameExists("Daily Pharmacy Sales")){
		mainTab.tabs('add','pharSales.php','Daily Pharmacy Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Daily Pharmacy Sales");
			mainTab.tabs('select', index);
		}
		});

	

	$("#dispDrugsWard").click(function(){
		if(!tabNameExists("Dispatch Drugs To ward")){
		mainTab.tabs('add','dispatchtoward.php','Dispatch Drugs To ward');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Dispatch Drugs To ward");
			mainTab.tabs('select', index);
		}
		});

	

	$("#sellDrugs").click(function(){
		if(!tabNameExists("Sell Drugs")){
		mainTab.tabs('add','selldrugs.php','Sell Drugs');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Sell Drugs");
			mainTab.tabs('select', index);
		}
		});

	
	$("#inputLab").click(function(){
		if(!tabNameExists("Test Types")){
		mainTab.tabs('add','testTypes.php','Test Types');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Test Types");
			mainTab.tabs('select', index);
		}
		});
	$("#inputLabR").click(function(){
		if(!tabNameExists("Radiology: Test Types")){
		mainTab.tabs('add','testTypesR.php','Radiology: Test Types');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Radiology: Test Types");
			mainTab.tabs('select', index);
		}
		});

	$("#labStoreLink").click(function(){
		if(!tabNameExists("Lab Store")){
		mainTab.tabs('add','labStore.php','Lab Store');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Lab Store");
			mainTab.tabs('select', index);
		}
		});
	$("#labStoreTransLink").click(function(){
		if(!tabNameExists("Lab Store Transaction")){
		mainTab.tabs('add','labStoreTrans.php','Lab Store Transaction');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Lab Store Transaction");
			mainTab.tabs('select', index);
		}
		});
	
	$("#labStoreLinkR").click(function(){
		if(!tabNameExists("Radiology  Store")){
		mainTab.tabs('add','labStoreR.php','Radiology  Store');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Radiology  Store");
			mainTab.tabs('select', index);
		}
		});
	
	
	$("#bookLab").click(function(){
		if(!tabNameExists("Lab Bookings")){
		mainTab.tabs('add','bookLab.php','Lab Bookings');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Lab Bookings");
			mainTab.tabs('select', index);
		}
		});
	$("#labSales").click(function(){
		if(!tabNameExists("Daily Lab Sales")){
		mainTab.tabs('add','labSales.php','Daily Lab Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Daily Lab Sales");
			mainTab.tabs('select', index);
		}
		});

	$("#labSalesFinance").click(function(){
		if(!tabNameExists("Daily Lab Sales")){
		mainTab.tabs('add','labSales.php','Daily Lab Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Daily Lab Sales");
			mainTab.tabs('select', index);
		}
		});
	$("#labSalesR").click(function(){
		if(!tabNameExists("Radiology:Daily Sales")){
		mainTab.tabs('add','labSalesR.php','Radiology:Daily Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Radiology:Daily Sales");
			mainTab.tabs('select', index);
		}
		});
	
	$("#bioSocialData").click(function(){
		if(!tabNameExists("BioSocial Data")){
		mainTab.tabs('add','bioSocialData.php','BioSocial Data');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("BioSocial Data");
			mainTab.tabs('select', index);
		}
		});

	$("#patientInfoMenu").click(function(){
		if(!tabNameExists("Patient Info")){
		mainTab.tabs('add','patientInfo.php','Patient Info');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Patient Info");
			mainTab.tabs('select', index);
		}
		});
	
	$("#obstericalHistory").click(function(){
		if(!tabNameExists("Obsterical History")){
		mainTab.tabs('add','obstericalHistory.php','Obsterical History');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Obsterical History");
			mainTab.tabs('select', index);
		}
		});
	$("#antenatalRecord").click(function(){
		if(!tabNameExists("Antenatal Record")){
		mainTab.tabs('add','antenatalRecord.php','Antenatal Record');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Antenatal Record");
			mainTab.tabs('select', index);
		}
		});
	$("#labourTreatments").click(function(){
		if(!tabNameExists("Labour Treatments")){
		mainTab.tabs('add','labourTreatments.php','Labour Treatments');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Labour Treatments");
			mainTab.tabs('select', index);
		}
		});
	$("#labourDelivery").click(function(){
		if(!tabNameExists("Delivery")){
		mainTab.tabs('add','labourDelivery.php','Delivery');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Delivery");
			mainTab.tabs('select', index);
		}
		});
	$("#postpartumCare").click(function(){
		if(!tabNameExists("Postpartum Care")){
		mainTab.tabs('add','postpartumCare.php','Postpartum Care');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Postpartum Care");
			mainTab.tabs('select', index);
		}
		});
	
$("#pettyCash").click(function(){
	if(!tabNameExists("Petty Cash")){
		mainTab.tabs('add','pettyCash.php','Petty Cash');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Petty Cash");
		mainTab.tabs('select', index);
	}
		});

$("#createBackup").click(function(){
	if(!tabNameExists("Create Backup")){
		mainTab.tabs('add','backup.php','Create Backup');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Create Backup");
		mainTab.tabs('select', index);
	}
		});


$("#transaction").click(function(){
	if(!tabNameExists("Financial Transaction")){
	mainTab.tabs('add','nurseLabour.php','Financial Transaction');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Financial Transaction");
		mainTab.tabs('select', index);
	}
	});
$("#companyBills").click(function(){
	if(!tabNameExists("Company Bills")){
	mainTab.tabs('add','companyBills.php','Company Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Company Bills");
		mainTab.tabs('select', index);

	}
});
$("#debtors").click(function(){
	if(!tabNameExists("Outstanding Debtors")){
	mainTab.tabs('add','debtors.php','Outstanding Debtors');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Outstanding Debtors");
		mainTab.tabs('select', index);
	}
});
$("#Expense").click(function(){
	if(!tabNameExists("Expenses")){
	mainTab.tabs('add','monthlyExpense.php','Expenses');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Expenses");
		mainTab.tabs('select', index);
	}
});
$("#dayBooks").click(function(){
	if(!tabNameExists("Day Books: Customer Receipt")){
	mainTab.tabs('add','dayBooks.php','Day Books: Customer Receipt');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Day Books: Customer Receipt");
		mainTab.tabs('select', index);
	}
});
$("#insuranceBills").click(function(){
	if(!tabNameExists("Insurance Bills")){
	mainTab.tabs('add','insuranceBills.php','Insurance Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Insurance Bills");
		mainTab.tabs('select', index);
	}
	});

$("#viewPrivateBills").click(function(){
	if(!tabNameExists("Private Bills")){
	mainTab.tabs('add','viewPrivateBills.php','Private Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Private Bills");
		mainTab.tabs('select', index);
	}
	});


$("#financePayments").click(function(){
	if(!tabNameExists("Payments")){
	mainTab.tabs('add','financePayments.php','Payments');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Payments");
		mainTab.tabs('select', index);
	}
	});
	
$("#scheduleAppointment").click(function(){
	if(!tabNameExists("Appointments")){
	mainTab.tabs('add','schedule.php','Appointments');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Appointments");
		mainTab.tabs('select', index);
	}
	});

$("#viewAppointment").click(function(){
	if(!tabNameExists("View Appointments")){
	mainTab.tabs('add','view_schedule.php','View Appointments');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("View Appointments");
		mainTab.tabs('select', index);
	}
	});

$("#changePassSubmit").button();



function validateChangePw(){
	$('#changePasswordForm').validate({
		
			'rules':{
				
				'oldpassword': 'required',
				'newpassword': {
					required: true,
					minlength: 5
				},
				'retypenewpassword': {
					required: true,
					minlength: 5,
					equalTo: "#retypenewpassword"
				}
			},
			messages: {
				
				oldpassword: "<i style='color:red;'>Old Password is Required<i>",
					
				newpassword: {
					required: "<i style='color:red;'>Please Provide the New Password<i>",
					minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>"
				},
				retypenewpassword: {
					required: "<i style='color:red;'>Please Provide the Old Password<i>",
					minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>",
					equalTo: "<i style='color:red;'>Password Mismatch<i>"
				}
			},
						
			invalidHandler: function(form, validator) {
			      var errors = validator.numberOfInvalids();
			      //alert(errors);
			      if(errors){
			    	 // $("#errorMessage").html("<p>Please Fill All Required Fields!</p>").dialog('open');
				    return false;
			      }else{
				      return true;
			      }
			}
	});
}

$('#changePasswordForm').ajaxForm({
	//target:"#content",
	beforeSubmit:validateChangePw() ,
	
	success:function(response) { 
		
		var res = parseInt(response);
		
			 if(res==0){				
			$("#successMessage").html("<p>Successfully Change Password </p>").dialog('open');
			 $('#changePasswordForm').resetForm();
			 }else if (res==1){
				 $("#errorMessage").html("<p>Invalid Password </p>").dialog('open');
			 }
   		 }
});
 });
</script>

</head>


<body>
<div style="display: none" id="confirmationPromptDialog" title="Confirm">
	<p>	Are You Sure You want to Continue </p>

</div>
<div style="display: none" id="confirmPromptDialog" title="Confirm">
	<p>This Patient Does Not Pay Consulation Fee.<br>
	Are You Sure You want to Continue</p>

</div>
<div style="display: none" id="dispatchDialog" title="Ambulance Dispatch">


</div>
<div style="display: none" id="fuelDialog" title="Add Fuel">


</div>
<div style="display: none" id="maintenanceDialog" title="Maintenance">


</div>

<div style="display: none" id="changePasswordDiv"
	title="Change Password">
<form id="changePasswordForm" action="changepassword.php" method="post">
<input type="hidden" id="changepasswordUsername"
	name="changepasswordUsername"
	value="<?php echo $_SESSION['username']; ?>" />
<table>
	<tr>
		<td><label>Old Password</label></td>
		<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="password"  size="20" type="text"
			id="oldpassword" name="oldpassword" /></td>
	</tr>
	<tr>
		<td><label>New Password</label></td>
		<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="password" size="20" type="text"
			id="newpassword" name="newpassword" /></td>
	</tr>
	<tr>
		<td><label>Retype Password</label></td>
		<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="password" size="20" type="text"
			id="retypenewpassword" name="retypenewpassword" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input size="10" type="submit" id="changePassSubmit"
			name="changePassSubmit" value="Change Password" /></td>

</table>
</form>
</div>

<div id="username"><?php echo $_SESSION['username'];?></div>
<div style="display: none" id="queueDialog" title="Patient Queue">
<table  width="500" border="0" class="ui-widget ui-widget-content">
	<thead>
		<tr style="white-space: nowrap;" class="ui-widget-header ">
			<th>Patient Number</th>
			<th>Name</th>
			<th>Address</th>
			<th>Telephone</th>
			<th>Arrival Time</th>


		</tr>
	</thead>
	<tbody id="queueDialogContent">

	</tbody>
</table>
</div>

<div style="display: none" id="successMessage" title="Success">
<p>Succesfully Saved</p>

</div>

<div style="display: none" id="errorMessage" title="Error"></div>

<div class="ui-layout-center">

<div class="ui-widget">

<div class="ui-widget-content ui-corner-bottom">
<div style="font-size: 12;" id="contentTab">
<ul>
	<li><a href="#a">Main</a></li>

</ul>
<div id="a" style="background-image: url('images/africmed_logo.png');height:900px;"></br>
</div>

</div>

</div>
</div>


</div>
<div class="ui-layout-north">
<div class="ui-widget">
<div class="header"><img id="logo" height="50px"
	src="images/africmed_log.jpg" alt="logo" />
<div	style="font-style: italic; float: right; font-size: 11px; color: aqua;">
<table>
<tr style="font-style: italic; float: right; font-size: 11px; color: aqua;">
<td style="font-size: 15;">
Welcome
<?php echo ucfirst($_SESSION['firstname'])." ". ucfirst($_SESSION['lastname']);?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><a
	id="chagngePassword"
	style="font-style: normal; font-size: 11px; color: aqua;" href="#">Change
Password </a>&nbsp&nbsp&nbsp&nbsp</td><td><a id="logout"
	style="font-style: normal; font-size: 11px; color: aqua;"
	href="logout.php">Logout </a> </td>
	
	</tr>
	</table>
	</div>
</div>


</div>
</div>
<div class="ui-layout-west">

<div class="ui-widget">

<div class="ui-widget-content ui-corner-bottom">

<div style="font-size: 11;" id="myAccordion"><?php getNavLink($_SESSION['group']);?></div>



</div>


</div>

</body>
</html>



