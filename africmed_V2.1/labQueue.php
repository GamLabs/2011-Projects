<script type="text/javascript">

$(document).ready(function () {

			$.post('labQueueController.php',{'labqueue': 'load'},function(data){
    			$("#queueList").html(data);
    		});
});

</script>

<div id="queue" class="ui-widget">
						  <div class="ui-state-default">
						    <a>Patient Queue- Laboratory<a></div>
						  <div  class="ui-widget-content ui-corner-bottom">
						  <select id="queueList" size="7">
						  
						  </select>
						 </div>
</div>