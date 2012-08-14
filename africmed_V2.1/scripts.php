<?php
require_once ("includes/connect.php");
require_once ("includes/scriptFunctions.php");
?>


<?php
//Script to run every 30 sec to update the database

date_default_timezone_set('Africa/Banjul');
$checkAppointment =  mysql_query("Select StartTime, EndTime from jqcalendar");

while ($row = mysql_fetch_array($checkAppointment)){
$startdatetime = strtotime($row['StartTime']);
$now = date("Y-m-d H:i:s");
$nowdatetime = strtotime($now);

//Calculate day difference, function is in the includes folder.
$diff = count_days($nowdatetime, $startdatetime);

//Start time from the db.
$dbstarttime = $row['StartTime'];
$now = date( "Y-m-d H:i:s") ;

//Break date time to Date only YYYY-MM-DD
$stdate = substr($dbstarttime, 0, 10);
$sttime = substr($dbstarttime, 11, 5);

//Break startdatetime to time only xx:xx
$endate = substr($now, 0, 10);
$entime = substr($now, 11, 5);
//print "$entime\n";


//Calculate time hour, and minute difference

list($hour,$minute) = split(':', $sttime);
list($nhour,$nminute) = split(':', $entime);

//$addtime = addTime($nhour, $hour, $nminute, $minute);

if($now <= $dbstarttime){
list($fhour, $fminute) = subTime($nhour, $hour, $nminute, $minute);
print $nhour."-".$hour;
print $fhour;
mysql_query("UPDATE jqcalendar SET overdue = '0' where StartTime = '$dbstarttime'");
$update=mysql_query("UPDATE jqcalendar SET timeleft = '$diff Day(s) $fhour Hour(s) $fminute Minute(s) Remaining' where StartTime = '$dbstarttime'");
if($update){
?>
<script>
alert("Insert Successful");
</script>
<?php
}
}else if ($now >= $dbstarttime){
list($fhour, $fminute) = subTime($nhour, $hour, $nminute, $minute);
mysql_query("UPDATE jqcalendar SET overdue = '1' where StartTime = '$dbstarttime'");
mysql_query("UPDATE jqcalendar SET timeleft = 'Overdue by $diff Days $fhour Hour(s), $fminute Minute(s)' where StartTime = '$dbstarttime'");
}
}
?>