
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('form').validationEngine('hideAll');

$("#submitDiag").button();
$("#resetDiag").button();
$("#submitPreAssess").button();



$("#diagnosis").hide();
$("#diagnosisAccordion").hide();
$("#diagQueue").button();
$("#assesfollowUpDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
$("#dtPreAss").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
$("#checkUpDateDiag").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});


$("#dtDiagnosis").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});


$("#investigationDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#treatmentDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#finalAssesment").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#provDiaglog").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
$("#admitDialogMessage").dialog({ autoOpen:false,minWidth: 300,modal:true,buttons: { "Yes": function() { $(this).dialog("close");admit() },"No": function() { $(this).dialog("close"); } } });
$("#releaseDialogMessage").dialog({ autoOpen:false,minWidth: 300,modal:true,buttons: { "Yes": function() { $(this).dialog("close");release() },"No": function() { $(this).dialog("close"); } } });

	function admit(){
		$.post('check.php',{'admittedPn': $("#pnDiagnosis").val()},function(data) {
			var val = parseInt(data);
			if(val == 0){
				 $("#successMessage").html('<p> Patient Successfully Admitted</p>').dialog('open');
			}else{
				 $("#errorMessage").html('<p>Patient Already  Admitted</p>').dialog('open');	
			}
			});
	}

	function release(){
		$.post('check.php',{'releasePn': $("#pnDiagnosis").val()},function(data) {
			var val = parseInt(data);
			if(val == 0){
				 $("#successMessage").html('<p> Patient Successfully Released</p>').dialog('open');
			}else{
				 $("#errorMessage").html('<p>Patient Already  Released</p>').dialog('open');	
			}
			});
	}

function validate(){
	return  $("#diagnosispndt").validationEngine('validate');
	
	
}
$("#investigationLink").click(function(){

	if(validate()){
		$("#investigationDialog").html();
		$("#investigationDialog").load('diagnosis_dialog.php');
	$("#investigationDialog").dialog('open');
	}
});

$("#prescriptionLink").click(function(){
	if(validate()){
		$("#treatmentDialog").html();
		$("#treatmentDialog").load('treatment_dialog.php');
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

$("#releasePatientLink").click(function(){
	
	$("#releaseDialogMessage").dialog('open');
	
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

		$('#pnDiagnosis').liveSearch({url: 'check.php?page=DiagnosisPInfo&liveSearchPnumber='+$('#pnDiagnosis').val()});
		$('#livePnumberQueryDiagnosisPInfo').live('click',function(e){
		$('#pnDiagnosis').val(($(this).text()));
		var pnumber = $('#pnDiagnosis').val();
		$('#jquery-live-search').slideUp();
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
		$.post('check.php',{'hasVisitNum': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#diagnosis").show();	
			}else{
				confirmPrompt($("#diagnosisAccordion"));
				//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
				//$("#diagnosis").hide();
			}
		});
		e.stopImmediatePropagation();
		return false;
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
/*	
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
*/

$("#CloseDiagnosis").click(function(){
	
	closeTab();
});


	//$('#diagnosispndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#finalAssesmentForm').formly({'onBlur':false, 'theme':'Dark'});
	//$('#preAssesmentForm').formly({'onBlur':false, 'theme':'Dark'});
function validateFinalAssess(){
	$('#finalAssesmentForm').validate({
		
			'rules':{
				'checkUpDateDiag': 'required',
				'assessment': 'required',
				'assesfollowUpDate':'required',		
			},
			messages: {
				checkUpDateDiag: "<i style='color:red;'>Please enter Date<i>",
				assessment: "<i style='color:red;'>Please write Something Here<i>",
				assesfollowUpDate: "<i style='color:red;'>Please enter Date<i>",
		
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
	$('#finalAssesmentForm').ajaxForm({
		//target:"#content",
		beforeSubmit:validateFinalAssess() ,
		success:function(response) { 
				var val = eval(response);
				 if(val == 0){
					 $("#successMessage").dialog('open');
					 $('#finalAssesmentForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p>"+response+"</p>");
					 $("#errorMessage").dialog('open');
				 }
       		 }
	});

	function validatePreAssess(){
		$('#preAssesmentForm').validate({
			
				'rules':{
					'dtPreAss': 'required',
					'preassesment': 'required',		
				},
				messages: {
					dtPreAss: "<i style='color:red;'>Please enter Date<i>",
					preassesment: "<i style='color:red;'>Please write Something Here<i>"
			
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
	$('#preAssesmentForm').ajaxForm({
		//target:"#content",
		beforeSubmit:validatePreAssess() ,
		success:function(response) { 
		//alert(response);
				 if(response == "Success"){
					 $("#successMessage").html("Successfully Added").dialog('open');
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
<a id="CloseDiagnosis" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div style="display: none" id="admitDialogMessage" title="Confirm">
<p>Are you Sure</p>
</div>
<div style="display: none" id="releaseDialogMessage" title="Confirm">
<p>Are you Sure</p>
</div>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form id="diagnosispndt" action="#" method="post">
  <table class="tdtext">
  <tr>
   <td>
		<label>Patient Number </label><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="pnDiagnosis" name="pnDiagnosis"/>
  </td>
  <td>
		<!-- <label style="float: right" id="diagQueue" >Show Queue </label> -->
	</td>
	</tr>
 </table>
</form>
</fieldset><br>


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





<div id="provDiaglog" style="display: none" title="Provisional Diagnosis">
<form id="preAssesmentForm" action="preassesment.php" method="post">
<input   type="hidden" id="pnPreAss" name="pnPreAss"/>

<table>
<tr>
<td><label>Date</label></td>
<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" readonly type="text" id="dtPreAss" name="dtPreAss"/></td>
</tr>
<tr>
<td><label>Pre Assesment</label></td>
<td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="6" cols="30" id="preassesment" name="preassesment">  </textarea></td>

</tr>

</table>
<input type="submit" value="Submit" id="submitPreAssess" name="submitPreAssess" />
</form>
</div>

<div id="investigationDialog" style="display: none" title="Investigation Dialog">

</div>
<div id="treatmentDialog" style="display: none" title="Prescription Dialog">

</div>
<div id="finalAssesment" style="display: none" title="Final Assessment">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Final Assesment</legend>
<form id="finalAssesmentForm" action="diagnosis_controller.php" method="post"> 
<input   type="hidden" id="pnumberDiag" name="pnumberDiag"/>

<table>
<tr>
<td><label>Date</label></td>
<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" readonly type="text" id="checkUpDateDiag" name="checkUpDateDiag"/></td>
</tr>
<tr>
<td><label>Assesment &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></td>
<td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="5" cols="30" id="assessment" name="assessment">  </textarea></td>
</tr>
<tr>
<td><label>Follow Up Date</label></td>
<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" name="assesfollowUpDate" id="assesfollowUpDate" /></td>
</tr>
</table>
<input id="submitDiag" type="submit" value="Submit">&nbsp<input id="resetDiag" type="reset" value="Reset">
</form>
</fieldset>
</div>



