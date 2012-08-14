<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>

    $(document).ready(function () {

    	function validateAddExp(){
			$('#pettyCashForm').validate({
				
					'rules':{
						'pettyCashCode':'required',
						'pettyCashChNo':'required',
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
						pettyCashCode: "<i style='color:red;'>Nominal Code is Required<i>",
						pettyCashChNo: "<i style='color:red;'>Cheque Number is Required<i>",
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
	$('#pettyCashForm').ajaxForm({
		beforeSubmit: validateAddExp(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Expenses</p>').dialog('open');
					$('#pettyCashForm').resetForm();
				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
			}
		//}
	});
    	
    	$("#pettyCashQueryButton").button();
    	$("#pettyCashSubmit").button();   	
        $("#pettyCashchooseByDate").hide();
        $("#pettyCashchooseByMonth").hide();
        $("#pettyCashchooseByYear").hide();
		$("#pettyCashTab").tabs();

		$("#pettyCashFilter").change(function(){
			var selected = $("#pettyCashFilter option:selected").val();
			if(selected == "date"){
				$("#pettyCashchooseByDate").show();
		        $("#pettyCashchooseByMonth").hide();
		        $("#pettyCashchooseByYear").hide();	
			}else if(selected == "month"){
				$("#pettyCashchooseByDate").hide();
		        $("#pettyCashchooseByMonth").show();
		        $("#pettyCashchooseByYear").hide();	
			}else if(selected == "year"){
				
				 $("#pettyCashchooseByYear").show();	
				$("#pettyCashchooseByDate").hide();
		        $("#pettyCashchooseByMonth").hide();
		       
			}else{

				$("#pettyCashchooseByDate").hide();
		        $("#pettyCashchooseByMonth").hide();
		        $("#pettyCashchooseByYear").hide();	
			}


		});

		$("#pettyCashChMonth").change(function(){
			var selected = $("#pettyCashChMonth option:selected").val();
			if(selected != "Select Month"){
				
		        $("#pettyCashchooseByYear").show();	
			}else {
				
		        $("#pettyCashchooseByYear").hide();	
			}


		});

		$("#pettyCashType").change(function(){
			var selected = $("#pettyCashType option:selected").val();
			
			if(selected == "Cheque"){
				
		        $("#pettychequeNo").show();	
		        $("#pettyCashChNo").val("");
			}else {
				
		        $("#pettychequeNo").hide();
		        $("#pettyCashChNo").val("0");
			}
		});
		

		$('#pettyCashDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});
		$('#pettyCashChDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});
		
		
		$("#pettyCashQueryButton").click(function(){
			//alert("you just click me");
			var selected = $("#pettyCashFilter option:selected").val();
			if(selected == "date"){
					var date = $('#pettyCashChDate').val();
					//$.post('pettyCashController.php',{'pettyCashDateFilter': date},function(data) {
					//		$('#pettyCashDisplayDataDiv').html(data);
						
					//});
					$('#pettyCashDisplayDataDiv').load('pettyDate.php?date='+date);
					
				
			}else if(selected == "month"){
					var month = $("#pettyCashChMonth").val();
					var year = 	$("#pettyCashChYear").val();
					if(year == "Select Year" || month == "Select Month"){
							$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
					}else{
						//$.post('pettyCashController.php',{'pettyCashMonthFilter': month,'year':year},function(data) {
							//$('#pettyCashDisplayDataDiv').html(data);
						
					//});
						$('#pettyCashDisplayDataDiv').load('pettyMonth.php?month='+month+'&year='+year);
					}
					
					
			}else if(selected == "year"){
				var year = 	$("#pettyCashChYear").val();
				if(year == "Select Year" ){
					$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
				}else{
				//$.post('pettyCashController.php',{'pettyCashYearFilter':year},function(data) {
					//$('#pettyCashDisplayDataDiv').html(data);
				
				//});
					$('#pettyCashDisplayDataDiv').load('pettyYear.php?year='+year);
			}
				
		       
			}else{
				$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
			}

		});
		$("#ClosePettyCash").click(function(){closeTab(); });

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

<a id="ClosePettyCash" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<?php //getExpenseByMonth(6);
//getExpensesByYear(2011);
//getExpensesByDate("2011-08-03");?>
<div id="pettyCashTab">
	<ul>
	
   	 <li><a href="#pettyCashInput">Add Petty Cash</a></li>
   	<li><a href="#pettyCashView">View Petty Cash</a></li> 
 	 </ul>
	<!--  first tab-->
	
	<div id="pettyCashInput">
		
				<form id="pettyCashForm" name="pettyCashForm" action="pettyCash_controller.php" method="post">
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
							  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Add Petty Cash</legend>
							  <table  cellpadding="0" border="0" class="tdtext">
								  <tr>
							  			   <td><label>Nominal Code: </label></td><td>
							  			   	<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pettyCashCode"  id="pettyCashCode" >
							  			   <?php getNominalCodes('expense');?>			
							  			   
							  			   </select>
							  			   </td>
							  	    </tr>
							  		<tr>
							  			   <td><label>Description: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashDesc" size="30" id="pettyCashDesc" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Comment: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashComment" size="30" id="pettyCashComment" /> </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Date: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashDate" size="15" id="pettyCashDate" /> </td>
									</tr>
									<tr>
										  <td><label>Amount: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashAmount" size="15" id="pettyCashAmount" /> </td>
									</tr>
									<tr>
							  			   <td><label>Type: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pettyCashType"  id="pettyCashType" >
							  			   			<option value="Cash">Cash</option>
							  			   			<option value="Cheque">Cheque</option>
							  			   
							  			   </select>
							  			    </td>
									</tr>
									<tr style="display:none" id="pettychequeNo">
							  			   <td><label>Bank Name</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="pettyCashBankCode" name="pettyCashBankCode" ><?php getAccounts();?></select>&nbsp<label>Cheque No: </label><input value="0" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashChNo" size="15" id="pettyCashChNo" /> </td>
									</tr>
									
							  		 <tr>
							  		 <td><label></label>  </td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="submit" name="pettyCashSubmit"  id="pettyCashSubmit" value="Add Petty Cash"/></td>
							  		 </tr>
								</table>
					</fieldset>
				</form>
		</div>
	
	<div id="pettyCashView">
		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >View Petty Cash </legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pettyCashFilter" id="pettyCashFilter" >
										<option>Slect One</option>
										<option value="date">Date</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							  <tr id="pettyCashchooseByDate">
							 	<td> <label>Choose Date:</label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pettyCashChDate" size="10" id="pettyCashChDate" /> </td>
							  </tr>
							  <tr id="pettyCashchooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pettyCashChMonth" id="pettyCashChMonth" >
							  			<?php getMonthsFromPettyCash();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="pettyCashchooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="pettyCashChYear" id="pettyCashChYear" > 
							 	<?php getYearsFromPettyCash();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="pettyCashQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>
				
				<div id="pettyCashDisplayDataDiv">
				
				
				</div>
			

	</div>
</div>
