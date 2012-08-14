<script type="text/javascript">

$(document).ready(function () {
			$.post('pharQueueController.php',{'pharqueue': 'load'},function(data){
    			$("#queueList").html(data);
    		});
});

</script>
<div><b font-size="17">Lists of Patients Waiting At Pharmacy</b></div><br />
<div id="queue" class="ui-widget">
						  <div class="ui-state-default ">
						  <a>Patient Queue- Pharmacy<a></div>
						  <div  class="ui-widget-content ui-corner-bottom">
						  <select id="queueList" size="7">
						  
						  </select>
						 </div>
</div>