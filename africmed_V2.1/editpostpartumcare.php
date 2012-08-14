<script type="text/javascript">
<!--
jQuery("#postpartumlist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editpostpartum_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','PN', 'Date', 'immediate','immediate_date','after1_week','after1_week_date',
	      	 'at6_week','at6_week_date'],
	  colModel:[ 
			  {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'immediate',index:'immediate',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'immediate_date',index:'immediate_date',editable:true, width:120 },
	      	  {name:'after1_week',index:'after1_week',editable:true, width:100},
	      	  {name:'after1_week_date',index:'after1_week_date',editable:true,hidden:true, 
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'after1_week_date' }},
	      		{name:'at6_week',index:'at6_week',editable:true,hidden:true, 
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'at6_week' }},
		      		{name:'at6_week_date',index:'at6_week_date',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'at6_week_date' }},
			      			
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#postpartumpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Postpartum Care  Records",
	      	      editurl:"edit_controllerVn.php?table=postpartum_care"

 });
  
   jQuery("#postpartumlist2").jqGrid('navGrid','#postpartumpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#postpartumlist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#postpartumlist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="postpartumlist2"></table>
 <div id="postpartumpager2"></div>