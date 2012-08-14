<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

?>

<script type="text/javascript">

$(document).ready(function(){

$("#editConFeeBack").button();
$("#editConFeeSubmit").button();
$("#deleteConFeeSubmit").button();

$("#editConFeeSubmit").click(function(){
	var amount = $("#editConFeeAmount").val();
	var type = $("#editConFeeType").val();
	var bol = isNaN(amount);
	if(amount != "" && type != "" && !bol){
	
	$.post('editConFee_controller.php',{'editConFee': type,'amount':amount},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#successMessage").html("<i style='color:red;'>Successfully Edited</i>").dialog('open');
			refreshTab();
		}else if(dt == 2){
			$("#errorMessage").html("<i style='color:red;'>Some Patients Are Still Registered To This Company</i>").dialog('open');

		}
 		});
	}else{
		$("#errorMessage").html("<i style='color:red;'>Fee and Type  are  Required and Fee Should Be A Number</i>").dialog('open');
	}
});

$("#deleteConFeeSubmit").click(function(){
	var amount = $("#editConFeeAmount").val();
	var type = $("#editConFeeType").val();
	var bol = isNaN(amount);
	if( type != "" ){
	
		$.post('editConFee_controller.php',{'deleteConFee': type,'amount':amount},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#successMessage").html("<i style='color:red;'>Successfully Deleted</i>").dialog('open');
			refreshTab();
		}else if(dt == 2){
			$("#errorMessage").html("<i style='color:red;'>Some Patients Are Still Registered To This Company</i>").dialog('open');

		}
 		});
	}else{
		$("#errorMessage").html("<i style='color:red;'>Fee and Type  are  Required and Fee Should Be A Number</i>").dialog('open');

	}
});


$("#editConFeeBack").click(function(){
	refreshTab();
});


});
</script>
<fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
<a id="editConFeeBack" style="float: right;font-size:12" href="#">Back</a>
 

<table class="tdtext">
<tr>
<td><label>Consulation Type:</label></td>
<td>
<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   id="editConFeeType" name="editConFeeType" > 
<?php getConFeeCombo();?>
</select>
</td>
</tr><tr>
<td><label>Fee:</label></td>
<td>
<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="editConFeeAmount" name="editConFeeAmount" > 
</td>
</tr>
<tr><td></td><td><button id="editConFeeSubmit" name="editConFeeSubmit">Edit</button> <button id="deleteConFeeSubmit" name="deleteConFeeSubmit">Delete</button> </td></tr>

</table>

</fieldset>