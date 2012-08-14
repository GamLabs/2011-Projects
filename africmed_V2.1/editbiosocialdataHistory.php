<script type="text/javascript">
<!--
jQuery("#biosocialHistorylist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editbiosocialhistory_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','PN', 'date', 'fh_tb','fh_diabetes','fh_multiple_birth','fh_other',
	      	 'ph_anaemia','ph_toxemia','ph_high_bp','ph_tb','ph_sickle_cell','ph_pid','ph_diabetes','mh_lmp','mh_regular','edd','delivery_place'],
	  colModel:[ 
			  {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'fh_tb',index:'fh_tb',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'fh_diabetes',index:'fh_diabetes',editable:true, width:120 },
	      	  {name:'fh_multiple_birth',index:'fh_multiple_birth',editable:true, width:100},
	      	  {name:'fh_other',index:'fh_other',editable:true,hidden:true, edittype:'select', editoptions:{value:{Male:'Male',Female:'Female'}},
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'Gender' }},
	      		{name:'ph_anaemia',index:'ph_anaemia',editable:true,hidden:true, edittype:'select', editoptions:{value:{Gambian:'Gambian','Non Gambian':'Non Gambian'}},
		      	editrules:{edithidden:true, required:true},formoptions: { label: 'Deliver Mode' }},
		      	{name:'ph_toxemia',index:'ph_toxemia',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			     {name:'ph_high_bp',index:'ph_high_bp',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'baby Weight' }},
				 {name:'ph_tb',index:'ph_tb',editable:true,hidden:true, 
			    editrules:{edithidden:true, required:false},formoptions: { label: 'Apgar Score' }},
			    {name:'ph_sickle_cell',index:'ph_sickle_cell',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			    {name:'ph_pid',index:'ph_pid',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			    {name:'ph_diabetes',index:'ph_diabetes',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			    {name:'mh_lmp',index:'mh_lmp',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},		      		
			    {name:'mh_regular',index:'mh_regular',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			    {name:'edd',index:'edd',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			    {name:'delivery_place',index:'delivery_place',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#biosocialHistorypager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Biosocial Data History Records",
	      	      editurl:"edit_controllerVn.php?table=labour_history"

 });
  
   jQuery("#biosocialHistorylist2").jqGrid('navGrid','#biosocialHistorypager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#biosocialHistorylist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#biosocialHistorylist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="biosocialHistorylist2"></table>
 <div id="biosocialHistorypager2"></div>