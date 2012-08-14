<script>
    $(document).ready(function () {
    	//$('form').validationEngine('hideAll');

    	function validateAddIns(){
			$('#addInsuranceForm').validate({
				
					'rules':{
						'addinsurance': 'required',
						'insAddr': 'required',
						'insemail': 'email',
						'inscontact': {
							'required':true,
							'number':true
						}
					},
					messages: {
						addinsurance: "<i style='color:red;'>Name of Insurance is Required<i>",
						insAddr: "<i style='color:red;'>Address is Required<i>",
						inscontact: {
							required:	"<i style='color:red;'>Contact is Required<i>",
							number :	"<i style='color:red;'>Contact Must be a Number<i>"
						},
						insemail   : "<i style='color:red;'>Invalid Email<i>"	
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
    	$('#addInsuranceForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddIns(),
			
			success:function(response) { 
				res = eval(response);
					 if(res==1){
						$("#successMessage").html("<p>Insurance Successfully Added</p>").dialog('open');
						 $('#addInsuranceForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p>Fail to Add Insurance</p>").dialog('open');
					 }
           		 }
		});
    	$("#CloseAddInsurance").click(function(){closeTab(); });
    	//$('#addInsuranceForm').formly({'onBlur':false, 'theme':'Dark'});
    	$("#addInsSubmit").button();
    	$("#editInsurances").button();
    	

    	$("#editInsurances").click(function(){
			$("#addInsurancePage").html("");
			$("#addInsurancePage").load('editInsurance.php');
	
		});
    });

</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 12px;
	}
-->
</style>

<a id="CloseAddInsurance" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="addInsurancePage">
 <fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
 <a id="editInsurances" style="float: right;font-size:12" href="#">Edit Companies</a>
<form id="addInsuranceForm" action="addInsuranceController.php" method="post">
<table class="tdtext">
<tr >
<td><label>Insurance:</label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="15" type="text" id="addinsurance" name="addinsurance" /> </td>
</tr><tr>
<td><label>Address:</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="3" id="insAddr" name="insAddr" > </textarea></td>
</tr>
<tr>
<td><label>Contact:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="inscontact" name="inscontact" /> </td>
</tr><tr>
<td><label>Email: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="13" type="text" id="insemail" name="insemail" /></td>
</tr><tr><br><td></td><td><input  size="7" type="submit" id="addInsSubmit" name="addInsSubmit" value="Add" /></td></tr>

</table>
</form>
</fieldset>

</div>