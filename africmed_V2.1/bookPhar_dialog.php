<?php require_once 'includes/connect.php';
		require_once 'includes/requireFile.php';
?>
<script>

$(document).ready(function(){
	




$(".addPrescriptionTP").click(function(){
	var id = $(this).closest('tr').find('td:eq(0)').text();
	var name = $(this).closest('tr').find('td:eq(1)').text();
	
	var pn = $("#pharPnumber").val();
	var type = $(this).closest('tr').find('td:eq(2)').text();
	var amount = $(this).closest('tr').find('td:eq(5)').text();
	$(this).parent().parent().remove();
	
	$.post('bookPharController.php',{'addPrescToBookingPn': pn,'dname':name,'type':type,'amount':amount,'id':id},function(data) {
		$("#addedPrescriptionsTobepaidDiv").html(data);
		

		
	});

});

});

</script>

<!--  Display Test(s) to be Done on this patient-->
		<div  id="displayTreatment">
			<fieldset class=" ui-widget-content ui-corner-all inputStyle">
				<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Recommended Prescriptions</i></b></legend>
					<div id="displayPharTreatments"><?php $pn = $_GET['pn'];$vn = getVisitNumber($pn);displayTreatments($vn);?></div>
			</fieldset>
		</div>
		
		<div id="addedPrescriptionsTobepaidDiv">
		
		</div>