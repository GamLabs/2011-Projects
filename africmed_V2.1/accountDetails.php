<script>
$("#accDetailchooseByMonth").hide();
$("#accDetailchooseByYear").hide();
$("#accountDetailQueryButton").button();
$("#accDetailFilter").change(function(){
	var selected = $("#accDetailFilter option:selected").val();
	 if(selected == "month"){
	
        $("#accDetailchooseByMonth").show();
        $("#accDetailchooseByYear").hide();	
	}else if(selected == "year"){
		
		 $("#accDetailchooseByYear").show();	
		
        $("#accDetailchooseByMonth").hide();
       
	}else{

        $("#accDetailchooseByMonth").hide();
        $("#accDetailchooseByYear").hide();	
	}


});

$("#accDetailChMonth").change(function(){
	var selected = $("#accDetailChMonth option:selected").val();
	if(selected != "Select Month"){
		
        $("#accDetailchooseByYear").show();	
	}else {
		
        $("#accDetailchooseByYear").hide();	
	}


});

$("#accDetailChMonth").change(function(){
	var selected = $("#accDetailChMonth option:selected").val();
	if(selected != "Select Month"){
		
        $("#accDetailByYear").show();	
	}else {
		
        $("#accDetailByYear").hide();	
	}


});
$("#accountDetailQueryButton").click(function(){
	var selected = $("#accDetailFilter option:selected").val();
	var code = $("#accountCode").html();

	if(selected == "month"){
		var month = $("#accDetailChMonth").val();
		var year = 	$("#accDetailChYear").val();				
		if(year == "Select Year" || month == "Select Month"){
				$("#errorMessage").html("<p style='color:red'>Please Select Month and Year</p>").dialog('open');
		}else{
			$('#accountDetailPane').load("accountDetailsPage.php?accountCode="+code+"&month="+month+"&year="+year);
		}
	
}else if(selected == "year"){
	var year = 	$("#accDetailChYear").val();
	if(year == "Select Year" ){
		$("#errorMessage").html("<p style='color:red'>Please Select a Year</p>").dialog('open');
	}else{
		$('#accountDetailPane').load("accountDetailsPage.php?accountCode="+code+"&year="+year);
}
	
   
}else{
	$("#errorMessage").html("<p style='color:red'>Please Filter By Date,Month or Year</p>").dialog('open');
}
	//alert();
	//$('#accountDetailPane').load("accountDetailsPage.php?accountCode="+code+"&month="+month);
	//$("#accountDetailViewWindow").dialog('open');
			
	
});


</script>

<?php 

require_once 'includes/connect.php';
require_once 'includes/financeFunctions.php';


$code = $_GET['accountCode'];
//echo "<h3>Transactions Details  For: ".getAccountName($code)."</h3>";

?>
<span style="display:none" id="accountCode"><?php echo $_GET['accountCode'];?></span>
<hr>
<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" ><?php echo "Transactions Details  For ".getAccountName($code);?>  Details</legend>
						
							<table>
							<tr>
						  	<td><label>Filter By:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="accDetailFilter" id="accDetailFilter" >
										<option>Slect One</option>
										<option value="month" >Month</option>
										<option value="year" >Year</option>
								  </select>
							</td>
							</tr>  
							
							
							
							  <tr id="accDetailchooseByMonth">
							  	<td><label>Choose Month:</label></td>
							  	<td>
							  		<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="accDetailChMonth" id="accDetailChMonth" >
							  			<?php getGeneralMonths();?>
								  </select>
								 </td>
							    
							  </tr>
							  <tr id="accDetailchooseByYear">
							 <td><label>Choose Year:</label> </td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="accDetailChYear" id="accDetailChYear" > 
							 	<?php getGeneralYears();?>
							 </select>
							 </td>
						
							 </tr>
							 <tr><td></td>
							 <td>
							 <button id="accountDetailQueryButton"  >Query</button>
							</td>
							</tr>
							</table>
					
				</fieldset>

<div id="accountDetailPane"></div>

