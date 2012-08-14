<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	table{width:70%}
</style>
<script>
	$(document).ready(function(){

		var oTable = $('#the_table').dataTable({

			'sAjaxSource':'search_controller.php'
		});
	});

	
</script>

<div style="width:900px; left:100px">
	<center>
		<table id="the_table">
			<thead>
				<tr>
					<th>Registration Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
					<th>Telephone</th>
				</tr>
			</thead>
		</tbody>
		</table>
	</center>
 </div>
 
 <div id="testing"></div>
 
