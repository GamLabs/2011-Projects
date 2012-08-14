<script>
    $(document).ready(function () {

    	$("#labDiagQueue").click(function(){
			$("#queueDialog").dialog('open');
			$.post('queue.php',{status:'PHAR'},function(data) {
				$("#queueDialogContent").html(data);
			});
			
		});
		
		

			$('#labResultsPnumber').liveSearch({url: 'check.php?page=BookLabResult&liveSearchPnumber='+$('#labResultsPnumber').val()});
			$('#livePnumberQueryBookLabResult').live('click',function(e){
			$('#labResultsPnumber').val(($(this).text()));
			var pnumber = $('#labResultsPnumber').val();
			$('#jquery-live-search').slideUp();
			var name = $(this).closest('tr').find('td:eq(1)').text();
        	$("#labresultsHeaderInfo").empty().text("Patient Name - "+ name);
			$("#displayLabResultsDiv").empty().load("labResults_diaglog.php?pn="+pnumber+"");
			$.post('check.php',{'hasVisitNum': pnumber},function(data) {
				var dt = parseInt(data);
				if(dt == 0){
					$("#displayLabResultsDiv").show();	
				}else{
					$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
					$("#displayLabResultsDiv").hide();
				}
			});
			e.stopImmediatePropagation();
			return false;
			});
	      
			$("#CloseLabResults").click(function(){	closeTab();});
			$("#labDiagQueue").button();
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
	  font-size: 12px;
	}
-->
</style>
<a id="CloseLabResults" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>		
<form id="labResultsForm" action="" method="post">
		<fieldset  class=" ui-widget-content ui-corner-all inputStyle">
			<legend  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact"><b><i>Patient Information</i></b></legend>
					<table border="0" class="tdtext">
						<tr>
							<td><label>Patient Number: </label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="labResultsPnumber" name="labResultsPnumber" ></td>
							
								
						</tr>
					</table>
		</fieldset>
		</form>
		<span class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="labresultsHeaderInfo"></span><br>
		<div id="displayLabResultsDiv">
		
		</div>
		
		
		
		
