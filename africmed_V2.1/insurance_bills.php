
<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>
$(document).ready(function(){
	$("#insurancepaymentDialog").dialog({ autoOpen:false,width:400,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });
	$("#insurancepaymentSubmit").button();
	$(".payInsuranceBillLink").click(function(){	
		var id = $(this).closest('tr').find('td:eq(0)').text();
		var bal = $(this).closest('tr').find('td:eq(4)').text();
		$("#insurancepaymentId").val(id);
		$("#insurancepaymentBalance").val(bal);
		
		$("#insurancepaymentDialog").dialog('open');
	});

	$("#insurepaymentMethod").change(function(){
		 var val = $("#insurepaymentMethod").val();
		 if(val == "Cheque"){
			 $("#insurepaychequeRow").show();
			 $("#insurepaymentChNo").val("");
		 }else{
			 $("#insurepaychequeRow").hide();
			 $("#insurepaymentChNo").val("0");
		 }
		
		
	});
	function validatePayment(){
		$('#insurancepaymentForm').validate({
			
				'rules':{
					'insurepaymentMethod':'required',
					'insurepaymentChNo':'required',
					'insurancepaymentAmount': {
								'required':true,
								'number':true
							}
				},
				messages: {
					insurepaymentMethod: "<i style='color:red;'>Please Choose payment Method<i>",
					insurepaymentChNo:"<i style='color:red;'>Cheque is Required<i>", 
					insurancepaymentAmount: "<i style='color:red;'>Please enter a valid Amount<i>"
					
				
				},
				invalidHandler: function(form, validator) {
					
				      var errors = validator.numberOfInvalids();
				     // alert(errors);
				      if(errors){
				    	 // $("#errorMessage").html("<p style='color:red;'>Please Fill All Required Fields!</p>").dialog('open');
					    return false;
				      }else{
				    	  
					      return true;
				      }
				}
		});
	}
	$('#insurancepaymentForm').ajaxForm({
		//target:"#content",
		beforeSubmit: validatePayment(),
		
		success:function(response) { 
			//alert(response);
			var res = parseInt(response);
				 if(res == 0){
					
				$("#successMessage").html("<p>Payment Successfully Done  </p>").dialog('open');
				 $('#insurancepaymentForm').resetForm();
				 $("#insurancepaymentDialog").dialog('close');
				 refreshTab();
				 }else if(res == 3){
					 $("#errorMessage").html("<p>Sorry, You Cannot pay More Than You Owe").dialog('open');
				 }else if(res == 4){
					 $("#errorMessage").html("<p>Sorry, Amount Cannot be a negateive Number").dialog('open');
				 }else{
					 $("#errorMessage").html("Sorry: "+response).dialog('open');
				 }
       		 }
	});

});


</script>

<?php 
	$comp = $_GET['comp'];
	$month = $_GET['month'];
	$year = $_GET['year'];
	getInsuranceBillToPay($comp,$month,$year);

?>
<div>
<?php 
$comp = $_GET['comp'];
$month = $_GET['month'];
$year = $_GET['year'];
$id = getInsuranceBillId($comp,$month,$year);
getInsuranceBillsPayments($id);
?>
</div>

<div style="display: none" id="insurancepaymentDialog" title="Payment">
	<form id="insurancepaymentForm" name="insurancepaymentForm" action="payInsuranceBills.php" method="post">
	<input type="hidden" name="insurancepaymentId" id="insurancepaymentId">
	<input type="hidden" name="insurancepaymentBalance" id="insurancepaymentBalance">
	<table>
	<tr>
	<td><label>	Amount</label></td>
	<td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="insurancepaymentAmount" name="insurancepaymentAmount" ><br></td>
	</tr>
	<tr>
	<td><label>	Method</label></td>
	<td>
	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="insurepaymentMethod" name="insurepaymentMethod">
	<option value="">Select Method</option>
	<option value="Cash">Cash</option>
	<option value="Cheque">Cheque</option>
	</select>
	</td>
	</tr>
	<tr id="insurepaychequeRow" style="display: none">
	<td><label>	Cheque Number</label></td>
	<td><input value="0"  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="insurepaymentChNo" name="insurepaymentChNo" ></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input  type="submit" id="insurancepaymentSubmit" name="insurancepaymentSubmit" value="Pay" >
	</td>
	</tr>
	</table>
	</form>
</div>



