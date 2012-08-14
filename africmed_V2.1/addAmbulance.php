  <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 

 ?>
 
 <script>
 $(document).ready(function () { 
 
 
 $("#ambulanceAccordion").accordion({
		autoHeight: true,
		animated: "bounceslide",
		collapsible: true
	});
	
		function validateAddAmbulance(){
			$('#addambulanceForm').validate({
				
					'rules':{
						'ambulanceName': 'required',
						'ambulanceNo': 'required'	
					},
					messages: {
						ambulanceName: "<i style='color:red;'>Please enter Ambulance Name<i>",
						ambulanceNo: "<i style='color:red;'>Please enter Ambulance Part Number<i>"
	
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
	$('#addambulanceForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddAmbulance() ,
			
			success:function(response) { 
				//alert(response);
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Ambulance </p>").dialog('open');
					var selected = $("#contentTab").tabs('option', 'selected');
					$("#contentTab").tabs('load',selected);
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
	
	$("#addAmbulanceSubmit").button();
	$(".addDispatchLinkAmb").click(function(){
	var ambId = $(this).closest('tr').find('td:eq(0)').text();
		//alert("Who Click Dispatch ?"+ambId);
		$("#dispatchDialog").load("ambulance_dispatch.php?ambulanceId="+ambId+"").dialog("open");;
			
	});
	$(".addFuelLinkAmb").click(function(){
	var Id = $(this).closest('tr').find('td:eq(0)').text();
		//alert("Who Click Fuel ?"+ambId);
		$("#fuelDialog").load("fuel.php?Id="+Id+"").dialog("open");;
		
	});
	$(".addMaintenanceLinkAmb").click(function(){
	var Id = $(this).closest('tr').find('td:eq(0)').text();
		//alert("Who wants Maintenence ?"+ambId);
		$("#maintenanceDialog").load("maintenance.php?Id="+Id+"").dialog("open");;
		
	});

	$("#CloseAddAmbulance").click(function(){closeTab(); });

 });
 </script>

 
<a id="CloseAddAmbulance" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <div id="ambulanceAccordion">
 <h2><a href="#">Add Ambulance</a></h2>
 <div class="ui-widget">
 <form id="addambulanceForm" action="addambulance_controller.php" method="post">
<table class="tdtext">
<tr>
<td><label>Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="20" type="text" id= "ambulanceName" name= "ambulanceName" /> </td>
</tr><tr>
<td><label>Registration Number:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="ambulanceNo" name="ambulanceNo" /> </td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="addAmbulanceSubmit" name="addAmbulanceSubmit" value="Add Ambulance" /></td></tr>

</table>
</form>
 
 
 </div>
 
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

 
<hr>