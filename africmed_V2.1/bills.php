<?php
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>
$(document).ready(function(){
	$("#paymentDialog").dialog({ autoOpen:false,width:600,minWidth: 400,modal:true,buttons: { "Close": function() { $(this).dialog('close'); } } });
	$("#paymentSubmit").button();
	$(".payPatientBillLink").click(function(){	
		var vn = $(this).closest('tr').find('td:eq(0)').text();
		var bal = $(this).closest('tr').find('td:eq(4)').text();
		$("#paymentvisitNum").val(vn);
		$("#paymentBalance").val(bal);
		
		$("#paymentDialog").dialog('open');
	});

	function validatePayment(){
		$('#paymentForm').validate({
			
				'rules':{
					'paymentMethod':'required',
					'paymentChNo':'required',
					'paymentChNo':'required',
					'paymentAmount': {
								'required':true,
								'number':true
							}
				},
				messages: {
					paymentChNo:"<i style='color:red;'>Cheque Number is Required<i>",
					paymentMethod: "<i style='color:red;'>Please Choose payment Method<i>",
					paymentChNo:	"<i style='color:red;'>Cheque Number is Required<i>",
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

	$("#paymentMethod").change(function(){
		 var val = $("#paymentMethod").val();
		 if(val == "Cheque"){
			 $("#paychequeRow").show();
			 $("#paymentChNo").val("");
		 }else{
			 $("#paychequeRow").hide();
			 $("#paymentChNo").val("0");
		 }
		
		
	});
	
	$('#paymentForm').ajaxForm({
		//target:"#content",
		beforeSubmit: validatePayment(),
		
		success:function(response) { 
			//alert(response);
			var res = parseInt(response);
				 if(res == 0){
					
				$("#successMessage").html("<p>Payment Successfully Done  </p>").dialog('open');
				 $('#paymentForm').resetForm();
				 $("#paymentDialog").dialog('close');
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
$vn = $_GET['vn'];
getBillsTable($vn);

?>
<div>
<?php
$vn = $_GET['vn'];
 getBillsPayments($vn);
 ?>
</div>
<div style="display: none" id="paymentDialog" title="Payment">
	<form id="paymentForm" name="paymentForm" action="payBills.php" method="post">
	<input type="hidden" name="paymentvisitNum" id="paymentvisitNum">
	<input type="hidden" name="paymentBalance" id="paymentBalance">
	<table>
	<tr>
	<td><label>	Amount</label></td>
	<td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="paymentAmount" name="paymentAmount" ><br></td>
	</tr>
	<tr>
	<td><label>	Method</label></td>
	<td>
	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="paymentMethod" name="paymentMethod">
	<option value="">Select Method</option>
	<option value="Cash">Cash</option>
	<option value="Cheque">Cheque</option>
	</select>
	</td>
	</tr>
	<tr id="paychequeRow" style="display: none">
	<td><label>	Cheque Number</label></td>
	<td><input value="0"  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="paymentChNo" name="paymentChNo" ></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input  type="submit" id="paymentSubmit" name="paymentSubmit" value="Pay" >
	</td>
	</tr>
	</table>
	</form>
</div>
<div style="display: none" id="paymentReceiptDiag" title="paymentReceiptDiag">

</div>

