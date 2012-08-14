 <script>
  $(document).ready(function () { 
	  $("#maintSubmit").button();
	  $("#maintDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});

	  	function validateMaintenance(){
			$('#maintenanceForm').validate({
				
					'rules':{
						'maintDate': {
							'required':true,
							'date':true
						},
						'maintType': 'required',
						'maintMainBy': 'required',
						'maintAuthBy': 'required',
						'maintCost': {
							'required':true,
							'number':true
						}
					},
					messages: {
						maintDate:{
							required: "<i style='color:red;'> Date is required!<i>",
							date:"<i style='color:red;'>Must be a Date!<i>"
						},
						maintType: "<i style='color:red;'>Maintenace Type  is Required<i>",
						maintMainBy: "<i style='color:red;'>maintenance By  is Required<i>",
						maintAuthBy: "<i style='color:red;'>Authorise By  is Required<i>",
						maintCost: {
							required:	"<i style='color:red;'>The Cost is Required<i>",
							number :	"<i style='color:red;'>Must be a Digit<i>"
						}
					},
								
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      //alert(errors);
					      if(errors){
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
 $('#maintenanceForm').ajaxForm({
			//target:"#content",
			
			beforeSubmit:validateMaintenance(),
			
			success:function(response) { 
				//alert(response);
				var res = parseInt(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Maintenance </p>").dialog('open');
					$('#maintenanceForm').resetForm();
					 
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
 
 
 });
 
 </script>
 
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
<form id="maintenanceForm" action="maintenance_controller.php" method="post">
<input class=" ui-widget-content ui-corner-all inputStyle"  size="20" type="hidden" id="machineId" name="machineId" value="<?php echo $_GET['Id']; ?>" /> 
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="10" type="text" id="maintDate" name="maintDate" /> </td>
</tr><tr>
<td><label>Maintenance Type:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="20" type="text" id="maintType" name="maintType" /> </td>
</tr>
<tr>
<td><label>Cost: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="maintCost" name="maintCost" /></td>
</tr><tr>
<td><label>maintenance By: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="maintMainBy" name="maintMainBy" /></td>
</tr><tr>
<td><label>AUthorised By: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="maintAuthBy" name="maintAuthBy" /></td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="maintSubmit" name="maintSubmit" value="Add Maintenance" /></td></tr>

</table>
</form>
</fieldset>