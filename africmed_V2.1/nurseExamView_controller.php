<?php include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

if (isset($_POST['oper'])){
$post = $_POST;
if(($post['oper'])=='edit'){
editTable($post, 'phyexam');
}elseif ($post['oper'] == 'del'){
	deleteRowByVnumber($post['id'],'phyexam');
}
	
}

?>
<script type="text/javascript">
<!--
jQuery("#nurseExamTable").jqGrid({ 
	width:700,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'search_nurseExam.php?q=2&table=phyexam',
	 datatype: "json",
	 colNames:['Visit Number','P Number','Fullname','Temperature', 'Weight', 'Height','Blood Pressure','Pulse','Complains'],
	  colModel:[ 
	            {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:'25%'},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: false, editoptions:{readonly:true,size:10}, width:'25%'},
	      	  {name:'hiddenNameToView',index:'hiddenNameToView',editable:true,key: false, editoptions:{readonly:true,size:10}, width:'25%'},
	      	  {name:'temperature',temperature:'temperature',editable:true,search:true, width:'10%', stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'weight',index:'weight',editable:true, width:'10%',searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'height',index:'height',editable:true, width:'10%',searchoptions: { sopt: ['cn', 'ne'] } },
	      	  {name:'bp',index:'bp',editable:true, width:'10%',searchoptions: { sopt: ['cn', 'ne'] }},
	      	  {name:'pulse',index:'pulse',editable:true, width:'10%',searchoptions: { sopt: ['cn', 'ne'] }},
	      	  {name:'complains',index:'complains',editable:true, width:'50%',searchoptions: { sopt: ['cn', 'ne'] }},
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#pagernurseExam',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Nurse Examination Records",
	      	      editurl:"nurseExamView_controller.php"

 });
  
   jQuery("#nurseExamTable").jqGrid('navGrid','#pagernurseExam',{edit:true,add:false,del:true,search:false},{width:500}); 
   jQuery("#nurseExamTable").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#nurseExamTable')[0].triggerToolbar();
   
//-->
</script>

<style>

.myAltRowClass { background: grey ; border:0px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 


<table id="nurseExamTable"></table>
 <div id="pagernurseExam"></div>