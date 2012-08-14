<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>

<script>

    $(document).ready(function () {

    	function validateAddExp(){
			$('#monthlyExpForm').validate({
				
					'rules':{
						'expenseCode':'required',
						'expenseChNo':'required',
						'expenseDesc': 'required',
						'expenseComment': 'required',
						'expenseAmount': {
							'required':true,
							'number':true
						},
						'expenseType': 'required',
						'expenseDate': {
									'required':true,
									'date':true
								},
						'expenseChNo': {
							'required':true,
							'number':true
						}
					},
					messages: {
						expenseCode: "<i style='color:red;'>Nominal Code is Required<i>",
						expenseChNo: "<i style='color:red;'>Cheque Number  is Required<i>",
						expenseDesc: "<i style='color:red;'>Name or Description is Required<i>",
						expenseComment: "<i style='color:red;'> Comment is Required<i>",
						expenseAmount: {
							required: "<i style='color:red;'>Amount is Required<i>",
							number: "<i style='color:red;'>Invalid Number<i>"
						},
						expenseType: "<i style='color:red;'>Type is Required <i>",
						expenseDate: {
							required: "<i style='color:red;'>Date is Required<i>",
							date: "<i style='color:red;'>Invalid Date<i>"
						},
						expenseChNo: {
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
	$('#monthlyExpForm').ajaxForm({
		beforeSubmit: validateAddExp(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Expenses</p>').dialog('open');
					$('#monthlyExpForm').resetForm();
				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
			}
		//}
	});
    	
    	$("#expensesQueryButton").button();
    	$("#expenseSubmit").button();   	
        $("#chooseByDate").hide();
        $("#chooseByMonth").hide();
        $("#chooseByYear").hide();
		$("#monthlyExpenseTab").tabs();

		$("#expenseFilter").change(function(){
			var selected = $("#expenseFilter option:selected").val();
			if(selected == "date"){
				$("#chooseByDate").show();
		        $("#chooseByMonth").hide();
		        $("#chooseByYear").hide();	
			}else if(selected == "month"){
				$("#chooseByDate").hide();
		        $("#chooseByMonth").show();
		        $("#chooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#chooseByYear").show();	
				$("#chooseByDate").hide();
		        $("#chooseByMonth").hide();
		       
			}else{

				$("#chooseByDate").hide();
		        $("#chooseByMonth").hide();
		        $("#chooseByYear").hide();	
			}


		});

		$("#expenseChMonth").change(function(){
			var selected = $("#expenseChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#chooseByYear").show();	
			}else {
				
		        $("#chooseByYear").hide();	
			}


		});

		$("#expenseType").change(function(){
			var selected = $("#expenseType option:selected").val();
			if(selected == "Cheque"){
				
		        $("#chequeNo").show();
		        $("#expenseChNo").val("");	
			}else {
				
		        $("#chequeNo").hide();	
		        $("#expenseChNo").val("0");
			}
		});
		

		$('#expenseDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});
		$('#expenseChDate').datepicker({
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

		$("#expensesQueryButton").click(function(){
			//alert("you just click me");
			var selected = $("#expenseFilter option:selected").val();
			if(selected == "date"){
					var date = $('#expenseChDate').val();
					$('#expensesDisplayDataDiv').load('expDate.php?date='+date);
					//$.post('monthlyExpenseController.php',{'expenseDateFilter': date},function(data) {
					//		$('#expensesDisplayDataDiv').html(data);
						
					//});
					
				
			}else if(selected == "month"){
					var month = $("#expenseChMonth").val();
					var year = 	$("#expenseChYear").val();				
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						$('#expensesDisplayDataDiv').load('expMonth.php?month='+month+'&year='+year);
					}
				
			}else if(selected == "year"){
				var year = 	$("#expenseChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{
					$('#expensesDisplayDataDiv').load('expYear.php?year='+year);
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
<?php //getExpenseByMonth(6);
//getExpensesByYear(2011);
//getExpensesByDate("2011-08-03");?>


<div id="monthlyExpenseTab">
	<ul>
	
   	 <li><a href="#monthExpenseInput">Add Expenses</a></li>
   	<li><a href="#monthExpenseView">View Expenses</a></li> 
 	 </ul>
	<!--  first tab-->
	
	<div id="monthExpenseInput">
		
				<form id="monthlyExpForm" name="monthlyExpForm" action="expenses_controller.php" method="post">
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
							  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Add Expenses</legend>
							  <table  cellpadding="0" border="0" class="tdtext">
							 		 <tr>
							  			   <td><label>Nominal Code: </label></td><td>
							  			   	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="expenseCode"  id="expenseCode" >
							  			   <?php getNominalCodes('expense');?>			
							  			   
							  			   </select>
							  			   </td>
							  	    </tr>
							  		<tr>
							  			   <td><label>Description: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseDesc" size="30" id="expenseDesc" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Comment: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseComment" size="30" id="expenseComment" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Date: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseDate" size="15" id="expenseDate" /> </td>
									</tr>
									<tr>
										  <td><label>Amount: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseAmount" size="15" id="expenseAmount" /> </td>
									</tr>
									<tr>
							  			   <td><label>Type: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="expenseType"  id="expenseType" >
							  			   			<option value="">Select One</option>
							  			   			<option value="Cash">Cash</option>
							  			   			<option value="Cheque">Cheque</option>
							  			   
							  			   </select>
							  			    </td>
									</tr>
									
									<tr style="display:none" id="chequeNo">
							  			   <td><label>Bank Name</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="expenseBankCode" name="expenseBankCode" ><?php getAccounts();?></select>&nbsp<label>Cheque No: </label><input value="0" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseChNo" size="15" id="expenseChNo" /> </td>
									</tr>
									
							  		 <tr>
							  		 <td><label></label>  </td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="submit" name="expenseSubmit"  id="expenseSubmit" value="Add Expenses"/></td>
							  		 </tr>
								</table>
					</fieldset>
				</form>
		</div>
	
	<div id="monthExpenseView">
		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >View Expense </legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="expenseFilter" id="expenseFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="chooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="expenseChDate" size="10" id="expenseChDate" /> </td>
							  </tr>
							  <tr id="chooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="expenseChMonth" id="expenseChMonth" >
							  			<?php getMonthsFromExpense();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="chooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="expenseChYear" id="expenseChYear" > 
							 	<?php getYearsFromExpense();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="expensesQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
				<div id="expensesDisplayDataDiv">
				
				
				</div>
			

	</div>
</div>
