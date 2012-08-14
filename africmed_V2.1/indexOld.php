
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>AfricMed | Modern Record System Application</title>


<link type="text/css" href="js/jqueryui/css/dark-hive/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<link type="text/css" href="css/validationEngine.jquery.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery-1.5.2.js"></script>
<script type="text/javascript" src="js/jqueryui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="js/ui.tabs.closable.min.js"></script>
<script type="text/javascript" src="js/jqueryui/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jqueryui/development-bundle/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="js/jquery.layout-latest.js"></script>
<script type="text/javascript" src="js/jqueryui/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.colorize-2.0.0.js"></script>


<style type="text/css">
	#myAccordion .ui-accordion-content { padding: 6 0 15 15; }


</style >
<script>
    $(document).ready(function () {
        $('body').layout({ applyDefaultStyles: true });
	$("#myAccordion").accordion({
		autoHeight: true,
		animated: "bounceslide"
	});
	
	var mainTab = $("#contentTab").tabs({closable: true});
	$("#checkup").click(function(){
	      //===
			var nameToCheck = "Consultation";
			var tabNameExists = false;

			$('#contentTab ul li a').each(function(i) {
			if (this.text == nameToCheck) {
				tabNameExists = true;
			}
		});
		if(!tabNameExists){
			//code to insert new tab here
			mainTab.tabs('add','consultation.php','Consultation');
			var newIndex = mainTab.tabs("length") - 1;
			mainTab.tabs("select", newIndex);
		}
	    //======
	});

	$("#registration").click(function(){
	
	mainTab.tabs('add','reception.php','Registration');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});
	
	$("#visits").click(function(){
	
	mainTab.tabs('add','visits.php','Visits');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});

	$("#search").click(function(){
		
		mainTab.tabs('add','search.php','Search');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
		$("#inputPhar").click(function(){
		
		mainTab.tabs('add','inputPhar.php','Input Drugs');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	
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
	$("#addLabour").click(function(){
		
		mainTab.tabs('add','addLabour.php','Add Labour');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#bookLabour").click(function(){
		
		mainTab.tabs('add','bookLabour.php','Labour Bookings');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#addDelivery").click(function(){
		
		mainTab.tabs('add','addDelivery.php','Add Delivery');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#viewLabour").click(function(){
		
		mainTab.tabs('add','viewLabour.php','View Labour');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#viewDelivery").click(function(){
		
		mainTab.tabs('add','viewDelivery.php','View Delivery');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});
	$("#nurseLabour").click(function(){
		
		mainTab.tabs('add','nurseLabour.php','Nurse');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});

$("#pettyCash").click(function(){
		
		mainTab.tabs('add','nurseLabour.php','Petty Cash');
		var newIndex = mainTab.tabs("length") - 1;
		mainTab.tabs("select", newIndex);
		});

$("#transaction").click(function(){
	
	mainTab.tabs('add','nurseLabour.php','Financial Transaction');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});
$("#companyBills").click(function(){
	
	mainTab.tabs('add','nurseLabour.php','Company Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});
$("#insuranceBills").click(function(){
	
	mainTab.tabs('add','nurseLabour.php','Insurance Bills');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});
$("#financePayments").click(function(){
	
	mainTab.tabs('add','nurseLabour.php','Payments');
	var newIndex = mainTab.tabs("length") - 1;
	mainTab.tabs("select", newIndex);
	});

	
    });
</script>

</head>


<body>

<div class="ui-layout-center">

<div class="ui-widget">

  <div class="ui-widget-content ui-corner-bottom">
<div id="contentTab">
  <ul>
    <li><a href="#a">Main</a></li>
   
  </ul>
  <div id="a">Welcome to AfriMed Medical Record System</br></div>
  
	</div>

   </div>
</div>


</div>
<div class="ui-layout-north">
<div class="ui-widget">
<div class="ui-widget-header ui-corner-top">
    <h4>AfriMed Medical Software</h2></div>


</div>
</div>
<div class="ui-layout-west">

<div class="ui-widget">

  <div class="ui-widget-content ui-corner-bottom">
   
<div id="myAccordion">
  <h2><a href="#">Reception</a></h2>
  
  	<div class="ui-widget">
  <div class="ui-state-default  ">
    <a href="#" id="registration">Registration</a></div>
  <div class="ui-state-default ">
    <a href="#" id="checkup">Consultation</a></div>
    <div class="ui-state-default ">
    <a href="#">Payments</a></div>
	<div class="ui-state-default ">
    <a href="#" id="visits">Visits</a></div>
    <div class="ui-state-default ">
    <a href="#" id="search">Search</a></div>
	</div>
  	
 
  <h2><a href="#">Pharmacy</a></h2>
  <div>pharmacy.</div>
  <h2><a href="#">Laboratory</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="inputLab">Input Test</a></div>
				  <div class="ui-state-default ">
				    <a href="#" id="bookLab">Book Test</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="labSales">Daily Sales</a></div>
 		</div>
<h2><a href="#">Labour</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="addLabour">Register Labour</a></div>
				  <div class="ui-state-default ">
				    <a href="#" id="bookLabour">Book Labour Visits</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="addDelivery">Add Delivery</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="viewLabour">View Labour Patients</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="viewDelivery">View Delivery</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="nurseLabour">View Patients Under Nurse</a></div>
			</div>
<h2><a href="#">Theater</a></h2>
  <div>Theater.</div>
<h2><a href="#">Finance</a></h2>
		<div class="ui-widget">
				  <div class="ui-state-default  ">
				    <a href="#" id="pettyCash">Petty Cash</a></div>
				  <div class="ui-state-default ">
				    <a href="#" id="transaction">Financial Transaction</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="companyBills">Company Bills</a></div>
				    <div class="ui-state-default ">
				    <a href="#" id="insuranceBills">Insurance Bills</a></div>
					<div class="ui-state-default ">
				    <a href="#" id="financePayments">Payments</a></div>
				    
			</div>
</div>



</div>


</div>


</body>
</html>



