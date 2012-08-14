<script>
    $(document).ready(function () {
    	$("#completeTransactionBillsP").hide();
    	$("#completeTransactionBillsP").button();
    	$('#paymentPnumber').liveSearch({url: 'privateBillsController.php?page=privateBills&liveSearchPnumber='+$('#paymentPnumber').val()});
		$('#livePnumberQueryprivateBills').live('click',function(e){
		$('#paymentPnumber').val(($(this).text()));
		var pnumber = $('#paymentPnumber').val();
		$("#paymentBillsmainDiv").empty().load("payBills_dialog.php?pn="+pnumber+"");
		$('#jquery-live-search').slideUp();
		var name = $(this).closest('tr').find('td:eq(1)').text();
    	$("#privateBillsHeaderInfo").empty().text("Bills For  - "+ name);
		//var name = $(this).closest('tr').find('td:eq(1)').text();
		$.post('check.php',{'isAdmitted': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#errorMessage").html("This Patient is Admitted.\nCannot Pay Untill Released..").dialog('open');	
				refreshTab();
			}else{
				$.post('check.php',{'hasVisitNum': pnumber},function(data) {
					var dt = parseInt(data);
					if(dt == 0){
						$("#completeTransactionBillsP").show();
						$("#paymentBillsmainDiv").hide();
						
					}else{
						$("#completeTransactionBillsP").hide();	
						$("#paymentBillsmainDiv").show();
					}
				});
				
				$.post('check.php',{'isNotPrivate': pnumber},function(data) {
					var dt = parseInt(data);
					if(dt == 0){
						$("#errorMessage").html("This Patient is a Non Private patient").dialog('open');	
					}else{
						
					}
				});
				
			}
		});
		
		
		e.stopImmediatePropagation();
		return false;
    });

		
		$("#ClosePrivateBills").click(function(){closeTab();});
		$("#completeTransactionBillsP").click(function(){
        	confirmationPrompt(function(){
        		$.post('check.php',{'CompleteNonPrivateTransact': $('#paymentPnumber').val()},function(data) {
    				var dt = parseInt(data);
    				//alert(dt);
    				//var pn = ('#paymentPnumber').val();
    				if(dt == 0){
    						$("#successMessage").html("Successfully Comlpleted The Transaction").dialog('open');  						
    						$("#completeTransactionBillsP").hide();
    						$("#paymentBillsmainDiv").show();
    						refreshTab();
    						
    				
    						
    						
    				}else{    					
    				}
    			});
        	});
    	});

    	

		
	
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


	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact">Patient Information</legend>
				<table border="0" class="tdtext">
					<tr >
							<td><label>Patient Name/Number: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="paymentPnumber" name="paymentPnumber"/></td>
							<td><button id="completeTransactionBillsP">Complete Transaction</button></td>
					</tr>
				</table>
	</fieldset>

<br>
<span id="privateBillsHeaderInfo" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"></span>
<div id="paymentBillsmainDiv">



</div>

