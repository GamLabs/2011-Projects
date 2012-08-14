<script type="text/javascript" src="jquery-validation/jquery.validate.min.js"></script>

<script>
     jQuery(document).ready( function() {

    	 $('#status').change(function() {
								var val=$("#status").val();
								if(val == "INSURANCE") {
									$('#insurance').removeAttr('disabled');
									$('#policyId').removeAttr('disabled');
									$('#companyno').val("0");
									$('#policyId').val("");
									//POPULATE INSURANCE SELECT BOX IF ENABLED
									$.post('reception_controller.php',{'InsuranceVal':val},function(data) {
							    			if(data){
								    			$("#insurance").html(data);
							    			}else{
							    				$("#insurance").html("");
							    			}
							    	});
							    	
									$('#company').attr('disabled', true);
									$('#companyno').attr('disabled', true);
								}else if(val == "COMPANY") {
									
									$('#company').removeAttr('disabled');
									$('#companyno').removeAttr('disabled');
									$('#policyId').val("0");
									$('#companyno').val("");
									//POPULATE COMPANY SELECT BOX IF ENABLED
									$.post('reception_controller.php',{'CompanyVal':val},function(data) {
						    			if(data){
							    			$("#company").html(data);
						    			}else{
						    				$("#company").html("");
						    			}
						    		});
									
									
									$('#insurance').attr('disabled', true);
									$('#policyId').attr('disabled', true);
								}else{
									$('#policyId').val("0");
									$('#companyno').val("0");
									$('#company').attr('disabled', true);
									$('#companyno').attr('disabled', true);
									$('#insurance').attr('disabled', true);
									$('#policyId').attr('disabled', true);
								}
							
						});

						function valid(){
								$('#registration-form').validate({
									
										'rules':{
											'fname': 'required',
											'lname': 'required',
											'dob': 'required',
											'email': 'email',
											'phone': {
														'required':true,
														'number':true
													},
											'address': 'required',
											'occupation': 'required',
											'pob': 'required',
											'sex': 'required',
											'status': 'required',
											'insurance': 'required',
											'policyId': 'required',
											'company': 'required',
											'companyno': 'required',
											
											'nationality': 'required'
										},
										messages: {
											fname: "<i style='color:red;'>Required<i>",
											lname: "<i style='color:red;'>Required<i>",
											dob: "<i style='color:red;'>Required<i>",
											email: "<i style='color:red;'>Invalid Email<i>",
											sex: "<i style='color:red;'>Required<i>",
											pob: "<i style='color:red;'>Required<i>",
											occupation: "<i style='color:red;'>Required<i>",
											status: "<i style='color:red;'>Required<i>",
											address: "<i style='color:red;'>Required<i>",
											nationality: "<i style='color:red;'>Required<i>",
											phone: {
												required:	"<i style='color:red;'>Required<i>",
												number :	"<i style='color:red;'>Invalid Number<i>"
											},
											insurance: "<i style='color:red;'>Required<i>",
											policyId: "<i style='color:red;'>Required<i>",
											company: "<i style='color:red;'>Required<i>",
											companyno: "<i style='color:red;'>Required<i>"

										},
										invalidHandler: function(form, validator) {
										      var errors = validator.numberOfInvalids();
										      if(errors){
										    	 // $("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
											    return false;
										      }else{
											      return true;
										      }
										}
								});
						}
						$('#registration-form').ajaxForm({
							beforeSubmit: valid(),
							//if(confirm("Are you sure you want to make payments")){
								success:function(response){
									$('#registration-form').resetForm();
									//$('#registration-form').resetForm();
									$("#successMessage").html('<p><b><i><font size=5 color=aqua> Patient Successfully Registered With Number:<font color=blue> '
											+response+'</font></i></b> </p>').dialog('open');
									//$('#ddd').html(response);
								}
							//}
						});
					$("#register").button();
	                $("#reset").button();
	                /*
	                	$("#dateSelect").datepicker({
							showOtherMonths: true,
							selectOtherMonths: true,
							changeMonth: true,
							changeYear: true,
							showButtonPanel: true,
							dateFormat: 'yy-mm-dd'
						});
						                
	                */
	                $("#dob").datepicker({
	                	showOtherMonths: true,
						selectOtherMonths: true,
						changeMonth: true,
						changeYear: true,
						showButtonPanel: true,
						yearRange: '1800:2050',
		                dateFormat: 'yy-mm-dd'

			        });

			        $("#status").change(function(){
				        var val = $("#status").val();
						if(val == "PRIVATE"){
							$("#insuranceSection").hide();
							$("#employerSection").hide();
							

						}else if(val == "COMPANY"){
							$("#insuranceSection").hide();
							$("#employerSection").show();

						}else if(val == "INSURANCE"){
							$("#insuranceSection").show();
							$("#employerSection").hide();

						}else{
							$("#insuranceSection").hide();
							$("#employerSection").hide();
						}
						
			        });

	                //$('#registration-form').formly({'onBlur':false, 'theme':'Dark'});


});//end document ready function
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
	  
		  		 <div id="ddd"></div>
		  <form  id="registration-form" name="registration-form" action ="reception_controller.php" method="post" >
		  <fieldset class=" ui-widget-content ui-corner-all inputStyle">
		  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Basic Information</i></b></legend>
		  	<table  cellpadding="0" class="tdtext">
			
		  		<tr>
				  
				     <td width="60%">&nbsp; First Name<br><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="fname" id="fname"  size="15" /></td>
				     <td>&nbsp; Last Name<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="lname" id="lname"  size="15" /></td>
				 </tr>
				 <tr>
				     
				    <td>&nbsp; Sex<br><Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="sex" id="sex"  >
					<option value="">Select Gender</option>
				     	<option value="Male">Male</option>
				     	<option value="Female">FeMale</option>
				     </Select></td>
				     
				      
					     <td>&nbsp; D.O.B<br><input readonly class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="dob" id="dob"  size="15" /></td>
				
				</tr>
				<tr>
						 	     
					     
					     <td>&nbsp; Place of Birth<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pob" id="pob"  size="15" /></td>
					       
					    	<td>&nbsp; Nationality<br> <Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="nationality" id="nationality" >
							<option value="">Select Nationality</option>
					     	<option value="Gambian">Gambian</option>
					     	<option value="Non Gambian">Non Gambian</option>
				     		</Select></td>
			
				     
			  </tr>
			  </table>
			  </fieldset> <br>
			  
			  <fieldset class=" ui-widget-content ui-corner-all inputStyle">
				  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Contact Information</i></b></legend>
				  <table cellpadding="0" class="tdtext">
				  	<tr> 
					     <td width="60%">&nbsp; Email Address<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="email" id="email"  size="15" /></td>
					     
					     
					     <td>&nbsp; Telephone<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="phone" id="phone"  size="15" /></td>
					</tr>
				  <tr>
				 		 
					     <td>&nbsp; Address<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="address" id="address"  size="15" /></td>
				  		 
					     <td>&nbsp; Occupation<br><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="occupation" id="occupation" size="15" /></td>
				  </tr>
					    
			     </table>
			 </fieldset><br>
			 
			 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
			 <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Subscription Information</i></b></legend>
			 <table cellpadding = "0" class="tdtext">
			 <tr>
			  
					    	<td width="60%">&nbsp; Status<br><Select  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="status" id="status"  >
							<option value=""></option>
					    	<option value="PRIVATE">Private</option>
					     	<option value="COMPANY">Employer</option>
					     	<option value="INSURANCE">Insurance</option>
				     </Select></td>
			  
			  </tr>
			  <tr id="insuranceSection" style="display: none">
			  		 
					    	<td>&nbsp; Insurance<br><Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="insurance" id="insurance"  disabled >
					    	<option value='NONE'>Select Insurance</option>
				     			 </Select></td>
			  		<td width="60%">&nbsp; Policy Number<br>
				     <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="policyId" id="policyId"  size="10" value="0" disabled /></td>
			  
			  </tr>
			  <tr id="employerSection" style="display: none">
			  		<td>&nbsp; Employer<br>
					    	<Select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="company" id="company"  disabled >
					    			<option value='NONE'>Select Employer</option>
				     			 </Select></td>
			  		<td>&nbsp; Employee Number<br>
				     <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="companyno" id="companyno" size="10" value="0" disabled /></td>
			  
			  </tr>
			  <tr>
				<td></td>
				
			 </tr>
			 </table>
			 
			 </fieldset>
			 <input class=" ui-widget-content ui-corner-all " id="register" type="submit" value="Register">
			 
		  </form>
		  