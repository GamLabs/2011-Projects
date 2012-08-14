<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script type="text/javascript">
<!--
	$(document).ready(function(){

		$("#generalFilter").change(function(){
			var selected = $("#generalFilter option:selected").val();
			if(selected == "date"){
				$("#generalchooseByDate").show();
		        $("#generalchooseByMonth").hide();
		        $("#generalchooseByYear").hide();	
			}else if(selected == "month"){
				$("#generalchooseByDate").hide();
		        $("#generalchooseByMonth").show();
		        $("#generalchooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#generalchooseByYear").show();	
				$("#generalchooseByDate").hide();
		        $("#generalchooseByMonth").hide();
		       
			}else{

				$("#generalchooseByDate").hide();
		        $("#generalchooseByMonth").hide();
		        $("#generalchooseByYear").hide();	
			}


		});

		$("#generalChMonth").change(function(){
			var selected = $("#generalChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#generalchooseByYear").show();	
			}else {
				
		        $("#generalchooseByYear").hide();	
			}


		});
		$("#generalChCat").change(function(){
			var selected = $("#generalChCat option:selected").val();
			if(selected != "Slect One"){
				
				if(selected == "companyBills"){
					
					$("#choosePrivateFilter").hide();
					$("#chooseInsuranceFilter").hide();
					$("#chooseCompanyFilter").show();

				} else if(selected == "insuranceBills"){
					$("#choosePrivateFilter").hide();
					$("#chooseCompanyFilter").hide();
					$("#chooseInsuranceFilter").show();
					
				}else if(selected == "privateBills"){
					$("#choosePrivateFilter").show();
					$("#chooseCompanyFilter").hide();
					$("#chooseInsuranceFilter").hide();
					
				}else{
					$("#choosePrivateFilter").hide();
					$("#chooseCompanyFilter").hide();
					$("#chooseInsuranceFilter").hide();
				}
				
				
				$("#generalFilterDiv").show();	
			}else {
				$("#choosePrivateFilter").hide();
				$("#chooseCompanyFilter").hide();
				$("#chooseInsuranceFilter").hide();
				$("#generalFilterDiv").hide();
				$("#generalchooseByDate").hide();
		        $("#generalchooseByMonth").hide();
		        $("#generalchooseByYear").hide();
					
			}


		});

		
		$("#generalQueryButton").button();
    	$("#generalSubmit").button();   	
        $("#generalchooseByDate").hide();
        $("#generalchooseByMonth").hide();
        $("#generalchooseByYear").hide();
        $("#generalFilterDiv").hide();
        $("#generalChDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
        
        $('#pdfprintprivatept').liveSearch({url: 'privateBillsController.php?page=privateBill&liveSearchPnumber='+$('#pdfprintprivatept').val()});
		$('#livePnumberQueryprivateBill').live('click',function(e){
		$('#pdfprintprivatept').val(($(this).text()));
		var pnumber = $('#pdfprintprivatept').val();
		
		$('#jquery-live-search').slideUp();
		
		e.stopImmediatePropagation();
		return false;
	
    });
	    
		$("#generalQueryButton").click(function(){
			var selectedCat = $("#generalChCat option:selected").val();
			
			var selected = $("#generalFilter option:selected").val();
			if(selected == "date"){
					var category = $('#generalChCat').val();
					var date = $('#generalChDate').val();
					if(selectedCat == "companyBills"){
						var comp = encodeURIComponent($("#companyNameFilter").val());
					
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&date="+date+"&status=bydate&company="+comp);
					}else if (selectedCat == "insuranceBills"){
						var comp = encodeURIComponent($("#insuranceNameFilter").val());
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&date="+date+"&status=bydate&insurance="+comp);
					
					}else if (selectedCat == "privateBills"){
						var pn =  $('#pdfprintprivatept').val();
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&pnumber="+pn+"&date="+date+"&status=bydate");
					
					}else{
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&date="+date+"&status=bydate");
					}
				
			}else if(selected == "month"){
					var category = $('#generalChCat').val();
					var month = $("#generalChMonth").val();
					var year = 	$("#generalChYear").val();
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						if(selectedCat == "companyBills"){
							var comp = encodeURIComponent($("#companyNameFilter").val());
							
							$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&month="+month+"&year="+year+"&status=bymonth&company="+comp);
						}else if (selectedCat == "insuranceBills"){
							var comp = encodeURIComponent($("#insuranceNameFilter").val());
							
							$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&month="+month+"&year="+year+"&status=bymonth&insurance="+comp);
						
						}else if (selectedCat == "privateBills"){
							var pn =  $('#pdfprintprivatept').val();
							
							$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&pnumber="+pn+"&month="+month+"&year="+year+"&status=bymonth");
						
						}else{
							
							$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&month="+month+"&year="+year+"&status=bymonth");
						}
						
						
					}
					
					
			}else if(selected == "year"){
				var category = $('#generalChCat').val();
				var year = 	$("#generalChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{

					if(selectedCat == "companyBills"){
						var comp = encodeURIComponent($("#companyNameFilter").val());
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&year="+year+"&status=byyear&company="+comp+"");
					}else if (selectedCat == "insuranceBills"){
						var comp = encodeURIComponent($("#insuranceNameFilter").val());
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&year="+year+"&status=byyear&insurance="+comp+"");
					
					}else if (selectedCat == "privateBills"){
						var pn =  $('#pdfprintprivatept').val();
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&pnumber="+pn+"&year="+year+"&status=byyear");
					
					}else{
						
						$('#generalDisplayDataDiv').load("pdfload.php?getWhatPDF="+category+"&year="+year+"&status=byyear");
					}
					
					
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
		$("#ClosePrinting").click(function(){closeTab(); });
	});
//-->
</script>

<a id="ClosePrinting" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="GeneralPrintView">
		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >Printing </legend>
						
							<table>
							<tr>
							<td><label>Choose Category:</label></td>
							<td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="generalChCat" id="generalChCat" >
								<option>Slect One</option>
								<option value="expenses">Expenses</option>
								<option value="dayBooks">Day Books</option>
								<option value="cashSales">Cash Sales</option>
								<option value="debtors">Debtors</option>
								<option value="pettyCash">Petty cash</option>
								<option value="companyBills">Company Bills</option>
								<option value="insuranceBills">Insurance Bills</option>
								<option value="privateBills">Private Bills</option>
							</select>
							</td>
							</tr>
							<tr id="choosePrivateFilter" style="display:none;">
							<td><label>Patient Number:</label></td>
							<td>
							<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="pdfprintprivatept" name="pdfprintprivatept"/>
							</td>
							</tr>
							<tr id="chooseCompanyFilter" style="display:none;">
							<td><label>Choose Company:</label></td>
							<td>
							<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="companyNameFilter" id="companyNameFilter" >
								     <?php getCompanys();?>
							</select>
							</td>
							</tr>
							<tr id="chooseInsuranceFilter" style="display:none;">
							<td><label>Choose Insurance:</label></td>
							<td>
							<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="insuranceNameFilter" id="insuranceNameFilter" >
								     <?php getInsurances();?>
							</select>
							</td>
							</tr>
							<tr id="generalFilterDiv" style="display:none;">
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="generalFilter" id="generalFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="generalchooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="generalChDate" size="10" id="generalChDate" /> </td>
							  </tr>
							  <tr id="generalchooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="generalChMonth" id="generalChMonth" >
							  			<?php getGeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="generalchooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="generalChYear" id="generalChYear" > 
							 	<?php getGeneralYears();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="generalQueryButton"  >Generate PDF</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
				<div id="generalDisplayDataDiv">
				
				
				</div>
			

	</div>