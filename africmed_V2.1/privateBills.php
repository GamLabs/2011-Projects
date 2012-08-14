<script>
    $(document).ready(function () {
        var globalPN=0;
        var balance=0;
		$("#debtorForm").dialog({
				autoOpen:false,
				modal:true,
				minWidth:'400',
				buttons:
					{
						'close':function(){
							$(this).dialog('close');
						}
				}
		});
		$("#confirmPrompt").dialog({ autoOpen:false,minWidth: 400,modal:true,buttons: { "Yes": function() { $(this).dialog("close"); $("#debtorForm").dialog('open');} ,"No": function() { $(this).dialog("close");return false; }} });
		$("#outPatientForm").dialog({
			autoOpen:false,
			modal:true,
			minWidth:'700',
			minHeight:'400',
			buttons:
				{
					'Pay' : function(){
			
						paidPrivateBills();
						
						
						$(this).dialog('close');
					},
					'close':function(){
						$(this).dialog('close');
					}
				}
		});
		
    	$('#payPnumber').liveSearch({url: 'privateBillsController.php?page=privateBills&liveSearchPnumber='+$('#payPnumber').val()});
		$('#livePnumberQueryprivateBills').live('click',function(){
		$('#payPnumber').val(($(this).text()));
		$('#jquery-live-search').slideUp();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		$.post('check.php',{'isNotPrivate': $('#payPnumber').val()},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				//alert($('#payPnumber').val());
				$("#successMessage").html("This Patient Not a Private Patient<br>He should be Paid For").dialog('open');
				$("#payBillButton").hide();
				$("#displayTransactions").hide();
				return;	
			}else{
				$.post('privateBillsController.php',{'pnumberKeyUp': $("#payPnumber").val()},function(data) {
					if(data == 1){
						$("#errorMessage").html('<p>This Patient Is Not Yet Booked For Consultation</p>').dialog('open');
						$("#displayTransactions").hide();
		    			$("#outPatient").hide();
		    			$("#payBillButton").hide();
					}else{
						$("#displayTransactions").show();
		    			$("#outPatient").show();
		    			
		    			$("#payBillButton").show();
		    			$('#transactions').html(data);
					}
				});
				//$("#payBillButton").show();
			}
		});
    	$("#privateBillsHeaderInfo").empty().text("Transactions - "+ name);
				
		});
    	$('#paymethod').change(function() {
			var val=$("#paymethod").val();
			if(val == "CHEQUE") {
				$('#chequeId').removeAttr('disabled');
			}else{
				$('#chequeId').attr('disabled', true);
			}
    	});

		$("#payBillButton").click(function(){
			
			// POST TO CHECK IF DRAWER IS OPENED
			$.post('privateBillsController.php',{'checkIfDrawerIsOpen': 'check'},function(data) {
				if(data == 1){
					$("#errorMessage").html('<p><font size=5>You Must Open A Drawer Before You Can Make Any Payments!!'+
    				'</font></p>').dialog('open');
    				return;
				}else if(data == 0){
					$("#outPatientForm").dialog('open');
				}
			});
			//POST TO GET THE TOTAL AMOUNT TO BE PAID
			$.post('privateBillsController.php',{'getTotal': $("#payPnumber").val()},function(data) {
				totalAmount=eval(data);
				$("#showTotalDiv").html('<p><font color=red size=4px> Total Amount: D'+totalAmount+'</font></p>');
			});
		});
		
		function paidPrivateBills(){

				var paidAmount=eval($('#paidAmount').val());
				var pn=$('#payPnumber').val();
				var paymethod=$('#paymethod').val();
				var checkNo=$('#chequeId').val();
				
				if(paymethod==""){
					$("#errorMessage").html('<p>Please choose pay method!</p>').dialog('open');
					return;
				}if(paymethod=="CHEQUE"){
					var chequeNo=$('#chequeId').val();
					if(chequeNo==""){
						$("#errorMessage").html('<p>Please Enter Cheque Number!</p>').dialog('open');
						return;
					}
				}
				if(paidAmount==""){
					$("#errorMessage").html('<p>Please enter paid amount!</p>').dialog('open');
					return;
				}else if(isNaN(paidAmount)){
					$("#errorMessage").html('<p>Amount Must be a number!</p>').dialog('open');
					return;
				}
				
				balance=(totalAmount - paidAmount);
				if(balance < 0){
					alert("asdaasd");
					$("#errorMessage").html('<p>You cannot pay more than you owe!</p>').dialog('open');
					return ;
				}else if(balance > 0){
					$("#confirmPrompt").dialog('open');
				}else{
					var pnumber =$("#payPnumber").val();
					
					$.post('privateBillsController.php',{'paidAmount':paidAmount,'Balance':balance,'payPnumber':pn,'payMethod':paymethod,
				    		'CheckNo': checkNo},function(data) {
				  			
				   				$("#successMessage").html('<p>Payment Successful for: '+data+'</p>').dialog('open');
				   				$("#outPatientForm").dialog('close');
				   				$("#payBillButton").hide();
				    			$("#displayTransactions").hide();
				    			$("#outPatient").hide();
				    			$("#outPatientForm").resetForm();
					});
				}
		
    	}
		$("#submitDebtor").click(function(){
			var au=$('#authorizer').val();
			var paymethod=$('#paymethod').val();
			var checkNo=$('#chequeId').val();
			if(au==""){
				alert("Please Enter An Authorizer!");
			}
			else{
	    		$.post('privateBillsController.php',{'Auth':au,'debtorBalance':balance,'debtorPaidAmount':paidAmount,
		    		'debtorPnumber':$("#payPnumber").val(),'payMethod':paymethod,'CheckNo': checkNo},function(data) {
						if(data == 0){
							$("#errorMessage").html('<p>Fail To Add As A Debtor! Please Contact Management</p>').dialog('open');
						}else{
							$("#successMessage").html('<p>'+data+'</p>').dialog('open');
							$("#outPatientForm").resetForm();
							$("#Debtor-Form").resetForm();
						}
				});
			}
	});
	    		        
			
			$("#submitDebtor").button();
			$("#payBillButton").button();
			$("#payBillButton").hide();
			$("#makePayment").button();
			$("#displayTransactions").hide();
			$("#outPatient").hide();
			$("#labDiagQueue").button();
			 $("#ClosePrivateBills").click(function(){	closeTab();});
			//$('#billForm').formly({'onBlur':false, 'theme':'Dark'});
			//$('#outPatient').formly({'onBlur':false, 'theme':'Dark'});
			//$('#Debtor-Form').formly({'onBlur':false, 'theme':'Dark'});
    });

</script>

<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 14px;
	}
-->
</style>
<a id="ClosePrivateBills" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div style="display: none" id="confirmPrompt" title="Confirm">

<font size="5px" color="red"><p>This Patient Has A Balance And Must Be Authorise First.</p><p>Do You Want To Proceed?</p></font>

</div>



<div id="debtorForm" style="display:none">

		<form action="" id="Debtor-Form">
		
		<label>Authorizer: </label><input type="text" name="authorizer" id="authorizer" size="20"/>
		 <input class=" ui-widget-content ui-corner-all inputStyle" type="hidden" name="balance" id="balance" size="20" /><br><br>
		<label id="submitDebtor">Add Debtor</label>
		
		</form>
	
</div>
<form id="billForm" action="" method="post">
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact"><b><i>Patient Information</legend>
				<table border="0" class="tdtext">
					<tr stlye="white-space:nowrap">
							<td><label>Patient Name/Number: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" size="10" type="text" id="payPnumber" name="payPnumber"/></td>
							<td></td><td width="20%"></td>
					</tr>
				</table>
	</fieldset>
</form>
<!--  Display Test(s) to be Done on this patient	-->
<div id="displayTransactions">
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="privateBillsHeaderInfo"><b><i>Transaction(s)</legend>
			<div id="transactions"></div>
	</fieldset>
</div>

<center><label id="payBillButton">Pay Bill</label></center>

<form id="outPatientForm" action="" method="post" style="display:none">
<div id="outPatient">
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Fill Details</legend>
	
			<table cellpadding="5" class="tdtext">
					
				<tr>
					<td><label>Payment Method: </label></td>
					<td><select class=" ui-widget-content ui-corner-all inputStyle"  name="paymethod" id="paymethod">
						 <option value=""> </option>
						 <option value="CASH">CASH</option>
						 <option value="CHEQUE">CHEQUE</option>
					</select></td>
					
					<td><label>Cheque No: </label></td>
					<td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="chequeId" id="chequeId" size="10" /disabled></td>
			</tr>
			<tr>
					<td><label>Paid Amount: </label></td>
					<td><input class=" ui-widget-content ui-corner-all inputStyle" type="text" name="paidAmount" id="paidAmount" size="10"></td>
					<!--  <td><label>Balance: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle" name="balance" id="balance" /readonly></td>-->
			</tr>
			<tr><td></td><td><div id="showTotalDiv"></div></td></tr>
			</table>
	</fieldset>
</div>
</form>


