<script>
    $(document).ready(function () {
		// EXPENDITURE FORM DIALOG
		
		$("#expenseForm").dialog({
				autoOpen:false,
				modal:true,
				minWidth:'500',
				buttons:
					{
						'Add' : function(){
								addExpenses();
								//$(this).dialog('close');
						},
						'close':function(){
						$(this).dialog('close');
					}
				}
		});
		 //POST TO GET THE NAMES OF ALL RECEPTIONIST
		$.post('cashDrawerController.php',{'RecepName': "getName"},function(data) {
			$('#openName').html(data);
		});
		// CHECK THE STATUS OF THE DRAWER
		$.post('cashDrawerController.php',{'CheckStatus': 'checking'},function(data) {
				
					if(data == 0){
						$('#cashDrawerOpenForm').hide();
						$('#cashDrawerCloseForm').show();
					}else if(data == 1){
						$('#cashDrawerOpenForm').show();
						$('#cashDrawerCloseForm').hide();
					}
				
		});
		// DISPLAY CASH SALES IF CASH DRAWER IS TO BE CLOSED
		$.post('cashDrawerController.php',{'CashSales': 'sales'},function(data) {
			if(data){
				$("#displaySales").html(data);
			}
		});

		// DISPLAY EXPENDITURE FORM
		$("#cashExpenditure").click(function(){
			$("#expenseForm").dialog('open');
		});
		
		$("#submitCloseDrawer").click(function(){
			if(confirm('Are You Sure You Want To Close Cash Drawer?')){
				$.post('cashDrawerController.php',{'ClosingShift': 'close'},function(data) {
					if(data){
						$("#successMessage").html('<p>Cash Drawer Closed Successfully!</p>').dialog('open');
						$("#submitCloseDrawer").hide();
						refreshTab();
					}else{
						$("#errorMessage").html('<p>Error Closing Shift!</p>').dialog('open');
					}
				});
			}
		});
    	$("#submitOpenDrawer").click(function(){
    		var shift=$("#openShift").val();
    		//alert(shift);
    		var name=$("#openName").val();
    		if(shift==""){
    			$("#errorMessage").html('<p>Your Shift Is Required!</p>').dialog('open');
    			return;
    		}else if(name==""){
    			$("#errorMessage").html('<p>Your Name Is Required!</p>').dialog('open');
    			return;
    		}
    			$.post('cashDrawerController.php',{'Shift': shift,'Name': name},function(data) {
					if(data){
						$("#successMessage").html('<p>'+shift+' Successfully Opened!</p>').dialog('open');
						refreshTab();
					}else{
						$("#errorMessage").html('<p>Cannot Open Shift!</p>').dialog('open');
					}
    			});
    		
    	});

    	function addExpenses(){
        	
    		var reason=$("#salesReason").val();
    		var amount=$("#expenseAmount").val();

    		if(reason==""){
    			$("#errorMessage").html('<p>Please State A Reason!</p>').dialog('open');
    			return;
    		}else if(amount==""){
    			$("#errorMessage").html('<p>Amount is Require!</p>').dialog('open');
    			return;
    		}if(isNaN(amount)){
    			$("#errorMessage").html('<p>Amount Must Be A Number!</p>').dialog('open');
    			return;
    		}else{
    			$.post('cashDrawerController.php',{'Reason': reason,'ExpAmount': amount},function(data) {
				var dt = parseInt(data);
				alert(dt);
					if(dt == 0){
						$("#successMessage").html('<p> Expenditure Successfully Added!</p>').dialog('open');
						$("#expenseForm").dialog('close');
						$("#salesExpenseForm").resetForm();
					}else{
						$("#errorMessage").html('<p>Failed To Add Expenditure!</p>').dialog('open');
					}
    			});
    		}
    	}
    	$("#CloseCashDrawer").click(function(){	closeTab();});
		$('#submitOpenDrawer').button();
		$('#submitCloseDrawer').button();
		$('#cashExpenditure').button();
		$('#submitExpense').button();
		$("#eodsummary").button();
		$("#eodDetail").button();
		$("#eodsummary").click(function(){
			$("#pdfSpaceDiv").load("cashDrawerSummary.php");
		});

		$("#eodDetail").click(function(){
			$("#pdfSpaceDiv").load("cashDrawerDetail.php");

		});
		
		//$('#openDrawerForm').formly({'onBlur':false, 'theme':'Dark'});
		//$('#salesExpenseForm').formly({'onBlur':false, 'theme':'Dark'});
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

<a id="CloseCashDrawer" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="cashDrawerOpenForm">
	<form action="" method="post" id="openDrawerForm">
	<!--  <center><div id="openDrawerDIV">OPEN CASH DRAWER</div></center><br>-->
			<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Open Cash Drawer</legend>
				
				<table CLASS="tdtext">
					
					<tr>
						<td><label>Shift: </label></td>
						<td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="openShift" id="openShift">
								<option value=""></option>
								<option value="AMSHIFT">AM SHIFT</option>
								<option value="PMSHIFT">PM SHIFT</option>
								<option value="NIGHTSHIFT">NIGHT SHIFT</option>
							</select></td>
						<td><label>Name: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="openName" id="openName">
						 					</select></td>
				    </tr>
					<tr>
						<td></td><td></td><td></td><td><label id="submitOpenDrawer">Open Cash Drawer</label></td>
					</tr>
				</table>
			</fieldset>
	</form>
</div>
<!-- EXPENSES FORM -->
<div id="expenseForm" style="display:none">

	<form action="" id="salesExpenseForm">
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Cash Sales Expenses</legend><br>
		<table class="tdtext">
			<tr>
				<td><label>Reason: </label></td>
						<td><select  name="salesReason" id="salesReason">
								<option value=""></option>
								<option value="Petty Cash">Petty Cash</option>
								<option value="other">Other</option>
						 </select></td>
			</tr>
			<tr>
				<td><label>Amount(D): </label></td><td><input size="10" type="text" id="expenseAmount" name="expenseAmount" ></td>
			</tr>
		</table>
		</fieldset>
	</form>
</div>

<div id="cashDrawerCloseForm">

	<div id="displaySales"></div><br>
	<label id="cashExpenditure">Expenses</label><center><!-- <button id="eodsummary">EOD Summary</button> --><button id="eodDetail">EOD Detail</button><label id="submitCloseDrawer">Close Cash Drawer</label></center>
</div>
<div id="pdfSpaceDiv"></div>
  