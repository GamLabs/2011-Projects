<script>
    $(document).ready(function () {

    	//$.post('schedule_controller.php',{'apptDept': "department"},function(data) {
		//	$('#apptDepartment').html(data);
		//});
		
    	
		$("#showPostTheatreView").hide();
    	function validatePostTheatre(){
			$('#postTheatreForm').validate({
				
					'rules':{
						'postTheatreDate': 'required',
						'postTheatreSampleType': 'required',
						'postTheatreFollowupDate': 'required',
						'postTheatreSurgNotes': 'required',
						'postTheatrePostOpCare': 'required'
						
					},
					messages: {
						postTheatreDate: "<i style='color:red;'> Date is required!<i>",
						postTheatreSampleType: "<i style='color:red;'>Sample Type is Required<i>",
						postTheatreFollowupDate: "<i style='color:red;'>Follow Up Date is Required<i>",
						postTheatreSurgNotes: "<i style='color:red;'>Notes is Required<i>",
						postTheatrePostOpCare   : "<i style='color:red;'>Post Operation Care is Required<i>"	
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
    	$('#postTheatreForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validatePostTheatre(),
			
			success:function(response) { 
			var	res = parseInt(response);
					 if(res==0){
						$("#successMessage").html("<p>Post Theatre Successfully Added</p>").dialog('open');
						 $('#postTheatreForm').resetForm();
					 }else{
						 $("#errorMessage").html("<p>Fail to Add Post Theatre</p>").dialog('open');
					 }
           		 }
		});

    	$('#pnPostTheatre').liveSearch({url: 'check.php?page=PostTheatre&liveSearchPnumber='+$('#pnPostTheatre').val()});
    	$('#livePnumberQueryPostTheatre').live('click',function(e){
    	$('#pnPostTheatre').val(($(this).text()));
    	 var pnumber = $('#pnPostTheatre').val();
    	$('#jquery-live-search').slideUp();
    	
    	$("#pnPostTheatreInput").val(pnumber);
    	
    	var name = $(this).closest('tr').find('td:eq(1)').text();
    	$("#postTheatreHeaderInfo").empty().text("Post Theatre - "+ name);
    	$.post('check.php',{'hasVisitNum': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
				$("#showPostTheatreView").show();
			}else{
				confirmPrompt($("#showPostTheatreView"));
				//$("#errorMessage").html("Sorry Patient has not paid Consulation fee Yet").dialog('open');
				//$("#showPostTheatreView").hide();
			}
		});
    	
    	e.stopImmediatePropagation();
		return false;
    	});
    	$("#postTheatreDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	$("#postTheatreFollowupDate").datepicker({
        	showOtherMonths: true,
			selectOtherMonths: true,
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			yearRange: '1800:2050',
            dateFormat: 'yy-mm-dd'

        });
    	//$('#appointment-form').formly({'onBlur':true, 'theme':'Dark'});
    	$("#postTheatreSubmit").button();

    	$("#ClosePostTheatre").click(function(){closeTab(); });
    	
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
<a id="ClosePostTheatre" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget-content ui-corner-all inputStyle">

<label>Patient Number </label><input size="10" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="pnPostTheatre" id="pnPostTheatre" />

</fieldset>
<br>
<div id="showPostTheatreView">
 <fieldset class=" ui-widget-content ui-corner-all inputStyle" >
 <legend id="postTheatreHeaderInfo" style="font-size:19px;" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header">Post Theatre</legend>
<form id="postTheatreForm" action="postTheatre_controller.php" method="post">
<input type="hidden" name="pnPostTheatreInput" id="pnPostTheatreInput">
	<table class="tdtext">
		<tr>
			<td><label>Date:</label></td>
			<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="postTheatreDate" name="postTheatreDate" size="11"/></td>
		</tr>
		<tr>
			<td><label>Type of Sample Sent(for investigation):</label></td>
			<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  id="postTheatreSampleType" name="postTheatreSampleType" size="20"/></td>
		</tr>
		<tr>
			<td><label>Follow up date:</label></td>
			<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="11" type="text" id="postTheatreFollowupDate" name="postTheatreFollowupDate" /></td>
		</tr>
				
		<tr>
			<td>Surgeons Notes:</td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="3" id="postTheatreSurgNotes" name="postTheatreSurgNotes" > </textarea></td>
		</tr>
		<tr>
			<td><label>Post Operation Care:</label></td><td><textarea class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" cols="20" rows="3" id="postTheatrePostOpCare" name="postTheatrePostOpCare" > </textarea> </td>
		</tr>

		<tr>
			<td></td><td><input  size="7" type="submit" id="postTheatreSubmit" name="postTheatreSubmit" value="Add Post Theatre" /></td>
		</tr>
	
	</table>
</form>
</fieldset>
</div>