<?php require_once 'includes/connect.php';
		require_once 'includes/requireFile.php';
?>
<script type="text/javascript">
<!--

var chFunc = function(){
  var comp = $(this).val();
	$.post('companyBillsController.php',{'getCompanyList': comp},function(data) {
		$('#statusName').html(data);
		
});



	
};
jQuery("#list2").jqGrid({ 
	width:800,
	height:300,
	autowidth: true,
	altRows:true,
	altclass:'myAltRowClass',
	url:'search2_controller.php?q=2',
	 datatype: "json",
	 colNames:['Registration Number','First Name', 'Last Name', 'Date of Birth','Telephone','Gender','Nationality',
	      	 'Place of Birth','Occupation','Status','Status Name','ID','Email','Phone','Address'],
	  colModel:[ 
	      	  {name:'pnumber',index:'pnumber',editable:true,key: true, editoptions:{readonly:true,size:10}, width:120},
	      	  {name:'fname',index:'fname',editable:true,search:true, width:200, stype: 'text', searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'lname',index:'lname',editable:true, width:100,searchoptions: { sopt: ['cn', 'ne'] }}, 
	      	  {name:'dob',index:'dob',editable:true, width:120 },
	      	  {name:'phone',index:'phone',editable:true, width:100},
	      	  {name:'gender',index:'gender',editable:true,hidden:true, edittype:'select', editoptions:{value:{Male:'Male',Female:'Female'}},
	      		editrules:{edithidden:true, required:true},formoptions: { label: 'Gender' }},
	      		{name:'nationality',index:'nationality',editable:true,hidden:true, edittype:'select', editoptions:{value:{Gambian:'Gambian','Non Gambian':'Non Gambian'}},
		      		editrules:{edithidden:true, required:true},formoptions: { label: 'Nationality' }},
		      		{name:'pob',index:'pob',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Place of Birth' }},
			      		{name:'occupation',index:'occupation',editable:true,hidden:true, editrules:{edithidden:true, required:true},formoptions: { label: 'Occupation' }},
				      		{name:'status',index:'status',editable:true,hidden:true,editoptions:{readonly:true},
					      		editrules:{edithidden:true, required:true},formoptions: { label: 'Status' }},
					      		{name:'statusName',index:'statusName',editable:true,hidden:true, editoptions:{readonly:true},
						      		editrules:{edithidden:true, required:false},formoptions: { label: 'Status Name' }},
						      		{name:'statusId',index:'statusId',editable:true,hidden:true, editoptions:{readonly:true},
							      		editrules:{edithidden:true, required:false},formoptions: { label: 'ID' }},
							      		{name:'email',index:'email',editable:true,hidden:true, 
								      		editrules:{edithidden:true, required:false},formoptions: { label: 'Email' }},
								      		{name:'phone',index:'phone',editable:true,hidden:true, 
									      		editrules:{edithidden:true, required:false},formoptions: { label: 'Phone' }},
									      		{name:'address',index:'address',editable:true,hidden:true, 
										      		editrules:{edithidden:true, required:false},formoptions: { label: 'Address' }}
										      		
	      	     ],
	      	      
	      	      rowNum:30, rowList:[30,60,100],
	      	      pager: '#pager2',
	      	      sortname: 'pnumber',
	      	      viewrecords: true,	      	    
	      	      sortorder: "desc",
	      	      caption:"Patient Records",
	      	      editurl:"edit_controller.php?table=patientrecord"

 });
  
   jQuery("#list2").jqGrid('navGrid','#pager2',{edit:true,add:false,del:true,search:false},{width:800}); 
   jQuery("#list2").jqGrid('filterToolbar',{stringResult: true,searchOnEnter:false});
   $('#list2')[0].triggerToolbar();
   
//-->
</script>
<style>
#list2 {
    width: 100% !Important;
}

.CaptionTD  {
	color:white;
}

.delmsg {
	color:white;
}

.myAltRowClass { background: grey ; border:2px solid #DDDDDD;  }

.ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
    }


</style> 

<table id="list2"></table>
 <div id="pager2"></div>