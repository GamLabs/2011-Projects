<script>
    $(document).ready( function() {

    	$('#the_lab_table').dataTable({

			//'sAjaxSource':'inputLabController.php'
		});

    	
    	$("#addTest").click(function(){
			var test= $("#testname").val();
			var amount= $("#TestAmountId").val();
			if(test == ""){
				$("#errorMessage").html('<p>Test Is Required!</p>').dialog('open');
				return;
			}
			if(amount == ""){
				$("#errorMessage").html('<p>Amount Is Required!</p>').dialog('open');
				return;
			}else if(isNaN(amount)){
				$("#errorMessage").html('<p>Amount Is Must Be A Number!</p>').dialog('open');
				return;
			}
			$.post('inputLabController.php',{'Test':test,'Amount':amount},function(data) {
					if(data == 1){
						$("#successMessage").html('<p>Test Added Successfully!</p>').dialog('open');
					}else if (data == 0){
						$("#errorMessage").html('<p>Fail To Add Test!</p>').dialog('open');
					}else if (data == 2){
						$("#errorMessage").html('<p>'+test+' Has Already Been Added!</p>').dialog('open');
					}else{
						
					}
    		});
    	});
    	
    	$('#inputlabForm').formly({'onBlur':false, 'theme':'Dark'});
        $("#addTest").button();
        $("#labMainTabs").tabs();
        
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
  
  <div id="labMainTabs">
		<ul>
	   	 <li><a href="#addTests">Add Test</a></li>
	   	<li><a href="#viewTests">View Test</a></li> 
	 	 </ul>
			<div id="addTests">
		  
				  <form id="inputlabForm"  method="post" action="" size="10">
				  <fieldset>
				  <legend>Add Lab Test</legend>
				  	<table  cellpadding="5" class="tdtext">
					
				  		<tr>
						    <td>Test</td>
						     <td><input type="text" name="testname" id="testname" size="10" /></td>
						     
						     <td>Amount</td>
						     <td><input type="text" name="TestAmountId" id="TestAmountId"  size="10"/></td>
						     
						 </tr>
						 <tr>   
				           	<td><label id="addTest">Add</label></td>
				       </tr>
					 </table>
					 </fieldset>
				  </form>
			</div>
			<div id="viewTests">
				<div style="width:900px; left:100px">
						<table id="the_lab_table">
							<thead>
								<tr>
									<th>Test</th>
									<th>Amount</th>
									<th>Added By</th>
								</tr>
							</thead>
						</tbody>
						</table>
			</div>
		</div>
</div>
