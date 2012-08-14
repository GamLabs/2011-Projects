<script>
$(document).ready(function () {

	$('#showDayBook').click(function(){
		var date = $("#dayBookDate").val();
		//$.post('dayBooksController.php',{'dayBookDate': $("#dayBookDate").val()},function(data) {
			
			//	$('#displayDayBook').html(data);
		
		//});
		$('#displayDayBook').load('dayBooksController.php?date='+date);
	});

	//$('#dayBook-form').formly({'onBlur':false, 'theme':'Dark'});
	$('#dayBookDate').datepicker({
     	showOtherMonths: true,
		selectOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		yearRange: '2005:2030',
     dateFormat: 'yy-mm-dd'
	});
	$('#showDayBook').button();
	$("#CloseDayBooks").click(function(){closeTab(); });
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

<a id="CloseDayBooks" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<form id="dayBook-form" name="dayBook-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Select Date</legend>
			  	<table  cellpadding="10" class="tdtext">
			  		<tr>
			  			<td>Date: </td>
					     <td><input size="10" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text"  name="dayBookDate" id="dayBookDate" >
					     </td>
			  		</tr>
					 <tr><td><label id="showDayBook">Show</label>  </td></tr>
				</table>
	</fieldset>
</form>
<div id="displayDayBook"></div>