<?php require_once 'includes/requireFile.php';?>
<script>
    $(document).ready(function () {
		$("#insuranceBillsTabs").tabs();
		$("#insuranceBillsInfoDis").button();
		$("#insuranceBillsGenerator").button();
		$("#insuranceBillsViewer").button();
		$("#insuranceBillsViewerSummary").button();
		
		

		//===
			
		$("#insuranceBillsViewer").click(function(){
			var comp = encodeURIComponent($("#insuranceBillsName").val());
			var month = $("#insuranceBillsMonth").val();
			var year = $("#insuranceBillsYear").val();
			
			if(comp == "Select Insurance" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Insurance,Month and Year Cannot Be Empty").dialog('open');
			}else{
				$('#mainDisplayForInsuranceBills').load('displayInsuranceBills.php?comp='+comp+'&month='+month+'&year='+year);
					//$.post('insuranceBillsController.php',{'generateInsuranceBills': comp,'month':month,'year':year},function(data) {
						//$('#mainDisplayForInsuranceBills').html(data);
						
			//});
			}
		});

		$("#insuranceBillsViewerSummary").click(function(){
			var comp = encodeURIComponent($("#insuranceBillsName").val());
			var month = $("#insuranceBillsMonth").val();
			var year = $("#insuranceBillsYear").val();
			
			if(comp == "Select Insurance" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Insurance,Month and Year Cannot Be Empty").dialog('open');
			}else{
				$('#mainDisplayForInsuranceBills').load('displayInsuranceBillsSummary.php?comp='+comp+'&month='+month+'&year='+year);
					//$.post('insuranceBillsController.php',{'generateInsuranceBills': comp,'month':month,'year':year},function(data) {
						//$('#mainDisplayForInsuranceBills').html(data);
						
			//});
			}
		});

		$("#insuranceBillsGenerator").click(function(){
			var comp = $("#insuranceBillsName").val();
			var month = $("#insuranceBillsMonth").val();
			var year = $("#insuranceBillsYear").val();
			
			if(comp == "Select Insurance" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Insurance,Month and Year Cannot Be Empty").dialog('open');
			}else{
					$.post('insuranceBillsController.php',{'generateInsuranceBills': comp,'month':month,'year':year},function(data) {
						$('#mainDisplayForInsuranceBills').html(data);
						
			});
			}
		});
	
		$("#insuranceBillsInfoDis").click(function(){
			var comp = encodeURIComponent($("#insuranceBillsNameInfo").val());
			//JobTitle = encodeURIComponent(JobTitle)
			
			var month = $("#insuranceBillsMonthInfo").val();
			var year = $("#insuranceBillsYearInfo").val();
			
			if(comp == "Select Insurance" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Insurance,Month and Year Cannot Be Empty").dialog('open');
			}else{
				$("#mainDisplayForInsuranceBills").empty().load("insurance_bills.php?comp="+comp+"&month="+month+"&year="+year+"");
					//$.post('companyBillsController.php',{'displayCompanyBills': comp,'month':month,'year':year},function(data) {
					//	$('#mainDisplayForCompanyBills').html(data);	
					//});
			}
		});
			

		//===
		$("#CloseInsuranceBills").click(function(){closeTab(); });
    	
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

<a id="CloseInsuranceBills" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<div id="insuranceBillsTabs">
	<ul>
   	 <li><a href="#insuranceBillsGenerate">Generate Bill</a></li>
   	<li><a href="#insuranceBillsInfo">Bill Payment</a></li> 
 	 </ul>
	<div id="insuranceBillsGenerate">
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
						  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Generate Bills</legend>
						  	<table  class="tdtext">
						  		<tr>
						  			<td>Company:<br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="insuranceBillsName" id="insuranceBillsName" >
								     <?php getInsurances();?>
								     </select>
								     </td>
						  		</tr>
						  		<tr >
								    <td>Month:<br><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="insuranceBillsMonth" id="insuranceBillsMonth" >
								     	<?php getBillingMonths();?>
								     </select>
								     </td>
								</tr>
								<tr>
								     <td>Year:<br><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="insuranceBillsYear" id="insuranceBillsYear" >
								     		<?php getBillingYears();?>
								     </select></td>
								 </tr>
								 <tr><td><label id="insuranceBillsGenerator">Generate Bill</label> <label id="insuranceBillsViewer">View Detail Bills</label> <label id="insuranceBillsViewerSummary">View Summary Bills</label> </td></tr>
							</table>
				</fieldset>
					
	
		</div>
		<div id="insuranceBillsInfo">
				
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
						  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Bill Payment</legend>
						  	<table   class="tdtext">
						  		<tr>
						  			<td>Insurance: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="insuranceBillsNameInfo" id="insuranceBillsNameInfo" >
								     		<?php getInsurances();?>
								     </select>
								     </td>
						  		</tr>
						  		<tr>
								    <td>Month: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="insuranceBillsMonthInfo" id="insuranceBillsMonthInfo" >
								     		<?php getBillingMonths();?>
								     </select>
								     </td>
								 </tr>
								<tr>
								     <td>Year: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="insuranceBillsYearInfo" id="insuranceBillsYearInfo" >
								     		<?php getBillingYears();?>
								     </select>
								     </td>
								 </tr>
								 <tr><td><label id="insuranceBillsInfoDis">Show Bills</label>  </td></tr>
							</table>
				</fieldset>
			
		</div>
</div>

<div id="mainDisplayForInsuranceBills"></div>
	 	