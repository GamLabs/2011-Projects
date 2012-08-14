<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});

$("#CloseViewSteril").click(function(){	closeTab();});
$("#viewSterilType").change(function(){
		
 	if($("#viewSterilType option:selected").val()!="none"){
 		$("#displaySterilRecords").html("");
 	 	var page = $("#viewSterilType option:selected").val();
 	 	//alert(page);
 		$("#displaySterilRecords").load(page);
 		
 		}else{
 			$("#displaySterilRecords").html("");
 		}
		
		
});
		 	
//-->
</script>
<a id="CloseViewSteril" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsSteril">
<table>
<tr>
<td><label>View Records For: </label></td>
<td>

<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="viewSterilType">
<option value="none">Choose One</option>
<option value="SView_controller.php">Sterilization</option>
<option value="SMView_controller.php">Sterilization Maintenance</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displaySterilRecords">


</div>