<?php require_once 'includes/connect.php';
		require_once 'includes/requireFile.php';
?>
<script>

$(document).ready(function(){
	




$(".addLabTestFP").click(function(){
	var id = $(this).closest('tr').find('td:eq(0)').text();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	var category = $(this).closest('tr').find('td:eq(2)').text();
	var forwho = $(this).closest('tr').find('td:eq(3)').text();
	var pn = $("#labPnumber").val();
	$(this).parent().parent().remove();
	
	$.post('bookLabController.php',{'addLabTestToBookingPn': pn,'tname':name,'id':id,'category':category ,'forwho':forwho },function(data) {
		//alert(data);
		$("#addedLabTestTobepaidDiv").html(data);
		

		
	});

});

});

</script>

<!--  Display Test(s) to be Done on this patient-->
		<div  id="displayLabTest">
			<fieldset class=" ui-widget-content ui-corner-all inputStyle">
				<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Recommended Lab Tests</i></b></legend>
					<div id="displayLabTests"><?php $pn = $_GET['pn'];displayInvestigationTable($pn);?></div>
			</fieldset>
		</div>
		
		<div id="addedLabTestTobepaidDiv">
		
		</div>