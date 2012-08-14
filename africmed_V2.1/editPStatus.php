<script>
$(document).ready(function(){
		$("#editStatusMainDiv").hide();
		$("#editStatusSubmit").button();
	$('#editStatusPnumber').liveSearch({url: 'privateBillsController.php?page=editStatus&liveSearchPnumber='+$('#editStatusPnumber').val()});
	$('#livePnumberQueryeditStatus').live('click',function(e){
	$('#editStatusPnumber').val(($(this).text()));
	var pnumber = $('#editStatusPnumber').val();
	$.post('check.php',{'getStatusForP': pnumber},function(data) {
		//var dt = parseInt(data);
		//alert(data);
		$("#statusInfoDiv").html(data);
	
	});
	$("#editStatuspn").val(pnumber);
	$('#jquery-live-search').slideUp();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	//$("#privateBillsHeaderInfo").empty().text("Bills For  - "+ name);
	//var name = $(this).closest('tr').find('td:eq(1)').text();
	$("#editStatusMainDiv").show();
	e.stopImmediatePropagation();
	return false;

	});

	function validEditStatus(){
		$('#editStatusPatient').validate({
			
				'rules':{
					
					'editStatus': 'required',
					'editStatusinsurance': 'required',
					'editStatuspolicyId': 'required',
					'editStatuscompany': 'required',
					'editStatuscompanyno': 'required'
					
					
				},
				messages: {
					
					editStatus: "<i style='color:red;'>Required<i>",
					editStatusinsurance: "<i style='color:red;'>Required<i>",
					editStatuspolicyId: "<i style='color:red;'>Required<i>",
					editStatuscompany: "<i style='color:red;'>Required<i>",
					editStatuscompanyno: "<i style='color:red;'>Required<i>"

				},
				invalidHandler: function(form, validator) {
				      var errors = validator.numberOfInvalids();
				      if(errors){
				    	 // $("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
					    return false;
				      }else{
					      return true;
				      }
				}
		});
}
	$('#editStatusPatient').ajaxForm({
		beforeSubmit: validEditStatus(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('Successfully Edited ').dialog('open');
					$('#editStatusPatient').resetForm();
				}else{
					$("#successMessage").html('Sorry, There is an Error').dialog('open');
				}
				
				
			}
		//}
	});
	
	$('#editStatus').change(function() {
		var val=$("#editStatus").val();
		if(val == "INSURANCE") {
			$('#editStatusinsurance').removeAttr('disabled');
			$('#editStatuspolicyId').removeAttr('disabled');
			$('#editStatuscompanyno').val("0");
			$('#editStatuspolicyId').val("");
			//POPULATE INSURANCE SELECT BOX IF ENABLED
			$.post('reception_controller.php',{'InsuranceVal':val},function(data) {
	    			if(data){
		    			$("#editStatusinsurance").html(data);
	    			}else{
	    				$("#editStatusinsurance").html("");
	    			}
	    	});
	    	
			$('#editStatuscompany').attr('disabled', true);
			$('#editStatuscompanyno').attr('disabled', true);
		}else if(val == "COMPANY") {
			
			$('#editStatuscompany').removeAttr('disabled');
			$('#editStatuscompanyno').removeAttr('disabled');
			$('#editStatuspolicyId').val("0");
			$('#editStatuscompanyno').val("");
			//POPULATE COMPANY SELECT BOX IF ENABLED
			$.post('reception_controller.php',{'CompanyVal':val},function(data) {
    			if(data){
	    			$("#editStatuscompany").html(data);
    			}else{
    				$("#editStatuscompany").html("");
    			}
    		});
			
			
			$('#editStatusinsurance').attr('disabled', true);
			$('#editStatuspolicyId').attr('disabled', true);
		}else{
			$('#editStatuspolicyId').val("0");
			$('#editStatuscompanyno').val("0");
			$('#editStatuscompany').attr('disabled', true);
			$('#editStatuscompanyno').attr('disabled', true);
			$('#editStatusinsurance').attr('disabled', true);
			$('#editStatuspolicyId').attr('disabled', true);
		}
	
});

	 $("#editStatus").change(function(){
	        var val = $("#editStatus").val();
			if(val == "PRIVATE"){
				$("#editStatusinsuranceSection").hide();
				$("#editStatusemployerSection").hide();
				

			}else if(val == "COMPANY"){
				$("#editStatusinsuranceSection").hide();
				$("#editStatusemployerSection").show();

			}else if(val == "INSURANCE"){
				$("#editStatusinsuranceSection").show();
				$("#editStatusemployerSection").hide();

			}else{
				$("#editStatusinsuranceSection").hide();
				$("#editStatusemployerSection").hide();
			}
			
     });






});


</script>

<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact">Edit Patient's Status</legend>
				<table border="0" class="tdtext">
					<tr >
							<td><label>Patient Name/Number: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="editStatusPnumber" name="editStatusPnumber"/></td>
							
					</tr>
				</table>
</fieldset>
<div id="statusInfoDiv"></div>
<div id="editStatusMainDiv">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			 <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>New Patient's Status</i></b></legend>
			 <form id="editStatusPatient" action="patientStatus_Controller.php" method="post">
			 <input type="hidden" id="editStatuspn" name="editStatuspn" />
			 <table cellpadding = "0" class="tdtext">
			 <tr>
			  
					    	<td width="60%">&nbsp; Status<br><Select  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="editStatus" id="editStatus"  >
							<option value=""></option>
					    	<option value="PRIVATE">Private</option>
					     	<option value="COMPANY">Employer</option>
					     	<option value="INSURANCE">Insurance</option>
				     </Select></td>
			  
			  </tr>
			  <tr id="editStatusinsuranceSection" style="display: none">
			  		 
					    	<td>&nbsp; Insurance<br><Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="editStatusinsurance" id="editStatusinsurance"  disabled >
					    	<option value='NONE'>Select Insurance</option>
				     			 </Select></td>
			  		<td width="60%">&nbsp; Policy Number<br>
				     <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="editStatuspolicyId" id="editStatuspolicyId"  size="10" value="0" disabled /></td>
			  
			  </tr>
			  <tr id="editStatusemployerSection" style="display: none">
			  		<td>&nbsp; Employer<br>
					    	<Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="editStatuscompany" id="editStatuscompany"  disabled >
					    			<option value='NONE'>Select Employer</option>
				     			 </Select></td>
			  		<td>&nbsp; Employee Number<br>
				     <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="editStatuscompanyno" id="editStatuscompanyno" size="10" value="0" disabled /></td>
			  
			  </tr>
			  <tr>
				<td><input type="submit" id="editStatusSubmit" name="editStatusSubmit" value="Edit Status" /></td>
				
			 </tr>
			 </table>
			 </form>
			 
	 </fieldset>
	 </div>