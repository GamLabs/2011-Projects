<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	table{width:70%}
</style>
<script>
	$(document).ready(function(){

		var oTable = $('#the_table').dataTable({

			'sAjaxSource':'search_controller.php'
		});
		
		
		$("#searchPnumberTable").live('click',function(){
			 var string = $(this).closest('tr').find('td:eq(0)').text();
			 var pnumber = string.split("Edit")[1];
			 
			 $('<div>').dialog({
		            modal: true,
		            width:800,
		        	height:700,
		        	buttons: {
		        		"Close": function() { $(this).remove();}
		        		 } ,
		            
		            open: function ()
		            {
		                $(this).load('commonEditor.php',{
		                    'searchEditPnumber': pnumber 
		                  });
		            },         
		            title: 'Edit'
		            
		        });
			
		
		});


		$("#deletePnumberTable").live('click',function(){
			 var string = $(this).closest('tr').find('td:eq(0)').text();
			 var pnumber = string.split("Edit")[1];
			 
			 $('<div>').dialog({
		            modal: true,
		            width:350,
		        	height:150,
		        	buttons: {
		        		"Close": function() { $(this).remove();}
		        		 } ,
		            
		            open: function ()
		            {
		                $(this).load('commonDelete.php',{
		                    'searchEditPnumber': pnumber 
		                  });
		            },         
		            title: 'Delete'
		            
		        });
			
		
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
 
