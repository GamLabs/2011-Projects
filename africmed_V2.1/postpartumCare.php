<script>
$(document).ready(function () {

	$("#postpartumcareDiv").hide();
	$("#postpartumCareGo").button();
	$("#postpartumCareSubmit").button();
	

	

	$("#pnPostpartumCare").keyup(function(){
		var charLength = $("#pnPostpartumCare").val().length;
		if(charLength != 8){
			$("#postpartumcareDiv").hide();
		}else{
			
		}
	});

	$('#pnPostpartumCare').liveSearch({url: 'check.php?page=Postpartum&liveSearchPnumber='+$('#pnPostpartumCare').val()});
	$('#livePnumberQueryPostpartum').live('click',function(){
	$('#pnPostpartumCare').val(($(this).text()));
	 var pnumber = $('#pnPostpartumCare').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#postPartumCHeaderInfo").empty().text("Postpartum Care - "+ name);

	
	$("#pnumberPostpartumCare").val($("#pnPostpartumCare").val());
	$("#datePostpartumCare").val($("#dtPostpartumCare").val());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#postpartumcareDiv").show();	
		}else{
			confirmPrompt($("#postpartumcareDiv"));
			//$("#postpartumcareDiv").show();	
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#postpartumcareDiv").hide();
		}
	});
	
	
	});

	//$('#postpartumcarepndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#postpartumCareForm').formly({'onBlur':false, 'theme':'Dark'});
	
	$('#postpartumCareForm').ajaxForm({
		//target:"#content",
		success:function(response) { 
			
				 if(response=="Sucess"){
				$("#successMessage").dialog('open');
				 $('#postpartumCareForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
					
				 }
       		 }
	});
	$("#ClosePostpartum").click(function(){closeTab(); });

	
	
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
<a id="ClosePostpartum" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form method="post" id="postpartumcarepndt">
<table>
<tr>
			<td><label>Patient Number </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" size="10" type="text" name="pnPostpartumCare" id="pnPostpartumCare"/></td>
			
</tr>
</table>
</form>
</fieldset>
<br>
<div id="postpartumcareDiv">

<form id="postpartumCareForm" action="postpartumCare_Controller.php" method="post">
<input type="hidden" name="pnumberPostpartumCare" id="pnumberPostpartumCare">
<input type="hidden" name="datePostpartumCare" id="datePostpartumCare">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend id="postPartumCHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Postpartum Care</legend>
		<table>
			
			<tr>
			<td><label>Immediate </label></td><td><input type="radio" name="immediate" value="yes" /> Yes <input type="radio" name="immediate" value="no" /> No</td>		
			<td><label>&nbsp&nbsp&nbsp&nbsp Date</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="immediate_date" /></br></td>
			</tr><tr>
			<td><label>After 1 Week</label></td><td><input type="radio" name="after1_week" value="yes" /> Yes <input type="radio" name="after1_week" value="no" /> No</td>	
			<td><label>&nbsp&nbsp&nbsp&nbsp Date</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="after1_week_date" /></br></td>
			</tr><tr>
			<td><label>At 6 Week </label></td><td><input type="radio" name="at6_week" value="yes" /> Yes <input type="radio" name="at6_week" value="no" /> No</td>
			<td><label>&nbsp&nbsp&nbsp&nbsp Date </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="at6_week_date" /></br></td>
			</tr>
			
		</table>
		
		</fieldset>
		<input type="submit" name="postpartumCareSubmit" id="postpartumCareSubmit" value="Register" />




</form>
</div>
