<script>
$(document).ready(function () {
	
	$("#antenatalRecordDiv").hide();
	$("#antenatalRecordGo").button();
	$("#antenatalRecordSubmit").button();
	

	

	$("#pnAntenatalRecord").keyup(function(){
		var charLength = $("#pnAntenatalRecord").val().length;
		if(charLength != 8){
			$("#antenatalRecordDiv").hide();
		}else{
			
		}
	});

	$('#pnAntenatalRecord').liveSearch({url: 'check.php?page=Antenatal&liveSearchPnumber='+$('#pnAntenatalRecord').val()});
	$('#livePnumberQueryAntenatal').live('click',function(){
	$('#pnAntenatalRecord').val(($(this).text()));
	 var pnumber = $('#pnAntenatalRecord').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#antenatalRHeaderInfo").empty().text("Antenatal Record - "+ name);
	
	$("#pnumberAntenatalRecord").val($("#pnAntenatalRecord").val());
	$("#dateAntenatalRecord").val($("#dtAntenatalRecord").val());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#antenatalRecordDiv").show();	
		}else{
			confirmPrompt($("#antenatalRecordDiv"));
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#antenatalRecordDiv").hide();
		}
	});
	});

	//$('#antenatalpndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#antenatalRecordForm').formly({'onBlur':false, 'theme':'Dark'});

	$('#antenatalRecordForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
			
				 if(response=="Sucess"){
				 $("#successMessage").dialog('open');
				 $('#antenatalRecordForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});

	$("#CloseAntenatal").click(function(){closeTab(); });

});


</script>
<style>
<!--
.tdtext {
	 /* white-space: nowrap; */
	  vertical-align: top;
	  color: aqua;
	  font-size: 14px;
	}
-->
</style>
<a id="CloseAntenatal" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form id="antenatalpndt" action="" method="post">
<table class="tdtext">
<tr>
			<td><label>Patient Number </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" size="10" type="text" name="pnAntenatalRecord" id="pnAntenatalRecord"/></td>
			
</tr>
</table>
</form>
</fieldset>
</br>
<div id="antenatalRecordDiv">
<form id="antenatalRecordForm" action="antenatalRecord_Controller.php" method="post">
<input type="hidden" name="pnumberAntenatalRecord" id="pnumberAntenatalRecord">
 <input type="hidden" name="dateAntenatalRecord" id="dateAntenatalRecord">



<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<legend id="antenatalRHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Antenatal Record</legend>
<table class="tdtext">		
			<tr>
				<td><label>Weight </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="weight" /></td>
				<td><label>B.P</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="bp" /></td>
			</tr>
			<tr>
				<td><label>Oedema </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="oedema" /></td>
			</tr>
</table>
<br/>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Ob. Exam</legend>
		<table class="tdtext">
			
			<tr>
				<td><label>Fundamental Ht. </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="obe_fundal_ht" /></td>
				<td><label>Pres. pos. </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="obe_press_poss" /></td>
			</tr>
			<tr>
				<td><label>F.H</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="obe_fh" /></td>
			</tr>
		</table>
		
</fieldset>
<br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Lab. Investigation</legend>
		<table class="tdtext">
			<tr>
			<td><label>Urine </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="li_urine" /></td>
			<td><label>H.B. </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="li_hb" /></td>
			</tr><tr>
			<td><label>VDRL</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="li_vdrl" /></td>
			<td><label>Sickle</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="li_sickle" /></td>
			</tr>
		</table>
</fieldset>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<table class="tdtext">
<tr>
			<td><label>Vaccination Doses </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="vaccination_dosses" /></td>
				<td><label>Medications </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="medications" /></td>
			</tr>
			<tr>
				<td><label>Next Followup Date </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="followup_date" /></td>
			</tr>
</table>
</fieldset>
		<input type="submit" name="antenatalRecordSubmit" id="antenatalRecordSubmit" value="Register" />
</form>
</div>