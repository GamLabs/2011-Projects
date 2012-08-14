<script>
$(document).ready(function () {
	$('form').validationEngine('hideAll');
	$("#labourDeliveryDiv").hide();
	$("#labourDeliveryGo").button();
	$("#labourDeliverySubmit").button();
	$("#dtLabourDelivery").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$("fieldset.collapsed").collapse({ closed : true });
	$("#deliveryDischargeNotesDiv").dialog({ autoOpen:false,minWidth: 700,modal:true,buttons: { "Close": function() { $(this).dialog("close");$('form').validationEngine('hideAll'); } } });
	
	
	$("#pnLabourDelivery").keyup(function(){
		var charLength = $("#pnLabourDelivery").val().length;
		if(charLength != 8){
			$("#labourDeliveryDiv").hide();
		}else{
			
		}
	});

	$('#pnLabourDelivery').liveSearch({url: 'check.php?page=LDelivery&liveSearchPnumber='+$('#pnLabourDelivery').val()});
	$('#livePnumberQueryLDelivery').live('click',function(){
	$('#pnLabourDelivery').val(($(this).text()));
	 var pnumber = $('#pnLabourDelivery').val();
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#labourDelivHeaderInfo").empty().text("Delivery Notes - "+ name);

	
	$("#pnumberLabourDelivery").val($("#pnLabourDelivery").val());
	$("#dateLabourDelivery").val($("#dtLabourDelivery").val());
	$("#pnumberLabourDeliveryD").val($("#pnLabourDelivery").val());
	$("#dateLabourDeliveryD").val($("#dtLabourDelivery").val());
	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
		var dt = parseInt(data);
		if(dt == 0){
			$("#labourDeliveryDiv").show();
		}else{
			confirmPrompt($("#labourDeliveryDiv"));
			//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
			//$("#labourDeliveryDiv").hide();
		}
	});
	
	
	});
	
	$("#addDeliveryDischargeLink").click(function(){
		//$("#pnumberLabourDeliveryD").val($("#pnLabourDelivery").val());
		//$("#dateLabourDeliveryD").val($("#dtLabourDelivery").val());
		if($("#labourdeliverypndt").validationEngine('validate')){
		$("#deliveryDischargeNotesDiv").dialog('open');
		}
	});
	
	//$('#labourdeliverypndt').formly({'onBlur':false, 'theme':'Dark'});
	//$('#labourDeliveryForm').formly({'onBlur':false, 'theme':'Dark'});
	//$('#labourDeliveryDischargeForm').formly({'onBlur':false, 'theme':'Dark'});

	
	$('#labourDeliveryForm').ajaxForm({
		beforeSubmit: function(){return $("#labourDeliveryForm").validationEngine('validate');  },
		success:function(response) { 
			
				 if(response=="Sucess"){
					 $("#successMessage").dialog('open');
				 $('#labourDeliveryForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p>"+response+"</p>");
					 $("#errorMessage").dialog('open');
				 }
       		 }
	});
	
	$('#labourDeliveryDischargeForm').ajaxForm({
		beforeSubmit: function(){return $("#labourDeliveryDischargeForm").validationEngine('validate');  },
		success:function(response) { 
			
				 if(response=="Sucess"){
					 $("#successMessage").dialog('open');
				 $('#labourDeliveryDischargeForm').resetForm();
				 }else{
					 $("#errorMessage").html("<p > Sorry: "+response+"</p>").dialog('open');
				 }
       		 }
	});

	$("#CloseLabDelivery").click(function(){closeTab(); });
	
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
<a id="CloseLabDelivery" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
<form method="post" id="labourdeliverypndt">
<table>
<tr>
			<td><label>Patient Number </label></td><td><input size="10" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="pnLabourDelivery" id="pnLabourDelivery"/></td>
			
			
			
</tr>
</table>
</form>
</fieldset>
<br>

<div id="labourDeliveryDiv">
<form id="labourDeliveryForm" action="labourDelivery_Controller.php" method="post">
<input type="hidden" name="pnumberLabourDelivery" id="pnumberLabourDelivery">
<input type="hidden" name="dateLabourDelivery" id="dateLabourDelivery">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend id="labourDelivHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Delivery Notes</legend>
		<a id="addDeliveryDischargeLink"  href="#" style="float: right;text-decoration:none;color:blue; font-size: 19;">+Add Discharge Notes</a>
		<table>
			
			<tr>
			<td><label>Time </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="time" id="time"/></br></td>
			</tr><tr>
			<td><label>Place</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="place" id="place"/></br></td>
			</tr><tr>
			<td><label>Delivered By </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivered_by" id="delivered_by"/></br></td>	
			</tr><tr>	
			<td><label>Designation</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="designation" id="designation"/></br></td>
			</tr><tr>
			<td><label>Mode of Delivery </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="delivery_mode" id="delivery_mode" value="SVD" /> SVD <input type="radio" name="delivery_mode" id="delivery_mode" value="Breech" /> Breech<input type="radio" name="delivery_mode" id="delivery_mode" value="Vaccum" /> Vaccum<input type="radio" id="delivery_mode" name="delivery_mode" value="CS" /> CS</td>
			</tr><tr>
			<td><label>Outcome: LB </label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="outcome" id="outcome" value="Death" /> Immediate Neonatal Death<input type="radio" name="outcome" id="outcome" value="FSB" /> FSB<input type="radio" id="outcome" name="outcome" value="MSB" /> MSB</td>
			</tr><tr>
			<td><label>Baby's Birth Weight </label></td><td> <input size="5" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="baby_weight" id="baby_weight"/>Kg</br></td>
			</tr><tr>
			<td><label>Apgar Score</label></td><td><input size="5" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="apgar_score" id="apgar_score"/></br></td>
			</tr><tr>
			<td><label>Neonatal Complications</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="neonatal_complications" id="neonatal_complications"/></br></td>
			</tr>
			
		</table>
		
		
		<input type="submit" name="labourDeliverySubmit" id="labourDeliverySubmit" value="Submit" />


</fieldset>
</form>
</br></br>
<div id="deliveryDischargeNotesDiv">
<form id="labourDeliveryDischargeForm" action="ldischarge_Controller.php" method="post">
<input type="hidden" name="pnumberLabourDeliveryD" id="pnumberLabourDeliveryD">
<input type="hidden" name="dateLabourDeliveryD" id="dateLabourDeliveryD">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Delivered Mother At Discharge</legend>
		<table>
			
			<tr>
			<td><label>BP (Blood Pressure) </label></td><td><input size="5" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_bp" id="delivery_bp"/></br></td>
			</tr><tr>
			<td><label>Pulse</label></td><td><input size="5" class=" ui-widget-content ui-corner-all inputStyle" type="text" name="delivery_pulse" id="delivery_pulse"/></br></td>
			</tr><tr>
			<td><label>Bleeding </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="delivery_bleeding" id="delivery_bleeding" value="yes" /> Yes <input type="radio" id="delivery_bleeding" name="delivery_bleeding" value="no" /> No</td>	
			</tr><tr>	
			<td><label>Episiotomy</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" type="radio" name="delivery_episiotomy" id="delivery_episiotomy" value="yes" /> Yes <input type="radio" id="delivery_episiotomy" name="delivery_episiotomy" value="no" /> No</td>
			</tr>
			
		</table>
		
		
		<input type="submit" name="labourDeliveryDSubmit" id="labourDeliverySubmitD" value="Submit" />


</fieldset>
</form>
</div>

</div>