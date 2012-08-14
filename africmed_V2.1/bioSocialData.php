<script>
$(document).ready(function () {
	$('form').validationEngine('hideAll');
	$("#labourTab").tabs();
	$("#labourTab").hide();
	
	$("#bioSocialDataSubmit").button();
	$("#labourHistorySubmit").button();
	$("#dateBioSocial").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});



	$("#pnumberBioSocial").keyup(function(){
		var charLength = $("#pnumberBioSocial").val().length;
		if(charLength != 8){
			$("#labourTab").hide();
		}else{
			//$("#labourTab").show();
		}
	});

	$('#pnumberBioSocial').liveSearch({url: 'check.php?page=BioSoc&liveSearchPnumber='+$('#pnumberBioSocial').val()});
	$('#livePnumberQueryBioSoc').live('click',function(){
	$('#pnumberBioSocial').val(($(this).text()));
	 var pnumber = $('#pnumberBioSocial').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#bioSocialDataHeaderInfo").empty().text("Patient Name - "+ name);
	
	$("#pnumberLabourRegistration").val($("#pnumberBioSocial").val());
	$("#dateLabourRegistration").val($("#dateBioSocial").val());
	$("#pnumberLabourHistory").val($("#pnumberBioSocial").val());
	$("#dateLabourHistory").val($("#dateBioSocial").val());	
	$("#biosocialRegUser").val($("#username").text());	
	$("#biosocialHistUser").val($("#username").text());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#labourTab").show();	
		}else{
			confirmPrompt($("#labourTab"));
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#labourTab").hide();
		}
	});
	
	});
	

	

	
	$('#labourRegistrationForm').ajaxForm({
		beforeSubmit: function(){return $("#labourRegistrationForm").validationEngine('validate');  },
		success:function(response) { 
			
				 if(response=="Sucess"){
					 $("#successMessage").dialog('open');;
				 $('#labourRegistrationForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});

	$('#labourHistoryForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
			
				 if(response=="Sucess"){
					 $("#successMessage").dialog('open');;
				 $('#labourHistoryForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});
	
	$("#CloseBiosocialData").click(function(){closeTab(); });
	
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
<a id="CloseBiosocialData" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form id="biosocialpndt" action="#" method="post">
<table>
<tr>
			
			<td><label>Patient Number </label></td><td><input size="10" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="pnumberBioSocial" id="pnumberBioSocial" /></td>
			
			
</tr>
</table>

</form>
</fieldset>
<span class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="bioSocialDataHeaderInfo"></span><br>

<div id="labourTab">


	<ul>
   	 <li><a href="#labourRegistration">Registration</a></li>
   	 <li><a href="#labourHistory">History</a></li>
 	 </ul>
	
 	 <div id="labourRegistration">
 	 <form id="labourRegistrationForm" action="bioSocialData_Controller.php" method="post">
 	 <input type="hidden" name="pnumberLabourRegistration" id="pnumberLabourRegistration">
 	 <input type="hidden" name="dateLabourRegistration" id="dateLabourRegistration">
 	 <input   type="hidden" id="biosocialRegUser" name="biosocialRegUser" value=""/>
 	 
 	 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Registration</legend>
		<table class="tdtext">
		
			
			<tr>
			<td><label>Height </label></td><td><input size="10" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="height" id="height"/></br></td>
			</tr><tr>
			<td><label>Marital Status </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle" id="marital_status" name="marital_status"><option></option><option value="married" >Married</option><option value="single">Single</option> </select></td>
			</tr><tr>
			<td><label>Compound Name </label></td><td><input size="10" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="compound_name" id="compound_name"/></br></td>
			</tr><tr>
			<td><label>GR</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="gr" id="gr"/></br></td>
			</tr><tr>
			<td><label>Family Planning Method </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="fmMethod" id="fmMethod"/></br></td>
			</tr><tr>
			<td><label>Para </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="para" id="para"/></td>
			</tr><tr>
			<td><label>None </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="none" id="para"/></td>
			</tr>
			
		</table>
		
		</fieldset>
		<input type="submit" name="bioSocialDataSubmit" id="bioSocialDataSubmit" value="Register" />
 	 
 	 
 	 
 	 </form>
 	
 	  </div>
 	  
 	  <div id="labourHistory">
 	  
 	  <form id="labourHistoryForm" action="bioSocialData_Controller.php" method="post">
 	  <input type="hidden" name="pnumberLabourHistory" id="pnumberLabourHistory">
 	  <input type="hidden" name="dateLabourHistory" id="dateLabourHistory">
 	  <input   type="hidden" id="biosocialHistUser" name="biosocialHistUser" value=""/>
 	  <fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Immediate Family History</legend>
		<table class="tdtext">
			
			<tr>
			<td><label>TB </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="fh_tb" value="yes" /> Yes <input type="radio" name="fh_tb" value="no" /> No</td>
			</tr><tr>
			<td><label>Diabetes </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="fh_diabetes" value="yes" /> Yes <input type="radio" name="fh_diabetes" value="no" /> No</td>
			</tr><tr>
			<td><label>Multiple Births </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="fh_multiple_birth" value="yes" /> Yes <input type="radio" name="fh_multiple_birth" value="no" /> No</td>
			</tr><tr>
			<td><label>Other </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="fh_other" value="yes" /> Yes <input type="radio" name="fh_other" value="no" /> No</td>
			</tr>
			
		</table>
		
		</fieldset>
	  <fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Patient's History</legend>
		<table class="tdtext">
			
			<tr>
			<td><label>Anaemia </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_anaemia" value="yes" /> Yes <input type="radio" name="ph_anaemia" value="no" /> No</td>
			</tr><tr>
			<td><label>Toxemia </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_toxemia" value="yes" /> Yes <input type="radio" name="ph_toxemia" value="no" /> No</td>
			</tr><tr>
			<td><label>High B.P </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_high_bp" value="yes" /> Yes <input type="radio" name="ph_high_bp" value="no" /> No</td>
			</tr><tr>
			<td><label>T.B </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_tb" value="yes" /> Yes <input type="radio" name="ph_tb" value="no" /> No</td>
			</tr><tr>
			<td><label>Sickle Cell </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_sickle_cell" value="yes" /> Yes <input type="radio" name="ph_sickle_cell" value="no" /> No</td>
			</tr><tr>
			<td><label>P.I.D </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_pid" value="yes" /> Yes <input type="radio" name="ph_pid" value="no" /> No</td>
			</tr><tr>
			<td><label>Diabetes </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_diabetes" value="yes" /> Yes <input type="radio" name="ph_diabetes" value="no" /> No</td>
			</tr><tr>
			<td><label>Others </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="ph_others" value="yes" /> Yes <input type="radio" name="ph_others" value="no" /> No</td>
			</tr>
			
		</table>
		
		</fieldset>
		
		<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Menstrual History</legend>
		<table class="tdtext">
			
			<tr>
			<td><label>L.M.P </label></td><td><input type="radio" name="mh_lmp" value="yes" /> Yes <input type="radio" name="mh_lmp" value="no" /> No</td>
			</tr><tr>
			<td><label>Regular (28 days) </label></td><td><input type="radio" name="mh_regular" value="yes" /> Yes <input type="radio" name="mh_regular" value="no" /> No</td>
			</tr>
			
		</table>
		
		</fieldset>
		<br/>
		<table class="tdtext">
			
			<tr>
			<td><label>E.D.D </label><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="edd" /></td><td></td>
			</tr>
			<tr>
			<td><label>  Recommeded Place of Delivery:  </label></td><td><input type="radio" name="mh_lmp" value="Hospital" /> Hospital <input type="radio" name="mh_lmp" value="HealthCenter" /> H. Center <input type="radio" name="mh_lmp" value="Home" /> Home</td>
			</tr>
			
		</table>
		
		<input type="submit" name="labourHistorySubmit" id="labourHistorySubmit" value="Submit" />
 	  
 	  </form>
 	  
 	  
 	  
 	  </div>
 </div>