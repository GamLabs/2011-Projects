<script type="text/javascript">
<!--
jQuery("#labourDelivlist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editlabourdelivery_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','PN', 'date', 'time','place','delivered_by','designation',
	      	 'delivery_mode','outcome','baby_weight','apgar_score'],
	  colModel:[ 
			  {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'time',index:'time',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'place',index:'place',editable:true, width:120 },
	      	  {name:'delivered_by',index:'delivered_by',editable:true, width:100},
	      	  {name:'designation',index:'designation',editable:true,hidden:true, edittype:'select', editoptions:{value:{Male:'Male',Female:'Female'}},
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'Gender' }},
	      		{name:'delivery_mode',index:'delivery_mode',editable:true,hidden:true, edittype:'select', editoptions:{value:{Gambian:'Gambian','Non Gambian':'Non Gambian'}},
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Deliver Mode' }},
		      		{name:'outcome',index:'outcome',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			      		{name:'baby_weight',index:'baby_weight',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'baby Weight' }},
					      		{name:'apgar_score',index:'apgar_score',editable:true,hidden:true, 
						      		editrules:{edithidden:true, required:false},formoptions: { label: 'Apgar Score' }},
						      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#labourDelivpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Patient Records",
	      	      editurl:"edit_controllerVn.php?table=delivery"

 });
  
   jQuery("#labourDelivlist2").jqGrid('navGrid','#labourDelivpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#labourDelivlist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#labourDelivlist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="labourDelivlist2"></table>
 <div id="labourDelivpager2"></div>