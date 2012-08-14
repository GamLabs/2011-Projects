<script>
    $(document).ready(function () {

    	//$.post('schedule_controller.php',{'apptDept': "department"},function(data) {
		//	$('#apptDepartment').html(data);
		//});
		
    	

    	function validateTheatre(){
			$('#theatreForm').validate({
				
					'rules':{
						'theartreDate': 'required',
						'theatreSurgeryName': 'required',
						'theatreSurType': 'required',
						'theatreScaNurse': 'required',
						'theatreSurgeon': 'required',
						'theatreAssSurgeon': 'required',
						'theatreAnesthetic': 'required',
						'theatreAnestheticType': 'required'
					},
					messages: {
						theartreDate: "<i style='color:red;'> Date is required!<i>",
						theatreSurgeryName: "<i style='color:red;'>Nameis  Required<i>",
						theatreSurType: "<i style='color:red;'>Surgery Type is  Required<i>",
						theatreScaNurse: "<i style='color:red;'>Nurse is Required<i>",
						theatreSurgeon   : "<i style='color:red;'>Surgeon is Reguired<i>"	,
						theatreAssSurgeon: "<i style='color:red;'>assistant Surgeon  is Required<i>",
						theatreAnesthetic: "<i style='color:red;'>Anesthetic is Required<i>",
						theatreAnestheticType   : "<i style='color:red;'>Anesthetic Type is Required<i>"	
					},
								
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      //alert(errors);
					      if(errors){
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
    	
    	$("#showTheatreView").hide();
    	$('#pnTheatre').liveSearch({url: 'check.php?page=Theatre&liveSearchPnumber='+$('#pnTheatre').val()});
    	$('#livePnumberQueryTheatre').live('click',function(e){
    	$('#pnTheatre').val(($(this).text()));
    	 var pnumber = $('#pnTheatre').val();
    	$('#jquery-live-search').slideUp();
    	
    	$("#pnTheatreInput").val(pnumber);
    	var name = $(this).closest('tr').find('td:eq(1)').text();
    
    	$("#theatreHeaderInfo").empty().text("Theatre - "+name);
    	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#showTheatreView").show();	
			}else{
				confirmPrompt($("#showTheatreView"));
				//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
				//$("#showTheatreView").hide();
			}
		});
    	
    	e.stopImmediatePropagation();
		return false;
    	});
    	$("#theartreDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#apptFollowUp").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });

    	$('#theatreForm').ajaxForm({
			//target:"#content",
			beforeSubmit: validateTheatre(),
			success:function(response) { 
				
				var res = parseInt(response);
					 if(res == 0){
						// alert(response);
					$("#successMessage").html("Sucessfully Added Theatre").dialog('open');
					 $('#theatreForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
    	//$('#theatre-form').formly({'onBlur':true, 'theme':'Dark'});
    	$("#thaetreSubmit").button();
    	$("#CloseTheatre").click(function(){closeTab(); });
    	
    });

</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 14px;
	}
-->
</style>
<a id="CloseTheatre" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">

<label>Patient Number </label><input size="10" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pnTheatre" id="pnTheatre" />

</fieldset>
<br>
<div id="showTheatreView">
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
 <legend id="theatreHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Theatre</legend>
<form id="theatreForm" action="theatre_controller.php" method="post">
<input type="hidden" name="pnTheatreInput" id="pnTheatreInput">
	<table class="tdtext">
		<tr >
			<td><label>Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="15" type="text" id="theartreDate" name="theartreDate" /> </td>
		</tr>
		<tr>
			<td><label>Name of Surgery:</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="15" rows="3" id="theatreSurgeryName" name="theatreSurgeryName" > </textarea></td>
		</tr>
		<tr>
			<td><label>Surgery Type:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="15" type="text" id="theatreSurType" name="theatreSurType" /> </td>
		</tr>
		<tr>
			<td><label>Scrub Nurse:</label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="theatreScaNurse" id="theatreScaNurse" ></td>
		</tr>
		<tr>
			<td><label>Surgeon:</label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="15" type="text" id="theatreSurgeon" name="theatreSurgeon" /></td>
		</tr>
		<tr>
			<td><label>Surgeon Assistant:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="15" type="text" id="theatreAssSurgeon" name="theatreAssSurgeon" /></td>
		</tr>
		<tr>
			<td><label>Name of Anesthetict:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="15" type="text" id="theatreAnesthetic" name="theatreAnesthetic" /></td>
		</tr>
		<tr>
			<td><label>Type of Anesthetic:</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="theatreAnestheticType" name="theatreAnestheticType" >
															<option value="Local">Local</option>
															<option value="General">General</option>
															<option value="Scinal">Scinal</option>
															</select></td>
		</tr>
		<tr>
			<td></td><td><input  size="7" type="submit" id="thaetreSubmit" name="thaetreSubmit" value="Add Theatre" /></td>
		</tr>
	
	</table>
</form>
</fieldset>
</div>