<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});


$("#labourRecordsType").change(function(){
		
 	if($("#labourRecordsType option:selected").val()!="none"){
 		$("#displayLabourRecords").html("");
 	 	var page = $("#labourRecordsType option:selected").val();
 	 	//alert(page);
 		$("#displayLabourRecords").load(page);
 		
 		}else{
 			$("#displayLabourRecords").html("");
 		}
		
		
});

$("#CloseEditLabour").click(function(){closeTab(); });
		 	
//-->
</script>
<a id="CloseEditLabour" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsLabour">
<table>
<tr>
<td><label>Search & Edit Records For: </label></td>
<td>

<select id="labourRecordsType">
<option value="none">Choose One</option>
<option value="editbiosocialdata.php">Biosocial Data:Registration</option>
<option value="editbiosocialdataHistory.php">Biosocial Data:History</option>
<option value="editobstericalhistory.php">Obsterical History</option>
<option value="editantinatalrecord.php">Antenatal Records</option>
<option value="editlabourtreatments.php">Labour Treatments</option>
<option value="editlabourdelivery.php">Delivery</option>
<option value="editpostpartumcare.php">Postpartum Care</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displayLabourRecords">


</div>