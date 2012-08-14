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
		
		$('#STM_table').dataTable( {
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
		"sAjaxSource": "sterilmain_processing.php"
		} );
		
		
	
	
	
	});

	
</script>
<style>
<!--
#STM_table {
    width: 100% !Important;
}
-->
</style>


		<table id="STM_table" >
			<thead>
				<tr style="white-space:nowrap;" class="ui-widget-header">
					
					<th>Date</th>
					<th>Problem Type</th>
					<th>SpareParts required</th>
					<th>Engineer's Name</th>
					<th>Engineer's Contact</th>
					<th>Employee Name</th>
					<th>Comment</th>
					
				</tr>
			</thead>
		</tbody>
		</table>
	
 
 <div id="testing4">_</div>
 
