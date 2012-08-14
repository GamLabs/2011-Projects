<script>
  $(document).ready(function () {
	  
	  $("#patientInfoAccordion").hide();
	 // $('#patientInfoSearchBox').formly({'onBlur':false, 'theme':'Dark'});
	  $('#pnumberPatientInfo').liveSearch({url: 'check.php?page=Pinfo&liveSearchPnumber='+$('#pnumberPatientInfo').val()});
		$('#livePnumberQueryPinfo').live('click',function(e){
		$('#pnumberPatientInfo').val(($(this).text()));
		var pnumber = $('#pnumberPatientInfo').val();
		$('#jquery-live-search').slideUp();
		$.post('check.php',{'isMale': pnumber},function(data) {
			var dt = parseInt(data);
			if(dt == 0){
			$("#onlyFemalesMenu").hide();
			}else{
				$("#onlyFemalesMenu").show();
			}
		});
		
		$("#patientInfoAccordion").slideDown();
		$("#patientInfoAccordion").accordion();
		//	alert($('#jquery-live-search').html().lenght);
		e.stopImmediatePropagation();
		return false;
		});

		
		$("#pnumberPatientInfo").keyup(function(e){
			var charLength = $("#pnumberPatientInfo").val().length;
			if(charLength != 8){
				
				$("#patientInfoAccordion").hide();
				$("#patientInfoDisplayDiv").hide();
				
			}else{
				var pnumber = $("#pnumberPatientInfo").val();
				$.post('check.php',{'pnumber': pnumber},function(data) {
					
					var val = eval(data);
					if(!(val == 3)){
						$("#patientInfoAccordion").slideDown();
						$("#patientInfoAccordion").accordion();
					}

				});
				
			}
		
		});
		
		

		$("#checkupsTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'checkup'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
		$("#patientrecordTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'patientrecord'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
		$("#finaldiagnosisTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'finaldiagnosis'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#phyexamTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'phyexam'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#investigationTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'investigation'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#prescriptionsTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'pharbooking'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
	//=======
		$("#biosocialRegistrationTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'biosocial_data'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#biosocialHistoryTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'labour_history'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
		$("#obstericalHistoryTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'obsterical_history'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#labourTreatmentsTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'labour_treatment'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#antenatalTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'antenatal_record'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#labourDeliveryTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'delivery'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});

		$("#postpartumTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'postpartum_care'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
		$("#operationsTable").live('click',function(e){
			//alert($(this).attr('id'));
			$.post('check.php',{'patientInfoPN': $("#pnumberPatientInfo").val(),'patientInfoTable':'theatre'},function(data) {
    		//alert(data+"me");
    		$("#patientInfoDisplayDiv").show().html(data);
    		$("fieldset.collapsed").collapse({ closed : true });
	    			
    		});
			e.stopImmediatePropagation();
			return false;
		});
		
		$("#ClosePatientInfo").click(function(){	closeTab();});
	
  });
 </script>
<a id="ClosePatientInfo" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<fieldset class=" ui-widget ui-widget-content ui-corner-all inputStyle" >
<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Patient Information</i></b></legend>

<label>Patient Name/Number </label> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="20" type="text" id="pnumberPatientInfo" name="pnumberPatientInfo" />


</fieldset>
<br>
<div style="width:100%;">
<div style=" width:250px;;float: right; display: inline;overflow:auto" id="patientInfoAccordion">
  <h2><a href="#">Patient Info Menu</a></h2>
  
  	<div class="ui-widget" id="patientInfoSecondDiv">
  	<div class="ui-state-default  ">
    <a href="#" id="patientrecordTable">Registration Details</a></div>
 	<div class="ui-state-default  ">
    <a href="#" id="checkupsTable">Health History</a></div>
    <div class="ui-state-default  ">
    <a href="#" id="phyexamTable">Phy/Men Examinations</a></div>
    <div class="ui-state-default ">
    <a href="#" id="finaldiagnosisTable">Doctors Diagnosis</a></div>
	<div class="ui-state-default ">
    <a href="#" id="investigationTable" class="lab">All Investigations</a></div>
    <div class="ui-state-default ">
    <a href="#" id="prescriptionsTable">Medical Prescriptions</a></div>
    <div class="ui-state-default ">
    <a href="#" id="operationsTable">Surgeries</a></div>
    
    <div id="onlyFemalesMenu">
     <div class="ui-state-default ">
    <a href="#" id="biosocialRegistrationTable">Biosocial Regitration</a></div>
     <div class="ui-state-default ">
    <a href="#" id="biosocialHistoryTable">Biosocial History</a></div>
     <div class="ui-state-default ">
    <a href="#" id="obstericalHistoryTable">Obsterical History</a></div>
    <div class="ui-state-default ">
    <a href="#" id="labourTreatmentsTable">Labour Treatments</a></div>
    <div class="ui-state-default ">
    <a href="#" id="antenatalTable">Antenatal Records</a></div>
    <div class="ui-state-default ">
    <a href="#" id="labourDeliveryTable">Delivery History</a></div>
    <div class="ui-state-default ">
    <a href="#" id="postpartumTable">Postpartum Care</a></div>
    </div>
    
	</div>
</div>
<div style="margin-left: 10px; overflow: auto;" id="patientInfoDisplayDiv">



</div> 
<br>
</div>