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
		
		$("#vSchedule_table tbody").click(function(event) {
			$(oTable.fnSettings().aoData).each(function (){
				$(this.nTr).removeClass('row_selected');
			});
			$(event.target.parentNode).addClass('row_selected');
		});
			
		
		$("#viewScheduleAccordion").accordion({
			autoHeight: false,
			animated: "bounceslide",
			collapsible: false
		});

		//var oTable = $('#the_table').dataTable({

		//	'sAjaxSource':'search_controller.php'
		//});
		
		$('#vSchedule_table').dataTable( {
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
		"sAjaxSource": "vsched_processing.php"
		} );
		
		
	
		$("#CloseVSch").click(function(){	closeTab();});

	
	});

	
</script>
<style>
<!--
#vSchedule_table {
    width: 100% !Important;
}
-->
</style>
<a id="CloseVSch" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <div id="viewScheduleAccordion">

 <h2><a href="#">Laundry Activities</a></h2>
 <div class="ui-widget" ">


		<table id="vSchedule_table" >
			<thead>
				<tr style="white-space: nowrap" class="ui-widget-header">
					
					<th>Date</th>
					<th>Medical Complain</th>
					<th>Doctor</th>
					<th>Department</th>
					<th>Time of Appointment</th>
					<th>FollowUp Date</th>
					<th>Status</th>
					
				</tr>
			</thead>
		</tbody>
		</table>

  </div>
  </div>
 
 <div id="testing10">_</div>
 
