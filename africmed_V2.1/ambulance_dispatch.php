
<script>
 $(document).ready(function () { 
	 $("#dispatchSubmit").button();
	 $("#dispDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});

 	function validateAmbDisp(){
		$('#dispatchForm').validate({
			
				'rules':{
					'dispCallPhone':{
						 'required':true,
						 'number':true
					},
					'dispRecName': 'required',
					'dispCallName': 'required',
					'dispCallAddress': 'required',
					'dispDate': {
						'required':true,
						'date':true
					},
					'dispDrivName': 'required',
					'dispCalloutType': 'required',
					'dispAccompBy': 'required',
					'dispComment': 'required',
					'dispOutcome': 'required'
				},
				messages: {
					dispCallPhone: {
						required: "<i style='color:red;'>Callers Phone is required!<i>",
						number: "<i style='color:red;'>Must be a Phone Number!<i>"
					},
					dispRecName: "<i style='color:red;'>Receivers Name is Required<i>",
					dispCallName: "<i style='color:red;'>Callers Name is Required<i>",
					dispCallAddress: "<i style='color:red;'>Callers Address is Required<i>",
					dispDate: {
						required:	"<i style='color:red;'>Date is Required<i>",
						date :	"<i style='color:red;'>Must Be a Date<i>"
					},
					dispDrivName   : "<i style='color:red;'>drivers Name is Required<i>",
					dispCalloutType: "<i style='color:red;'>Callout Type is required!<i>",
					dispAccompBy: "<i style='color:red;'>Accompany by is Required<i>",
					dispComment: "<i style='color:red;'>Comment is Required<i>",
					dispOutcome: "<i style='color:red;'>The Outcome is Required<i>"	
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
 $('#dispatchForm').ajaxForm({
			//target:"#content",
			
			beforeSubmit:validateAmbDisp(),
			
			success:function(response) { 
				//alert(response);
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Dispatch Ambulance </p>").dialog('open');
					$('#dispatchForm').resetForm();
					 
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
 
 
 });

</script>

 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
<form id="dispatchForm" action="dispatch_controller.php" method="post">
<input   size="20" type="hidden" id="generatorID" name="generatorID" value="<?php echo $_GET['ambulanceId']; ?>" /> </td>
<table class="tdtext">
<tr >
<td><label>Date & Time:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"   size="16" type="text" id="dispDate" name="dispDate" /> </td>
</tr><tr>
<td><label>Recipient's Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"  size="20" type="text" id="dispRecName" name="dispRecName" /> </td>
</tr>
<tr>
<td><label>Caller's Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"   size="10" type="text" id="dispCallName" name="dispCallName" /> </td>
</tr><tr>
<td><label>Caller's Address: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"  size="10" type="text" id="dispCallAddress" name="dispCallAddress" /></td>
</tr><tr>
<td><label>Caller's Phone: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" size="10" type="text" id="dispCallPhone" name="dispCallPhone" /></td>
</tr><tr>
<td><label>Drivers's Name:: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"  size="10" type="text" id="dispDrivName" name="dispDrivName" /></td>
</tr><tr>
<td><label>CallOut Type: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle" id="dispCalloutType" name="dispCalloutType">
<option>Emergency</option>
<option>Semi-Urgent</option>
<option>Not Urgent</option>
</select></td>
</tr><tr>
<td><label>Accompany By: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"  size="10" type="text" id="dispAccompBy" name="dispAccompBy" /></td>
</tr><tr>
<td><label>Doctors' Comment: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle"  size="10" type="text" id="dispComment" name="dispComment" /></td>
</tr><tr>
<td><label>Outcome: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle" id="dispOutcome" name="dispOutcome">
<option>Admission</option>
<option>Transfer</option>
<option>Death</option>

</select></td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="dispatchSubmit" name="dispatchSubmit" value="Dispatch" /></td>

</table>
</form>
</fieldset>