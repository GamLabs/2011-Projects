<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
require_once 'includes/receptionFunctions.php';


?>
<style type="text/css">
.ui-jqgrid tr.jqgrow td {
       white-space: normal !important;
   }
</style>

<script>
$('#addstoremed').button();
$('#ddrugSubmit').button();

$('#storeview').tabs();
/*
$("#dname").change(function(){
	$.post('check.php',{'getDrugType':$("#dname option:selected").val()},function(data) {
		$("#dtype").empty().val(data);
});
});  
*/
$("#ddrugtype").change(function(){
	$.post('check.php',{'getDrugProp':$("#ddrugname option:selected").val(),'ddDrugType':$("#ddrugtype option:selected").val()},function(data) {
		$("#storeDrugProperty").empty().html(data);
});
});




$("#CloseInputStoreDrug").click(function(){	closeTab();});

//Non tablet display starts
jQuery("#storetable").jqGrid({
    width:880,
    height:500,
    url:'viewstore_controller.php?q=2',
     datatype: "json",
     colNames:['ID','Drug','Type', 'Quantity' , 'Expiry Date'  , 'Reorder Level'],
      colModel:[
				{name:'id',index:'id',editable:true, key: true,width:100},
				{name:'dname',index:'dname',editable:true,width:250},
                {name:'dtype',index:'dtype',editable:true, width:150},
				{name:'quantity',index:'quantity',editable:true,width:100},
                {name:'expiry_date',index:'expiry_date',editable:true,search:true, width:150},
				{name:'reorder_level',index:'reorder_level',editable:true, width:150}
                   ],
                   
                    rowNum:30, rowList:[30,60,100],
                    pager: '#storepagination',
                    sortname: 'dname',
                    viewrecords: true,
                    searchGrid: {multipleSearch:true,closeAfterSearch: true},
                    sortorder: "asc",
                    caption:"Drugs in Store",
                    editurl:"storeedit_controller.php"

 });
 
   jQuery("#storetable").jqGrid('navGrid','#storepagination',{edit:true,add:false,del:true},{width:500});
//End of non tablet display
</script>

<script type="text/javascript" src="jquery-validation/jquery.validate.min.js"></script>
<a id="CloseInputStoreDrug" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id ="storeview">
	<ul>
		<li><a href="#receiveDrugsStore">Received Drugs In Store</a></li> 
		<li><a href="#dispatchDrugSstore">Dispatch Drugs To Pharmacy</a></li> 
		<li><a href="#viewstore">Drugs in Store</a></li>
	</ul>
	<div id = "receiveDrugsStore">
		<form id="inputstoredrugs" name="inputstoredrugs" action ="input_store_controller.php" method="post" >
			 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="biodata" ><b><i >New Drugs</b></i></legend>
				<table cellpadding="5">
					<tr>
						<td>Name of Drug</td>
						<td>
						<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="dname" id="dname"  >
						<?php  getDrugNames();?>
						</select>
						</td>
						<td>Type</td>
						<td> 
							<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  type="text" name="dtype" id="dtype" >
							<?php getPackagingCombo();?>
							</select>	
						</td>
					</tr>
					<tr>
						<td>Quantity In Units</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="dquantity" id="dquantity"  size="15" /></td>
						<td> Expiry Date</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="edate" id="edate"  size="15" /></td>
					</tr>
					<tr>
						<td>Reorder Level</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="dreorder" id="dreorder"  size="15" /></td>
							</tr>
					<tr>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="submit" name="addstoremed" id="addstoremed" value="Add to Store"></td>
					</tr>
				</table>
			</fieldset> 
		</form>	  
	</div>
	<div id = "dispatchDrugSstore">
	<div id="storeDrugProperty"></div>
		<form id="ddrugForm" name="ddrugForm" action ="dispatch_store_controller.php" method="post" >
			 <fieldset class=" ui-widget-content ui-corner-all inputStyle">
			  <legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="biodata" ><b><i>Dispatch Drugs To Pharmacy</i></b></legend>
				<table cellpadding="5">
					<tr>
						<td>Name of Drug</td>
						<td>
						<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="ddrugname" id="ddrugname"  >
						<?php  getDrugNamesInStore();?>
						</select>
						</td>
						
					</tr>
					<tr>
					<td>Type</td>
						<td> 
							<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="ddrugtype" id="ddrugtype" >
							<?php getPackagingCombo();?>
							</select>	
					</td>
					
					</tr>
					<tr>
						<td>Quantity In Units</td>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="ddrugquantity" id="ddrugquantity"  size="7" /></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
					</tr>
					<tr>
						<td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="submit" name="ddrugSubmit" id="ddrugSubmit" value="Dispatch To Pharmacy"></td>
					</tr>
				</table>
			</fieldset> 
		</form>	  
	
	</div>
	
	<div id="viewstore">
		<table id="storetable"></table>
		<div id="storepagination"></div>	
	</div>	
</div>			  
			  
 <div id="scontent">


		</div>
			  
			  
<script type="text/javascript">
function validateStoreForm(){
	$('#inputstoredrugs').validate({
	'rules':{
		'dname': 'required',
		'dtype': 'required',
		'dquantity': {
		'required':true,
		'number':true},
		'edate': {
		'required':true,
		'date':true},
		'dreorder': {
		'required':true,
		'number':true},
		'dselling': {
		'required':true,
		'number':true}
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


$(function() {
var today = new Date()
var year = today.getFullYear();

		$( "#edate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: new Date(year, 1 - 1, 1),
			dateFormat: 'yy-mm-dd',
			yearRange: '1900:2030'
			//showButtonPanel: true
			
		});
	});


</script>

<script>
            $(document).ready( function() {
                // binds form submission and fields to the validation engine
                //jQuery("#form-id").validationEngine();
            	function validateDispatchDrug(){
        			$('#ddrugForm').validate({
        				
        					'rules':{
        						'ddrugname': 'required',
        						'ddrugtype':'required',
        						'ddrugquantity': {
        							required: true,
        							number: true
        						}
        					},
        					messages: {
        						ddrugname: "<i style='color:red;'>Please Choose The Name<i>",
        						ddrugquantity: "<i style='color:red;'>Please Enter the Quantity<i>",
        						ddrugtype: "<i style='color:red;'>Please Choose the Type<i>"
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
		$('#inputstoredrugs').ajaxForm({
			beforeSubmit: validateStoreForm(),
			//target:"#scontent",
			success:function(response) { 
				var res = parseInt(response);
				 if(res == 0){
						// alert(response);
					$("#successMessage").html("<p>Successfully Stored</p>").dialog('open');
					refreshTab();
					 $('#inputstoredrugs').resetForm();
					 }else{
						 $("#errorMessage").html("Sorry: "+response).dialog('open');
					 }
           		 }
		});

		$('#ddrugForm').ajaxForm({
			beforeSubmit: validateDispatchDrug(),
			target:"#scontent",
			success:function(response) { 
				var res = parseInt(response);
				 if(res == 0){
						// alert(response);
					$("#successMessage").html("<p>Successfully Dispatched</p>").dialog('open');
					 $('#ddrugForm').resetForm();
					 }else{
						 $("#errorMessage").html("Sorry: "+response).dialog('open');
					 }
           		 }
		});

            });
   </script>