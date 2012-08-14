<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>
$(document).ready(function () {
	$("#extraChargesInPDF").hide();
	$('#showextraCharges').click(function(){
		var date = $("#extraChargesDate").val();
		$('#displayextraCharges').load('extraChargesController.php?date='+date);
		//$("#extraChargesInPDF").show();
		//$.post('extraChargesController.php',{'extraChargesDate': $("#extraChargesDate").val()},function(data) {
		//	
		//	if(data == 0){
		//		$('#displayextraCharges').hide();
		//		$("#errorMessage").html('<p>NO SALES ON THIS DATE</p>').dialog('open');
		//	}else{
		//		$('#displayextraCharges').show();
		//		$('#displayextraCharges').html(data);
		//	}
		//});
	
		
	});	

	//=====
	$("#extraChargesQueryButton").button();
    	$("#expenseSubmit").button();   	
        $("#extraChargeschooseByDate").hide();
        $("#extraChargeschooseByMonth").hide();
        $("#extraChargeschooseByYear").hide();
		$("#monthlyExpenseTab").tabs();

		$("#extraChargesFilter").change(function(){
			var selected = $("#extraChargesFilter option:selected").val();
			if(selected == "date"){
				$("#extraChargeschooseByDate").show();
		        $("#extraChargeschooseByMonth").hide();
		        $("#extraChargeschooseByYear").hide();	
			}else if(selected == "month"){
				$("#extraChargeschooseByDate").hide();
		        $("#extraChargeschooseByMonth").show();
		        $("#extraChargeschooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#extraChargeschooseByYear").show();	
				$("#extraChargeschooseByDate").hide();
		        $("#extraChargeschooseByMonth").hide();
		       
			}else{

				$("#extraChargeschooseByDate").hide();
		        $("#extraChargeschooseByMonth").hide();
		        $("#extraChargeschooseByYear").hide();	
			}


		});

		$("#extraChargesChMonth").change(function(){
			var selected = $("#extraChargesChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#extraChargeschooseByYear").show();	
			}else {
				
		        $("#extraChargeschooseByYear").hide();	
			}


		});


		$('#extraChargesChDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});

		$( "#expenseCode" ).autocomplete();
		
		//====
		
		
		//=====

		$("#extraChargesQueryButton").click(function(){
			//alert("you just click me");
			var selected = $("#extraChargesFilter option:selected").val();
			if(selected == "date"){
					var date = $('#extraChargesChDate').val();
					$('#displayextraCharges').load('extraChargesController.php?status=bydate&date='+date);
					//$('#expensesDisplayDataDiv').load('expDate.php?date='+date);
					//$.post('monthlyExpenseController.php',{'expenseDateFilter': date},function(data) {
					//		$('#expensesDisplayDataDiv').html(data);
						
					//});
					
				
			}else if(selected == "month"){
					var month = $("#extraChargesChMonth").val();
					var year = 	$("#extraChargesChYear").val();				
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						$('#displayextraCharges').load('extraChargesController.php?status=bymonth&month='+month+'&year='+year);
						
					}
				
			}else if(selected == "year"){
				var year = 	$("#extraChargesChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{
					$('#displayextraCharges').load('extraChargesController.php?status=byyear&year='+year);
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
	
	
	
	$("#CloseextraCharges").click(function(){	closeTab();});

	//$('#extraCharges-form').formly({'onBlur':false, 'theme':'Dark'});
	$('#extraChargesDate').datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$('#showextraCharges').button();
	$("#extraChargesInPDF").click(function(){
		var date = $("#extraChargesDate").val();
		$("#displayextraCharges").load("pdfload.php?getWhatPDF=extraCharges&date="+date);

	});
});
</script>
<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 12px;
	}
-->
</style>
<a id="CloseextraCharges" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<!--  <form id="extraCharges-form" name="extraCharges-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Select Date</i></b></legend>
			  	<table class="tdtext">
			  		<tr>
			  			<td>Date: </td>
					     <td><input readonly type="text" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="extraChargesDate" id="extraChargesDate" size="15">
					     </td>
			  		</tr>
					 <tr><td><label id="showextraCharges">Sales</label>  </td></tr>
				</table>
	</fieldset>
</form>
-->

<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >View Charges Sales </legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="extraChargesFilter" id="extraChargesFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="extraChargeschooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="extraChargesChDate" size="10" id="extraChargesChDate" /> </td>
							  </tr>
							  <tr id="extraChargeschooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="extraChargesChMonth" id="extraChargesChMonth" >
							  			<?php getGeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="extraChargeschooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="extraChargesChYear" id="extraChargesChYear" > 
							 	<?php getGeneralYears();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="extraChargesQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
<a id="extraChargesInPDF"  href="#"><img src="images/PDF2.png" width="40" height="40"></img></a>
<div id="displayextraCharges"></div>