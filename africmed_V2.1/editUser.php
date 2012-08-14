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

	
		var oTable = $('#editUser_table').dataTable( {
			
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
		"sAjaxSource": "editUserController.php"
		
		});
		
	
	$("#listUserBack").button();
	$("#listUserBack").click(function(){
		refreshTab();
	});

	$('.changeUserStatusLink').live('click',function(e){
		 var id = $(this).closest('tr').find('td:eq(0)').text();
		 var cs = $(this).closest('tr').find('td:eq(4)').text();
		 $.post('check.php',{'editUserStatusId':id,'cStatus':cs},function(data) {
			
			var st = parseInt(data);
				
			if(st == 3){
				$("#successMessage").html('<p> Successfully Deactivated</p>').dialog('open');
				
			}else if(st==4){
				$("#successMessage").html('<p> Successfully Activated</p>').dialog('open');
			}	
			
			 //refreshTab();
			oTable.fnDraw();
			
		 });
	
		e.stopImmediatePropagation();
		return false;
	});
	});


	
</script>

<style>
<!--
#editUser_table {
    width: 100% !Important;
}

 .highlight {
                background-color: yellow;
        }
  

-->
</style>
<a id="listUserBack" style="float: right;font-size:12" href="#">Back</a>
<!-- <div style="width:100%; left:50px; float:left;">
	<center> -->
		<table id="editUser_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 50px">ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th style="width: 100px">User Name</th>
					<th style="width: 50px">Active</th>
					<th style="width: 100px">Department</th>
					<th style="width: 100px">Status</th>
					
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
 
