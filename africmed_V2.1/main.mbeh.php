<?php require_once("includes/session.php"); ?>
<?php require_once 'includes/connect.php';?>
<?php require_once("includes/receptionFunctions.php"); ?>
<?php require_once 'includes/aclFunctions.php';?>
<?php confirm_logged_in(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>AfricMed | Modern Record System Application</title>


<link type="text/css"
	href="js/jqueryui/css/dark-hive/jquery-ui-1.8.11.custom.css"
	rel="stylesheet" />
<link type="text/css" href="css/validationEngine.jquery.css"
	rel="stylesheet" />
<link rel="stylesheet" href="css/formly.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.liveSearch.css" type="text/css" />





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
<script type="text/javascript" src="js/formly.js"></script>
<script type="text/javascript" src="js/jquery.collapsible-v.2.1.3.js"></script>
<script type="text/javascript" src="js/jquery.liveSearch.js"></script>


<style type="text/css">
#myAccordion .ui-accordion-content {
	padding: 6 0 15 15;
}

.header {
	background: url('images/bg-body.gif') top left repeat-x;
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
	$("#changePasswordDiv").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close");$('form').validationEngine('hideAll'); } } });
	var mainTab = $("#contentTab").tabs({closable: true,spinner: 'Loading...'});
		// $(".remove").remove();
		$("#logout").button();
		$("#chagngePassword").button();
		
		$('#changePasswordForm').formly({'onBlur':false, 'theme':'Dark'});
		$("#chagngePassword").click(function(){
			$("#changePasswordDiv").dialog('open');
		});

		$('#changePasswordForm').ajaxForm({
			//target:"#content",
			beforeSubmit: function(){ return $("#changePasswordForm").validationEngine('validate');},
			
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
	
	$("#addUser").click(function(){
		 
		if(!tabNameExists("Add User")){
			//code to insert new tab here
			mainTab.tabs('add','adduser.php','Add User');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}else{
			
			var index = getTabName("Add User");
			//alert(index);
			mainTab.tabs('select', index);
						
		}
	    //======
	});
	
	
		$("#registration").click(function(){
			if(!tabNameExists("Registration")){
			mainTab.tabs('add','reception.php','Registration');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
			}else{
				var index = getTabName("Registration");
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
		if(!tabNameExists("Lab Test Results")){
		mainTab.tabs('add','labResults.php','Lab Test Results');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Lab Test Results");
			mainTab.tabs('select', index);
		}
	});

	$("#RequestTest").click(function(){
		if(!tabNameExists("Request Test")){
		mainTab.tabs('add','bookLab.php','Request Test');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Request Test");
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
		mainTab.tabs('add','privateBills.php','Pay Bills');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Pay Bills");
			mainTab.tabs('select', index);
		}
	});

	$("#search").click(function(){
		if(!tabNameExists("Search")){
		mainTab.tabs('add','search.php','Search');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Search");
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
				if(!tabNameExists("Add Store Drugs")){
			mainTab.tabs('add','inputStoreDrugs.php','Add Store Drugs');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
				}else{
					var index = getTabName("Add Store Drugs");
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
		if(!tabNameExists("Pharmacy Bookings")){
		mainTab.tabs('add','bookPhar.php','Pharmacy Bookings');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Pharmacy Bookings");
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
	$("#inputLab").click(function(){
		if(!tabNameExists("Input Tests")){
		mainTab.tabs('add','inputLab.php','Input Tests');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		}else{
			var index = getTabName("Input Tests");
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
		mainTab.tabs('add','nurseLabour.php','Petty Cash');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
	}else{
		var index = getTabName("Petty Cash");
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
$("#generalExpense").click(function(){
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
})
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
$("#consultationLink").removeClass('remove');

$.post('check.php',{'getCategoryGroup': $("#username").text()},function(data) {
	
	//alert(data);
	var link = "#"+data+"Link";
	var div = "#"+data+"Div";
	//alert(link);
	//$(link).removeClass('remove');
	});
 });
</script>

</head>


<body>


<div style="display: none" id="changePasswordDiv"
	title="Change Password">
<form id="changePasswordForm" action="changepassword.php" method="post">
<input type="hidden" id="changepasswordUsername"
	name="changepasswordUsername"
	value="<?php echo $_SESSION['username']; ?>" />
<table>
	<tr>
		<td><label>Old Password</label></td>
		<td><input class="validate[required]" size="20" type="text"
			id="oldpassword" name="oldpassword" /></td>
	</tr>
	<tr>
		<td><label>New Password</label></td>
		<td><input class="validate[required]" size="20" type="text"
			id="newpassword" name="newpassword" /></td>
	</tr>
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
<table width="500" border="0" class="ui-widget ui-widget-content">
	<thead>
		<tr class="ui-widget-header ">
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
<div class="header"><img id="logo" height="50px"
	src="images/africmed_log.jpg" alt="logo" />
<div
	style="font-style: italic; float: right; font-size: 19px; color: aqua;">Welcome
<?php echo ucfirst($_SESSION['firstname'])." ". ucfirst($_SESSION['lastname']);?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a
	id="chagngePassword"
	style="font-style: normal; font-size: 19px; color: aqua;" href="#">Change
Password </a>&nbsp&nbsp&nbsp&nbsp<a id="logout"
	style="font-style: normal; font-size: 19px; color: aqua;"
	href="logout.php">Logout </a></div>
</div>


</div>
</div>
<div class="ui-layout-west">

<div class="ui-widget">

<div class="ui-widget-content ui-corner-bottom">

<div id="myAccordion"><?php getNavLink($_SESSION['group']);?></div>



</div>


</div>

</body>
</html>



