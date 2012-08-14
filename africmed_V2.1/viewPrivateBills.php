<?php require_once 'includes/requireFile.php';?>
<script>
    $(document).ready(function () {
		
    	$("#privateBillsFilter").change(function(){
			var selected = $("#privateBillsFilter option:selected").val();
			if(selected == "date"){
				$("#privateBillschooseByDate").show();
		        $("#privateBillschooseByMonth").hide();
		        $("#privateBillschooseByYear").hide();	
			}else if(selected == "month"){
				$("#privateBillschooseByDate").hide();
		        $("#privateBillschooseByMonth").show();
		        $("#privateBillschooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#privateBillschooseByYear").show();	
				$("#privateBillschooseByDate").hide();
		        $("#privateBillschooseByMonth").hide();
		       
			}else{

				$("#privateBillschooseByDate").hide();
		        $("#privateBillschooseByMonth").hide();
		        $("#privateBillschooseByYear").hide();	
			}


		});

		$("#privateBillsChMonth").change(function(){
			var selected = $("#privateBillsChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#privateBillschooseByYear").show();	
			}else {
				
		        $("#privateBillschooseByYear").hide();	
			}


		});

		$("#privateBillDetailQueryButton").button();
    	  	
        $("#privateBillschooseByDate").hide();
        $("#privateBillschooseByMonth").hide();
        $("#privateBillschooseByYear").hide();
        $("#privateBillsFilterDiv").hide();
        $("#privateBillsChDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
        
        $('#privateBillsViewPN').liveSearch({url: 'privateBillsController.php?page=privateBillView&liveSearchPnumber='+$('#privateBillsViewPN').val()});
		$('#livePnumberQueryprivateBillView').live('click',function(e){
		$('#privateBillsViewPN').val(($(this).text()));
		$("#privateBillsFilterDiv").show();
		var pnumber = $('#privateBillsViewPN').val();
		
		$('#jquery-live-search').slideUp();
		
		e.stopImmediatePropagation();
		return false;
	
    });
	    
		$("#privateBillDetailQueryButton").click(function(){
			var selectedCat = $("#privateBillsChCat option:selected").val();
			
			var selected = $("#privateBillsFilter option:selected").val();
			if(selected == "date"){
				
					var pnumber = $("#privateBillsViewPN").val();
					var date = $('#privateBillsChDate').val();
					if(date == ""){
						$("#errorMessage").html("<p style='color:red'>Please Select a Date</p>").dialog('open');
					}else{
					
					$('#mainDisplayForviewPrivateBills').load("displayPrivateBills.php?pnumber="+pnumber+"&date="+date+"&status=bydate");
					}
			}else if(selected == "month"){
					var pnumber = $("#privateBillsViewPN").val();
					var month = $("#privateBillsChMonth").val();
					var year = 	$("#privateBillsChYear").val();
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
							
							$('#mainDisplayForviewPrivateBills').load("displayPrivateBills.php?pnumber="+pnumber+"&month="+month+"&year="+year+"&status=bymonth");
					
					}
				
			}else if(selected == "year"){
				var pnumber = $("#privateBillsViewPN").val();
				var year = 	$("#privateBillsChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{

						$('#mainDisplayForviewPrivateBills').load("displayPrivateBills.php?pnumber="+pnumber+"&year="+year+"&status=byyear");
				
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
		
		//===
		$("#CloseviewPrivateBills").click(function(){closeTab(); });
    	
    });
    
</script>
<a id="CloseviewPrivateBills" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >Printing </legend>
						
							<table>
						
							<tr id="PrivateFilter" ">
							<td><label>Patient Number:</label></td>
							<td>
							<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="privateBillsViewPN" name="privateBillsViewPN"/>
							</td>
							</tr>
							
							
							<tr id="privateBillsFilterDiv" style="display:none;">
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="privateBillsFilter" id="privateBillsFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="privateBillschooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="privateBillsChDate" size="10" id="privateBillsChDate" /> </td>
							  </tr>
							  <tr id="privateBillschooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="privateBillsChMonth" id="privateBillsChMonth" >
							  			<?php getgeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="privateBillschooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="privateBillsChYear" id="privateBillsChYear" > 
							 	<?php getgeneralYears();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="privateBillDetailQueryButton"  >View Detail Bills</button>
							
							</td>
							</tr>
							</table>
					
				</fieldset>
				
				
				<div id="mainDisplayForviewPrivateBills"></div>
					
	