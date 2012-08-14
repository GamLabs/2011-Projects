<?php
require_once 'includes/session.php';
require_once 'includes/requireFile.php';
?>
<script>
$(document).ready(function(){
	$("#comppaymentDialog").dialog({ autoOpen:false,width:400,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });
	$("#comppaymentSubmit").button();
	$(".payCompanyBillLink").click(function(){	
		var id = $(this).closest('tr').find('td:eq(0)').text();
		var bal = $(this).closest('tr').find('td:eq(4)').text();
		$("#comppaymentId").val(id);
		$("#comppaymentBalance").val(bal);
		
		$("#comppaymentDialog").dialog('open');
	});

	function validatePayment(){
		$('#comppaymentForm').validate({
			
				'rules':{
					'companypaymentMethod':'required',
					'companypaymentChNo':'required',
					'comppaymentAmount': {
								'required':true,
								'number':true
							}
				},
				messages: {
					companypaymentMethod: "<i style='color:red;'>Payment Method is Required<i>" ,
					companypaymentChNo:  "<i style='color:red;'>Cheque Number is Required <i>",
					paymentAmount: "<i style='color:red;'>Please enter a valid Amount<i>"
					
				
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
	$("#companypaymentMethod").change(function(){
		 var val = $("#companypaymentMethod").val();
		 if(val == "Cheque"){
			 $("#companypaychequeRow").show();
			 $("#companypaymentChNo").val("");
		 }else{
			 $("#companypaychequeRow").hide();
			 $("#companypaymentChNo").val("0");
		 }
		
		
	});
	$('#comppaymentForm').ajaxForm({
		//target:"#content",
		beforeSubmit: validatePayment(),
		
		success:function(response) { 
			//alert(response);
			var res = parseInt(response);
				 if(res == 0){
					
				$("#successMessage").html("<p>Payment Successfully Done  </p>").dialog('open');
				 $('#comppaymentForm').resetForm();
				 $("#comppaymentDialog").dialog('close');
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
	getCompBillToPay($comp,$month,$year);

?>
<div>
<?php 
$comp = $_GET['comp'];
$month = $_GET['month'];
$year = $_GET['year'];
$id = getCompanyBillId($comp,$month,$year);
getCompanyBillsPayments($id);
?>
</div>

<div style="display: none" id="comppaymentDialog" title="Payment">
	<form id="comppaymentForm" name="comppaymentForm" action="payCompanyBills.php" method="post">
	<input type="hidden" name="comppaymentId" id="comppaymentId">
	<input type="hidden" name="comppaymentBalance" id="comppaymentBalance">
	<table>
	<tr>
	<td><label>	Amount</label></td>
	<td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="comppaymentAmount" name="comppaymentAmount" ><br></td>
	</tr>
	<tr>
	<td><label>	Method</label></td>
	<td>
	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="companypaymentMethod" name="companypaymentMethod">
	<option value="">Select Method</option>
	<option value="Cash">Cash</option>
	<option value="Cheque">Cheque</option>
	</select>
	</td>
	</tr>
	<tr id="companypaychequeRow" style="display: none">
	<td><label>	Cheque Number</label></td>
	<td><input value="0"  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="companypaymentChNo" name="companypaymentChNo" ></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input  type="submit" id="comppaymentSubmit" name="comppaymentSubmit" value="Pay" >
	</td>
	</tr>
	</table>
	</form>
</div>



