 <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 

 ?>
 <script>
 $(document).ready(function () { 
 $("#viewAmbulanceAccordion").accordion({
		autoHeight: false,
		animated: "bounceslide",
		collapsible: false
	});
 $("#displayAmbulanceExpDivAcc").accordion({
		autoHeight: false,
		animated: "bounceslide",
		collapsible: false
	});
 
	
	$(".addFuelLinkAmb").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$("#displExpForAmbulance").html("");
		$("#expAmbulanceHeader").html("Fuel Expenses On "+name);
		$("#displExpForAmbulance").load("fuelexp.php?Id="+Id+"&In="+"Amb");
		
		
	});
	$(".addMaintenanceLinkAmb").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$("#displExpForAmbulance").html("");
		$("#expAmbulanceHeader").html("Maintenance Expenses On "+name);
		
		$("#displExpForAmbulance").load("maintenanceexp.php?Id="+Id+"&In="+"Amb");
		
		//$("#maintenanceDialog").load("maintenanceexp.php?Id="+Id+"").dialog("open");
		
	});
	$(".addDispatchLinkAmb").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$("#displExpForAmbulance").html("");
		$("#expAmbulanceHeader").html("Ambulance Dispatch Expenses On "+name);
		
		$("#displExpForAmbulance").load("ambulance_dispatchexp.php?Id="+Id+"&In="+"Amb");
		
		//$("#maintenanceDialog").load("maintenanceexp.php?Id="+Id+"").dialog("open");
		
	});
	
	



	$("#CloseExpAmbulance").click(function(){closeTab(); });

 });
 </script>
 
 <style>
	img {
  border: none;
}
 
 </style>
<a id="CloseExpAmbulance" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

 <div id="viewAmbulanceAccordion">

 <h2><a href="#">List of Ambulances</a></h2>
 <div class="ui-widget">
 
 <table id="users" class="ui-widget ui-widget-content">
	
			<tr class="ui-widget-header ">
				<th>ID</th>
				<th>Name</th>
				<th>Registration NO</th>
				<th>Action</th>
			</tr>
		
			<?php
				getAmbulances();
				
			?>
		
</table>

 
 
 </div>
 </div>
<br>
<div id="displayAmbulanceExpDivAcc">
	<h2><a href="#">Expenses</a></h2>
	<div class="ui-widget" >
	<center><h1 style="color:green;" id="expAmbulanceHeader"></h1></center>
	<div id="displExpForAmbulance"></div>
	</div>

</div>
 
<hr>