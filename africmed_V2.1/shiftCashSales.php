<?php require_once 'includes/requireFile.php';?>
<script>
$(document).ready(function () {
		$("#showCashSalesForShift").button();	
		$('#shiftSelector').hide();
		$('#showCashSalesForShift').hide();
		
		
		$("#salesDate").change(function(){
			$('#shiftSelector').hide();
			$('#showCashSalesForShift').hide();
		});

		$("#showCashSalesForShift").click(function(){
			var date = $("#salesDate").val();
			var shift = $("#salesShift").val();
			
			if(date == "" || shift =="Select Shift"){
				$('#shiftSelector').hide();
				$("#errorMessage").html("Sorry Date or Shift Cannot Be Empty").dialog('open');
			}else{
				$.post('cashDrawerController.php',{'CashSalesForFinanceDrw': shift},function(data) {
					if(data){
						$("#summaryShiftCashSalesDiv").html(data);
					}
				});
					//$.post('shiftCashSalesController.php',{'getShiftsCashSales': shift,'date':date},function(data) {
					
					//$('#mainDisplayForCashSalesDiv').html(data);
						$('#mainDisplayForCashSalesDiv').load('shiftCashSalesLoader.php?date='+date+'&shift='+shift);
				//});
			}
		});
	
	$('#showCashSales').click(function(){
		
			var date = $("#salesDate").val();
			if(date == ""){
				$('#shiftSelector').hide();
				$("#errorMessage").html("Sorry Date cannot Be Empty").dialog('open');
			}else{
					$.post('shiftCashSalesController.php',{'getShifts': date},function(data) {
						var dt = parseInt(data);
						if(	dt == 1){
							$("#errorMessage").html("Sorry No Shift Transaction Found On this Date").dialog('open');
						}else{
						$('#salesShift').html(data);
						$('#shiftSelector').show();	
						$('#showCashSalesForShift').show();
						}		
			});
			}
	
	});


	$("#CloseShiftCashSales").click(function(){closeTab(); });
	$("#showCashSales").button();
	$("#salesDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	//$('#shiftSales-form').formly({'onBlur':false, 'theme':'Dark'});
});
</script>

<style>
<!--
.tdtext {
	  white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 15px;
	}
-->
</style>

<a id="CloseShiftCashSales" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<form id="shiftSales-form" name="shiftSales-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Shift Cash Sales</legend>
			  	<table class="tdtext">
			  		 <tr>
			  			<td>Date: </td>
					     <td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text"  name="salesDate" id="salesDate" size="10">
					     <label id="showCashSales">Get Shifts</label> 
					     </td>
			  		</tr>
			  		<tr id="shiftSelector">
			  			<td><label>Shift: </label></td>
						<td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="salesShift" id="salesShift">
								
						 </select></td>
						 
					 </tr>
						
					 <tr><td></td><td> <label id="showCashSalesForShift">Display Shifts Sales</label> </td></tr>
				</table>
	</fieldset>
</form>
<div id="summaryShiftCashSalesDiv"></div>
<div id="mainDisplayForCashSalesDiv"></div>