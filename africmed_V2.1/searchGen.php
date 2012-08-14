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
		
		$('#the_table').dataTable( {
			
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
		"sAjaxSource": "server_processing2.php"
		
		});
		
		
		
	
		$("#CloseSearchGen").click(function(){	closeTab();});

		

	
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
#the_table {
    width: 100% !Important;
}
.DataTables_sort_wrapper {
	font-size:14px;
	}
 .highlight {
                background-color: yellow;
        }
  

-->
</style>
<a id="CloseSearchGen" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<!-- <div style="width:100%; left:50px; float:left;">
	<center> -->
		<table id="the_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 100px">Reg Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th style="width: 100px">Date of Birth</th>
					<th style="width: 100px">Telephone</th>
					<th>Address</th>
				</tr>
			</thead>
			
			
	
		</table>
		
		<!-- 
	</center>
 </div>
  -->
 <div id="testing">_</div>
 
