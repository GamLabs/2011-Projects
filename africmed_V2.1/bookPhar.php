<script>
    $(document).ready(function () {
    	$("#addPhartreatmentDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } }, close: function(){$('#livePnumberQueryBookPhar').trigger('click'); } });
    	$("#completeTransactionPhar").hide();
    	//$("#nonPrivatepatientInfo").hide();
    	$("#completeTransactionPhar").button();
    	$("#pharDiagQueue").click(function(){
			$("#queueDialog").dialog('open');
			$.post('queue.php',{status:'PHAR'},function(data) {
				$("#queueDialogContent").html(data);
			});
			
		});

    	$("#completeTransactionPhar").click(function(){
        	confirmationPrompt(function(){
        		$.post('check.php',{'CompleteNonPrivateTransact': $('#pharPnumber').val()},function(data) {
    				var dt = parseInt(data);
    				//alert(dt);
    				if(dt == 0){
    						$("#successMessage").html("Successfully Comlpleted The Transaction").dialog('open');
    						$("#displayPharPrescDiv").hide();
    						$("#completeTransactionPhar").hide();
    						$("#addPrescriptionBtn").hide();
    				}else{
    					
    				}
    			});

        	});
    		

        	

    	});
		
			$("#queueDialog table tr td > a").live('click',function(){
				var pharPnumber = $(this).closest('tr').find('td:eq(0)').text();
				$("#pharPnumber").val(pharPnumber);
				$("#queueDialog").dialog('close');
				$("#displayPharPrescDiv").empty().load("bookPhar_dialog.php?pn="+pharPnumber+"");
    		
			});	

			$('#pharPnumber').liveSearch({url: 'check.php?page=BookPhar&liveSearchPnumber='+$('#pharPnumber').val()});
			$('#livePnumberQueryBookPhar').live('click',function(e){
			$('#pharPnumber').val(($(this).text()));
			var pnumber = $('#pharPnumber').val();
			$('#jquery-live-search').slideUp();
			var name = $(this).closest('tr').find('td:eq(1)').text();
        	$("#bookPharHeaderInfo").empty().text("Patient Name - "+ name);
			$("#displayPharPrescDiv").empty().load("bookPhar_dialog.php?pn="+pnumber+"");
			
			$.post('check.php',{'hasVisitNum': pnumber},function(data) {
				var dt = parseInt(data);
				if(dt == 0){
					$("#addPrescriptionBtn").show();
					$("#displayPharPrescDiv").show();
					$("#completeTransactionPhar").show();	
				}else{
						confirmPrompt($("#hidebookPharTrans"));
						$("#completeTransactionPhar").hide();
						$("#displayPharPrescDiv").hide();
						$("#addPrescriptionBtn").hide();
						//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
						//$("#displayPharPrescDiv").hide();
						//$("#completeTransactionPhar").hide();
						//$("#nonPrivatepatientInfo").hide();
					}
			});
			e.stopImmediatePropagation();
			return false;
			});
			$("#CloseBookPhar").click(function(){	closeTab();});
			$("#pharDisplay").hide();
			$("#pharDiagQueue").button();
			$("#addPrescriptionBtn").button();

			$("#addPrescriptionBtn").click(function(){
				$("#addPhartreatmentDialog").html();
				$("#addPhartreatmentDialog").load('pharTreat_dialog.php');
				$("#addPhartreatmentDialog").dialog('open');

			});
			//$('#addPhar-form').formly({'onBlur':false, 'theme':'Dark'});
			//$('#pharForm').formly({'onBlur':false, 'theme':'Dark'});
			
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
<a id="CloseBookPhar" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
		<form id="pharForm" action="" method="post">
		<fieldset  class=" ui-widget-content ui-corner-all inputStyle">
			<legend  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact"><b><i>Patient Information</i></b></legend>
					<table border="0" class="tdtext">
						<tr>
							<td><label>Patient Number: </label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="pharPnumber" name="pharPnumber" ></td>
							<!-- <td> <label style="float: right" id="pharDiagQueue" >Show Queue</label></td> -->
								
						</tr>
					</table>
		</fieldset>
		</form>
		<button style="display: none" id="addPrescriptionBtn">Add Prescriptions for </button>
		<span class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="bookPharHeaderInfo"></span><br><br>
		<div id="hidebookPharTrans">
		
		<div id="displayPharPrescDiv">
		
		</div>
		
		</div>
		<button id="completeTransactionPhar">Complete Transaction</button>
		
		<div id="addPhartreatmentDialog" style="display: none" title="Prescription Dialog">

		</div>
		
		
		
		
		
		
