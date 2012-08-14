<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	/*table{width:80%}*/
</style>
<script>
	$(document).ready(function(){
		$("#accountDetailViewWindow").dialog({ autoOpen:false,width: 900,position: 'top',modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
		$("#addAccountWindow").dialog({ autoOpen:false,width:700,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
		
		$('.showAccountDetails').live('click',function(e){
			 var code = $(this).closest('tr').find('td:eq(0)').text();
				
			 $('#accountDetailViewWindow').load("accountDetails.php?accountCode="+code);
			 $("#accountDetailViewWindow").dialog('open');
			
			 
				
			e.stopImmediatePropagation();
			return false;
		});

	
		$('#addAccounts_table').dataTable( {
			
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bJQueryUI": true,
		"iDisplayLength": 20,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		
		"sAjaxSource": "account_list.php"
		
		});
		
		$("#addAccountBtn").click(function(){
			$("#addAccountWindow").dialog('open');
		});
		
		$("#addAccountBtn").button();
		$("#accSubmitBtn").button();
		
		$("#CloseSearchGen").click(function(){	closeTab();});
		function validateAddAccount(){
			$('#addAccountForm').validate({
				      
					'rules':{
						'accName': 'required',
						'accCode': 'required'
					
					},
					messages: {
						accName: "<i style='color:red;'>Please enter the Account Name<i>",
						accCode: "<i style='color:red;'>Please enter the Account Code<i>"
					
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
		
		
    	$('#addAccountForm').ajaxForm({
			//target:"#content",
			beforeSubmit:validateAddAccount() ,
			
			success:function(response) { 
				
				res = eval(response);
			
					 if(res==0){				
					$("#successMessage").html("<p>Successfully Added Account </p>").dialog('open');
					 $('#addAccountForm').resetForm();
					 }else{
					 alert("Error: "+response);
					 }
           		 }
		});

		

	
	});
/*
 *
 <div class="add_delete_toolbar" ></div>
 "fnDrawCallback": function(){
	 // $('td').bind('click', function () { $('tbody').children().each(function(){$(this).removeClass('highlight');}); });
     // $('td').bind('click', function () { $(this).parent().children().each(function(){$(this).addClass('highlight');}); });
		$('td').bind('click',function () {
		 // $(this).toggleClass('highlight');
		  $(this).parent().children().each(function(){$(this).toggleClass('highlight');});
		});      
},				
.makeEditable({
	 sDeleteURL: "DeleteData.php",
	 sUpdateURL: "UpdateData.php"
		 
	 
			
})
*/

	
</script>

<style>
<!--
#addAccounts_table {
    width: 100% !Important;
}

 .highlight {
                background-color: yellow;
        }
  

-->
</style>
<a id="CloseSearchGen" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<!-- <div style="width:100%; left:50px; float:left;">
	<center> -->
	
	
	<button id="addAccountBtn">Add Account</button>
		<table id="addAccounts_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 50px">Account Code</th>
					<th style="width: 100px">Account Name</th>
					<th style="width: 50px">Action</th>
				</tr>
			</thead>
			
			
	
		</table>
		
		<!-- 
	</center>
 </div>
  -->
 <div id="testing">_</div>
 
 <div style="display: none" id="accountDetailViewWindow"
	title="Account Transaction Details">
	
	</div>
	
	<div style="display: none" id="addAccountWindow"
	title="Add Account ">
	<fieldset>
<form id="addAccountForm" action="addAccount_controller.php" method="post">  
<table class="tdtext">
<tr >
<td><label>Code:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="accCode" name="accCode" /> </td>
</tr>
<tr >
<td><label>Account Name:</label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"   size="20" type="text" id="accName" name="accName" /> </td>
</tr><tr><td></td><td><input  size="10" type="submit" id="accSubmitBtn" name="accSubmitBtn" value="Add Account" /></td></tr>

</table>
</form>
</fieldset>
	
	</div>
 
