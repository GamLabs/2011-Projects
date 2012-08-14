<?php
function insertAppointment($title, $place, $start, $end, $description, $Sdate, $Edate, $Stime, $Etime, $repeat){//time left and user will come later
$insapp = mysql_query("INSERT INTO jqcalendar(Subject, Location, Description, StartTime, EndTime,  Sdate, Edate, Stime, Etime, IsAllDayEvent) VALUES ('$title', '$place', '$description', '$start', '$end' , '$Sdate', '$Edate', '$Stime', '$Etime',  '$repeat')")or die(mysql_error());
if($insapp){
echo "<div id=\"appointment\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Appoitment $title inserted successfully</p>";
	echo "</div>";
?>
<script>
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#appointment" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>

<?php
}
}
?>