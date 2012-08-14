<script type="text/javascript">
<!--
//$('#viewRecordsConsul').formly({'onBlur':false, 'theme':'Dark'});

$("#CloseViewConsulRecords").click(function(){	closeTab();});
$("#consultationRecordsType").change(function(){
		
 	if($("#consultationRecordsType option:selected").val()!="none"){
 		$("#displayConsulRecords").html("");
 	 	var page = $("#consultationRecordsType option:selected").val();
 	 	//alert(page);
 		$("#displayConsulRecords").load(page);
 		
 		}else{
 			$("#displayConsulRecords").html("");
 		}
		
		
});
		 	
//-->
</script>
<a id="CloseViewConsulRecords" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class="ui-widget ui-widget-content ui-corner-all">
<form id="viewRecordsConsul">
<table>
<tr>
<td><label>View Records For: </label></td>
<td>

<select id="consultationRecordsType">
<option value="none">Choose One</option>
<option value="nurseExamView_controller.php">Nurse Examination</option>
<option value="diagnosisView_controller.php">Diagnosis</option>

</select>
</td>
</tr>
</table>
</form>
</fieldset>


<div id="displayConsulRecords">


</div>