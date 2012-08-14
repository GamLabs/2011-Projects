<script>
    $(document).ready(function () {

    	//$.post('schedule_controller.php',{'apptDept': "department"},function(data) {
		//	$('#apptDepartment').html(data);
		//});
		
    	$('form').validationEngine('hideAll');

    	function validateAddIns(){
			$('#appointment-form').validate({
				
					'rules':{
						'apptStatus': 'required',
						'apptComplaint': 'required',
						'apptDoctor': 'required',
						'apptDepartment': 'required',
						'apptDate': {
							'required':true,
							'date':true
						},
						'apptFollowUp': {
							'required':true,
							'date':true
						}//,
						//'apptTime': {
						//	'required':true,
						//	'date':true
						//}
						
					},
					messages: {
						apptStatus: "<i style='color:red;'>Appointment Date is required!<i>",
						apptComplaint: "<i style='color:red;'>Medical Conplaint is Required<i>",
						apptDoctor: "<i style='color:red;'>Doctor/Nurse is Required<i>",
						apptDepartment: "<i style='color:red;'>Department is Required<i>",
						apptFollowUp: {
							required:	"<i style='color:red;'>Appt FollowUp is Required<i>",
							date :	"<i style='color:red;'>Invalid DateTime<i>"
						},
						apptDate  : {
							required: "<i style='color:red;'>App Date is Required<i>",
							date: 	"<i style='color:red;'>Invalid Date<i>"
						},
						apptTime  : {
							required: "<i style='color:red;'>App DateTime is Required<i>",
							datetime: 	"<i style='color:red;'>Invalid Date<i>"
						}
					},
								
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      //alert(errors);
					      if(errors){
						    return false;
					      }else{
						      return true;
					      }
					}
			});
		}
    	$('#appointment-form').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddIns(),
			
			success:function(response) { 
				//alert(response);
				var res = parseInt(response);
					 if(res==0){
						$("#successMessage").html("<p>Appointment Successfully Scheduled</p>").dialog('open');
						 $('#appointment-form').resetForm();
					 }else{
						 $("#errorMessage").html("<p>Fail to schedule appointment</p>").dialog('open');
					 }
           		 }
		});

    	$("#apptDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#apptTime").datetimepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#apptFollowUp").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	//$('#appointment-form').formly({'onBlur':true, 'theme':'Dark'});
    	$("#apptSchedule").button();
    	$("#CloseAddSchedule").click(function(){closeTab(); });
    	
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

<a id="CloseAddSchedule" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
<form id="appointment-form" action="schedule_controller.php" method="post">

	<table class="tdtext">
		<tr >
			<td><label>Date of Appointment:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="apptDate" name="apptDate" /> </td>
		</tr>
		<tr>
			<td><label>Medical Complaint:</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="3" id="apptComplaint" name="apptComplaint" > </textarea></td>
		</tr>
		<tr>
			<td><label>Doctor/Nurse:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="15" type="text" id="apptDoctor" name="apptDoctor" /> </td>
		</tr>
		<tr>
			<td><label>Department:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="apptDepartment" id="apptDepartment" ></td>
		</tr>
		<tr>
			<td><label>Time of Appointment:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="apptTime" name="apptTime" /></td>
		</tr>
		<tr>
			<td><label>Follow-up Date:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="text" id="apptFollowUp" name="apptFollowUp" /></td>
		</tr><tr>
			<td><label>Status:</label></td>
			<td>
			<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   id="apptStatus" name="apptStatus" >
				<option value="PENDING">Pending</option>
				<option value="DONE">Done</option>
			</select>
			</td>
		</tr>
		<tr>
		<td></td><td><input  size="7" type="submit" id="apptSchedule" name="apptSchedule" value="Schedule Appointment" /></td>
		</tr>
	
	</table>
</form>
</fieldset>