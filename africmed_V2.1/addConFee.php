<script>
    $(document).ready(function () {
    	//$('form').validationEngine('hideAll');

    	function validateAddConFee(){
			$('#addConFeeForm').validate({
				
					'rules':{
						'addConFee': 'required',
						'addConFeeAmount': {
							'required':true,
							'number':true
						},
						'addConFeeNominalCode': {
							'required':true,
							'number':true
						}
			
					},
					messages: {
						addConFee: "<i style='color:red;'>Consultation is Required<i>",
						addConFeeAmount: {
							required:	"<i style='color:red;'>Amount is Required<i>",
							number :	"<i style='color:red;'>Amount Must be a Number<i>"
						},
						addConFeeNominalCode: {
							required:	"<i style='color:red;'>Nominal Code is Required<i>",
							number :	"<i style='color:red;'>Nominal Code Must be a Number<i>"
						}	
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
    	$('#addConFeeForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddConFee(),
			
			success:function(response) { 
				res = eval(response);
					 if(res==1){
						$("#successMessage").html("<p>Consulation Successfully Added</p>").dialog('open');
						 $('#addConFeeForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p>Fail to Add Consultation</p>").dialog('open');
					 }
           		 }
		});
    	$("#CloseAddConFee").click(function(){closeTab(); });
    	//$('#addConFeeForm').formly({'onBlur':false, 'theme':'Dark'});
    	$("#SubmitConFee").button();
    	$("#editConFees").button();
    	

    	$("#editConFees").click(function(){
			$("#addeditConFeePage").html("");
			$("#addeditConFeePage").load('editConFee.php');
	
		});
    });

</script>
<style>
<!--
.tdtext {
	 /* white-space: nowrap;*/
	  vertical-align: top;
	  color: aqua;
	  font-size: 12px;
	}
-->
</style>
<a id="CloseAddConFee" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="addeditConFeePage">

 <fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
  <a id="editConFees" style="float: right;font-size:12" href="#">Edit Consulation Fees</a>
<form id="addConFeeForm" action="addConFeeController.php" method="post">
	<table class="tdtext">
		<tr>
			<td><label>Consultation Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="addConFee" name="addConFee" /> </td>
		</tr>
		<tr>
			<td><label>Nominal Code:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="addConFeeNominalCode" name="addConFeeNominalCode" /> </td>
		</tr>
		<tr>
			<td><label>Amount:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" id="addConFeeAmount" name="addConFeeAmount" /></td>
		</tr>
		<tr>
			<td><input  size="7" type="submit" id="SubmitConFee" name="SubmitConFee" value="Add" /></td>
		</tr>
	</table>
</form>
</fieldset>
</div>