<script>

 $(document).ready(function () { 
	 $("#fuelSubmit").button();
	 $("#fuelDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});

	  	function validateFuel(){
			$('#fuelForm').validate({
				
					'rules':{
						'fuelDate': {
							'required':true,
							'date':true
						},
						'fuelType': 'required',
						'fuelReqBy': 'required',
						'fuelAuthBy': 'required',
						'fuelVolume': {
							'required':true,
							'number':true
						}
					},
					messages: {
						fuelDate:{
							required: "<i style='color:red;'> Date is required!<i>",
							date:"<i style='color:red;'>Must be a Date!<i>"
						},
						fuelType: "<i style='color:red;'>Fuel Type  is Required<i>",
						fuelReqBy: "<i style='color:red;'>Fuel By  is Required<i>",
						fuelAuthBy: "<i style='color:red;'>Authorise By  is Required<i>",
						fuelVolume: {
							required:	"<i style='color:red;'>The Volume is Required<i>",
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
 $('#fuelForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateFuel(),
			
			success:function(response) { 
				//alert(response);
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Fuel </p>").dialog('open');
					$('#fuelForm').resetForm();
					 
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
 
 
 });


</script>

<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
<form id="fuelForm" action="fuel_controller.php" method="post">
<input   size="20" type="hidden" id="usedIn" name="usedIn" value="<?php echo $_GET['Id']; ?>" /> 
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="10" type="text" id="fuelDate" name="fuelDate" /> </td>
</tr><tr>
<td><label>Type Of Fuel:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="20" type="text" id="fuelType" name="fuelType" /> </td>
</tr>
<tr>
<td><label>Volume / Quantity:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="10" type="text" id="fuelVolume" name="fuelVolume" /> </td>
</tr><tr>
<td><label>Requested By: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="fuelReqBy" name="fuelReqBy" /></td>
</tr><tr>
<td><label>Authorised By: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="fuelAuthBy" name="fuelAuthBy" /></td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="fuelSubmit" name="fuelSubmit" value="Add Fuel" /></td></tr>

</table>
</form>
</fieldset>