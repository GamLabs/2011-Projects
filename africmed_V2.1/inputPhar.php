<?php
require_once 'includes/connect.php';
require_once 'includes/pharFunctions.php';
?>
<style type="text/css">
.ui-jqgrid tr.jqgrow td {
       white-space: normal !important;
   }
</style>
<script type="text/javascript" src="jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#addpharmed').button();
$('#inputandview').tabs();

//Non tablet display starts
jQuery("#phartable").jqGrid({
    width:700,
    height:100,
    url:'nontablet_controller.php?q=2',
     datatype: "json",
     colNames:['ID','Name of Drug','Quantity', 'Amount'],
      colModel:[
				{name:'id',index:'id',editable:true, key: true, width:100},
                {name:'type',index:'type',editable:true, editoptions:{size:40}, width:110},
                {name:'quantity',index:'quantity',editable:true,search:true, width:100},
                {name:'amount',index:'amount',editable:true, width:100},
                   ],
                   
                    rowNum:30, rowList:[30,60,100],
                    pager: '#pharpagination',
                    sortname: 'type',
                    viewrecords: true,
                    searchGrid: {multipleSearch:true,closeAfterSearch: true},
                    sortorder: "asc",
                    caption:"Drugs in Pharmacy",
                    editurl:"pharedit_controller.php"

 });
 
   jQuery("#phartable").jqGrid('navGrid','#pharpagination',{edit:true,add:false,del:true},{width:500});
//End of non tablet display

jQuery("#tabtable").jqGrid({
    width:700,
    height:100,
    url:'tablet_controller.php?q=2',
     datatype: "json",
     colNames:['ID','Name of Tab','Quantity', 'Amount'],
      colModel:[
				{name:'id',index:'id',editable:true, key: true, width:100},
                {name:'type',index:'type',editable:true, editoptions:{size:40}, width:110},
                {name:'quantity',index:'quantity',editable:true,search:true, width:100},
                {name:'amount',index:'amount',editable:true, width:100},
                   ],
                   
                    rowNum:30, rowList:[30,60,100],
                    pager: '#tabpagination',
                    sortname: 'type',
                    viewrecords: true,
                    searchGrid: {multipleSearch:true,closeAfterSearch: true},
                    sortorder: "asc",
                    caption:"Tablets in Pharmacy",
                    editurl:"tabedit_controller.php"

 });
 
   jQuery("#tabtable").jqGrid('navGrid','#tabpagination',{edit:true,add:false,del:true},{width:500});
</script>


 
<div id ="inputandview">
	<ul>
		<li><a href="#inputlab">Input Lab Drugs</a></li> 
		<li><a href="#viewnontabs">View Non Tabs</a></li>
		<li><a href="#viewtabs">View Tabs</a></li>
	</ul>
	<div id = "inputlab">
		<form id="inputphardrugs" name="inputphardrugs" action = "input_phar_controller.php" method="POST" >
			<fieldset>
				<legend id="phardrugs" ><b><i >Drugs at Pharmacy</b></i></legend>
					<table cellpadding="5">
						<tr>
							<td>Name of Drug</td>
							<td><input type="text" name="pname" id="pname"  size="15" /></td>
						 
							<td>Quantity</td>
							<td><input type="text" name="pquantity" id="pquantity"  size="15" /></td>
							 
							<td>Date</td>
							<td><input type="text" name="pdate" id="pdate"  size="15" /></td>
						</tr>
						<tr>
							<td><input type="submit" name="addpharmed" id="addpharmed" value="Add to Pharmacy"></td>
						</tr>
					</table>
			</fieldset> 
		</form>	  
	</div>	
<div id="viewnontabs">
	<table id="phartable"></table>
	 <div id="pharpagination"></div>	
</div>	

<div id="viewtabs">
	<table id="tabtable"></table>
	 <div id="tabpagination"></div>	
</div>  
</div>
			  
<div id="pcontent">
</div>		  
			  
<script type="text/javascript">
function validatePharForm(){
	$('#inputphardrugs').validate({
	'rules':{
		'pname': 'required',
		'ptype': 'required',
		'pquantity': {
		'required':true,
		'number':true},
		'pdate': {
		'required':true,
		'date':true}
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

		$( "#pdate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: new Date(year, 1 - 1, 1),
			dateFormat: 'yy-mm-dd',
			yearRange: '1900:2030'
		});
});
</script>

<script>
    $(document).ready( function() {
	$('#inputphardrugs').ajaxForm({
		beforeSubmit: validatePharForm(),
		target:"#pcontent",
		success:function(response){ 
             //  alert(response); 
        }
	});
$(function(){
	$( "#pname" ).autocomplete({
	source: <?php echo json_encode(getAllDrugs());?>
	});
	});	
});
</script>