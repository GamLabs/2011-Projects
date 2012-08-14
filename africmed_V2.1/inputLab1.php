<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	table{width:70%}
</style>
<script>
    $(document).ready(function () {

    	$('#the_table').dataTable({

			'sAjaxSource':'LabInputController.php'
		});
		
    	$('#LabInputForm').ajaxForm({
        	
    		success:function(response) { 
    				 if(response=="Success"){
    					$("#successMessage").dialog('open');
    				 	$('#LabInputForm').resetForm();
    				 }else{
    					 $("#errorMessage").html("<p>"+response+"</p>");
    					 $("#errorMessage").dialog('open');
    				 }
           		 }
    	});
        
        $('#LabTab').tabs();
        $('#addTest').button();
    });
</script>

<div id="LabTab">
	<ul>
   		<li><a href="#LabInput">Input Test</a></li>
   		<li><a href="#LabView">View Lab Tests</a></li> 
 	 </ul>

	
	<div id="LabInput"> 
		
		<form id="LabInputForm" action="LabInputController.php" method="post">
		
	<input type="hidden" name="inputTest" id="inputTest">
 	 <fieldset>
		<legend>Input Test</legend>
		<table>
			<tr>
			<td><label>Test: </label></td><td><input type="text" name="testType" /></br></td>
			
			<td><label>Amount: </label></td><td><input type="text" name="labAmount" /></br></td>
			</tr>
		</table>
		
		</fieldset>
		<input type="submit" name="addTest" id="addTest" value="Add Test" />
 	 </form>
		
	
	</div>
<div id="LabView">
			<div style="width:900px; left:100px">
		<center>
			<table id="the_table">
				<thead>
					<tr>
						<th>Number</th>
						<th>Test</th>
						<th>Amount</th>
						<th>Added By</th>
						<th>Date Added</th>
					</tr>
				</thead>
			</tbody>
			</table>
		</center>
	 </div>
	
</div>	


</div>
