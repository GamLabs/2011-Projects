<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
?>


<script>

$(document).ready(function(){
$("#dispToWardDate").datepicker({
	showOtherMonths: true,
	selectOtherMonths: true,
	changeMonth: true,
	changeYear: true,
	showButtonPanel: true,
	yearRange: '1800:2050',
    dateFormat: 'yy-mm-dd'

});


function validatesellDrug(){
	$('#dispToWardForm').validate({
		
			'rules':{
				'dispToWardDate':'required',
				'dispToWardName': 'required',
				'dispToWardPkgName': 'required',
				'dispToWardDName': 'required',
				'dispToWardQty': {
					required: true,
					number: true
				}
				//'sellDrugPresc': 'required'
			},
			messages: {
				dispToWardDate: "<i style='color:red;'>Please enter Date<i>",
				dispToWardName: "<i style='color:red;'>Please enter Customer Name<i>",
				dispToWardPkgName: "<i style='color:red;'>Please Choose Package Type<i>",
				dispToWardDName: "<i style='color:red;'>Please Choose Drug Name<i>",
					
				dispToWardQty: {
					required: "<i style='color:red;'>Please Enter Quantity<i>",
					number: "<i style='color:red;'>Invalid Quantity<i>"
				}
				//sellDrugPresc: "<i style='color:red;'>Please Enter Prescriptions<i>"
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

$('#dispToWardForm').ajaxForm({
	//target:"#content",
	beforeSubmit:validatesellDrug() ,
	
	success:function(response) { 
		
		res = eval(response);
	
			 if(res==0){				
			$("#successMessage").html("<p>Successfully Added Transaction </p>").dialog('open');
			 $('#dispToWardForm').resetForm();
			 }else{
			 alert("Error: "+response);
			 }
   		 }
});

$("#CloseDispToWard").click(function(){closeTab(); });
$("#dispToWardSubmit").button();
$("#dispToWardPkgName").change(function(){
	$.post('check.php',{'getDrugNameFordispToWard': $("#dispToWardPkgName").val()},function(data) {	
		$("#dispToWardDName").empty().html(data);
	});

	//getTreatmentType

});

});
</script>
<a id="CloseDispToWard" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
 

 
<form id="dispToWardForm" action="dispatchtoward_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" readonly  size="10" type="text" id="dispToWardDate" name="dispToWardDate" /> </td>
</tr>
<tr>
<td><label>Ward Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="dispToWardName" name="dispToWardName" /> </td>
</tr><tr>
<td><label>Drug Package:</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="dispToWardPkgName" name="dispToWardPkgName" >
<?php getPackagingCombo();?>
</select>
 </td>
</tr>
<tr>
<td><label>Name of Drug:</label></td><td><select  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="dispToWardDName" name="dispToWardDName" >
<option value="">Select One</option>
</select>
</td>
</tr><tr>
<td><label>Quantity: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="6" type="text" id="dispToWardQty" name="dispToWardQty" /></td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="dispToWardSubmit" name="dispToWardSubmit" value="Dispatch To Ward" /></td>

</table>
</form>
</fieldset>