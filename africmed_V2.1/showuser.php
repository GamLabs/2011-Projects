<?php include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

if (isset($_POST['oper'])){
$post = $_POST;
if(($post['oper'])=='edit'){
editTableByKey($post, 'users','username');
}elseif ($post['oper'] == 'del'){
	deleteRowByKey('username',$post['id'],'users');
}
	
}

?>

<script type="text/javascript">
<!--
jQuery("#showUsersTable").jqGrid({ 
	width:700,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'showuser_controller.php?q=2',
	 datatype: "json",
	 colNames:['First Name','Last Name', 'User Name', 'Group'],
	  colModel:[ 
	      	  {name:'firstname',index:'firstname',editable:true,  width:120},
	      	  {name:'lastname',index:'lastname',editable:true,search:true, width:100, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'username',index:'username',editable:true,key: true,editoptions:{readonly:true,size:10}, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'category',index:'category',editable:true, width:120 },
	      	 
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#pagershowUsers',
	      	      sortname: 'firstname',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Patient Records",
	      	      editurl:"showuser.php"

 });
  
   jQuery("#showUsersTable").jqGrid('navGrid','#pagershowUsers',{edit:true,add:false,del:true,search:false},{width:500}); 
   jQuery("#showUsersTable").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:true});
   $('#showUsersTable')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:0px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="showUsersTable"></table>
 <div id="pagershowUsers"></div>