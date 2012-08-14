<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>
$(document).ready(function () {
	$("#PharSalesInPDF").hide();
	$('#showPharSales').click(function(){
		var date = $("#pharSalesDate").val();
		$('#displayPharSales').load('pharSalesController.php?date='+date);
		//$("#PharSalesInPDF").show();
		//$.post('pharSalesController.php',{'pharSalesDate': $("#pharSalesDate").val()},function(data) {
		//	
		//	if(data == 0){
		//		$('#displayPharSales').hide();
		//		$("#errorMessage").html('<p>NO SALES ON THIS DATE</p>').dialog('open');
		//	}else{
		//		$('#displayPharSales').show();
		//		$('#displayPharSales').html(data);
		//	}
		//});
	
		
	});	

	//=====
	$("#pharQueryButton").button();
    	$("#expenseSubmit").button();   	
        $("#pharchooseByDate").hide();
        $("#pharchooseByMonth").hide();
        $("#pharchooseByYear").hide();
		$("#monthlyExpenseTab").tabs();

		$("#pharSalesFilter").change(function(){
			var selected = $("#pharSalesFilter option:selected").val();
			if(selected == "date"){
				$("#pharchooseByDate").show();
		        $("#pharchooseByMonth").hide();
		        $("#pharchooseByYear").hide();	
			}else if(selected == "month"){
				$("#pharchooseByDate").hide();
		        $("#pharchooseByMonth").show();
		        $("#pharchooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#pharchooseByYear").show();	
				$("#pharchooseByDate").hide();
		        $("#pharchooseByMonth").hide();
		       
			}else{

				$("#pharchooseByDate").hide();
		        $("#pharchooseByMonth").hide();
		        $("#pharchooseByYear").hide();	
			}


		});

		$("#pharChMonth").change(function(){
			var selected = $("#pharChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#pharchooseByYear").show();	
			}else {
				
		        $("#pharchooseByYear").hide();	
			}


		});


		$('#pharChDate').datepicker({
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

		$("#pharQueryButton").click(function(){
			//alert("you just click me");
			var selected = $("#pharSalesFilter option:selected").val();
			if(selected == "date"){
					var date = $('#pharChDate').val();
					$('#displayPharSales').load('pharSalesController.php?status=bydate&date='+date);
					//$('#expensesDisplayDataDiv').load('expDate.php?date='+date);
					//$.post('monthlyExpenseController.php',{'expenseDateFilter': date},function(data) {
					//		$('#expensesDisplayDataDiv').html(data);
						
					//});
					
				
			}else if(selected == "month"){
					var month = $("#pharChMonth").val();
					var year = 	$("#pharChYear").val();				
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						$('#displayPharSales').load('pharSalesController.php?status=bymonth&month='+month+'&year='+year);
						
					}
				
			}else if(selected == "year"){
				var year = 	$("#pharChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{
					$('#displayPharSales').load('pharSalesController.php?status=byyear&year='+year);
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
	
	
	
	$("#ClosePharSales").click(function(){	closeTab();});

	//$('#pharSales-form').formly({'onBlur':false, 'theme':'Dark'});
	$('#pharSalesDate').datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
	$('#showPharSales').button();
	$("#PharSalesInPDF").click(function(){
		var date = $("#pharSalesDate").val();
		$("#displayPharSales").load("pdfload.php?getWhatPDF=pharSales&date="+date);

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
<a id="ClosePharSales" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<!--  <form id="pharSales-form" name="pharSales-form" action ="" method="post" >
	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Select Date</i></b></legend>
			  	<table class="tdtext">
			  		<tr>
			  			<td>Date: </td>
					     <td><input readonly type="text" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pharSalesDate" id="pharSalesDate" size="15">
					     </td>
			  		</tr>
					 <tr><td><label id="showPharSales">Sales</label>  </td></tr>
				</table>
	</fieldset>
</form>
-->

<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >View Pharmacy Sales </legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pharSalesFilter" id="pharSalesFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="pharchooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pharChDate" size="10" id="pharChDate" /> </td>
							  </tr>
							  <tr id="pharchooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pharChMonth" id="pharChMonth" >
							  			<?php getGeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="pharchooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pharChYear" id="pharChYear" > 
							 	<?php getGeneralYears();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="pharQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
<a id="PharSalesInPDF"  href="#"><img src="images/PDF2.png" width="40" height="40"></img></a>
<div id="displayPharSales"></div>