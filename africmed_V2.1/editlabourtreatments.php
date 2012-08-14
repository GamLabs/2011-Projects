<script type="text/javascript">
<!--
jQuery("#labourTreatlist2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'editlabourtreatment_controller.php?q=2',
	 datatype: "json",
	 colNames:['Visit Number','PN', 'Date', 'mip_ipt1_dose','mip_ipt1_date','mip_ipt2_dose','mip_ipt2_date',
	      	 'mip_received_lln','mip_received_date','tm_date','tm_drug','sti_vd','sti_gud','sti_lap','sti_date_index_treated','sti_date_partner_treated'],
	  colModel:[ 
			  {name:'visitNumber',index:'visitNumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'date',index:'date',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'mip_ipt1_dose',index:'mip_ipt1_dose',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'mip_ipt1_date',index:'mip_ipt1_date',editable:true, width:120 },
	      	  {name:'mip_ipt2_dose',index:'mip_ipt2_dose',editable:true, width:100},
	      	  {name:'mip_ipt2_date',index:'mip_ipt2_date',editable:true,hidden:true, edittype:'select', 
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'mip_ipt2_date' }},
	      		{name:'mip_received_lln',index:'mip_received_lln',editable:true,hidden:true, edittype:'select', 
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Nationality' }},
		      		{name:'mip_received_date',index:'mip_received_date',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'mip_received_date' }},
			      		{name:'tm_date',index:'tm_date',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'tm_date' }},
				      		{name:'tm_drug',index:'tm_drug',editable:true,hidden:true, 
					      		editrules:{edithidden:true, required:true},formoptions: { label: 'tm_drug' }},
					      		{name:'sti_vd',index:'sti_vd',editable:true,hidden:true, 
						      		editrules:{edithidden:true, required:false},formoptions: { label: 'sti_vd' }},
						      		{name:'sti_gud',index:'sti_gud',editable:true,hidden:true, 
							      		editrules:{edithidden:true, required:false},formoptions: { label: 'sti_gud' }},
							      		{name:'sti_lap',sti_lap:'sti_lap',editable:true,hidden:true, 
								      		editrules:{edithidden:true, required:false},formoptions: { label: 'sti_lap' }},
								      		{name:'sti_date_index_treated',index:'sti_date_index_treated',editable:true,hidden:true, 
									      		editrules:{edithidden:true, required:false},formoptions: { label: 'sti_date_index_treated' }},
									      		{name:'sti_date_partner_treated',index:'sti_date_partner_treated',editable:true,hidden:true, 
										      		editrules:{edithidden:true, required:false},formoptions: { label: 'sti_date_partner_treated' }}
										      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#labourTreatpager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Labour Treatment Records",
	      	      editurl:"edit_controllerVn.php?table=labour_treatment"

 });
  
   jQuery("#labourTreatlist2").jqGrid('navGrid','#labourTreatpager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#labourTreatlist2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#labourTreatlist2')[0].triggerToolbar();
   
//-->
</script>
<style>

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="labourTreatlist2"></table>
 <div id="labourTreatpager2"></div>