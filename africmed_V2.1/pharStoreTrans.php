<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});

$("#CloseViewPharStoreTrans").click(function(){	closeTab();});
$("#viewPharStoreType").change(function(){
		
 	if($("#viewPharStoreType option:selected").val()!="none"){
 		$("#displayPharStoreTransRecords").html("");
 	 	var page = $("#viewPharStoreType option:selected").val();
 	 	//alert(page);
 		$("#displayPharStoreTransRecords").load(page);
 		
 		}else{
 			$("#displayPharStoreTransRecords").html("");
 		}
		
		
});

//-->
</script>

<style>

label { color:white;}

</style>
<a id="CloseViewPharStoreTrans" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsPharStore">
<table>
<tr>
<td><label>View Lab Store Transaction: </label></td>
<td>

<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="viewPharStoreType">
<option value="none">Choose One</option>
<option value="pharStoreReceive_controller.php">Received Drugs In Store</option>
<option value="pharStoreUsed_controller.php">Dispatch Drugs To Pharmacy</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displayPharStoreTransRecords">


</div>