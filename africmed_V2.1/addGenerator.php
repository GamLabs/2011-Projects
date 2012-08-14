 <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 

 ?>
 <script>
 $(document).ready(function () { 
 $("#generatorAccordion").accordion({
		autoHeight: true,
		animated: "bounceslide",
		collapsible: true
	});
	
	$(".addFuelLinkGen").click(function(){
		var Id = $(this).closest('tr').find('td:eq(0)').text();
		
		//alert("Who Click Fuel On " +Id);
		$("#fuelDialog").load("fuel.php?Id="+Id+"").dialog("open");
		
	});
	$(".addMaintenanceLinkGen").click(function(){
	var Id = $(this).closest('tr').find('td:eq(0)').text();
		//alert("Who wants Maintenence On "+genId);
		$("#maintenanceDialog").load("maintenance.php?Id="+Id+"").dialog("open");
		
	});
	
	$("#addGeneratorSubmit").button();
	
	function validateAddGenerator(){
			$('#addgeneratorForm').validate({
				
					'rules':{
						'generatorName': 'required',
						'generatorNo': 'required'	
					},
					messages: {
						generatorName: "<i style='color:red;'>Please enter Generator Name<i>",
						generatorNo: "<i style='color:red;'>Please enter Generator Part Number<i>"
	
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
	
	$('#addgeneratorForm').ajaxForm({
			//target:"#content",
			
			beforeSubmit:validateAddGenerator() ,
			
			success:function(response) { 
				//alert(response);
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added generator </p>").dialog('open');
					var selected = $("#contentTab").tabs('option', 'selected');
					$("#contentTab").tabs('load',selected);
					 
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});

	$("#CloseAddGenerator").click(function(){closeTab(); });

 });
 </script>
 
 <style>
	img {
  border: none;
}
 
 </style>
<a id="CloseAddGenerator" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <div id="generatorAccordion">
 <h2><a href="#">Add Generator</a></h2>
 <div class="ui-widget">
 <form id="addgeneratorForm" action="addgenerator_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Type Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="generatorName" name="generatorName" /> </td>
</tr><tr>
<td><label>Part Number:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="20" type="text" id="generatorNo" name="generatorNo" /> </td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="addGeneratorSubmit" name="addGeneratorSubmit" value="Add Generator" /></td>

</table>
</form>
 
 
 </div>
 <h2><a href="#">List of Generators</a></h2>
 <div class="ui-widget">
  <table id="users" class="ui-widget ui-widget-content">
	
			<tr class="ui-widget-header ">
				<th>ID</th>
				<th>Name</th>
				<th>Part NO</th>
				<th>Action</th>
			</tr>
		
			<?php 
			
			getGenerators();
			?>
		
</table>
 
 
 </div>
 </div>

 
<hr>