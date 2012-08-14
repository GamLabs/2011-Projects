<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>

<script>
    $(document).ready(function () {
    	
    	$('#genBookDate').datepicker({
	     	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '2005:2030',
	    	 dateFormat: 'yy-mm-dd'
		});
    	$("#generalBookingmainDiv").hide();
    	$("#genBookSubmit").button();
    	$('#genBookPnumber').liveSearch({url: 'privateBillsController.php?page=GenBook&liveSearchPnumber='+$('#genBookPnumber').val()});
		$('#livePnumberQueryGenBook').live('click',function(e){
		$('#genBookPnumber').val(($(this).text()));
		var pnumber = $('#genBookPnumber').val();
		$("#genBookPn").val(pnumber);
		//$("#generalBookingmainDiv").show();
		$('#jquery-live-search').slideUp();
		//var name = $(this).closest('tr').find('td:eq(1)').text();
		$.post('check.php',{'hasVisitNum': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#generalBookingmainDiv").show();	
			}else{
				confirmPrompt($("#generalBookingmainDiv"));
				//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
				//$("#hideTab").hide();
			}
		});
		e.stopImmediatePropagation();
		return false;
	
    });


		function validateAddExp(){
			$('#genBookingForm').validate({
				
					'rules':{
						'genBookStatus': 'required',
						'genBookProduct': 'required',
						'genBookCode':'required',
						'genBookDate': {
									'required':true,
									'date':true
								},
						'genBookAmount': {
							'required':true,
							'number':true
						}
					},
					messages: {
						genBookCode: "<i style='color:red;'>Code is Required<i>",
						genBookStatus: "<i style='color:red;'>Status is Required<i>",
						genBookProduct: "<i style='color:red;'>Product is Required<i>",
						
						genBookAmount: {
							required: "<i style='color:red;'>Amount is Required<i>",
							number: "<i style='color:red;'>Invalid Number<i>"
						},
						
						genBookDate: {
							required: "<i style='color:red;'>Date is Required<i>",
							date: "<i style='color:red;'>Invalid Date<i>"
						}
						
					},
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      if(errors){
					    	  //$("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
	}

		$("#genBookStatus").change(function(){
			$.post('check.php',{'genGetProductList': $("#genBookStatus").val(),'productCode':$("#genBookCode").val()},function(data) {
    			if(data){
	    			$("#genBookProduct").html(data);
	    			$("#genBookAmount").val('');
    			}
    		});


		});
		$("#genBookProduct").change(function(){
			$.post('check.php',{'genGetProductPrice': $("#genBookProduct").val(),'status':$("#genBookStatus").val(),'productCode':$("#genBookCode").val()},function(data) {
    			if(data){
	    			$("#genBookAmount").val(data);
    			}
    		});


		});
		
	$('#genBookingForm').ajaxForm({
		beforeSubmit: validateAddExp(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Extra Charges</p>').dialog('open');
					$('#genBookingForm').resetForm();
				}else if(res == 4){
					$("#successMessage").html('Sorry ,You Must Open Your Drawer First').dialog('open');

				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
				
			}
		//}
	});
		$("#CloseGenBookingBills").click(function(){closeTab();});

		
	
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
<a id="CloseGenBookingBills" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>


	<fieldset class=" ui-widget-content ui-corner-all inputStyle">
		<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact">Patient Information</legend>
				<table border="0" class="tdtext">
					<tr >
							<td><label>Patient Name/Number: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="genBookPnumber" name="genBookPnumber"/></td>
							
					</tr>
				</table>
	</fieldset>

<br>
<div id="generalBookingmainDiv">

		
				<form id="genBookingForm" name="genBookingForm" action="generalBookingController.php" method="post">
				<input type="hidden" id="genBookPn" name="genBookPn">
				<fieldset class=" ui-widget-content ui-corner-all inputStyle ">
							  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Add Extra Charges</legend>
							  <table  cellpadding="0" border="0" class="tdtext">                                                                 
							  		<tr>
							  			   <td><label>Date: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="genBookDate" size="15" id="genBookDate" /> </td>
									</tr>
									<tr>
							  			   <td><label>Product Code: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="genBookCode"  id="genBookCode" >
							  			   <?php getNominalCodes('income');?>
							  			   </select>
							  			    </td>
									</tr>
							  		<tr>
							  			   <td><label>Status: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="genBookStatus"  id="genBookStatus" >
							  			    <option value="">Select Status</option>
											<option value="gambian">Gambian</option>
											<option value="nongambian">Non Gambian Resident</option>
											<option value="visitor">Non Gambian Visitor</option>
							  			   </select>
							  			    </td>
							  	    </tr>
							  	    <tr>
							  			   <td><label>Product: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="genBookProduct"  id="genBookProduct" >
							  			   <option value="">Select One</option>
							  			   </select>
							  			    </td>
							  	    </tr>
							  	    
							  	    
									<tr>
										  <td><label>Amount: </label></td><td><input readonly class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="genBookAmount" size="15" id="genBookAmount" /> </td>
									</tr>
									
									
							  		 <tr>
							  		 <td><label></label>  </td><td><input  type="submit" name="genBookSubmit"  id="genBookSubmit" value="Add Charges"/></td>
							  		 </tr>
								</table>
					</fieldset>
				</form>
	


</div>

