<script>
$(document).ready(function () {
	$("#LabSalesInPDF").hide();
	$('#showLabSales').click(function(){
		var date = $("#labSalesDate").val();
		$('#displayLabSales').load('labSalesController.php?date='+date);
		//$("#LabSalesInPDF").show();
		//$.post('labSalesController.php',{'labSalesDate': $("#labSalesDate").val()},function(data) {
		//	
		//	if(data == 0){
		//		$('#displayLabSales').hide();
		//		$("#errorMessage").html('<p>NO SALES ON THIS DATE</p>').dialog('open');
		//	}else{
		//		$('#displayLabSales').show();
		//		$('#displayLabSales').html(data);
		//	}
		//});
	});	

	$("#CloseLabSales").click(function(){	closeTab();});
	//$('#labSales-form').formly({'onBlur':false, 'theme':'Dark'});
	$('#labSalesDate').datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$('#showLabSales').button();
	$("#LabSalesInPDF").click(function(){
		var date = $("#labSalesDate").val();
		$("#displayLabSales").load("pdfload.php?getWhatPDF=labSales&date="+date);

	});
});
</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 15px;
	}
-->
</style>
<a id="CloseLabSales" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<form id="labSales-form" name="labSales-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i >Select Date</b></i></legend>
			  	<table class="tdtext">
			  		<tr>
			  			<td>Date: </td>
					     <td><input readonly type="text" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="labSalesDate" id="labSalesDate" size="15">
					     </td>
			  		</tr>
					 <tr><td><label id="showLabSales">Sales</label>  </td></tr>
				</table>
	</fieldset>
</form>
<a id="LabSalesInPDF"  href="#"><img src="images/PDF2.png" width="40" height="40"></img></a>
<div id="displayLabSales"></div>