
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('form').validationEngine('hideAll');

$("#submitDiag").button();
$("#resetDiag").button();
$("#addTreat").button();
$("#addInvest").button();
$("#diagnosis").hide();
$("#diagnosisAccordion").hide();
$("#diagQueue").button();
$("#assesfollowUpDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
$("#dtDiagnosis").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});


$("#investigationDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#treatmentDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#finalAssesment").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#provDiaglog").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#admitDialogMessage").dialog({ autoOpen:false,minWidth: 300,modal:true,buttons: { "Yes": function() { $(this).dialog("close");admit() },"No": function() { $(this).dialog("close"); } } });


	function admit(){
		$.post('check.php',{'admittedPn': $("#pnDiagnosis").val()},function(data) {
			var val = eval(data);
			if(val != 1){
				 $("#successMessage").html('<p> Patient Successfully Admitted</p>').dialog('open');
			}else{
				 $("#errorMessage").html('<p>Patient Already  Admitted</p>').dialog('open');	
			}
			});
	}

function validate(){
	return  $("#diagnosispndt").validationEngine('validate');
	
	
}
$("#investigationLink").click(function(){

	if(validate()){
	$("#investigationDialog").dialog('open');
	}
});

$("#prescriptionLink").click(function(){
	if(validate()){
	$("#treatmentDialog").dialog('open');
	}
});

$("#finalAssesmentLink").click(function(){
	if(validate()){
	$("#finalAssesment").dialog('open');
	}
});

$("#provDiagnosisLink").click(function(){
	if(validate()){
	$("#provDiaglog").dialog('open');
	}
});

$("#admitPatientLink").click(function(){
	if(validate()){
	$("#admitDialogMessage").dialog('open');
	}
});


 $('#dtDiagnosis').change(function(){
	 $("#checkUpDateDiag").val($("#dtDiagnosis").val());
	$("#dtPreAss").val($("#dtDiagnosis").val());
 });


$("#diagQueue").click(function(){
	$("#queueDialog").dialog('open');
	$.post('queue.php',{'status':'DOCTOR'},function(data) {
	$("#queueDialogContent").html(data);
	});
	
});
$("#queueDialog table tr td > a").live('click',function(){
	var pnumber = $(this).closest('tr').find('td:eq(0)').text();
	var date = $(this).closest('tr').find('td:eq(2)').text();
	//alert(substr(3,date));
	// var date = $(this).closest('tr').find('td:eq(2)').text().substr(0,10);
	// $("#dtDiagnosis").val(date);
	$("#diagnosis").show();
	$("#diagnosisAccordion").slideDown();
	$("#diagnosisAccordion").accordion();
	$("#pnDiagnosis").val(pnumber);
	$("#queueDialog").dialog('close');
	$("#addedTreat").html('');

	
	$("#pnDiagnosis").val(pnumber);
	$("#pnumberDiag").val(pnumber);
	
	$("#pnPreAss").val(pnumber);
	$("#checkUpDateDiag").val($("#dtDiagnosis").val());
	$("#dtPreAss").val($("#dtDiagnosis").val());
	$.post('check.php',{'getInfoPn': $("#pnDiagnosis").val()},function(data) {
	$("#diagnosis").html(data);
	});
});
	
$("#pnDiagnosis").keyup(function(){
	var charLength = $("#pnDiagnosis").val().length;
	if(charLength != 8){
		$("#diagnosis").hide();
		$("#diagnosisAccordion").hide();
		
	}else{
		var pnumber = $("#pnDiagnosis").val();
		//alert(pnumber);
		$.post('check.php',{'pnumberDiagnosis': pnumber},function(data) {
			var val=eval(data);
			if(val == 0){
				$("#diagnosis").show();
				$("#diagnosisAccordion").slideDown();
				$("#diagnosisAccordion").accordion();
				//alert(data);
			}else if (val == 1){
				$("#diagnosis").hide();
				$("#diagnosisAccordion").hide();
				$("#errorMessage").html("<p><font size=5> This Patient Is Not Yet Booked For Consultation!!</font></p>").dialog('open');
			}else if(val == 2){
				$("#diagnosis").hide();
				$("#diagnosisAccordion").hide();
				$("#errorMessage").html("<p><font size=5> Choose From The Queue!!</font></p>").dialog('open');
			
			}else{
				$("#diagnosis").hide();
				$("#diagnosisAccordion").hide();
				$("#errorMessage").html("<p><font size=5> Patient Doesnt Exist!!</font></p>").dialog('open');
			}
		});
		$.post('check.php',{'getInfoPn': $("#pnDiagnosis").val()},function(data) {
			$("#diagnosis").html(data);
			});
		
		$("#pnumberDiag").val(pnumber);
		$("#pnPreAss").val(pnumber);
		
		$("#checkUpDateDiag").val($("#dtDiagnosis").val());
		$("#dtPreAss").val($("#dtDiagnosis").val());
	}
});



$("#investigation").change(function(){
	$.post('check.php',{'investigation': $("#investigation").val()},function(data) {
			
			$("#investigationType").empty().html(data);
			
		});
	});

	$("#treatment").change(function(){
		$.post('check.php',{'treatment': $("#treatment").val()},function(data) {
				$("#treatmentType").empty().html(data);
			});
		});
	

	$("#addInvest").click(function(){
		if($("#investigationType").val() !="Choose One"){
			$.post('check.php',{'investPnumber':$('#pnDiagnosis').val(),'investCategory': $("#investigation option:selected").text(),'investType': $("#investigationType option:selected").text()},function(data) {
			
				$("#addedInvest").empty().html(data);
				});
		$("#addedInvest").append($("#investigationType").val()+"</br>");
		}
	});

	$("#addTreat").click(function(){
		
		if($("#treatmentType").val()!="Choose One"){
			
			$.post('check.php',{'treatmentPnumber':$('#pnDiagnosis').val(),'treatmentCategory': $("#treatment option:selected").text(),'treatmentType': $("#treatmentType option:selected").text(),'prescription':$("#treatmentPrescription").val()},function(data) {
				$("#treatmentPrescription").val("");
				
			$("#addedTreat").empty().html(data);
			});
	
		
		}
	});

	//$('#diagnosispndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#finalAssesmentForm').formly({'onBlur':false, 'theme':'Dark'});
	//$('#preAssesmentForm').formly({'onBlur':false, 'theme':'Dark'});
	
	$('#finalAssesmentForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
		
				 if(response == "Success"){
					 $("#successMessage").dialog('open');
				 $('#finalAssesmentForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p>"+response+"</p>");
					 $("#errorMessage").dialog('open');
				 }
       		 }
	});

	$('#preAssesmentForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
		//alert(response);
				 if(response == "Success"){
					 $("#successMessage").dialog('open');
				 $('#preAssesmentForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p>"+response+"</p>");
					 $("#errorMessage").dialog('open');
				 }
       		 }
	});

});
	
</script>
<style>
<!--
.tdtext {
	 /* white-space: nowrap;*/
	  vertical-align: top;
	  font-size: 14px;
	}
-->
</style>
<div style="display: none" id="admitDialogMessage" title="Confirm">
<p>Are you Sure</p>
</div>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="diagnosispndt" action="#" method="post">
  <table class="tdtext">
  <tr>
   <td>
		<label>Patient Number </label><input  size="10" type="text" id="pnDiagnosis" name="pnDiagnosis"/>
  </td>
  <td>
		<label style="float: right" id="diagQueue" >Show Queue </label>
	</td>
	</tr>
 </table>
</form>
</fieldset>


<div style="width: 300;;float: right;display: none" id="diagnosisAccordion" >
  <h2><a href="#">Diagnosis Menu</a></h2>
  
  	<div class="ui-widget">
 	<div class="ui-state-default  ">
    <a href="#" id="provDiagnosisLink">provisional Diagnosis</a></div>
    <div class="ui-state-default ">
    <a href="#" id="investigationLink">Investigation</a></div>
	<div class="ui-state-default ">
    <a href="#" id="prescriptionLink">Prescriptions</a></div>
    <div class="ui-state-default ">
    <a href="#" id="finalAssesmentLink">Final Assesment</a></div>
    <div class="ui-state-default ">
    <a href="#" id="admitPatientLink">Admit Patient</a></div>
    <div class="ui-state-default ">
    <a href="#" id="releasePatientLink">Release Patient</a></div>
	</div>
</div>
<div id="diagnosis" >

</div>





<div id="provDiaglog" style="display: none">
<form id="preAssesmentForm" action="preassesment.php" method="post">
<input   type="hidden" id="pnPreAss" name="pnPreAss"/>
<input   type="hidden" id="dtPreAss" name="dtPreAss"/>
<table>
<tr>
<td><label>Pre Assesment</label></td>
<td><textarea rows="6" cols="30" id="preassesment" name="preassesment">  </textarea></td>

</tr>

</table>
<input type="submit" value="Submit"  />
</form>
</div>

<div id="investigationDialog" style="display: none">
<fieldset class="ui-widget ui-widget-content ui-corner-all">

<legend class="ui-widget ui-widget-header ui-corner-all">Investigations</legend>
<table>
<tr>

<td><label>Type</label></td>
<td>
<select id="investigation">
<option>Select One</option><option value="lab_config" >Laboratory</option>

    <optgroup label="Radiology">
       <option value="xray_config" >X Ray</option>
       <option>ECG</option>
       <option>Ultrasound</option>
       <option>Others</option>
    </optgroup>


</select>
</td>
</tr>
<tr>
<td><label>Type of Test </label></td>
<td>
<select id="investigationType" >
<option>Select One</option>
</select>
&nbsp&nbsp<label id="addInvest">Add</label>
</td>
</tr>
<tr>

<td><label>Added Investigations </label></td>
<td><div style="float: right" id="addedInvest" >  </div></td>
</tr>
</table>


</fieldset>
</div>
<div id="treatmentDialog" style="display: none">
<fieldset class="ui-widget ui-widget-content ui-corner-all">

<legend class="ui-widget ui-widget-header ui-corner-all">Treatment Plan</legend>
<table>
<tr>
<td><label>Type</label></td>
<td>
<select id="treatment" >
<option>Select One</option><option value="tablet_config" >Tablets</option><option value="nontablet_config" >Non Tablets</option>
</select>

</td>
</tr>

<tr>
<td><label>Add Type</label></td>
<td>
<select id="treatmentType" >
<option>Select One</option></select>
</td>
</tr>
<tr>
<td><label>Prescriptions/Usage:</label></td>
<td><textarea rows="2" cols="30" id="treatmentPrescription" name="treatmentPrescription">  </textarea> &nbsp&nbsp<label id="addTreat">Add</label></td>

</tr>
<tr>
<td><label>Added Treatments </label></td>
<td><div id="addedTreat" > </div>
</tr>
</table>


</fieldset>
</div>
<div id="finalAssesment" style="display: none">
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<legend class="ui-widget ui-widget-header ui-corner-all">Final Assesment</legend>
<form id="finalAssesmentForm" action="diagnosis_controller.php" method="post"> 
<input   type="hidden" id="pnumberDiag" name="pnumberDiag"/>
<input   type="hidden" id="checkUpDateDiag" name="checkUpDateDiag"/>
<table>
<tr>
<td><label>Assesment &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></td>
<td><textarea rows="5" cols="30" id="assessment" name="assessment">  </textarea></td>
</tr>
<tr>
<td><label>Follow Up Date</label></td>
<td><input size="10" type="text" name="assesfollowUpDate" id="assesfollowUpDate" /></td>
</tr>
</table>
<input id="submitDiag" type="submit" value="Submit">&nbsp<input id="resetDiag" type="reset" value="Reset">
</form>
</fieldset>
</div>



