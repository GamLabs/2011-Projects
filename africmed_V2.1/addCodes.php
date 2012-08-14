<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>

    $(document).ready(function () {
	$("#addCodesSubmit").button();
    	function validateAddCodes(){
			$('#addCodesForm').validate({
				
					'rules':{
						'codeDesc': 'required',
						'codeType': 'required',
						
						
						'codeNumber': {
							'required':true,
							'number':true
						}
					},
					messages: {
						codeDesc: "<i style='color:red;'>Code Description is Required<i>",
						codeType: "<i style='color:red;'>Code Description is Required<i>",
						codeNumber: {
							required: "<i style='color:red;'>Code is Required<i>",
							number: "<i style='color:red;'>Invalid Code Number<i>"
						}
					},
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      if(errors){
					    	  $("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
	}
	$('#addCodesForm').ajaxForm({
		beforeSubmit: validateAddCodes(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Code</p>').dialog('open');
					$('#addCodesForm').resetForm();
				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
			}
		//}
	});
    	
    


    
		$("#CloseCodes").click(function(){closeTab(); });
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
<a id="CloseCodes" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >Add Codes </legend>
						<form id="addCodesForm" name="addCodesForm" method="post" action="addcodes_controller.php">
							<table>
							<tr>
						  	<td><label>Code Number:</label></td>
						  	<td>
								<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="codeNumber" size="10" id="codeNumber" />
							</td>
							</tr>
							<tr>
						  	<td><label>Type:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="codeType"  id="codeType" >
								<option value="">Select One</option>
								<option value="expense">Expense</option>
								<option value="income">Income</option>
								<option value="product">Product</option>
								
								</select>
							</td>
							</tr>   
							<tr>
						  	<td><label>Code Description:</label></td>
						  	<td>
								<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="codeDesc" size="20" id="codeDesc" />
							</td>
							</tr> 
							  
							 <tr><td></td>
							 <td>
							 <input type="submit" id="addCodesSubmit" name="addCodesSubmit" value="Add Code"/ >
							</td>
							</tr>
							</table>
							</form>
					
				</fieldset>
				
			
				
			
			

