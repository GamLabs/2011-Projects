<script type="text/javascript" src="jquery-validation/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
    	$("#conDisplay").dialog({ autoOpen:false,minWidth: 400, width:500,modal:true,buttons: { "Close": function() { $(this).dialog("close"); } }

    		  , close: function(event, ui) { 
    			  var selected = $("#contentTab").tabs('option', 'selected');
  				$("#contentTab").tabs('load',selected);
        		   }
    		 });
	    	$.ajax({
	            url     : 'conFeeController.php',
	            type    : 'POST',
	            data    : $('#conForm').serialize(),
	            success: function( data ){	    		
	                   $('#con').html(data);   
	            }
	        });

	    	$("#conpnumber").keyup(function(){

	    		var charLength = $("#conpnumber").val().length;
	    		if(!isNaN(charLength)){
					if(charLength != 8){
						$("#mainConDiv").hide();
				    	$("#conHidden").hide();
				    	$("#con").val("");
				    	$("#conAmount").val("");
					}
	    		}
		    		
	    	});
    	
    	$("#con").change(function(){
    		$.post('conFeeController.php',{'conType': $("#con").val()},function(data) {
    			if(data){
	    			$("#conAmount").val(data);
    			}else{
    				$("#conAmount").val("");
    			}
    		});
    	});
        
    	

    	$("#ADD").click(function(){
    		var typ=$("#con").val();
    		if(typ==""){
    			$("#errorMessage").html('<p>Please choose a consultation type!</p>').dialog('open');
				return;
    		}else{
	    		$.post('conFeeController.php',{'addConType': $("#con").val(),'addAmount': $("#conAmount").val(),'addPnumber': $("#conpnumber").val()},function(data) {
					//alert(eval(data));	
	    			if(data == 0){
	    				$("#errorMessage").html('<p class="errorStyle">This Patient Has Already Been Booked For Consultation!</p>').dialog('open');
	    			}else{
	    				//$("#conDisplay").show();
	    				$('#displayConsultation').html(data);
	    				$("#conDisplay").dialog('open');
	    				
	    			}
	    		});
    		}
    	});

    	//$('#conForm').formly({'onBlur':false, 'theme':'Dark'});
    	$("#mainConDiv").hide();
    	$("#conHidden").hide();
    	$("#conDisplay").hide();
    	$("#conFeeSubmit").button();
    	$("#ADD").button();
    	$("#conDate").datepicker( {showOtherMonths: true,selectOtherMonths: true,changeMonth: true,changeYear: true,showButtonPanel:true,yearRange: '1800:2050',dateFormat: 'yy-mm-dd'});
    	
    	$('#conpnumber').liveSearch({url: 'conFeeController.php?page=conFee&liveSearchPnumber='+$('#conpnumber').val()});
    		$('#livePnumberQueryconFee').live('click',function(e){
    		$('#conpnumber').val(($(this).text()));
    		$('#jquery-live-search').slideUp();
    		var name = $(this).closest('tr').find('td:eq(1)').text();
        	$("#conFeeHeaderInfo").empty().text("Consultation Fee - "+ name);
    		// POST TO CHECK IF DRAWER IS OPENED
			$.post('conFeeController.php',{'checkIfDrawerIsOpen': 'check'},function(data) {
				if(data == 0){
					$("#mainConDiv").hide();
					$("#conHidden").hide();
					$("#errorMessage").html('<p><font size=5>You Must Open Cash Drawer Before You Can Proceed!!'+
    				'</font></p>').dialog('open');
    				return;
				}else if(data == 1){
					$("#mainConDiv").show();
					$("#conHidden").show();
				}
			});
			e.stopImmediatePropagation();
			return false;
    	});

    		$("#CloseConFee").click(function(){	closeTab();});
    	
    });// end document ready
</script>

<style>
<!--
.tdtext {
	 /* white-space: nowrap;*/
	  vertical-align: top;
	  color: aqua;
	  font-size: 12px;
	}
-->
</style>


<a id="CloseConFee" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<form id="conForm" name="conForm"  method="post">
<fieldset class=" ui-widget-content ui-corner-all inputStyle">
	<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Person Information</i></b></legend>
			<table border="0" class="tdtext">
				<tr>
					<td><label>Patient Name/Number </label></td><td><input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" size="10" type="text" id="conpnumber" name="conpnumber"/></td>
				</tr>
			</table>
</fieldset>
<div id="mainConDiv" style="display:none"> 
	<div id="conHidden"><br>
		<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			<legend id="conFeeHeaderInfo" class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"><b><i>Consultation Booking</i></b></legend>
		
				<table class="tdtext" >
						
					<tr>
						<td><label>Select Consultation Type</label></td><td><select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="con" id="con"></select></td>
					</tr>
					<tr>
						<td><label>Amount: </label></td><td> <input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" name="conAmount" id="conAmount" size="10" /readonly>  </td>
					</tr>
					<tr>
						<td><label id="ADD">Add</label>  </td><td></td>
												
					</tr>
				</table>
		</fieldset><br>
	</div>
	<div id="conDisplay" style="display:none">
		<fieldset class=" ui-widget-content ui-corner-all inputStyle">
			<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" id="contact"><b><i>Booking Details</i></b></legend>
		
				<div id="displayConsultation"></div>
		</fieldset>
	
	</div>
</div>		
</form>

