
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
		
		var id = $("#fuelexpid").html();
		var type = $("#fuelexpin").html();
		//var oTable = $('#the_table').dataTable({

		//	'sAjaxSource':'search_controller.php'
		//});
		
		$('#Fuel_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bDestroy":true,
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
		"sAjaxSource": "fuel_processing.php?id="+id+"&type="+type ,
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
            /*
             * Calculate the total market share for all browsers in this table (ie inc. outside
             * the pagination)
             */
           
          
            var total = 0;
            for ( var i=0 ; i<aaData.length ; i++ )
            {
                total += aaData[i][2]*1;
               
            }
             
            /* Calculate the market share for browsers on this page 
            var iPageMarket = 0;
            for ( var i=iStart ; i<iEnd ; i++ )
            {
                iPageMarket += aaData[ aiDisplay[i] ][4]*1;
            }
             
            Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
            nCells[2].innerHTML = parseInt(total );
          
        }
		} );
	
	
	});

	
</script>
<style>
<!--
#Fuel_table {
    width: 100% !Important;
}
-->
</style>

<div style="display: none;" id="fuelexpid"><?php echo $_GET['Id'];?></div>
<div style="display: none;" id="fuelexpin"><?php echo $_GET['In'];?></div>

		<table id="Fuel_table" >
			<thead>
				<tr style="white-space:nowrap;" class="ui-widget-header">
					
					<th>Date</th>
					<th>Type</th>
					<th>Volume</th>
					<th>Equipment Name </th>
					<th>Requested By </th>
					<th>Authorised By</th>
						
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
			   
			 </tr>
			</tfoot>
		</table>

 
 <div id="testing6">_</div>
 
