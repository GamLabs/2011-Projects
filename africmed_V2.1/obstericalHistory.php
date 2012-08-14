<script>
$(document).ready(function () {
	
	$("#obstericalHistoryDiv").hide();
	$("#obstericalHistoryGo").button();
	$("#obstericalHistorySubmit").button();
	

	
	$("#pnumberObsterical").keyup(function(){
		var charLength = $("#pnumberObsterical").val().length;
		if(charLength != 8){
			$("#obstericalHistoryDiv").hide();
		}else{
		}
	});

	$('#pnumberObsterical').liveSearch({url: 'check.php?page=Obsterical&liveSearchPnumber='+$('#pnumberObsterical').val()});
	$('#livePnumberQueryObsterical').live('click',function(){
	$('#pnumberObsterical').val(($(this).text()));
	 var pnumber = $('#pnumberObsterical').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#obstericalHHeaderInfo").empty().text("Obsterical History - "+ name);
	
	$("#pnumberObstericalHistory").val($("#pnumberObsterical").val());
	$("#dateObstericalHistory").val($("#dateObsterical").val());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#obstericalHistoryDiv").show();	
		}else{
			confirmPrompt($("#obstericalHistoryDiv"));
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#obstericalHistoryDiv").hide();
		}
	});
	
	
	});

	//$('#obstericalpndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#obstericalHistoryForm').formly({'onBlur':false, 'theme':'Dark'});

	$('#obstericalHistoryForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
			
				 if(response=="Sucess"){
					 $("#successMessage").dialog('open');
				 $('#obstericalHistoryForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});

	$("#CloseObsterical").click(function(){closeTab(); });

	
	
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
<a id="CloseObsterical" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form id="obstericalpndt" action="#" id="none" method="post">
<table class="tdtext">
<tr>
			<td><label>Patient Number </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" size="10" name="pnumberObsterical" id="pnumberObsterical" /></td>
			
</tr>
</table>
</form>
</fieldset>


<div id="obstericalHistoryDiv">
<form id="obstericalHistoryForm" action="obstericalHistory_Controller.php" method="post">
<input type="hidden" name="pnumberObstericalHistory" id="pnumberObstericalHistory">
 <input type="hidden" name="dateObstericalHistory" id="dateObstericalHistory">

<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend id="obstericalHHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Obsterical History</legend>
		<table class="tdtext">
			
			<tr>
			<td><label>Delivery Date </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_date" /></td>
			</tr><tr>
			<td><label>Duration of Pregnancy </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="pregnancy_duration" /></td>
			</tr><tr>
			<td><label>Antenatal care</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="antenaltal_care" value="yes" /> Yes <input type="radio" name="antenaltal_care" value="no" /> No</td>
			</tr><tr>
			<td><label>Birth Weight</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="birth_weight" /></td>
			</tr><tr>
			<td><label>Delivery Type</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_type" /></td>
			</tr><tr>
			<td><label>Delivery Place </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_place" /></td>
			</tr><tr>
			<td><label>Delivery Attendance </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_att" /></td>
			</tr><tr>
			<td><label>Comments </label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle" rows="4" cols="25" id="comments" name="comments">  </textarea> </td>
			</tr>
			
		</table>
		
</fieldset>
		<input type="submit" name="obstericalHistorySubmit" id="obstericalHistorySubmit"  value="Register" />

</form>
</div>