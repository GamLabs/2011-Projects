<script type="text/javascript">
<!--
jQuery("#obstericallist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editobsterical_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','P Number', 'Date', 'Delivery Date','Pregnancy Duration','Antenatal care','Birth Weight',
	      	 'Delivery Type','Delivery Place','Delivery Attendance','Comments'],
	  colModel:[ 
			  {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: false, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'delivery_date',index:'delivery_date',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'pregnancy_duration',index:'pregnancy_duration',editable:true, width:120 },
	      	  {name:'antenaltal_care',index:'antenaltal_care',editable:true, width:100},
	      	  {name:'birth_weight',index:'birth_weight',editable:true,hidden:true, edittype:'select', editoptions:{value:{Male:'Male',Female:'Female'}},
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'Gender' }},
	      		{name:'delivery_type',index:'delivery_type',editable:true,hidden:true, edittype:'select', editoptions:{value:{Gambian:'Gambian','Non Gambian':'Non Gambian'}},
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Nationality' }},
		      		{name:'delivery_place',index:'delivery_place',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			      		{name:'delivery_att',index:'delivery_att',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Occupation' }},
				      		{name:'comments',index:'comments',editable:true,hidden:true, 
					      		editrules:{edithidden:true, required:true},formoptions: { label: 'Status' }},
					      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#obstericalpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Obsterical History Records",
	      	      editurl:"edit_controllerVn.php?table=obsterical_history"

 });
  
   jQuery("#obstericallist2").jqGrid('navGrid','#obstericalpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#obstericallist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#obstericallist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="obstericallist2"></table>
 <div id="obstericalpager2"></div>