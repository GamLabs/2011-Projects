
<?php 
require_once 'includes/connect.php';

?>
<script>
    $(document).ready(function () {
    		
		$("#packagingSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validatepharPackType(){
			$('#pharpackagingForm').validate({
				
					'rules':{
						'packagingName': 'required'
					
					},
					messages: {
						packagingName: "<i style='color:red;'>Please enter Package Name<i>"
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
    	$('#pharpackagingForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validatepharPackType(),
			success:function(response) { 
				
				var res = parseInt(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Packaging Type </p>").dialog('open');
					 $('#pharpackagingForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p style='color:red'>"+response+"</p>").dialog('open');
					 }
           		 }
		});
    	$("#ClosepharPackagingTypes").click(function(){	closeTab();});

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
<a id="ClosepharPackagingTypes" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  ><b>New Packaging Type</b></legend>
<form id="pharpackagingForm" action="pharpackaging_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Packaging Name:</label></td>
<td><input class="ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="packagingName" name="packagingName" /> </td>
</tr><tr><td></td><td><input  size="10" type="submit" id="packagingSubmit" name="packagingSubmit" value="Add Packaging Type" /></td>

</table>
</form>
</fieldset>