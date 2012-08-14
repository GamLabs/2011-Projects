 <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 

 ?>
 <script>
 $(document).ready(function () { 
 $("#viewgeneratorAccordion").accordion({
		autoHeight: false,
		animated: "bounceslide",
		collapsible: false
	});
 $("#displayGenExpDivAcc").accordion({
		autoHeight: false,
		animated: "bounceslide",
		collapsible: false
	});
 
	
	$(".addFuelLinkGen").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$("#displExpForGene").html("");
		$("#expGeneHeader").html("Fuel Expenses On "+name);
		$("#displExpForGene").load("fuelexp.php?Id="+Id+"&In="+"Gen");
		
		
	});
	$(".addMaintenanceLinkGen").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$("#displExpForGene").html("");
		$("#expGeneHeader").html("Maintenance Expenses On "+name);
		
		$("#displExpForGene").load("maintenanceexp.php?Id="+Id+"&In="+"Gen");
		
		//$("#maintenanceDialog").load("maintenanceexp.php?Id="+Id+"").dialog("open");
		
	});
	



	$("#CloseExpGenerator").click(function(){closeTab(); });

 });
 </script>
 
 <style>
	img {
  border: none;
}
 
 </style>
<a id="CloseExpGenerator" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

 <div id="viewgeneratorAccordion">

 <h2><a href="#">List of Generators</a></h2>
 <div class="ui-widget" style="height: 150px;">
  <table id="users" class="ui-widget ui-widget-content">
	
			<tr class="ui-widget-header ">
				<th>ID</th>
				<th>Name</th>
				<th>Registration NO</th>
				<th>Action</th>
			</tr>
		
			<?php 
			
			getGenerators();
			?>
		
</table>
 
 
 </div>
 </div>
<br>
<div id="displayGenExpDivAcc">
	<h2><a href="#">Expenses</a></h2>
	<div class="ui-widget" >
	<center><h1 style="color:green;" id="expGeneHeader"></h1></center>
	<div id="displExpForGene"></div>
	</div>

</div>
 
<hr>