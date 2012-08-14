<script>

$("#addInvest").button();
$("#investigation").change(function(){
	if($("#investigation").val() !="Select One"){
	$.post('check.php',{'investigation': $("#investigation").val(),'forwho':$("#investigationFor").val()},function(data) {
			
			$("#investigationType").empty().html(data);
			
		});
	}else{
		$("#investigationType").empty().html("<option>Select One</option>");
	}
	});

		$("#investigationFor").change(function(){
			$("#investigation").val("");
		});

	

	$("#addInvest").click(function(){
		if($("#investigationType").val() !="Select One"){
			$.post('check.php',{'investPnumber':$('#pnDiagnosis').val(),'investCategory': $("#investigation").val(),'investType': $("#investigationType option:selected").text(),'investFor':$("#investigationFor").val()},function(data) {
			
				$("#addedInvest").empty().html(data);
				});
		$("#addedInvest").append($("#investigationType").val()+"</br>");
		}
	});

	


	$("td").delegate('a','click',function(){
		var id = $(this).attr('class');
		$.post('check.php',{'deleteInvestigationById':id,'pn':$('#pnDiagnosis').val()},function(data){
			$("#addedInvest").empty().html(data);
			//alert(data);
		});
		//alert('dont click me '+cl);
	});


</script>


<fieldset class="ui-widget ui-widget-content ui-corner-all">

<legend class="ui-widget ui-widget-header ui-corner-all">Investigations</legend>
<table>
<tr >
<td><label>Test For:</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"    id="investigationFor" name="investigationFor" >
								<option value="gambian">Gambian</option>
								<option value="nongambian">Non Gambian Resident</option>
								<option value="visitor">Non Gambian Visitor</option>
</select>
</td>
</tr>
<tr>

<td><label>Type</label></td>
<td>
<select id="investigation" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">
<option value="">Select One</option><option value="4001" >Laboratory</option>

    <optgroup label="Radiology">
       <option value="4002" >X-Ray</option>
       <option value="4003">Scans</option>
       <option>Others</option>
    </optgroup>


</select>
</td>
</tr>
<tr>
<td><label>Type of Test </label></td>
<td>
<select id="investigationType" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">
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