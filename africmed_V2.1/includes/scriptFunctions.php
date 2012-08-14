<?php
function splitDateTime($dbstarttime, $dbendtime){
	//Break date time to Date only YYYY-MM-DD
	$stdate = substr($dbstarttime, 0, 10);
	$sttime = substr($dbstarttime, 11, 5);

	//Break startdatetime to time only xx:xx
	$endate = substr($dbendtime, 0, 10);
	$endtime = substr($dbendtime, 11, 5);
	return array($stdate, $sttime, $endate, $endtime);
}

function addTime($nhour, $hour, $nmin, $min){
$fhour = $nhour+$hour;
$fmin = $nmin+$min;
if($fmin >=60){
$fhour+=1;
$fmin-=60;
}
return $fhour.":".$fmin;
}

function subTime($nhour, $hour, $nmin, $min){
$fhour = $nhour-$hour;
$fmin = $nmin-$min;
if($fmin<0){
$fhour-=1;
$fmin+=60;
}
if($fhour<0){
$fhour+=1;
$fmin = 60-$fmin;
}
return array (abs($fhour), abs($fmin));
}

if( function_exists( 'date_default_timezone_set' ) )
#
{
#
// Set the default timezone to US/Eastern
#
date_default_timezone_set( 'Africa/Banjul' );
#
}
#
 
#
// Will return the number of days between the two dates passed in
#
function count_days( $a, $b ){
#
// First we need to break these dates into their constituent parts:
$gd_a = getdate( $a );
$gd_b = getdate( $b );
// Now recreate these timestamps, based upon noon on each day
// The specific time doesn't matter but it must be the same each day

$a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
$b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

// Subtract these two numbers and divide by the number of seconds in a
// day. Round the result since crossing over a daylight savings time
// barrier will cause this time to be off by an hour or two.
return round( abs( $a_new - $b_new ) / 86400 );
}

?>