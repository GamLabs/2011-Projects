<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
?>


<script>

$(document).ready(function(){
$("#selldrugDate").datepicker({
	showOtherMonths: true,
	selectOtherMonths: true,
	changeMonth: true,
	changeYear: true,
	showButtonPanel: true,
	yearRange: '1800:2050',
    dateFormat: 'yy-mm-dd'

});


function validatesellDrug(){
	$('#sellDrugForm').validate({
		
			'rules':{
				'selldrugDate':'required',
				'selldrugFName': 'required',
				'sellDrugPkgName': 'required',
				'sellDrugDName': 'required',
				'sellDrugQty': {
					required: true,
					number: true
				}
				//'sellDrugPresc': 'required'
			},
			messages: {
				selldrugDate: "<i style='color:red;'>Please enter Date<i>",
				selldrugFName: "<i style='color:red;'>Please enter Customer Name<i>",
				sellDrugPkgName: "<i style='color:red;'>Please Choose Package Type<i>",
				sellDrugDName: "<i style='color:red;'>Please Choose Drug Name<i>",
					
				sellDrugQty: {
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

$('#sellDrugForm').ajaxForm({
	//target:"#content",
	beforeSubmit:validatesellDrug() ,
	
	success:function(response) { 
		
		res = eval(response);
	
			 if(res==0){				
			$("#successMessage").html("<p>Successfully Added Transaction </p>").dialog('open');
			 $('#sellDrugForm').resetForm();
			 }else{
			 alert("Error: "+response);
			 }
   		 }
});

$("#CloseSellDrug").click(function(){closeTab(); });
$("#sellDrugSubmit").button();
$("#sellDrugPkgName").change(function(){
	$.post('check.php',{'getDrugNameForSellDrug': $("#sellDrugPkgName").val()},function(data) {	
		$("#sellDrugDName").empty().html(data);
	});

	//getTreatmentType

});

});
</script>
<a id="CloseSellDrug" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
 

 
<form id="sellDrugForm" action="selldrug_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" readonly  size="10" type="text" id="selldrugDate" name="selldrugDate" /> </td>
</tr>
<tr >
<td><label>Full Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="selldrugFName" name="selldrugFName" /> </td>
</tr><tr>
<td><label>Drug Package:</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="sellDrugPkgName" name="sellDrugPkgName" >
<?php getPackagingCombo();?>
</select>
 </td>
</tr>
<tr>
<td><label>Name of Drug:</label></td><td><select  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="sellDrugDName" name="sellDrugDName" >
<option value="">Select One</option>
</select>
</td>
</tr><tr>
<td><label>Quantity: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="6" type="text" id="sellDrugQty" name="sellDrugQty" /></td>
</tr><tr>
<td><label>Prescriptions/Usage: </label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="4" id="sellDrugPresc" name="sellDrugPresc"></textarea></td>
</tr>
<tr><td></td><td><input  size="10" type="submit" id="sellDrugSubmit" name="sellDrugSubmit" value="Sell" /></td>

</table>
</form>
</fieldset>