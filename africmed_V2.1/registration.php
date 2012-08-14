<script>
     jQuery(document).ready( function() {
    	 $("#registrationTabs").tabs();
    	 $("#regnewpatient").load("reception.php");
    	 $("#regeditpatient").load("search2.php");
    	 $("#regeditpatientstatus").load("editPStatus.php");
    	
    	 
    	 $("#CloseRegistration").click(function(){	closeTab();});
     });

</script>

<a id="CloseRegistration" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
<div id="registrationTabs">
	<ul>
   	<li><a href="#regnewpatient">New Patient</a></li> 
   	<li><a href="#regeditpatient">Edit|Search Patient</a></li>
   		<li><a href="#regeditpatientstatus">Edit Patient's Status</a></li>
   	
 	 </ul>
 	 
 	 
 	 <div id="regnewpatient"></div>
 	 <div id="regeditpatient"> </div>
 	 <div id="regeditpatientstatus"> </div>
 	 
 	 
</div>