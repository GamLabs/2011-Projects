
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>AfricMed | Modern Record System Application</title>


<link type="text/css"
	href="js/jqueryui/css/dark-hive/jquery-ui-1.8.11.custom.css"
	rel="stylesheet" />
<link type="text/css" href="css/validationEngine.jquery.css"
	rel="stylesheet" />

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
<script type="text/javascript"
	src="js/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.colorize-2.0.0.js"></script>


<style type="text/css">
#myAccordion .ui-accordion-content {
	padding: 6 0 15 15;
}
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
	var mainTab = $("#contentTab").tabs({closable: true});

	function tabNameExists(name){
		returnVal = false;
		$('#contentTab ul li a').each(function(i) {
				if (this.text == name) {
					returnVal = true;
				}
			});
		return returnVal;
	}
	
	$("#checkup").click(function(){
	 
		if(!tabNameExists("Examination")){
			//code to insert new tab here
			mainTab.tabs('add','consultation.php','Examination');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}
	    //======
	});
	if(!tabNameExists("Registration")){
		$("#registration").click(function(){
		
			mainTab.tabs('add','reception.php','Registration');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		});
	}
	$("#conFee").click(function(){
		
		mainTab.tabs('add','conFee.php','Consultation Fee');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});
	
	$("#visits").click(function(){
	
	mainTab.tabs('add','visits.php','Visits');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});

	$("#labResults").click(function(){
		mainTab.tabs('add','labResults.php','Lab Test Results');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});

	$("#RequestTest").click(function(){
		mainTab.tabs('add','bookLab.php','Request Test');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});

	$("#privateBills").click(function(){
		
		mainTab.tabs('add','privateBills.php','Pay Bills');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});

	$("#search").click(function(){
		
		mainTab.tabs('add','search.php','Search');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});

	$("#cashDrawer").click(function(){
		
		mainTab.tabs('add','cashDrawer.php','Cash Drawer');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	});

	$("#diagnosis").click(function(){
		if(!tabNameExists("Diagnosis")){
		mainTab.tabs('add','diagnosis.php','Diagnosis');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}
	});
	
		/*from jarra*/
			$("#inputStoreDrugs").click(function(){
		
			mainTab.tabs('add','inputStoreDrugs.php','Input Store Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		});
		
		$("#viewStoreDrugs").click(function(){
		
			mainTab.tabs('add','viewStoreStock.php','View Store Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		});
		
		$("#inputPhar").click(function(){
		
			mainTab.tabs('add','inputPhar.php','Input Pharmacy Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		});
		
		$("#viewPharDrugs").click(function(){
		
			mainTab.tabs('add','viewPhar.php','View Pharmacy Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		});
	
		//$("#bookPhar").click(function(){
		
		//	mainTab.tabs('add','bookPhar.php','Pharmacy Bookings');
		//	var newIndex = mainTab.tabs("length") - 1;
		//	mainTab.tabs("select", newIndex);
		//});
		//END FFROM JARRA
	$("#bookPhar").click(function(){
		
		mainTab.tabs('add','bookPhar.php','Pharmacy Bookings');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});

	$("#pharSales").click(function(){
		
		mainTab.tabs('add','pharSales.php','Daily Pharmacy Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#inputLab").click(function(){
		
		mainTab.tabs('add','inputLab.php','Input Tests');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#bookLab").click(function(){
		
		mainTab.tabs('add','bookLab.php','Lab Bookings');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#labSales").click(function(){
		
		mainTab.tabs('add','labSales.php','Daily Lab Sales');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#bioSocialData").click(function(){
		
		mainTab.tabs('add','bioSocialData.php','BioSocial Data');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#obstericalHistory").click(function(){
		
		mainTab.tabs('add','obstericalHistory.php','Obsterical History');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#antenatalRecord").click(function(){
		
		mainTab.tabs('add','antenatalRecord.php','Antenatal Record');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#labourTreatments").click(function(){
		
		mainTab.tabs('add','labourTreatments.php','Labour Treatments');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#labourDelivery").click(function(){
		
		mainTab.tabs('add','labourDelivery.php','Delivery');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#postpartumCare").click(function(){
		
		mainTab.tabs('add','postpartumCare.php','Postpartum Care');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});

$("#scheduleAppointment").click(function(){
		
		mainTab.tabs('add','wdCalendar/schedule.php','Schedule Appointment');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
});
	
$("#pettyCash").click(function(){
		
		mainTab.tabs('add','nurseLabour.php','Petty Cash');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
});

$("#cash_sales").click(function(){
	
	mainTab.tabs('add','shiftCashSales.php','Cash Sales Transaction');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
});
$("#companyBills").click(function(){
	mainTab.tabs('add','companyBills.php','Company Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
});
$("#debtors").click(function(){
	mainTab.tabs('add','debtors.php','Outstanding Debtors');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
});
$("#monthlyExpense").click(function(){
	mainTab.tabs('add','monthlyExpense.php','Monthly Expenses');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
});
$("#dayBooks").click(function(){
	mainTab.tabs('add','dayBooks.php','Day Books: Customer Receipt');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
})
$("#insuranceBills").click(function(){
	
	mainTab.tabs('add','insuranceBills.php','Insurance Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});
$("#financePayments").click(function(){
	
	mainTab.tabs('add','financePayments.php','Payments');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});

	
    });
</script>

</head>


<body>
<div style="display: none" id="queueDialog" title="Patient Queue">
<table width="500" border="0" class="ui-widget ui-widget-content">
	<thead>
		<tr class="ui-widget-header" style="white-space: nowrap;">
			<th>Patient Number</th>
			<th>Full Name</th>
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
<div id="contentTab">
<ul>
	<li><a href="#a">Main</a></li>

</ul>
<div id="a">Welcome to AfriMed Medical Record System</br>
</div>

</div>

</div>
</div>


</div>
<div class="ui-layout-north">
<div class="ui-widget">
<div class="ui-widget-header ui-corner-top">
<h4>AfriMed Medical Software
</h2>

</div>


</div>
</div>
<div class="ui-layout-west">

<div class="ui-widget">

<div class="ui-widget-content ui-corner-bottom">

<div id="myAccordion">
<h2><a href="#">Reception</a></h2>

<div class="ui-widget">
<div class="ui-state-default  "><a href="#" id="registration">Registration</a></div>
<div class="ui-state-default "><a href="#" id="conFee">Consultation Fee</a></div>
<div class="ui-state-default "><a href="#" id="privateBills">Bill
Payment</a></div>
<div class="ui-state-default "><a href="#" id="visits">Visits</a></div>
<div class="ui-state-default "><a href="#" id="search">Search</a></div>
<div class="ui-state-default "><a href="#" id="cashDrawer">Cash Drawer</a></div>
</div>

<h2><a href="#">Consultation</a></h2>

<div class="ui-widget">
<div class="ui-state-default  "><a href="#" id="checkup">Examination</a></div>
<div class="ui-state-default "><a href="#" id="diagnosis">Diagnosis</a></div>

</div>


<h2><a href="#">Pharmacy</a></h2>
<div class="ui-widget"><!--  <div class="ui-state-default ">
				    <a href="#" id="inputStoreDrugs">Input Store Drugs</a></div> 
				    <div class="ui-state-default ">
				    <a href="#" id="viewStoreDrugs">View Store Drugs</a></div>
				  <div class="ui-state-default  ">
				    <a href="#" id="inputPhar">Input Phar. Drugs</a></div>
				     <div class="ui-state-default ">
				    <a href="#" id="viewPharDrugs">View Phar. Drugs</a></div>-->

<div class="ui-state-default  "><a href="#" id="inputPhar">Input Drugs</a></div>
<div class="ui-state-default "><a href="#" id="bookPhar">Request Drugs</a></div>
<div class="ui-state-default "><a href="#" id="pharSales">Daily Sales</a></div>
</div>
<h2><a href="#">Laboratory</a></h2>
<div class="ui-widget">
<div class="ui-state-default  "><a href="#" id="inputLab">Input Test</a></div>
<div class="ui-state-default  "><a href="#" id="RequestTest">Request
Test</a></div>
<div class="ui-state-default  "><a href="#" id="labResults">Request
Results</a></div>
<div class="ui-state-default "><a href="#" id="labSales">Daily Sales</a></div>
</div>
<h2><a href="#">Labour</a></h2>
<div class="ui-widget">
<div class="ui-state-default  "><a href="#" id="bioSocialData">BioSocial
Data</a></div>
<div class="ui-state-default "><a href="#" id="obstericalHistory">Obsterical
History</a></div>
<div class="ui-state-default "><a href="#" id="antenatalRecord">Antenatal
Record</a></div>
<div class="ui-state-default "><a href="#" id="labourTreatments">Treatments</a></div>
<div class="ui-state-default "><a href="#" id="labourDelivery">Delivery</a></div>
<div class="ui-state-default "><a href="#" id="postpartumCare">Postpartum
care</a></div>
<!--   <div class="ui-state-default ">
				    <a href="#" id="nurseLabour">View Patients Under Nurse</a></div>-->
</div>
<h2><a href="#">Theater</a></h2>
<div>Theater.</div>
<h2><a href="#">Appointments</a></h2>

<div class="ui-state-default "><a href="#" id="scheduleAppointment">Schedule
Appoinments</a></div>

<h2><a href="#">Finance</a></h2>
<div class="ui-widget">
<div class="ui-state-default  "><a href="#" id="monthlyExpense">Monthly
Expense</a></div>
<div class="ui-state-default  "><a href="#" id="dayBooks">Day Books</a></div>
<div class="ui-state-default  "><a href="#" id="debtors">Debtors</a></div>
<div class="ui-state-default  "><a href="#" id="pettyCash">Petty Cash</a></div>
<div class="ui-state-default "><a href="#" id="cash_sales">Cash Sales</a></div>
<div class="ui-state-default "><a href="#" id="companyBills">Company
Bills</a></div>
<div class="ui-state-default "><a href="#" id="insuranceBills">Insurance
Bills</a></div>
<div class="ui-state-default "><a href="#" id="financePayments">Payments</a></div>
</div>

<h2><a href="#">Ambulance</a></h2>
<div>Ambulance Services</div>
<h2><a href="#">Estate Services</a></h2>
<div>Estate Services</div>
</div>



</div>


</div>

</body>
</html>



