<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

?>
<script>
    $(document).ready(function () {
    	
				
		$("#drugTypeSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validateDrugType(){
			$('#drugTypeForm').validate({
				
					'rules':{
						'drugTypeName': 'required',
						'drugTypeType': 'required'
						
					},
					messages: {
						drugTypeName: "<i style='color:red;'>Please enter Drug Name<i>",
						drugTypeType: "<i style='color:red;'>Please Choose Drug Type<i>"
						
					
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
    	$('#drugTypeForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateDrugType(),
			success:function(response) { 
				
				var res = parseInt(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Drug </p>").dialog('open');
					 $('#drugTypeForm').resetForm();
					 }else if(res == 3){
						 $("#errorMessage").html("<p style='color:red'>Duplicate Entry</p>").dialog('open');
					 }else{
						 $("#errorMessage").html("<p style='color:red'>"+response+"</p>").dialog('open');
					 }
           		 }
		});
    	$("#CloseDrugTypes").click(function(){	closeTab();});
		

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
<a id="CloseDrugTypes" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  ><b>New Drug TYpe</b></legend>
<form id="drugTypeForm" action="drugtypes_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Drug Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="drugTypeName" name="drugTypeName" /> </td>
</tr><tr>
<td><label>Drug Type: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="drugTypeType" name="drugTypeType">
<?php getPackagingCombo();?>

</select></td>
</tr><tr><td></td><td><input  size="10" type="submit" id="drugTypeSubmit" name="drugTypeSubmit" value="Add Drug" /></td>

</table>
</form>
</fieldset>