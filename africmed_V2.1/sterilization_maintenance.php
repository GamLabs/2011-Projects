<script>
    $(document).ready(function () {
    	
    	$("#sterilMaintDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });

				
		$("#sterilMaintSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validateAddSteril(){
			$('#SterilizationMaintForm').validate({
				
					'rules':{
						'sterilMaintDate': 'required',
						'sterilMaintProblem': 'required',
						'sterilMaintSpare': 'required',
						'sterilMaintEngineer': 'required',
						'sterilMaintEngineerCont':'required',
						'sterilMaintEmployee': 'required',
						'sterilMaintComment': 'required'
						
					},
					messages: {
						sterilMaintDate: "<i style='color:red;'>Please Enter Date<i>",
						sterilMaintProblem: "<i style='color:red;'>Please enter Problem Type<i>",
						sterilMaintSpare: "<i style='color:red;'>Please enter Spare Parts<i>",
						sterilMaintEngineer:"<i style='color:red;'>Please enter Engineer's name<i>",
						sterilMaintEngineerCont: "<i style='color:red;'>Please Enter Engineer's Contact<i>",
						sterilMaintEmployee: "<i style='color:red;'>Please Enter Employee name<i>",
						sterilMaintComment: "<i style='color:red;'>Please Enter Some Comments<i>"
					
					},
								
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      //alert(errors);
					      if(errors){
					    	 // $("#errorMessage").html("<p>Please Fill All Required Fields!</p>").dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
    	$('#SterilizationMaintForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddSteril() ,
			
			success:function(response) { 
				
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Sterilization Maintenance </p>").dialog('open');
					 $('#SterilizationMaintForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});
    	$("#CloseSterilizationMaint").click(function(){closeTab(); });

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
<a id="CloseSterilizationMaint" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget ui-widget-content ui-corner-all" >
<form id="SterilizationMaintForm" action="sterilmaintenance_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>Date:</label></td><td><input   size="10" type="text" id="sterilMaintDate" name="sterilMaintDate" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Type Of Problem:</label></td><td><input  size="20" type="text" id="sterilMaintProblem" name="sterilMaintProblem" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr>
<tr>
<td><label>Spare Parts Required:</label></td><td><input   size="10" type="text" id="sterilMaintSpare" name="sterilMaintSpare" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Name of Engineer: </label></td><td><input   size="10" type="text" id="sterilMaintEngineer" name="sterilMaintEngineer" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Engineer's Contact No: </label></td><td><input   size="10" type="text" id="sterilMaintEngineerCont" name="sterilMaintEngineerCont" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /> </td>
</tr><tr>
<td><label>Name of Emplyee On Duty: </label></td><td><input   size="10" type="text" id="sterilMaintEmployee" name="sterilMaintEmployee" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" /></td>
</tr>
<tr >
<td><label>Comment:</label></td><td><textarea   size="10" type="text" id="sterilMaintComment" name="sterilMaintComment" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" ></textarea> </td>

</tr><tr><td></td><td><input  size="10" type="submit" id="sterilMaintSubmit" name="sterilMaintSubmit" value="Submit" /></td>

</table>
</form>
</fieldset>