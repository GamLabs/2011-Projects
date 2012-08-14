<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});

$("#ClosePricingView").click(function(){	closeTab();});
$("#viewPricingType").change(function(){
		
 	if($("#viewPricingType option:selected").val()!="none"){
 		$("#displayPricingTables").html("");
 	 	var page = $("#viewPricingType option:selected").val();
 	 	//alert(page);
 		$("#displayPricingTables").load(page);
 		
 		}else{
 			$("#displayPricingTables").html("");
 		}
		
		
});
		 	
//-->
</script>
<a id="ClosePricingView" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsSteril">
<table>
<tr>
<td><label>Choose Pricing Options: </label></td>
<td>

<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="viewPricingType">
<option value="none">Choose One</option>
<option value="PharmacyPricing.php">Medicine Pricing</option>
<option value="LabTestPricing.php">Lab Testing Pricing</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displayPricingTables">


</div>