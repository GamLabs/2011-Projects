<?php require_once 'includes/requireFile.php';?>
<script>
    $(document).ready(function () {
		$("#companyBillsTabs").tabs();
		$("#companyBillsInfoDis").button();
		$("#companyBillsGenerator").button();
		$("#companyBillsViewer").button();
		$("#companyBillsViewerSummary").button();
		

		//===
			$("#companyBillsViewer").click(function(){
			var comp = encodeURIComponent($("#companyBillsName").val());
			var month = $("#companyBillsMonth").val();
			var year = $("#companyBillsYear").val();
			
			if(comp == "Select Company" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Company,Month and Year Cannot Be Empty").dialog('open');
			}else{
				$('#mainDisplayForCompanyBills').load('displayCompanyBills.php?comp='+comp+'&month='+month+'&year='+year);
					//$.post('companyBillsController.php',{'generateCompanyBills': comp,'month':month,'year':year},function(data) {
					//	$('#mainDisplayForCompanyBills').html(data);
						
			//});
			}
		});

			$("#companyBillsViewerSummary").click(function(){
				var comp = encodeURIComponent($("#companyBillsName").val());
				var month = $("#companyBillsMonth").val();
				var year = $("#companyBillsYear").val();
				
				if(comp == "Select Company" || month =="Select Month" || year == "Select Year"){
					
					$("#errorMessage").html("Sorry Company,Month and Year Cannot Be Empty").dialog('open');
				}else{
					$('#mainDisplayForCompanyBills').load('displayCompanyBillsSummary.php?comp='+comp+'&month='+month+'&year='+year);
						//$.post('companyBillsController.php',{'generateCompanyBills': comp,'month':month,'year':year},function(data) {
						//	$('#mainDisplayForCompanyBills').html(data);
							
				//});
				}
			});

		$("#companyBillsGenerator").click(function(){
			var comp = $("#companyBillsName").val();
			var month = $("#companyBillsMonth").val();
			var year = $("#companyBillsYear").val();
			
			if(comp == "Select Company" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Company,Month and Year Cannot Be Empty").dialog('open');
			}else{
					$.post('companyBillsController.php',{'generateCompanyBills': comp,'month':month,'year':year},function(data) {
						$('#mainDisplayForCompanyBills').html(data);
						
			});
			}
		});
	
		$("#companyBillsInfoDis").click(function(){
			var comp = encodeURIComponent($("#companyBillsNameInfo").val());
			//JobTitle = encodeURIComponent(JobTitle)
			
			var month = $("#companyBillsMonthInfo").val();
			var year = $("#companyBillsYearInfo").val();
			
			if(comp == "Select Company" || month =="Select Month" || year == "Select Year"){
				
				$("#errorMessage").html("Sorry Company,Month and Year Cannot Be Empty").dialog('open');
			}else{
				$("#mainDisplayForCompanyBills").empty().load("company_bills.php?comp="+comp+"&month="+month+"&year="+year+"");
					//$.post('companyBillsController.php',{'displayCompanyBills': comp,'month':month,'year':year},function(data) {
					//	$('#mainDisplayForCompanyBills').html(data);	
					//});
			}
		});
			

		//===
		$("#CloseCompanyBills").click(function(){closeTab(); });
    	
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
<a id="CloseCompanyBills" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

<div id="companyBillsTabs">
	<ul>
   	 <li><a href="#companyBillsGenerate">Generate Bill</a></li>
   	<li><a href="#companyBillsInfo">Bill Payment</a></li> 
 	 </ul>
	<div id="companyBillsGenerate">
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
						  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Generate Bills</legend>
						  	<table  class="tdtext">
						  		<tr>
						  			<td>Company:<br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="companyBillsName" id="companyBillsName" >
								     <?php getCompanys();?>
								     </select>
								     </td>
						  		</tr>
						  		<tr >
								    <td>Month:<br><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="companyBillsMonth" id="companyBillsMonth" >
								     	<?php getBillingMonths();?>
								     </select>
								     </td>
								</tr>
								<tr>
								     <td>Year:<br><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="companyBillsYear" id="companyBillsYear" >
								     		<?php getBillingYears();?>
								     </select></td>
								 </tr>
								 <tr><td><label id="companyBillsGenerator">Generate Bill</label> <label id="companyBillsViewer">View Detail Bills</label><label id="companyBillsViewerSummary">View Summary Bills</label> </td></tr>
							</table>
				</fieldset>
			
			
		
			
	
		</div>
		<div id="companyBillsInfo">
				
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
						  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Bill Payment</legend>
						  	<table   class="tdtext">
						  		<tr>
						  			<td>Company: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="companyBillsNameInfo" id="companyBillsNameInfo" >
								     		<?php getCompanys();?>
								     </select>
								     </td>
						  		</tr>
						  		<tr>
								    <td>Month: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="companyBillsMonthInfo" id="companyBillsMonthInfo" >
								     		<?php getBillingMonths();?>
								     </select>
								     </td>
								 </tr>
								<tr>
								     <td>Year: <br>
								     <select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="companyBillsYearInfo" id="companyBillsYearInfo" >
								     		<?php getBillingYears();?>
								     </select>
								     </td>
								 </tr>
								 <tr><td><label id="companyBillsInfoDis">Show Bills</label>  </td></tr>
							</table>
				</fieldset>
			
		</div>
</div>

<div id="mainDisplayForCompanyBills"></div>
	 	