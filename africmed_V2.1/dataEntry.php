<script>
$(document).ready(function () {

	$('#showDEntry').click(function(){
		$.post('dataEntryController.php',{'DEntryDate': $("#DEntryDate").val()},function(data) {
			
			if(data == 0){
				$('#displayEntry').hide();
				$("#errorMessage").html('<p>NO ENTRY ON THIS DATE</p>').dialog('open');
			}else{
				$('#displayEntry').show();
				$('#displayEntry').html(data);
			}
		});
	});	


	//$('#DEntry-form').formly({'onBlur':false, 'theme':'Dark'});
	$('#DEntryDate').datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$('#showDEntry').button();

	$("#CloseDataEntry").click(function(){closeTab(); });
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
<a id="CloseDataEntry" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<form id="DEntry-form" name="DEntry-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
			  <legend ><b><i>Select Date</i></b></legend>
			  	<table class="tdtext">
			  		<tr>
			  			<td>Date: </td>
					     <td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text"  name="DEntryDate" id="DEntryDate" size="15">
					     </td>
			  		</tr>
					 <tr><td><label id="showDEntry">Submit</label>  </td></tr>
				</table>
	</fieldset>
</form>
<div id="displayEntry"></div>
