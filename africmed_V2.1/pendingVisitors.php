


<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	/*table{width:80%}*/
</style>
<script>
	$(document).ready(function(){
	
		//var oTable = $('#the_table').dataTable({

		//	'sAjaxSource':'search_controller.php'
		//});
		
		$('#Visitors_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bDestroy":true,
		"bJQueryUI": true,
		"sAjaxSource": "pendingVisitors_controller.php" 
		
		} );

		$("#ClosePendingVisitors").click(function(){	closeTab();});
	
	});

	
</script>
<style>
<!--
#Visitors_table {
    width: 100% !Important;
}
-->
</style>
<a id="ClosePendingVisitors" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>



		<table id="Visitors_table" >
			<thead>
				<tr style="white-space:nowrap;" class="ui-widget-header">
					
					<th>Date</th>
					<th>Visit No.</th>
					<th>Patient No.</th>
					<th>Full Name</th>
					<th>Admitted</th>
					
						
				</tr>
			</thead>
				
		</table>

 
 <div id="testing11">_</div>
 


