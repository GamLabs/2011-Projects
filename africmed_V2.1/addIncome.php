<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>

<script>

    $(document).ready(function () {

    	function validateAddExp(){
			$('#monthlyIncomeForm').validate({
				
					'rules':{
						'incomeCode':'required',
						'incomeChNo':'required',
						'incomeDesc': 'required',
						'incomeComment': 'required',
						'incomeAmount': {
							'required':true,
							'number':true
						},
						'incomeType': 'required',
						'incomeDate': {
									'required':true,
									'date':true
								},
						'incomeChNo': {
							'required':true,
							'number':true
						}
					},
					messages: {
						incomeCode: "<i style='color:red;'>Nominal Code is Required<i>",
						incomeChNo: "<i style='color:red;'>Cheque Number  is Required<i>",
						incomeDesc: "<i style='color:red;'>Name or Description is Required<i>",
						incomeComment: "<i style='color:red;'> Comment is Required<i>",
						incomeAmount: {
							required: "<i style='color:red;'>Amount is Required<i>",
							number: "<i style='color:red;'>Invalid Number<i>"
						},
						incomeType: "<i style='color:red;'>Type is Required <i>",
						incomeDate: {
							required: "<i style='color:red;'>Date is Required<i>",
							date: "<i style='color:red;'>Invalid Date<i>"
						},
						incomeChNo: {
							required: "<i style='color:red;'>Cheque Number is Required<i>",
							number: "<i style='color:red;'>Invalid Number<i>"
						}

					},
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      if(errors){
					    	  $("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
	}
	$('#monthlyIncomeForm').ajaxForm({
		beforeSubmit: validateAddExp(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Incomes</p>').dialog('open');
					$('#monthlyIncomeForm').resetForm();
				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
			}
		//}
	});
    	
    	$("#incomesQueryButton").button();
    	$("#incomeSubmit").button();   	
        $("#incomechooseByDate").hide();
        $("#incomechooseByMonth").hide();
        $("#incomechooseByYear").hide();
		$("#monthlyIncomeTab").tabs();

		$("#incomeFilter").change(function(){
			var selected = $("#incomeFilter option:selected").val();
			if(selected == "date"){
				$("#incomechooseByDate").show();
		        $("#incomechooseByMonth").hide();
		        $("#incomechooseByYear").hide();	
			}else if(selected == "month"){
				$("#incomechooseByDate").hide();
		        $("#incomechooseByMonth").show();
		        $("#incomechooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#incomechooseByYear").show();	
				$("#incomechooseByDate").hide();
		        $("#incomechooseByMonth").hide();
		       
			}else{

				$("#incomechooseByDate").hide();
		        $("#incomechooseByMonth").hide();
		        $("#incomechooseByYear").hide();	
			}


		});

		$("#incomeChMonth").change(function(){
			var selected = $("#incomeChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#incomechooseByYear").show();	
			}else {
				
		        $("#incomechooseByYear").hide();	
			}


		});

		$("#incomeType").change(function(){
			var selected = $("#incomeType option:selected").val();
			if(selected == "Cheque"){
				
		        $("#incomechequeNo").show();
		        $("#incomeChNo").val("");	
			}else {
				
		        $("#incomechequeNo").hide();	
		        $("#incomeChNo").val("0");
			}
		});
		

		$('#incomeDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});
		$('#incomeChDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});

		$( "#incomeCode" ).autocomplete();
		
		//====
		
		
		//=====

		$("#incomesQueryButton").click(function(){
			//alert("you just click me");
			var selected = $("#incomeFilter option:selected").val();
			if(selected == "date"){
					var date = $('#incomeChDate').val();
					$('#incomesDisplayDataDiv').load('incomeDate.php?date='+date);
					//$.post('monthlyIncomeController.php',{'incomeDateFilter': date},function(data) {
					//		$('#incomesDisplayDataDiv').html(data);
						
					//});
					
				
			}else if(selected == "month"){
					var month = $("#incomeChMonth").val();
					var year = 	$("#incomeChYear").val();				
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						$('#incomesDisplayDataDiv').load('incomeMonth.php?month='+month+'&year='+year);
					}
				
			}else if(selected == "year"){
				var year = 	$("#incomeChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{
					$('#incomesDisplayDataDiv').load('incomeYear.php?year='+year);
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
    
		$("#CloseMonthlyExpe").click(function(){closeTab(); });
	});
</script>

<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 14px;
	}
-->
</style>
<a id="CloseMonthlyExpe" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<?php //getIncomeByMonth(6);
//getIncomesByYear(2011);
//getIncomesByDate("2011-08-03");?>


<div id="monthlyIncomeTab">
	<ul>
	
   	 <li><a href="#monthIncomeInput">Add Income</a></li>
   	<li><a href="#monthIncomeView">View Income</a></li> 
 	 </ul>
	<!--  first tab-->
	
	<div id="monthIncomeInput">
		
				<form id="monthlyIncomeForm" name="monthlyIncomeForm" action="income_controller.php" method="post">
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
							  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Add Income</legend>
							  <table  cellpadding="0" border="0" class="tdtext">
							 		 <tr>
							  			   <td><label>Nominal Code: </label></td><td>
							  			   	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="incomeCode"  id="incomeCode" >
							  			   <?php getNominalCodes('income');?>			
							  			   
							  			   </select>
							  			   </td>
							  	    </tr>
							  		<tr>
							  			   <td><label>Description: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeDesc" size="30" id="incomeDesc" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Comment: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeComment" size="30" id="incomeComment" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Date: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeDate" size="15" id="incomeDate" /> </td>
									</tr>
									<tr>
										  <td><label>Amount: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeAmount" size="15" id="incomeAmount" /> </td>
									</tr>
									<tr>
							  			   <td><label>Type: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="incomeType"  id="incomeType" >
							  			   			<option value="">Select One</option>
							  			   			<option value="Cash">Cash</option>
							  			   			<option value="Cheque">Cheque</option>
							  			   
							  			   </select>
							  			    </td>
									</tr>
									
									<tr style="display:none" id="incomechequeNo">
							  			   <td><label>Bank Name</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="incomeBankCode" name="incomeBankCode" ><?php getAccounts();?></select>&nbsp<label>Cheque No: </label><input value="0" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeChNo" size="15" id="incomeChNo" /> </td>
									</tr>
									
							  		 <tr>
							  		 <td><label></label>  </td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="submit" name="incomeSubmit"  id="incomeSubmit" value="Add Income"/></td>
							  		 </tr>
								</table>
					</fieldset>
				</form>
		</div>
	
	<div id="monthIncomeView">
		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >View Income </legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="incomeFilter" id="incomeFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="incomechooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="incomeChDate" size="10" id="incomeChDate" /> </td>
							  </tr>
							  <tr id="incomechooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="incomeChMonth" id="incomeChMonth" >
							  			<?php getGeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="incomechooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="incomeChYear" id="incomeChYear" > 
							 	<?php getGeneralYears()?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="incomesQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
				<div id="incomesDisplayDataDiv">
				
				
				</div>
			

	</div>
</div>
