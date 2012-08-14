<script>
    $(document).ready(function () {
    	
	

    	
    	$("#laundryDate").datetimepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#laundryTimeReturned").datetimepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
		$("#laundrySubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validatelaundry(){
			$('#laundryForm').validate({
				
					'rules':{
						'laundryDate': {
							'required':true
							
						},
						'laundryRecBy': 'required',
						'laundryItemType': 'required',
						'laundryItemQty': {
							'required':true,
							'number':true
						},
						'laundryUsedMaterial':'required',
						'laundryUsedMaterialQty':{
							 'required':true,
							 'number':true
						},
						'laundryIroning': 'required',
						'laundryTimeReturned': {
							'required':true
							
						},
						'laundryComment': 'required'
						
					},
					messages: {
						laundryDate: {
							required:"<i style='color:red;'>Date Required<i>",
						
						},
						laundryRecBy: "<i style='color:red;'>Received By is Required<i>",
						laundryItemType: "<i style='color:red;'>Laundry Item is Required<i>",
						laundryItemQty:{
							required:"<i style='color:red;'>Quantity of Item is Required<i>",
							number: "<i style='color:red;'>Must Be a Digit<i>"
						},
						laundryUsedMaterial: "<i style='color:red;'>Washing Materials Used is Required<i>",
						laundryUsedMaterialQty: {
							required: "<i style='color:red;'>Quantity of Washing materials is Required<i>",
							number: "<i style='color:red;'>Must Be a Digit<i>"
						},
						laundryIroning: "<i style='color:red;'>Ironing is Required<i>",
						laundryTimeReturned: {
							required:  "<i style='color:red;'>The Time Returned is Required<i>",
							
						},
						laundryComment: "<i style='color:red;'>Please Comment<i>"
					
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
    	$('#laundryForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validatelaundry() ,
			
			success:function(response) { 
				
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Laundry Record </p>").dialog('open');
					 $('#laundryForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
    	$("#CloseLaundry").click(function(){closeTab(); });
		
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
<a id="CloseLaundry" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget ui-widget-content ui-corner-all" >
<form id="laundryForm" action="laundy_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Date & Time Received:</label></td><td><input readonly  size="15" type="text" id="laundryDate" name="laundryDate" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Received By:</label></td><td><input  size="20" type="text" id="laundryRecBy" name="laundryRecBy" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr>
<tr>
<td><label>Types of Laundry item:</label></td><td><input   size="10" type="text" id="laundryItemType" name="laundryItemType" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Quantity of Laundry Items: </label></td><td><input   size="10" type="text" id="laundryItemQty" name="laundryItemQty" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Washing Materials Used: </label></td><td><input   size="10" type="text" id="laundryUsedMaterial" name="laundryUsedMaterial" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Quantity Of Washing materials Used: </label></td><td><input   size="10" type="text" id="laundryUsedMaterialQty" name="laundryUsedMaterialQty" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /></td>
</tr>
<tr >
<td><label>Ironing:</label></td><td><select    id="laundryIroning" name="laundryIroning" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >
<option value="Yes">Yes</option>
<option value="No">No</option>

</select> </td>

</tr>
<tr >
<td><label>Date & Time Returned :</label></td><td><input readonly  size="15" type="text" id="laundryTimeReturned" name="laundryTimeReturned" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr>
<tr >
<td><label>Comment:</label></td><td><textarea     id="laundryComment" name="laundryComment" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" ></textarea> </td>

</tr><tr><td></td><td><input  size="10" type="submit" id="laundrySubmit" name="laundrySubmit" value="Submit" /></td>

</table>
</form>
</fieldset>