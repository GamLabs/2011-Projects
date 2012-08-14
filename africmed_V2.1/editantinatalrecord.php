<script type="text/javascript">
<!--
jQuery("#antenatallist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editantinatal_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','PN', 'Date', 'Weight','BP','Oedema','obe_fundal_ht',
	      	 'obe_press_poss','obe_fh','li_urine','li_hb','li_vdrl','li_sickle','vaccination_dosses','medications',
	      	 'followup_date'],
	  colModel:[ 
			  {name:'VisitNumber',index:'VisitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: false, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'weight',index:'weight',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'bp',index:'bp',editable:true, width:120 },
	      	  {name:'oedema',index:'oedema',editable:true, width:100},
	      	  {name:'obe_fundal_ht',index:'obe_fundal_ht',editable:true,hidden:true,
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'Fundamenta HT' }},
	      		{name:'obe_press_poss',index:'obe_press_poss',editable:true,hidden:true,
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Pres Pos:' }},
		      		{name:'obe_fh',index:'obe_fh',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'FH' }},
			      		{name:'li_urine',index:'li_urine',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Urine' }},
				      		{name:'li_hb',index:'li_hb',editable:true,hidden:true, 
					      		editrules:{edithidden:true, required:true},formoptions: { label: 'HB' }},
					      		{name:'li_vdrl',index:'li_vdrl',editable:true,hidden:true, 
						      		editrules:{edithidden:true, required:false},formoptions: { label: 'VDRL' }},
						      		{name:'li_sickle',index:'li_sickle',editable:true,hidden:true, 
							      		editrules:{edithidden:true, required:false},formoptions: { label: 'Sickle Cell' }},
							      		{name:'vaccination_dosses',index:'vaccination_dosses',editable:true,hidden:true, 
								      		editrules:{edithidden:true, required:false},formoptions: { label: 'Vaccination Doeses' }},
								      		{name:'medications',index:'medications',editable:true,hidden:true, 
									      		editrules:{edithidden:true, required:false},formoptions: { label: 'Medications' }},
									      		{name:'followup_date',index:'followup_date',editable:true,hidden:true, 
										      		editrules:{edithidden:true, required:false},formoptions: { label: 'FollowUp Date' }}
										      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#antenatalpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Antenatal Records",
	      	      editurl:"edit_controllerVn.php?table=antenatal_record"

 });
  
   jQuery("#antenatallist2").jqGrid('navGrid','#antenatalpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#antenatallist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#antenatallist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="antenatallist2"></table>
 <div id="antenatalpager2"></div>