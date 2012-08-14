

function refreshTab(){
			var selected = $("#contentTab").tabs('option', 'selected');
			$("#contentTab").tabs('load',selected);
}

function refreshTabFun(value){
	alert(value+"1");
	var selected = $("#contentTab").tabs('option', 'selected');
	$("#contentTab").tabs('load',selected);
	alert(value);
}

function closeTab(){
	var selected = $("#contentTab").tabs('option', 'selected');
	$("#contentTab").tabs('remove',selected);
}


$("#CloseCurrentTab").click(function(){
	
	closeTab();
});

function tabNameExists(name){
	returnVal = false;
	$('#contentTab ul li a').each(function(i) {
			if (this.text == name) {
				returnVal = true;
			}
	});
	return returnVal;
}

function getTabName(name){
	inc = 0;
	returnVal = 0;
	$('#contentTab ul li a').each(function(i) {
		
			if (this.text == name) {
				//alert(returnVal);	
				inc =  returnVal;	
			}
			returnVal++;
	});
	return inc;
			
}
function confirmPrompt(fun){
	 $("#confirmPromptDialog").dialog({ 
		 autoOpen:false,
		 width:400,
		 minWidth: 400,
		 modal:true,
		 buttons: { 
			 "Yes": function() {
					// fun();
					fun.show();
				  $(this).dialog('close');
				   } ,
			 "No": function() {
				 	fun.hide();
				 	$(this).dialog('close');
					 }
	   			}  
	   		 
		   			
	   		});
	 $("#confirmPromptDialog").dialog('open');

}

function confirmationPrompt(funct){
	 $("#confirmationPromptDialog").dialog({ 
		 autoOpen:false,
		 width:400,
		 minWidth: 400,
		 modal:true,
		 buttons: { 
			 "Yes": function() {
				  funct();
				  $(this).dialog('close');
				  
				   } ,
			 "No": function() {
				
				 	$(this).dialog('close');
				 	
					 }
	   			}  
	   		 
		   			
	   		});
$("#confirmationPromptDialog").dialog('open');
}