<?php 

require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
?>
<script type="text/javascript">
<!--

$("#addTreat").button();
$("#treatment").change(function(){
	if($("#treatment").val()!="Select One"){
	$.post('check.php',{'treatment': $("#treatment").val()},function(data) {
		
			$("#treatmentType").empty().html(data);
		});
	}else{
		$("#treatmentType").empty().html("<option>Select One</option>");
	}
	});

$("#addTreat").click(function(){
	
	var val = isNaN($("#drugTreatQuantity").val());

	if($("#treatmentType").val()!="Select One"  && !val && $("#drugTreatQuantity").val() != ""){		
		$.post('check.php',{'treatmentPnumber':$('#pnDiagnosis').val(),'treatmentCategory': $("#treatment option:selected").val(),'treatmentType': $("#treatmentType option:selected").text(),'prescription':$("#treatmentPrescription").val(),'drugQuantity':$("#drugTreatQuantity").val()},function(data) {
			$("#treatmentPrescription").val("");
			
		$("#addedTreat").empty().html(data);
		$("#drugTreatQuantity").val("");
		});
	}else{
			$("#errorMessage").html("Drug category,Name and Quantity are required ").dialog('open');
		
	}
});


$("td").delegate('a','click',function(){
	var id = $(this).attr('class');
	//alert('dont click me '+id);
	$.post('check.php',{'deleteTreatmentById':id,'pn':$('#pnDiagnosis').val()},function(data){
		$("#addedTreat").empty().html(data);
		//alert(data);
	});

});
//-->
</script>

<fieldset class=" ui-widget-content ui-corner-all inputStyle">

<legend class="ui-widget ui-widget-header ui-corner-all">Treatment Plan</legend>
<table class="tdtext">
<tr>
<td><label>Drug Category</label></td>
<td>
<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="treatment" >
<?php getPackagingCombo();?>
</select>

</td>
</tr>

<tr>
<td><label>Name of Drug</label></td>
<td>
<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="treatmentType" >
<option>Select One</option></select>
</td>
</tr>
<tr>
<td><label>Quantity:</label></td>
<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="drugTreatQuantity" id="drugTreatQuantity"  size="3" /></td>
</tr>
<tr>
<td><label>Prescriptions/Usage:</label></td>
<td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="2" cols="30" id="treatmentPrescription" name="treatmentPrescription">  </textarea> &nbsp&nbsp<label id="addTreat">Add</label></td>

</tr>
<tr>
<td><label>Added Drugs </label></td>
<td><div class=" ui-widget-content ui-corner-all inputStyle" id="addedTreat" > </div>
</tr>
</table>


</fieldset>