<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

?>
<script>
$(document).ready(function(){
	
$("#paymentBillsSelect").change(function(){
    var visitNumber = $("#paymentBillsSelect option:selected").val();
    //alert(visitNumber); 
   // $.post('check.php',{'getBillsForPatient': visitNumber },function(data) {
		//	$("#paymentTableDiv").html(data);
			$("#paymentTableDiv").empty().load("bills.php?vn="+visitNumber+"");
   // });
	
	});



});
</script>

<?php 


$pn  = $_GET['pn'];
getBillDates($pn)



?>
<div id="paymentTableDiv">

</div>