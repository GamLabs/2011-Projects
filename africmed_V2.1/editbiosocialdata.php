<script type="text/javascript">
<!--
jQuery("#biosociallist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editbiosocial_constroller.php?q=2',
	 datatype: "json",
	 colNames:['Registration Number','Date', 'Height', 'Marital Sataus','Compound','Gr','Family Planning Method',
	      	'Para','None'],
	  colModel:[ 
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'height',index:'height',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'marital_status',index:'marital_status',editable:true, width:120 },
	      	  {name:'compound_name',index:'compound_name',editable:true, width:100},
	      	  {name:'gr',index:'gr',editable:true,hidden:true,
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'GR' }},
	      	  {name:'fmMethod',index:'fmMethod',editable:true,hidden:false ,
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Family Planning Methods' }},
		      {name:'para',index:'para',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			      		{name:'none',index:'none',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Occupation' }},
				      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#biosocialpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"BioSocial Data Records",
	      	      editurl:"edit_controller.php?table=biosocial_data"

 });
  
   jQuery("#biosociallist2").jqGrid('navGrid','#biosocialpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#biosociallist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#biosociallist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
   }


</style> 

<table id="biosociallist2"></table>
 <div id="biosocialpager2"></div>