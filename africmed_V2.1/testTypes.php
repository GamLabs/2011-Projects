
<?php 
require_once 'includes/connect.php';

?>
<script>
    $(document).ready(function () {
    	
				
		$("#testTypeSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validateDrugType(){
			$('#testTypeForm').validate({
				
					'rules':{
						'testTypeName': 'required',
						
						'testTypeCategory': 'required'
						
					},
					messages: {
						testTypeName: "<i style='color:red;'>Please enter Test Name<i>",
						testTypeCategory: "<i style='color:red;'>Please Choose Category<i>"
						
						
					
					},
								
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      //alert(errors);
					      if(errors){
					    	 // $("#errorMessage").html("<p>Please Fill All Required Fields!</p>").dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
    	$('#testTypeForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateDrugType(),
			success:function(response) { 
				
				var res = parseInt(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Test </p>").dialog('open');
					 $('#testTypeForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p style='color:red'>"+response+"</p>").dialog('open');
					 }
           		 }
		});
    	$("#CloseTestTypes").click(function(){	closeTab();});

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
<a id="CloseTestTypes" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  ><b>New Test Type</b></legend>
<form id="testTypeForm" action="testtypes_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Test Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="testTypeName" name="testTypeName" /> </td>
</tr><tr >
<td><label>Test For:</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"    id="testTypeFor" name="testTypeFor" >
								<option value="">Select Status</option>
								<option value="gambian">Gambian</option>
								<option value="nongambian">Non Gambian Resident</option>
								<option value="visitor">Non Gambian Visitor</option>
</select>
</td>
</tr><tr >
<td><label>Test Category:</label></td><td>
<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="testTypeCategory" name="testTypeCategory">
<option></option><option value="4001" >Laboratory</option>

   


</select>
</td>
</tr><tr><td></td><td><input  size="10" type="submit" id="testTypeSubmit" name="testTypeSubmit" value="Add Test" /></td>

</table>
</form>
</fieldset>