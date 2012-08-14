<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
?>
<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	/*table{width:80%}*/
</style>
<script>
	$(document).ready(function(){

		function formatTableToolsButton(node, icon) {
			$(node).removeClass('DTTT_button');
			$(node).button({icons: {primary: icon}});
			$('.DTTT_container').buttonset();
			/* Add this part if you're using a DataTable inside an hidden JUI tab. */
			$( ".ui-tabs" ).bind( "tabsshow", function(event, ui) {
			$('.DTTT_container').buttonset();
			});
			}

					
		

		//var oTable = $('#the_table').dataTable({

		//	'sAjaxSource':'search_controller.php'
		//});
		
		var oTable = $('#editCompany_table').dataTable( {
			
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bJQueryUI": true,
		"iDisplayLength": 20,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		//"sDom": 'T<"clear">lfrtip',
		"sDom": 'T<"clear"><"fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix"lfr>t<"fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix"ip>',
		"iButtonHeight": 30,
		"iButtonWidth": 30,
	    "oTableTools": {
	    	"sSwfPath": "DataTables-TableTools/media/swf/copy_cvs_xls_pdf.swf",
	    	"aButtons": [
	    	{
	    	"sExtends": "print",
	    	"fnInit": function(node){formatTableToolsButton(node, 'ui-icon-print');}
	    	},
	    	{
		    	"sExtends": "pdf",
		    	"fnInit": function(node){formatTableToolsButton(node, 'ui-icon-disk');}
		    },
		    {
		    	"sExtends": "xls",
		    	"fnInit": function(node){formatTableToolsButton(node, 'ui-icon-disk');}
		    }
	    	]
	    	},
		"sAjaxSource": "editCompanyController.php"
		
		});
		
	
	$("#editCompanyBack").button();
	$("#editCompanyBack").click(function(){
		refreshTab();
	});

	$("#editCompanyRefresh").button();
	$("#editCompanyRefresh").click(function(){
		oTable.fnDraw();
	});
	
	$("#editCompanyFormDialog").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
	$('.editCompanyLink').live('click',function(e){
		 var id = $(this).closest('tr').find('td:eq(0)').text();

		 $('#editCompanyFormDialog').load("tableEditor.php?companyId="+id);
		 $("#editCompanyFormDialog").dialog('open');
		
		 
		oTable.fnDraw();	
		e.stopImmediatePropagation();
		return false;
	});

	$('.deleteCompanyLink').live('click',function(e){

		
		 var id = $(this).closest('tr').find('td:eq(0)').text();
		var name = $(this).closest('tr').find('td:eq(1)').text();
		// $('#editCompanyFormDialog').load("tableEditor.php?companyId="+id);
		// $("#editCompanyFormDialog").dialog('open');
		 $.post('edit_controller.php',{'deleteCompany': id,'name':name},function(data) {
				var dt = parseInt(data);
				if(dt == 0){
					$("#successMessage").html("<i style='color:red;'>Successfully Deleted</i>").dialog('open');
					 oTable.fnDraw();
				}else if(dt == 2){
					$("#errorMessage").html("<i style='color:red;'>Some Patients Are Still Registered To This Company</i>").dialog('open');

				}
		 });
		 oTable.fnDraw();	
		e.stopImmediatePropagation();
		return false;
	});

	
	});


	
</script>

<style>
<!--
#editCompany_table {
    width: 100% !Important;
}

 .highlight {
                background-color: yellow;
        }
  

-->
</style>
<a id="editCompanyBack" style="float: right;font-size:12" href="#">Back</a>
<a id="editCompanyRefresh" style="float: right;font-size:12" href="#">Refresh</a>
<!-- <div style="width:100%; left:50px; float:left;">
	<center> -->
		<table id="editCompany_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 50px">ID</th>
					<th>Company Name</th>
					<th>Address</th>
					<th style="width: 100px">Contact</th>
					<th style="width: 100px">Email</th>
					<th style="width: 100px">Edit</th>
					<th style="width: 100px">Delete</th>
					
				</tr>
			</thead>
			<tfoot>
  <tr>
      
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
			
	
		</table>
		
		<!-- 
	</center>
 </div>
  -->
 <div id="testing">_</div>
 
 <div style="display: none" id="editCompanyFormDialog"
	title="Edit Company">
	
	</div>
 
