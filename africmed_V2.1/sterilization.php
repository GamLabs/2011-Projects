<script>
    $(document).ready(function () {
    	
    	$("#steriDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#steriStarted").datetimepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });

    	$("#steriCompleted").datetimepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });

				
		$("#steriSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validateAddSteril(){
			$('#addSterilizationForm').validate({
				
					'rules':{
						'steriDate': {
							'required':true,
							'date':true
						},
						'steriInstrument': 'required',
						'steriQuantity': {
							 'required':true,
							 'number':true
						},
						'steriState': 'required',
						'steriPreClean':'required',
						'steriStarted': 'required',
						'steriCompleted': 'required'
						
					},
					messages: {
						steriDate: {
							required: "<i style='color:red;'>Date is Required<i>",
							date: "<i style='color:red;'>Date is Required<i>"
						},
						steriInstrument: "<i style='color:red;'>Type of Instrument is Required <i>",
						steriQuantity:{
							required: "<i style='color:red;'>Quantity is Required<i>",
							number: "<i style='color:red;'>Must be a Digit<i>"
						},
						steriState:"<i style='color:red;'>Please Choose a State<i>",
						steriPreClean: "<i style='color:red;'>Please Choose Pre-Sterilization Cleaning <i>",
						steriStarted: "<i style='color:red;'>Start Time is Required<i>",
						steriCompleted: "<i style='color:red;'>Completed Time is Required<i>"
					
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
    	$('#addSterilizationForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddSteril() ,
			
			success:function(response) { 
				
				var res = parseInt(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Sterilization Record </p>").dialog('open');
					 $('#addSterilizationForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
		
    	$("#CloseSterilization").click(function(){closeTab(); });
    });

</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 12px;
	}
-->
</style>
<a id="CloseSterilization" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget ui-widget-content ui-corner-all" >
<form id="addSterilizationForm" action="addsterilization_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input readonly  size="10" type="text" id="steriDate" name="steriDate"  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"/> </td>
</tr><tr>
<td><label>Type Of Instrument:</label></td><td><input  size="20" type="text" id="steriInstrument" name="steriInstrument" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr>
<tr>
<td><label>Quantity:</label></td><td><input   size="10" type="text" id="steriQuantity" name="steriQuantity" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>State: </label></td><td><select  id="steriState" name="steriState" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">
		<option value="Dirty">Dirty</option>
		<option value="Soiled">Soiled</option>
		<option value="Clean">Clean</option>
		</select></td>
</tr><tr>
<td><label>Pre-Sterilization Cleaning: </label></td><td><select  id="steriPreClean" name="steriPreClean" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">
		<option value="Yes">Yes</option>
		<option value="No">No</option>
</select></td>
</tr><tr>
<td><label>Time Started: </label></td><td><input readonly  size="10" type="text" id="steriStarted" name="steriStarted" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /></td>
</tr>
<tr >
<td><label>Time Completed:</label></td><td><input readonly  size="10" type="text" id="steriCompleted" name="steriCompleted" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>

</tr><tr><td></td><td><input  size="10" type="submit" id="steriSubmit" name="steriSubmit" value="Add Item" /></td>

</table>
</form>
</fieldset>