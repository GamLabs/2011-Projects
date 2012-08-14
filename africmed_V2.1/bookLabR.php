<script>
    $(document).ready(function () {
    	$("#addbookLabDialog").dialog({ autoOpen:false,minWidth: 600,maxHeight:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } }, close: function(){$('#livePnumberQueryBookLab').trigger('click'); } });
    	if(tabNameExists("Test Patient")){
    		var index = getTabName("Test Patient");
    		$("#contentTab").tabs('remove',index);
    		refreshTab();
    	}

    	$("#labDiagQueue").click(function(){
			$("#queueDialog").dialog('open');
			$.post('queue.php',{status:'PHAR'},function(data) {
				$("#queueDialogContent").html(data);
			});
			
		});
		
		

			$('#labPnumber').liveSearch({url: 'check.php?page=BookLab&liveSearchPnumber='+$('#labPnumber').val()});
			$('#livePnumberQueryBookLab').live('click',function(e){
			$('#labPnumber').val(($(this).text()));
			var pnumber = $('#labPnumber').val();
			$('#jquery-live-search').slideUp();
			var name = $(this).closest('tr').find('td:eq(1)').text();
        	$("#bookLabHeaderInfo").empty().text("Patient Name - "+ name);
			$("#displayLabTestcDiv").empty().load("bookLab_diaglog.php?pn="+pnumber+"");
			$.post('check.php',{'hasVisitNum': pnumber},function(data) {
				var dt = parseInt(data);
				if(dt == 0){
					$("#displayLabTestcDiv").show();	
					$("#addInvestigationBtn").show();
				}else{
					confirmPrompt($("#displayLabTestcDiv"));
					$("#addInvestigationBtn").hide();
					//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
					//$("#displayLabTestcDiv").hide();
				}
			});
			e.stopImmediatePropagation();
			return false;
			});
	      
			$("#CloseBookLab").click(function(){	closeTab();});
			$("#labDiagQueue").button();
			$("#addInvestigationBtn").button();

			$("#addInvestigationBtn").click(function(){
				$("#addbookLabDialog").html();
				$("#addbookLabDialog").load('labdiagnosis_dialog.php');
				$("#addbookLabDialog").dialog('open');

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
	  font-size: 12px;
	}
-->
</style>
<a id="CloseBookLab" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
		<form id="labBookingForm" action="" method="post">
		<fieldset  class=" ui-widget-content ui-corner-all inputStyle">
			<legend  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact"><b><i>Patient Information</i></b></legend>
					<table border="0" class="tdtext">
						<tr>
							<td><label>Patient Number: </label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="labPnumber" name="labPnumber" ></td>
							
								
						</tr>
					</table>
		</fieldset>
		</form>
		<button style="display: none" id="addInvestigationBtn">Add Tests for </button>
		<span class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="bookLabHeaderInfo"></span><br>
		<div id="displayLabTestcDiv">
		
		</div>
		
		<div id="addbookLabDialog" style="display: none" title="Investigation Dialog">

		</div>
		
		
		
		
