<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});

$("#CloseViewLabStoreTrans").click(function(){	closeTab();});
$("#viewLabStoreType").change(function(){
		
 	if($("#viewLabStoreType option:selected").val()!="none"){
 		$("#displayLabStoreTransRecords").html("");
 	 	var page = $("#viewLabStoreType option:selected").val();
 	 	//alert(page);
 		$("#displayLabStoreTransRecords").load(page);
 		
 		}else{
 			$("#displayLabStoreTransRecords").html("");
 		}
		
		
});
		 	
//-->
</script>
<a id="CloseViewLabStoreTrans" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsLabStore">
<table>
<tr>
<td><label>View Lab Store Transaction: </label></td>
<td>

<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="viewLabStoreType">
<option value="none">Choose One</option>
<option value="labStoreReceive_controller.php">Received Stocks</option>
<option value="labStoreUsed_controller.php">Used Stocks</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displayLabStoreTransRecords">


</div>