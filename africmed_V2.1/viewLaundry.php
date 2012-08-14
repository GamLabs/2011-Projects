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
		
		$("#viewLaundryAccordion").accordion({
			autoHeight: false,
			animated: "bounceslide",
			collapsible: false
		});

		//var oTable = $('#the_table').dataTable({

		//	'sAjaxSource':'search_controller.php'
		//});
		
		$('#vl_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bJQueryUI": true,
		"sAjaxSource": "vl_processing.php",
		"iDisplayLength": 20,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
            /*
             * Calculate the total market share for all browsers in this table (ie inc. outside
             * the pagination)
             */
            var iTotalMarket = 0;
            var itemQty = 0;
            var UsedQty = 0;
            for ( var i=0 ; i<aaData.length ; i++ )
            {
                itemQty += aaData[i][3]*1;
                UsedQty += aaData[i][5]*1;
            }
             
            /* Calculate the market share for browsers on this page 
            var iPageMarket = 0;
            for ( var i=iStart ; i<iEnd ; i++ )
            {
                iPageMarket += aaData[ aiDisplay[i] ][4]*1;
            }
             
            Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[3].innerHTML = parseInt(itemQty );
            nCells[5].innerHTML = parseInt(UsedQty );
        }
 
		} );
		
		
	
		$("#CloseVl").click(function(){	closeTab();});

	
	});

	
</script>
<style>
<!--
#vl_table {
    width: 100% !Important;
}
-->
</style>
<a id="CloseVl" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

 


		<table id="vl_table" >
			<thead>
				<tr  class="ui-widget-header">
					
					<th>Date&Time</th>
					<th>Received By</th>
					<th>Item Type</th>
					<th>Item Qty</th>
					<th>Used Materials</th>
					<th>Qty of Used Materials</th>
					<th>Ironing</th>
					<th>Date&Time Returned</th>
					<th>Comments</th>
				</tr>
			</thead>
			<tfoot>
			 <tr>
			   <th>Total</th>
			   <th></th>
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
	
 
 <div id="testing2">_</div>
 
