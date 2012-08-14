<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';


?>
<style type="text/css">
.ui-jqgrid tr.jqgrow td {
       white-space: normal !important;
   }
</style>

<script>
$(document).ready( function() {
	if(tabNameExists("Lab Store")){
		var index = getTabName("Lab Store");
		$("#contentTab").tabs('remove',index);
		refreshTab();
	}
    
$('#labItemUsedForm').ajaxForm({
			beforeSubmit: validateUsedLabItem(),
			//target:"#scontent",
			success:function(response) { 
				var res = parseInt(response);
				 if(res == 0){
				// alert(response);
			$("#successMessage").html("<p>Successfully Added</p>").dialog('open');
			refreshTab();
			 $('#labItemUsedForm').resetForm();
			 }else{
				 $("#errorMessage").html("Sorry: "+response).dialog('open');
			 }
			 }
});

	$('#labreceivedItemsForm').ajaxForm({
				beforeSubmit: validateAddLabItem(),
				//target:"#scontent",
				success:function(response) { 
					 var res = parseInt(response);
					 if(res == 0){
							// alert(response);
					 $("#successMessage").html("<p>Successfully Added</p>").dialog('open');
					 $('#labreceivedItemsForm').resetForm();
					 }else{
						 $("#errorMessage").html("Sorry: "+response).dialog('open');
					 }
				 }
	});


$('#usedLabItemSubmit').button();
$('#labItemSubmit').button();

$('#labStoreTab').tabs();




		function validateAddLabItem(){
			$('#labreceivedItemsForm').validate({
			'rules':{
				'labItemName': 'required',
				'labItemDate': {
						'required':true,
						'date':true
						},
				'labItemQuant': {
					'required':true,
					'number':true
					},
				'labItemUnit': {
					'required':true,
					'number':true
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

		function validateUsedLabItem(){
			$('#labItemUsedForm').validate({
			'rules':{
				'usedLabItemName': 'required',
				'usedLabItemDate': {
						'required':true,
						'date':true
						},
				'usedLabItemQuant': {
					'required':true,
					'number':true
					},
				'usedLabItemUnit': {
					'required':true,
					'number':true
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




		$( "#usedLabItemDate" ).datepicker({
			changeMonth: true,
			changeYear: true,			
			dateFormat: 'yy-mm-dd',
			yearRange: '1900:2030'
			//showButtonPanel: true
			
		});

		$( "#labItemDate" ).datepicker({
			changeMonth: true,
			changeYear: true,			
			dateFormat: 'yy-mm-dd',
			yearRange: '1900:2030'
			//showButtonPanel: true
			
		});

		$("#CloseLabStore").click(function(){	closeTab();});
	



});

</script>
<a id="CloseLabStore" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id ="labStoreTab">
	<ul>
		<li><a href="#receiveLabItems">Received Lab Items</a></li> 
		<li><a href="#usedLabItems">Used Lab Items</a></li> 
		
	</ul>
	<div id = "receiveLabItems">
		<form id="labreceivedItemsForm" name="labreceivedItemsForm" action ="labStore_controller.php" method="post" >
			 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="biodata" ><b><i >New Lab Items</b></i></legend>
				<table cellpadding="5">
				
					<tr>
						<td>Date</td>
						<td><input class=" ui-widget-content ui-corner-all inputStylen ui-widget-header" type="text" name="labItemDate" id="labItemDate"  size="15" /></td>
						<td> Name of Item</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="labItemName" id="labItemName"  size="15" /></td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="labItemQuant" id="labItemQuant"  size="15" /></td>
						<td>Unit Cost</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="labItemUnit" id="labItemUnit"  size="15" /></td>
					</tr>
					<tr>
					<td></td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle" type="submit" name="labItemSubmit" id="labItemSubmit" value="Add to Store"></td>
					</tr>
				</table>
			</fieldset> 
		</form>	  
	</div>
	<div id = "usedLabItems">
	
		<form id="labItemUsedForm" name="labItemUsedForm" action ="labUsedItem_controller.php" method="post" >
			 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="biodata" ><b><i >Used Lab Items</b></i></legend>
				<table cellpadding="5">
					<tr>
						<td>Date</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="usedLabItemDate" id="usedLabItemDate"  size="15" /></td>
						<td> Name of Item</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="usedLabItemName" id="usedLabItemName"  size="15" /></td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="usedLabItemQuant" id="usedLabItemQuant"  size="15" /></td>
						<td>Unit Cost</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="usedLabItemUnit" id="usedLabItemUnit"  size="15" /></td>
					</tr>
					
					<tr>
					<td></td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle" type="submit" name="usedLabItemSubmit" id="usedLabItemSubmit" value="Add Used Items"></td>
					</tr>
				</table>
			</fieldset> 
		</form>	  
	
	</div>
	
	
</div>			  
			  
 <div id="scontent">


		</div>
			  
			  

