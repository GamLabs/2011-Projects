<?php
require_once 'includes/requireFile.php';

$date=$_POST['DEntryDate'];
getData($date);

function getData($date=""){
	
	$html ="";
	if(!empty($date)){
	$dateS = formatDate($date);
	$html .= "<center style='color:aqua;font-size:19;'> Total Records Enter On $dateS  </center>";
	}else{

	$html .= "<center style='color:aqua;font-size:19;'> All Records Enter So far  </center>";
	}
	$sql = "select firstname,lastname,username from users where category='dataentry'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		$html .="<center><div><table border='light' width='70%'><tr class='ui-widget-header'><td><span><font color='aqua'><i> <b>NAME</b></i> </font></span></td><td><span><font color='aqua'><i>Total Data Entry</font></span></td></tr><br />";
		while($row = mysql_fetch_array($result)){
			$html .="<tr><td class='ui-widget-header'><span><i>". $row['firstname']." ".$row['lastname'] ."</i></span></td><td class='ui-widget-header'><span><i>".
				getRecords($row['username'], $date)."</i></span></td></tr><br />";
		}
		
	}

	echo $html;
}

function getRecords($user,$date=""){
	$qString="select count(*) as total from patientrecord where user='$user' AND timeStamp like '$date%'";
	$sql=mysql_query($qString);
	$row = mysql_fetch_array($sql);
	return $row['total'];
}
?>
