<?php include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

if (isset($_POST['oper'])){
$post = $_POST;
if(($post['oper'])=='edit'){
editTable($post, 'finaldiagnosis');
}elseif ($post['oper'] == 'del'){
	deleteRowByVnumber($post['id'],'finaldiagnosis');
}
	
}

?>

<script type="text/javascript">
<!--
jQuery("#diagnosisViewTable").jqGrid({ 
	width:700,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'search_DiagnosisView.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','Registration Number','Final Assessment', 'Follow Up Date', 'Time Stamp'],
	  colModel:[ 
	           {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10},  width:'20%'},
	      	  {name:'pnumber',index:'pnumber',editable:true,key:false , editoptions:{readonly:true,size:10},  width:'20%'},
	      	  {name:'assessment',index:'assessment',editable:true,search:true,edittype:'textarea',  width:'50%', stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'followUpDate',index:'followUpDate',editable:true,  width:'15%',searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'timeStamp',index:'timeStamp',editable:true,  width:'15%' ,searchoptions: { sopt: ['cn', 'ne'] }},
	      	  
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#pagerdiagnosisExam',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Final Diagnosis Records",
	      	      editurl:"diagnosisView_controller.php"

 });
  
   jQuery("#diagnosisViewTable").jqGrid('navGrid','#pagerdiagnosisExam',{edit:true,add:false,del:true,search:false},{width:500}); 
   jQuery("#diagnosisViewTable").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#diagnosisViewTable')[0].triggerToolbar();
   
//-->
</script>

<style>

.myAltRowClass { background: grey ; border:0px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 


<table id="diagnosisViewTable"></table>
 <div id="pagerdiagnosisExam"></div>