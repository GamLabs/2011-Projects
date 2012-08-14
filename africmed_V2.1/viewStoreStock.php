<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
?>

<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	table.viewall{width:70%}
</style>

<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$('#example').dataTable({
					"bProcessing": true,
					"bServerSide": true,
					'sAjaxSource': 'server_processing.php'
				});
				
				//$('#deleteoredit').ajaxForm{};
			});
		</script>
	</head>
	
	<body id="dt_example">

<hr>
<script type="text/javascript">
$('#med_delete').button();
$('#med_edit').button();
</script>
		<div id="container" style="width:1000px; left:100px">
<center><table id="example" class="viewall">
	<thead>
		<tr>
			<th width="20%">Name</th>
			<th width="15%">Type</th>
			<th width="15%">Quantity</th>
			<th width="20%">Expiry Date</th>
			<th width="25%">Reorder Level</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
	
</table></center>
</div>			



<script>
    $(document).ready( function() {
	//$('#inputphardrugs').ajaxForm({
		//beforeSubmit: validatePharForm(),
		//target:"#pcontent",
		//success:function(response){ 
             //  alert(response); 
       // }
	//});
$(function(){
	$( "#medicationname" ).autocomplete({
	source: <?php echo json_encode(getAllDrugs());?>
	});
	});	
});
</script>