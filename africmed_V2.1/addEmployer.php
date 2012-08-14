<script>
    $(document).ready(function () {
    	//$('form').validationEngine('hideAll');

    	function validateAddIns(){
			$('#addEmployerForm').validate({
				
					'rules':{
						'addemployer': 'required',
						'empAddr': 'required',
						'empemail': 'email',
						'empcontact': {
							'required':true,
							'number':true
						}
					},
					messages: {
						addemployer: "<i style='color:red;'>Name of Employer is Required<i>",
						empAddr: "<i style='color:red;'>Address is Required<i>",
						empcontact: {
							required:	"<i style='color:red;'>Contact is Required<i>",
							number :	"<i style='color:red;'>Contact Must be a Number<i>"
						},
						empemail   : "<i style='color:red;'>Invalid Email<i>"	
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
    	$('#addEmployerForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddIns(),
			
			success:function(response) { 
				res = eval(response);
					 if(res==1){
						$("#successMessage").html("<p>Employer Successfully Added</p>").dialog('open');
						 $('#addInsuranceForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p>Fail to Add Employer</p>").dialog('open');
					 }
           		 }
		});
    	$("#CloseAddEmployer").click(function(){closeTab(); });
    	//$('#addEmployerForm').formly({'onBlur':false, 'theme':'Dark'});
    	$("#addEmpSubmit").button();
    	$("#editCompanies").button();

    	$("#editCompanies").click(function(){
			$("#addCompanyPage").html("");
			$("#addCompanyPage").load('editCompany.php');
	
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

<a id="CloseAddEmployer" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<div id="addCompanyPage">
 <fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
 <a id="editCompanies" style="float: right;font-size:12" href="#">Edit Companies</a>
 
<form id="addEmployerForm" action="addEmployerController.php" method="post">
<table class="tdtext">
<tr>
<td><label>Employer:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="15" type="text" id="addemployer" name="addemployer" /> </td>
</tr><tr>
<td><label>Address:</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="3" id="empAddr" name="empAddr" > </textarea></td>
</tr>
<tr>
<td><label>Contact:</label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="empcontact" name="empcontact" /> </td>
</tr><tr>
<td><label>Email: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="13" type="text" id="empemail" name="empemail" /></td>
</tr><tr><br><td></td><td><input  size="7" type="submit" id="addEmpSubmit" name="addEmpSubmit" value="Add" /></td></tr>

</table>
</form>
</fieldset>
</div>