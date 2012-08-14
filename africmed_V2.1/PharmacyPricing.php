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
		
		var oTable = $('#editPharmacyPricing_table').dataTable( {
			
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
		"sAjaxSource": "editPharPricingController.php"
		
		});
		
	
	$("#editPharPricingFormDialog").dialog({ autoOpen:false,minWidth: 600,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } } });
	$('.editPharPricingLink').live('click',function(e){
		 var id = $(this).closest('tr').find('td:eq(0)').text();

		 $('#editPharPricingFormDialog').load("tableEditor.php?pharPricingId="+id);
		 $("#editPharPricingFormDialog").dialog('open');
		
		 
			
		e.stopImmediatePropagation();
		return false;
	});

	
	
	});


	
</script>

<style>
<!--
#editPharmacyPricing_table {
    width: 100% !Important;
}

 .highlight {
                background-color: yellow;
        }
  

-->
</style>

<!-- <div style="width:100%; left:50px; float:left;">
	<center> -->
		<table id="editPharmacyPricing_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 50px">ID</th>
					<th>Drug  Name</th>
					<th style="width: 100px">Drug TYpe</th>
					<th style="width: 100px">Selling Price</th>
					<th style="width: 100px">Pricing</th>
					
				</tr>
			</thead>
			<tfoot>
  <tr>
      
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
 
 <div style="display: none" id="editPharPricingFormDialog"
	title="Edit Pharmacy Pricing">
	
	</div>
 
