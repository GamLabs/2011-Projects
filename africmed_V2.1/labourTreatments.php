<script>
$(document).ready(function () {

	$("#labourTreatmentsDiv").hide();
	$("#labourTreatmentsGo").button();
	$("#labourTreatmentsSubmit").button();
	

	

	$("#pnlabourTreatments").keyup(function(){
		var charLength = $("#pnlabourTreatments").val().length;
		if(charLength != 8){
			$("#labourTreatmentsDiv").hide();
		}else{
			
		}
	});

	$('#pnlabourTreatments').liveSearch({url: 'check.php?page=LTreatment&liveSearchPnumber='+$('#pnlabourTreatments').val()});
	$('#livePnumberQueryLTreatment').live('click',function(){
	$('#pnlabourTreatments').val(($(this).text()));
	 var pnumber = $('#pnlabourTreatments').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#labourTreatHeaderInfo").empty().text("Labour Treatment - "+ name);
	
	$("#pnumberLabourTreatments").val($("#pnlabourTreatments").val());
	$("#dateLabourTreatments").val($("#dtlabourTreatments").val());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#labourTreatmentsDiv").show();
		}else{
			confirmPrompt($("#labourTreatmentsDiv"));
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#labourTreatmentsDiv").hide();
		}
	});
	
	});

	//$('#labourtreatmentspndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#labourTreatmentsForm').formly({'onBlur':false, 'theme':'Dark'});

	$('#labourTreatmentsForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
			
				 if(response == "Sucess"){
				$("#successMessage").dialog('open');
				 $('#labourTreatmentsForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});
	$("#CloseLabTreatment").click(function(){closeTab(); });

	
	
});


</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 19px;
	}
-->
</style>
<a id="CloseLabTreatment" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form id="labourtreatmentspndt" method="post" >
<table class="tdtext">
<tr>
			<td><label>Patient Number </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" size="10" type="text" name="pnlabourTreatments" id="pnlabourTreatments"/></td>
			
</tr>
</table>
</form>
</fieldset>

<br>
<div id="labourTreatmentsDiv">
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="labourTreatmentsForm" action="labourTreatments_Controller.php" method="post">
<input type="hidden" name="pnumberLabourTreatments" id="pnumberLabourTreatments">
 <input type="hidden" name="dateLabourTreatments" id="dateLabourTreatments">
 
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend id="labourTreatHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Labour Treatment</legend>

 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">MIP/IPTs: </legend>
		<table class="tdtext">
			
			<tr>
			<td><label>IPT 1 Dose </label></td><td><input type="radio" name="mip_ipt1_dose" value="yes" /> Yes <input type="radio" name="mip_ipt1_dose" value="no" /> No</td>
			<td><label>&nbsp&nbsp&nbsp Date </label></td><td><input readonly class=" ui-widget-content ui-corner-all inputStyle"  type="text" name="mip_ipt1_date" /></td>
			</tr><tr>
			<td><label>IPT 2 Dose </label></td><td><input type="radio" name="mip_ipt2_dose" value="yes" /> Yes <input type="radio" name="mip_ipt2_dose" value="no" /> No</td>
			<td><label>&nbsp&nbsp&nbsp Date </label></td><td><input readonly class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mip_ipt2_date" /></td>
			</tr><tr>
			<td><label>Received LLN </label></td><td><input type="radio" name="mip_received_lln" value="yes" /> Yes <input type="radio" name="mip_received_lln" value="no" /> No</td>
			<td><label>&nbsp&nbsp&nbsp Date </label></td><td><input readonly class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mip_received_date" /></td>
			</tr>
			
		</table>
		
</fieldset>
<br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Treatment of Malaria: </legend>
		<table class="tdtext">
			
			<tr>
			<td><label>Treatment Date (If any)</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="tm_date" /></td>
			</tr><tr>
			<td><label>Drug</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle" rows="4" cols="25" id="tm_drug" name="tm_drug">  </textarea> </td>
			</tr>
			
			
		</table>
		
</fieldset>
<br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">STIs:</legend>
		<table class="tdtext">		
			<tr>
			<td><label>VD</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="sti_vd" /></td>	
			</tr><tr>
			<td><label>GUD </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="sti_gud" /></td>
			</tr><tr>
			<td><label>LAP in Preg.</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="sti_lap" /></td>
			</tr><tr>
			<td><label>Date Index Treated</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="sti_date_index_treated" /></td>
			</tr><tr>
			<td><label>Date Partner Treated</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="sti_date_partner_treated" /></td>			
			</tr>			
		</table>
		
</fieldset>



</fieldset>

<input type="submit" name="labourTreatmentsSubmit" id="labourTreatmentsSubmit" value="Register" />


</form>
</div>