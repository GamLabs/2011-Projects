<?php require_once 'includes/connect.php';
		require_once 'includes/requireFile.php';
?>
<script>

$(document).ready(function(){
	var currentRow = null;
	$("#labResultsDialog").dialog({ autoOpen:false,width:400,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } },close: function(){/*currentRow.remove(); */} });


	$("#labResultsDiagSubmit").button();

$(".addLabTestResultsLk").click(function(){

	$("#labResultId").val($(this).closest('tr').find('td:eq(0)').text());
	$("#labResultName").val($(this).closest('tr').find('td:eq(2)').text());
	$("#labResultPnumber").val($(this).closest('tr').find('td:eq(1)').text());
	$("#resultLabelId").html("Enter ("+$("#labResultName").val()+") Results Below");
	$("#labResultsDialog").dialog('open');
	//$(this).parent().parent().remove();
	currentRow = $(this).parent().parent();
	currentRow.remove(); 
	//alert(currentRow.text());
	

});


function validateLabRSubmit(){
	$('#labResultsSubmissionForm').validate({
			'rules':{
				'labResultsDiagText': 'required'
			},
			messages: {
				labResultsDiagText: "<i style='color:red;'>Lab Results is Required<i>"		
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
$('#labResultsSubmissionForm').ajaxForm({
	//target:"#content",
	beforeSubmit:validateLabRSubmit(),
	success:function(response) { 
		var res = parseInt(response);
			 if(res == 0){
			
			$("#successMessage").html("Successfully Added Results").dialog('open');
			 $('#labResultsSubmissionForm').resetForm();
			 $("#labResultsDialog").dialog('close');
			 }else{
				 alert("Error: "+response);
			 }
   		 }
});

});

</script>

<!--  Display Test(s) to be Done on this patient-->
		<div  id="displayLabTest">
			<fieldset class=" ui-widget-content ui-corner-all inputStyle">
				<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Recommended Lab Tests</i></b></legend>
					<div id="displayLabTests"><?php displayLabResultEntry($_GET['pn']);?></div>
			</fieldset>
		</div>
		
		<div id="addedLabTestTobepaidDiv">
		
		</div>
		
		
<div style="display: none;font-size:14px;" id="labResultsDialog" title="Add Investigation Results">
<form id="labResultsSubmissionForm" name = "labResultsSubmissionForm" action="submitLabResults.php" method="post">
<input type="hidden" id="labResultId" name = "labResultId">
<input type="hidden" id="labResultName" name = "labResultName">
<input type="hidden" id="labResultPnumber" name = "labResultPnumber">

<label id="resultLabelId" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"></label><br>
<textarea class=" ui-widget-content ui-corner-all inputStyle" rows="5" cols="40" id="labResultsDiagText" name="labResultsDiagText">  </textarea>  <br>
<input type="submit" id="labResultsDiagSubmit" name="labResultsDiagSubmit" value="Add Result">

</form>

</div>