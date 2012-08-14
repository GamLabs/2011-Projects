<?php require_once 'includes/connect.php';
		require_once 'includes/receptionFunctions.php';
?>
<script>
    $(document).ready(function () {
    	//$('form').validationEngine('hideAll');
				$.post('check.php',{'getUserGroups':'group'},function(data) {
					$("#addusergroups").empty().html(data);
	});

	 $("#changeOperatorPasswordDiv").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close");$('form').validationEngine('hideAll'); } } });
	

				
		$("#addUserSubmit").button();
    	//$('#adduserForm').formly({'onBlur':false, 'theme':'Dark'});
    	function validateAddUser(){
			$('#adduserForm').validate({
				
					'rules':{
						'addfirstname': 'required',
						'addlastname': 'required',
						'addusername': 'required',
						'addpassword': {
							required: true,
							minlength: 5
						},
						'addcpassword': {
							required: true,
							minlength: 5,
							equalTo: "#addpassword"
						},
						'addusergroups': 'required'
						
					},
					messages: {
						addfirstname: "<i style='color:red;'>Please enter your FirstName<i>",
						addlastname: "<i style='color:red;'>Please enter your LastName<i>",
						addusername: "<i style='color:red;'>Please enter your UserName<i>",
							
						addpassword: {
							required: "<i style='color:red;'>Please Provide a Password<i>",
							minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>"
						},
						addcpassword: {
							required: "<i style='color:red;'>Please Provide a Password<i>",
							minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>",
							equalTo: "<i style='color:red;'>Password Mismatch<i>"
						},
						addusergroups: "<i style='color:red;'>Please Choose a Group<i>"
					
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
		$("#chOpPasswdUser").button();
		$("#editUser").button();
		$("#changeoprPassSubmit").button();
		

		$("#editUser").click(function(){
			$("#addUserPage").html("");
			$("#addUserPage").load('editUser.php');
	
		});

		$("#chOpPasswdUser").click(function(){
			$("#changeOperatorPasswordDiv").dialog('open');
			
		});
		
    	$('#adduserForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddUser() ,
			
			success:function(response) { 
				
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added User </p>").dialog('open');
					 $('#adduserForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});



    	function validateChangeOprPw(){
    		$('#changeOprPasswordForm').validate({
    			
    				'rules':{
    					
    					'opUserName': 'required',
    					'newpasswordopr': {
    						required: true,
    						minlength: 5
    					},
    					'retypenewpasswordopr': {
    						required: true,
    						minlength: 5,
    						equalTo: "#newpasswordopr"
    					}
    				},
    				messages: {
    					
    					opUserName: "<i style='color:red;'>User name is  Required<i>",
    						
    					newpasswordopr: {
    						required: "<i style='color:red;'>Please Provide the New Password<i>",
    						minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>"
    					},
    					retypenewpasswordopr: {
    						required: "<i style='color:red;'>Please Retype the  Password<i>",
    						minlength: "<i style='color:red;'>Minimum Password Lenght is 5 Characters<i>",
    						equalTo: "<i style='color:red;'>Password Mismatch<i>"
    					}
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

    	$('#changeOprPasswordForm').ajaxForm({
    		//target:"#content",
    		beforeSubmit:validateChangeOprPw() ,
    		
    		success:function(response) { 
    			
    			var res = parseInt(response);
    			
    				 if(res==0){				
    				$("#successMessage").html("<p>Successfully Change Password </p>").dialog('open');
    				 $('#changeOprPasswordForm').resetForm();
    				 }else if (res==1){
    					 $("#errorMessage").html("<p>Error changing passwd </p>").dialog('open');
    				 }
    	   		 }
    	});
		
    	$("#CloseAddUser").click(function(){closeTab(); });
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
<a id="CloseAddUser" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="addUserPage">
 <fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
 
 <a id="editUser" style="float: right;font-size:12" href="#">List Users</a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a id="chOpPasswdUser" style="float: right;font-size:12" href="#">Change OPerator Password</a><br>
 
<form id="adduserForm" action="adduser_controller.php" method="post">
<table class="tdtext">
<tr >
<td><label>First Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="addfirstname" name="addfirstname" /> </td>
</tr><tr>
<td><label>Last Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="addlastname" name="addlastname" /> </td>
</tr>
<tr>
<td><label>UserName:</label></td><td><input  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="addusername" name="addusername" /> </td>
</tr><tr>
<td><label>Password: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  size="10" type="password" id="addpassword" name="addpassword" /></td>
</tr><tr>
<td><label>Confirm Password: </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="password" id="addcpassword" name="addcpassword" /></td>
</tr><tr>
<td><label>Group: </label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="addusergroups" name="addusergroups"></select></td>
</tr><tr><td></td><td><input  size="10" type="submit" id="addUserSubmit" name="addUserSubmit" value="Add User" /></td>

</table>
</form>
</fieldset>

<div style="display: none" id="changeOperatorPasswordDiv"
	title="Change Operator Password">
<form id="changeOprPasswordForm" action="changeOprpassword.php" method="post">
<table>
	<tr>
		<td><label>Select Operator</label></td>
		<td><select  class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="opUserName" name="opUserName" >
		<?php getuserCombo();?>
		</select>
		</td>
	</tr>

	<tr>
		<td><label>New Password</label></td>
		<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="password" size="20" type="text"
			id="newpasswordopr" name="newpasswordopr" /></td>
	</tr>
	<tr>
		<td><label>Retype Password</label></td>
		<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="password" size="20" type="text"
			id="retypenewpasswordopr" name="retypenewpasswordopr" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input size="10" type="submit" id="changeoprPassSubmit"
			name="changeoprPassSubmit" value="Change Password" /></td>

</table>
</form>
</div>
</div>


