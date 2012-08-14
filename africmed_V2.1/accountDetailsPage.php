<?php 
function getParamsAcct(){
	$ot = "";
foreach($_GET as $k => $v){
	$ot .= $k."=".$v."&";
}
 echo $ot;
}

//getParamsAcct();
//print_r($_GET);
?>

<style type="text/css">
	@import "js/plugins/DataTables/media/css/demo_table.css";
	/*table{width:80%}*/
</style>
<script>
	$(document).ready(function(){
		

		var get = $("#accDetailPaneGetter").attr('data');
		
		var oTable = $('#accountDetailPage_table').dataTable( {
			
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"bJQueryUI": true,
		"iDisplayLength": -1,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		
		"sAjaxSource": "accountDetail_list.php?"+get,
		"fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
            /*
             * Calculate the total market share for all browsers in this table (ie inc. outside
             * the pagination)
             */
           
          	var mainT = 0;
            var total = 0;
            for ( var i=0 ; i<aaData.length ; i++ )
            {
               
                mainT += aaData[i][4]*1;
               
            }
             
            /* Calculate the market share for browsers on this page 
            var iPageMarket = 0;
            for ( var i=iStart ; i<iEnd ; i++ )
            {
                iPageMarket += aaData[ aiDisplay[i] ][4]*1;
            }
             
            Modify the footer row to match what we want */
            var nCells = nRow.getElementsByTagName('th');
           
            nCells[4].innerHTML = 'D'+parseInt(mainT );
          
        }
		
		});
		
		$("tfoot input").keyup( function () {
			/* Filter on the column (the index) of this element */
			//oTable.fnFilter( this.value, $("tfoot input").index(this) );
			 var id = $(this).attr('id').split("-")[1];
			  oTable.fnFilter( this.value, id );
		} );
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
#accountDetailPage_table {
    width: 100% !Important;
}

 .highlight {
                background-color: yellow;
        }
  

-->
</style>

<span style="display: none;" id="accDetailPaneGetter" data="<?php getParamsAcct();?>"></span>


		<table id="accountDetailPage_table" >
			<thead>
				<tr style="white-space: nowrap;" class="ui-widget-header">
					
					<th style="width: 50px">Date</th>
					<th style="width: 100px">Reason</th>
					<th style="width: 100px">Type</th>
					<th style="width: 50px">Account Code</th>
					<th style="width: 50px">Amount</th>
				</tr>
			</thead>
			<tfoot>
			 <tr>
			   <th>Total</th>
			    <th></th>
			   <th><input type="text" id="i-0" class="search_init"></th>
			   <th></th>
			   <th></th>
			  
			   
			 </tr>
			</tfoot>
			
			
	
		</table>
		

 <div id="testing">_</div>
 

