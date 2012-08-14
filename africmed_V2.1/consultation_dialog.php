<script type="text/javascript">
<!--
$("#basic_addInvest").button();
$("#referedButton").button();
	$("#referedButton").click(function(){
		//$("#referedButton").attr('disabled','true');
		//$("#referals").attr('disabled','true');
		$.post('check.php',{'referalsPn':$('#pnumber').val(),'referLoc':$("#referals option:selected").text()},function(data) {
	});
		$("#basic_investtable").dialog('close');
	});


	$("#basic_investigation").change(function(){
		if($("#basic_investigation").val() !="Select One"){
 		$.post('check.php',{'investigation': $("#basic_investigation").val()},function(data) {
 				
 				$("#basic_investigationType").empty().html(data);
 				
 			});

		}else{
			$("#basic_investigationType").empty().html("<option>Select One</option>");

		}
 		});
 	$("#basic_addInvest").click(function(){
		if($("#basic_investigationType").val() !="Select One"){
			$.post('check.php',{'investPnumber':$('#pnumber').val(),'investCategory': $("#basic_investigation option:selected").text(),'investType': $("#basic_investigationType option:selected").text()},function(data) {
				
				$("#basic_addedInvest").empty().html(data);
				});
		$("#basic_addedInvest").append($("#basic_investigationType").val()+"</br>");
		}
	});
	
$("#referals").change(function(){
		
 	if($("#referals option:selected").text()=="Investigations"){
	 
 		$("#investShowHideDiv").show();
 		}else if($("#referals option:selected").text()=="Labour"){
		$("#investShowHideDiv").hide();
		/*
				$.post('check.php',{'labourPn':$('#pnumber').val()},function(data) {
				});
		*/
		}else if ($("#referals option:selected").text()=="Doctor"){
			$("#investShowHideDiv").hide();
			/*
			$.post('check.php',{'doctorPn':$('#pnumber').val()},function(data) {
			});
			*/
		}else{
			$("#investShowHideDiv").hide();
		}
		
		
		
	});


$("td").delegate('a','click',function(){
	var id = $(this).attr('class');
	$.post('check.php',{'deleteInvestigationById':id,'pn':$('#pnumber').val()},function(data){
		$("#basic_addedInvest").empty().html(data);
		//alert(data);
	});
	//alert('dont click me '+cl);
});
//-->
</script>
<table class="tdtext">

<tr>
	<td>Referals</td><td>
	<select id="referals">
	<option>Choose One</option>
	<option>Investigations</option>
	<option>Labour</option>
	<option>Doctor</option>
	
	</select>
	</td>
	<td><button id="referedButton" name="referedButton" >Refered</button>  </td>
	<!--<input type="checkbox" name="showInvest" id="showInvest" value="yes" />Investigations  <input type="checkbox" name="rlabour" id="rlabour" value="labour" />Refer to Labour</td>  -->
	</tr>
</table>
<div style="display: none" id="investShowHideDiv">
<table class="tdtext">
<tr>

	<td><label>Type</label></td>
	<td>
	<select id="basic_investigation">
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
	<select id="basic_investigationType" >
	<option>Select One</option>
	</select>
	&nbsp&nbsp<label id="basic_addInvest">Add</label>
	</td>
	</tr>
	<tr>
	
	<td><label>Added Investigations </label></td>
	<td><div style="float: right" id="basic_addedInvest" >  </div></td>
	</tr>
</table>

</div>