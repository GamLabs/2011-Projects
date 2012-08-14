<?php require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
?>

<script>
    $(document).ready(function () {
    	$("#consulinvestigationDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
    	$('form').validationEngine('hideAll');
	$("#myAccordion").accordion({
		active:false,
		animated: "bounceslide"
	});
	 $("#queueDialog").hide();
	 $("#hideTab").hide();
	 $("#output").hide();
	$("#submitGeneral").button();
	$("#resetGeneral").button();
	$("#submitExam").button();
	$("#resetExam").button();
	
	$("#basic_checkupSubmit").button();
	$("#pmh_asthma_date").datepicker({
    	showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		yearRange: '1800:2050',
        dateFormat: 'yy-mm-dd'

    });
	$("#pmh_admission_date").datepicker({
    	showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		yearRange: '1800:2050',
        dateFormat: 'yy-mm-dd'

    });
	$("#pmh_surgery_date").datepicker({
    	showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		yearRange: '1800:2050',
        dateFormat: 'yy-mm-dd'

    });
	$("#gencheckupDate").datepicker({
    	showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		yearRange: '1800:2050',
        dateFormat: 'yy-mm-dd'

    });

	
		
	 $("#basic_investtable").dialog({ autoOpen:false,width:600,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });

	 $("#CloseConsultation").click(function(){
		
			closeTab();
		});
		
	$("#conQueue").button();
	$("a").click(function(){
		$('form').validationEngine('hideAll');
	});
	 
	$("#consult").button();
	$("#conQueue").click(function(){
		
		$("#queueDialog").dialog('open');
		$.post('queue.php',{status:'CHECKUP'},function(data) {
			$("#queueDialogContent").html(data);
		});
		
	});

	$(".toggle").change(function(){
		if($(this).val()=="yes"){
			//alert($(this).parent().find('div').html());
			$(this).parent().find('div').show();
		}else if($(this).val()=="no"){
			$(this).parent().find('div').hide();
		}
	});

	$('#pnumber').liveSearch({url: 'check.php?page=ConsulInfo&liveSearchPnumber='+$('#pnumber').val()});
	$('#livePnumberQueryConsulInfo').live('click',function(e){
	$('#pnumber').val(($(this).text()));
	var pnumber = $('#pnumber').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#conExaminationHeaderInfo").empty().text("Patient Name - "+ name);
	$("#pnumberGeneral").val(pnumber);
	$("#pnumberExam").val(pnumber);
	$("#pnumberDiag").val(pnumber);
	$("#checkUpDateGeneral").val($("#checkUpDate").val());
	$("#checkUpDateExam").val($("#checkUpDate").val());
	$("#checkUpDateDiag").val($("#checkUpDate").val());
	
	$("#pnBasicCheck").val(pnumber);
	$("#dtBasicCheck").val($("#checkUpDate").val());
	
		$.post('check.php',{'isMale': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
			$("#onlyFemales").hide();
			}else{
				$("#onlyFemales").show();
			}
	});

		$.post('check.php',{'hasVisitNum': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#hideTab").show();	
			}else{
				confirmPrompt($("#hideTab"));
				//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
				//$("#hideTab").hide();
			}
		});
		e.stopImmediatePropagation();
		return false;
	});

	
	
	$("#queueDialog table tr td > a").live('click',function(){
		var pnumber = $(this).closest('tr').find('td:eq(0)').text();
		/*
		$.post('check.php',{'getInfoPn': pnumber},function(data) {
			$("#output").html(data);
			});
			
			*/
		$("#hideTab").show();
		
		$("#pnumber").val(pnumber);
		$("#queueDialog").dialog('close');
		
		//alert( $(this).closest('tr').find('td:eq(2)').text().substr(0,10));
		//  var date = $(this).closest('tr').find('td:eq(2)').text().substr(0,10);
		//$("#checkUpDate").val(date);
		$("#pnumberGeneral").val(pnumber);
		$("#pnumberExam").val(pnumber);
		$("#pnumberDiag").val(pnumber);
		$("#checkUpDateGeneral").val($("#checkUpDate").val());
		$("#checkUpDateExam").val($("#checkUpDate").val());
		$("#checkUpDateDiag").val($("#checkUpDate").val());
		
		$("#pnBasicCheck").val(pnumber);
		$("#dtBasicCheck").val($("#checkUpDate").val());
	});
	
		
		$("#pnumberGeneral").val(pnumber);
		$("#pnumberExam").val(pnumber);
		$("#pnumberDiag").val(pnumber);
		$("#checkUpDateGeneral").val($("#checkUpDate").val());
		$("#checkUpDateExam").val($("#checkUpDate").val());
		$("#checkUpDateDiag").val($("#checkUpDate").val());
		$("#checkupGeneralUser").val($("#username").text());
		$("#checkupExamUser").val($("#username").text());
	
		
	
	});
    
    $("#checkUpDate").change(function(){
    	$("#checkUpDateGeneral").val($("#checkUpDate").val());
		$("#checkUpDateExam").val($("#checkUpDate").val());
		$("#checkUpDateDiag").val($("#checkUpDate").val());
		$("#dtBasicCheck").val($("#checkUpDate").val());

    });
    /*
	$("#pnumber").keyup(function(){
		var charLength = $("#pnumber").val().length;
		if(charLength != 8){
			
			$("#hideTab").hide();
			
		}else{
			
			var pnumber = $("#pnumber").val();
			$.post('check.php',{'pnumber': pnumber},function(data) {
				var val=eval(data);
				if(val == 0){
					$("#hideTab").show();
					$("#output").show();
				}else if (val == 1){
					$("#pnumber").val("");
					$("#hideTab").hide();
					$("#errorMessage").html("<p><font size=5> This Patient Is Not Yet Booked For Consultation!!</font></p>").dialog('open');
				}else if(val == 2){
					$("#pnumber").val("");
					$("#hideTab").hide();
					$("#errorMessage").html("<p><font size=5> Choose From The Queue!!</font></p>").dialog('open');
				}else{
					$("#pnumber").val("");
					$("#hideTab").hide();
					$("#errorMessage").html("<p><font size=5> Patient Doesnt Exist!!</font></p>").dialog('open');
				}
			});
			
			$("#pnumberGeneral").val(pnumber);
			$("#pnumberExam").val(pnumber);
			$("#pnumberDiag").val(pnumber);
			$("#pnBasicCheck").val(pnumber);
			$("#checkUpDateGeneral").val($("#checkUpDate").val());
			$("#checkUpDateExam").val($("#checkUpDate").val());
			$("#checkUpDateDiag").val($("#checkUpDate").val());
			$("#dtBasicCheck").val($("#checkUpDate").val());
			$("#checkupGeneralUser").val($("#username").text());
			$("#checkupExamUser").val($("#username").text());
		}
		
	});
		*/

	
	$("#submit").click(function(){
	
	
	});
	$("#reset").click(function(){
		$("#hideTab").hide();
		 $("#output").hide();
	});
	
	$("#checkupTab").tabs();
	$("#lastMensDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$("#checkUpDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$("#followUpDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$("#phyexamdate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	

	$("#temp_skinRash").change(function(){
		
		if($("#temp_skinRash").val()=="yes"){
			
			$("#skinrashLocation").show();
		}else{
			
			$("#skinrashLocation").hide();
		
		}
	});
	
	
	 	$("#advanced_checkup").click(function(){
	 		$("#hideTab").show();
	 		$("#basicExamination").hide();
	 		
		 });
	 	$("#basic_checkup").click(function(){
	 		$("#hideTab").hide();
	 		$("#basicExamination").show();
	 		
		 });

	 	
	 	
	 	
	 	
	 	
				 	
	 	
	 	
	
	 	
	 	//$('#consulationpndt').formly({'onBlur':false, 'theme':'Dark'});
	 	//$('#basicCheckup').formly({'onBlur':false, 'theme':'Dark'});
	 	//$('#checkupGeneral').formly({'onBlur':false, 'theme':'Dark'});
	 	//$('#checkupExam').formly({'onBlur':false, 'theme':'Dark'});
	 	$("fieldset.collapsed").collapse({ closed : true });
	 	
		$("#rlabour").change(function(){
		 	
		 	if($('#rlabour').is(":checked")){
			 
		 		$.post('check.php',{'updateLabourPn':$('#pnumber').val(),'labourValue':'LABOUR'},function(){
			 		
		 		});
		 	}
				 	
	 		
	 	});
	
		$('#checkupGeneral').ajaxForm({
			//target:"#content",
			beforeSubmit: validateGeneralCheckUp(),
			success:function(response) { 
				//alert(response);
					 if(response == "Success"){
						// alert(response);
					$("#successMessage").html("Successfully submitted").dialog('open');
					 $('#checkupGeneral').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
		function validateGeneralCheckUp(){
			$('#checkupGeneral').validate({
				
					'rules':{
						'gencheckupDate': 'required',
						'hypertension': 'required',
						'diabetic': 'required',
						'allergy': 'required',
						'ph_smoking':	'required',
						'ph_alcohol': 'required',
						
						'fh_diabetic': 'required',
						'fh_hypertension': 'required',
						'fh_cancer': 'required',
						'fh_heartProblem':	'required',
						'fh_sicklecell': 'required',
						'fh_asthma': 'required',
						'pmh_asthma': 'required',
						'pmh_admission': 'required',
						'pmh_surgery':	'required',
						'pmh_cholesterol': 'required',
						'mentalHealth': 'required',
						'currentMedication':	'required'
						
					},
					messages:{
						'gencheckupDate': "<i style='color:red;'>Please Choose Date<i>",
						
						'hypertension': "<i style='color:red;'>Required<i>",
						'diabetic': "<i style='color:red;'>Required<i>",
						'allergy': "<i style='color:red;'>Required<i>",
						'ph_smoking':	"<i style='color:red;'>Required<i>",
						'ph_alcohol': "<i style='color:red;'>Required<i>",
						
						'fh_diabetic': "<i style='color:red;'>Required<i>",
						'fh_hypertension': "<i style='color:red;'>Required<i>",
						'fh_cancer': "<i style='color:red;'>Required<i>",
						'fh_heartProblem':	"<i style='color:red;'>Required<i>",
						'fh_sicklecell': "<i style='color:red;'>Required<i>",
						'fh_asthma': "<i style='color:red;'>Required<i>",
						'pmh_asthma': "<i style='color:red;'>Required<i>",
						'pmh_admission': "<i style='color:red;'>Required<i>",
						'pmh_surgery':	"<i style='color:red;'>Required<i>",
						'pmh_cholesterol': "<i style='color:red;'>Required<i>",
						'mentalHealth': "<i style='color:red;'>Required<i>",
						'currentMedication':	"<i style='color:red;'>Required<i>"
						
					},
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					     // alert(errors);
					      if(errors){
					    	 // $("#errorMessage").html("<p style='color:red;'>Please Fill All Required Fields!</p>").dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
		
		function validateCheckUpExam(){
			$('#checkupExam').validate({
				
					'rules':{
						'basic_temperature': 'required',
						'basic_weight': 'required',
						'basic_height': {
									'required':true,
									'number':true
								},
						'basic_bp': 'required',
						'basic_pulse': 'required',
						'basic_complains': 'required',
						'phyexamdate':	'required'
						
					},
					messages: {
						basic_temperature: "<i style='color:red;'>Please enter Temperature<i>",
						basic_weight: "<i style='color:red;'>Please Enter Weight<i>",
						basic_height: "<i style='color:red;'>Please Enter Height<i>",	
						basic_bp: "<i style='color:red;'>Please Enter Blood Pressure<i>",
						basic_pulse:  "<i style='color:red;'>Please Enter Pulse<i>",
						basic_complains: "<i style='color:red;'>Please Enter Complains<i>",
						phyexamdate: "<i style='color:red;'>Please Choose a Date<i>"
					
					},
					invalidHandler: function(form, validator) {
						
					      var errors = validator.numberOfInvalids();
					     // alert(errors);
					      if(errors){
					    	 // $("#errorMessage").html("<p style='color:red;'>Please Fill All Required Fields!</p>").dialog('open');
						    return false;
					      }else{
					    	  
						      return true;
					      }
					}
			});
		}
		
		/*
		function validateCheckupExam(){
			return $("#checkupExam").validationEngine('validate');
		}
		*/
		$('#checkupExam').ajaxForm({
			//target:"#content",
			
			beforeSubmit: validateCheckUpExam(),
			success:function(response) { 
				//alert(response);
					 if(response == "Success"){
						 $("#basic_investtable").html();
						 $("#basic_investtable").load('consuldiagnosis_dialog.php');
						$("#basic_investtable").dialog('open');
					//$("#successMessage").dialog('open');
					 $('#checkupExam').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
		
		$('#checkupDiag').ajaxForm({
			//target:"#content",
			success:function(response) { 
			
					 if(response == "Success"){
							 $("#consulinvestigationDialog").html();
							$("#consulinvestigationDialog").load('diagnosis_dialog.php');
							$("#consulinvestigationDialog").dialog('open');
						 
					//createInvestDialog();
					$("#successMessage").dialog('open');
					 $('#checkupDiag').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
		
		$('#basicCheckup').ajaxForm({
			//target:"#content",
			
			success:function(response) { 
			
					 if(response){
					
					 $("#successMessage").dialog('open');
					 $('#basicCheckup').resetForm();
					 $("#basic_investtable").hide();
					 
					 }else{
					 alert("Error: "+response);
					 }
           		 }
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
<a id="CloseConsultation" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>


<form id="consulationpndt" method="post" name="consulationpndt">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<table class="tdtext">
	<tr>
		<td>
			<label>Patient Number </label> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="pnumber" name="pnumber" />
		</td>
		<td><!-- <label style="float: right" id="conQueue" >Show Queue</label> --></td>
	</tr>
</table>

</fieldset>
</form>

<span class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="conExaminationHeaderInfo"></span>

<div style="display: none" id="basic_investtable" title="Preliminary Investigation Dialog">


</div>


 
 
 <div style="display: none" id="pnumberError" title="Error">
 <p>Patient Number Does Not Exist</p>

 </div>



<br />
<!-- 
<div style="display: none" id="basicExamination">
<form id="basicCheckup" action="basicExam_controller.php" method="post">
<input   type="hidden" id="pnBasicCheck" name="pnBasicCheck"/>
<input   type="hidden" id="dtBasicCheck" name="dtBasicCheck"/>



<input type="submit" id="basic_checkupSubmit" name="basic_checkupSubmit" value="Submit">
</form>
</div>

 -->
<div style="display: none" id="hideTab">

<!-- 
 <fieldset class="collapsed">
 <legend><a href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Patient's Last Visist</a></legend>
  <div id="output">
  
 </div>
 </fieldset>
-->

<div id="checkupTab">
	<ul>
   	<li><a href="#physical">Physical/Mental  Examination</a></li> 
   	<li><a href="#general">General History</a></li>
 	 </ul>


<div id="checkup"> 
<div id="general">

<form id="checkupGeneral" action="checkup_controller.php" method="post">

<input   type="hidden" id="pnumberGeneral" name="pnumberGeneral"/>

<input   type="hidden" id="checkupGeneralUser" name="checkupGeneralUser" value=""/>


<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">General</legend>

<table class="tdtext">
<tr>
<td><label>Date </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" readonly type="text" size="10" id="gencheckupDate" name="gencheckupDate" /></br></td>
</tr>

	<tr id="onlyFemales">
	<td><label>Last Mentrual Date </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" readonly type="text" size="10" id="lastMensDate" name="lastMensDate" /></br></td>
	</tr>
<tr>
<td><label>Hypertension </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="hypertension" value="yes" /> Yes <input type="radio" name="hypertension" value="no" /> No</br></td>
</tr>
<tr>
<td><label>Diabetic </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="diabetic" value="yes" /> Yes <input type="radio" name="diabetic" value="no" /> No  </br> </td>
</tr>
<tr>
<td><label>Allergy </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="allergy" value="yes" /> Yes <input type="radio" name="allergy" value="no" /> No   </br></td>
</tr>

</table>
</fieldset>

<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">History</legend>
<table class="tdtext">
<tr>
<td>
Personel History:</br>
<table class="tdtext">
      <tr>
	<td><label>Smoking </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="ph_smoking" value="yes" /> Yes <input type="radio" name="ph_smoking" value="no" /> No</br></td>
	</tr>
	<tr>
	<td><label>Alcohol </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="ph_alcohol" value="yes" /> Yes <input type="radio" name="ph_alcohol" value="no" /> No</br></td>
	</tr>
      
</table></br></br>
Family History:</br>
<table class="tdtext">
      <tr>
		<td><label>Diabetic </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_diabetic" value="yes" /> Yes <input type="radio" name="fh_diabetic" value="no" /> No</td>
		</tr><tr>
		<td><label>Hypertension </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_hypertension" value="yes" /> Yes <input type="radio" name="fh_hypertension" value="no" /> No</td>
		</tr><tr>
		<td><label>Cancer </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_cancer" value="yes" /> Yes <input type="radio" name="fh_cancer" value="no" /> No</td>
		</tr><tr>
		<td><label>Heart Problem </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_heartProblem" value="yes" /> Yes <input type="radio" name="fh_heartProblem" value="no" /> No</td>
		</tr><tr>
		<td><label>Sickle Cell </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_sicklecell" value="yes" /> Yes <input type="radio" name="fh_sicklecell" value="no" /> No</td>
		</tr><tr>
		<td><label>ASthma </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="radio" name="fh_asthma" value="yes" /> Yes <input type="radio" name="fh_asthma" value="no" /> No</br></td>
		</tr>
      
</table></br></br>

Past Medical History:
<table border="0" class="tdtext">
      <tr valign="top" style="white-space: nowrap;">
		<td><label>Asthma </label></td><td style="text-align:right;"><input  type="radio" class="toggle" name="pmh_asthma" value="yes" /> Yes <input type="radio" class="toggle" name="pmh_asthma" value="no" /> No<div style="display: none"  >&nbsp  <label>Date of Last Attack</label><input size="10" type="text" name="pmh_asthma_date"  id="pmh_asthma_date"/></div></br></td>
		</tr><tr valign="top">
		<td><label>Admission </label></td><td style="text-align:right;"><input  type="radio" class="toggle" name="pmh_admission" value="yes" /> Yes <input type="radio" class="toggle" name="pmh_admission" value="no" /> No<div style="display: none"  >&nbsp  <label>Date</label><input size="10" type="text" name="pmh_admission_date" id="pmh_admission_date" /></div></br></td>
		</tr><tr  valign="top">
		<td><label>Surgery </label></td><td style="text-align:right;"><input  type="radio" class="toggle" name="pmh_surgery" value="yes" /> Yes <input type="radio" class="toggle" name="pmh_surgery" value="no" /> No<div style="display: none"  >&nbsp  <label>Date </label><input size="10" type="text" name="pmh_surgery_date"  id="pmh_surgery_date" /></div></br></td>
		</tr><tr valign="top">
		<td><label>Cholesterol </label></td><td style="text-align:right;"><input  type="radio" class="toggle" name="pmh_cholesterol" value="yes" /> Yes <input type="radio" class="toggle" name="pmh_cholesterol" value="no" /> No<div style="display: none"  >&nbsp  <label>Amount/Level </label><input size="10" type="text" name="pmh_cholesterol_level"  /></div></br></td>
		</tr>
      
</table>



</td>	

</tr>
<tr>
<td align="top"><label>Mental Health</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="4" cols="20" id="mentalHealth" name="mentalHealth">  </textarea>   </br></td>
</tr>
<tr>
<td align="top"><label>Current medication</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="4" cols="20" id="currentMedication" name="currentMedication">  </textarea>   </br></td>
</tr>
</tr>
</table>
</fieldset>
<input id="submitGeneral" type="submit" value="Submit">
</form>
</div>

</div>
 

<div id="physical">
<form id="checkupExam" action="phyexam_controller.php" method="post">
<input   type="hidden" id="pnumberExam" name="pnumberExam"/>

<input   type="hidden" id="checkupExamUser" name="checkupExamUser" value=""/>


<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Physical Examination</legend>


<table class="tdtext">
	<tr><td><label>Date</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" readonly size="10" type="text" name="phyexamdate" id="phyexamdate" /></td></tr>
	<tr><td><label>Temperature ('C) </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="4" type="text" name="basic_temperature" id="basic_temperature" /></td></tr>
	<tr>
	<td><label>Weight (Kg) </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="4" type="text" name="basic_weight"  id="basic_weight"/></td>
	</tr><tr>
	<td><label>Height (Cm) </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="4" type="text" name="basic_height" id="basic_height" /></td>
	</tr>
	<tr>
	<td><label>BP </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="4" type="text" name="basic_bp" id="basic_bp"/></td>
	</tr><tr>
	
	<td><label>Pulse</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="4" type="text" name="basic_pulse" id="basic_pulse"/></td>
	</tr>
	<tr>
	<td><label>Complains</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" rows="6" cols="30" id="basic_complains" name="basic_complains" id="basic_complains">  </textarea> </td>
	</tr>
	
</table>


<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed " >
<legend style="font-size:19px;" class="ui-widget ui-widget-header ui-corner-all"><a href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Extended Examination</a></legend>
<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed">
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+General</a></legend>
<table>
	
	<tr>        
	<td><label>Pallor </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="temp_pallor" value="yes" /> Yes <input type="radio" name="temp_pallor" value="no" /> No</td>
	
	<td><label>Hydration </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="temp_hydration" /></br></td>
	</tr><tr>
	<td><label>Jaundice </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="temp_jaundice" value="yes" /> Yes <input type="radio" name="temp_jaundice" value="no" /> No</td>
	
	<td><label>Fnger Clubbing </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="temp_fingerClubbing" value="yes" /> Yes <input type="radio" name="temp_fingerClubbing" value="no" /> No</td>
	</tr><tr valign="top">
	<td><label>Skin Rash </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" class="toggle" name="temp_skinRash" id="temp_skinRash" value="yes" /> Yes <input type="radio" class="toggle" name="temp_skinRash" id="temp_skinRash" value="no" /> No<div style="display: none" id="skinrashLocation" >&nbsp  <label>Location </label><input size="10" type="text" name="skinRashLocation"  /></div></td>
	
	<td><label>Lymphnodes </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="temp_lymphnodes" value="yes" /> Yes <input type="radio" name="temp_lymphnodes" value="no" /> No</td>
	</tr><tr>
	<td><label>Other </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="temp_other" /></td>
	</tr>
	
</table>

</fieldset>
<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed ">
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+CVS</a></legend>
<table>
      <tr>
	<td><label>BP </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="cvs_bp" /></br></td>
	
	<td><label>Pluse%</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="cvs_pluse" /></br></td>
	</tr><tr>
	<td><label>JVP </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="cvs_jvp" /></br></td>
	
	<td><label>Oedema </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="cvs_oedema" /></br></td>
	</tr>
      
      
</table>

</fieldset>
<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed " >
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Chest</a></legend>
<table>
      <tr>
	<td><label>RR </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_rr" name="chest_rr"/></br></td>

	<td><label>SP02% </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_sp02" name="chest_sp02"/></br></td>
	</tr>
	<tr>
	<td><label>FEV1 </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_fev1" name="chest_fev1"/></br></td>
	
	<td><label>Wheezing </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_wheezing" name="chest_wheezing"/></br></td>
	</tr>
	<tr>
	<td><label>Crepitation </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_crepitation" name="chest_crepitation"/></br></td>
	
	<td><label>Air Entry </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" id="chest_airentry" name="chest_airentry"/></br></td>
	</tr>
      
</table>

</fieldset>
<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed " >
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Abdoment</a></legend>
<table>
      <tr>
	<td><label>BS </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_bs"/></br></td>

	<td><label>Guarding </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_guarding"/></br></td>
	</tr>
	<tr>
	<td><label>Rebound </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_rebound"/></br></td>
	
	<td><label>Mass </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_mass"/></br></td>
	</tr>
	<tr>
	<td><label>Ascitis </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_ascitis"/></br></td>
	
	<td><label>Rectal Exam </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_rectalExam"/></br></td>
	</tr>
	<tr>
	<td><label>Viginal Exam </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text"  name="abdoment_viginalExam"/></td>
	</tr>
      
</table>


</fieldset>
<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed " >
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Neurology</a></legend>
<table>
	
	<tr>
	<td><label>Cranial Nerves </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_cranialNerves" /></td>
	
	<td><label>Swallowing & Speech </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_swallowingSpeech" /></td>
	</tr><tr>
	<td><label>Reflexes </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_reflexes" /></td>
	
	<td><label>power </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_power" /></td>
	</tr><tr>
	<td><label>Tones </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_tones" /></td>
	
	<td><label>Sensation </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_sensation" /></td>
	</tr><tr>
	<td><label>Babinsky </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neurology_babinsky" /></td>
	</tr>
	
</table>

</fieldset>

<fieldset class=" ui-widget-content ui-corner-all inputStyle collapsed " >
<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><a  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Mental Examination</a></legend>

<table>
<tr>
		<td><label> Paranoia </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_paranoia" /></td>
		
		<td><label>Delusions </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_delusions" /></td>
		</tr><tr>
		<td><label>Hallucinations </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_hallucinations" /></td>
		
		<td><label>Cognition & memory </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_cognition" /></td>
		</tr><tr>
		<td><label>Abnormal Beliefs</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_abnormalBeliefs" /></td>
		
		<td><label>Insights</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="ftd_insights" /></td>
</tr>
</table>


<table>

		<tr>
		<td><label>A+B </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mentalexam_ab" /></td>
		
		<td><label>Speech </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mentalexam_speech" /></td>
		</tr><tr>
		<td><label>Homicidal </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mentalexam_homicidal" /></td>
		
		<td><label>Suicidal </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="mentalexam_suicidal" /></td>
		</tr>


</table>

</fieldset>
</fieldset>
</fieldset>



<input id="submitExam" type="submit" value="Submit">
</form>
   
</div>
</div>	





 




</div>
<div id="consulinvestigationDialog" style="display: none" title="Investigation Dialog">

</div>
