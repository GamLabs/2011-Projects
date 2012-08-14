<?php 
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';


//count existing records
$r=mysql_query("select count(pnumber) as pn from patientrecord") or die(mysql_error());;
$row=mysql_fetch_array($r);
$total=$row['pn'];

//start displaying records
echo '{"total records": '. $total.',"TotalDisplayRecords": '. $total.',"aaData": [';

$Fetch=dbAll("select pnumber, fname,lname,dob,phone from patientrecord order by fname,lname limit 0,$total");
$start=0;

//echo "{";
	//$response=array("ITotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData"=>$Fetch);
	//echo json_encode($response);

$count=0;
$rrr=count($Fetch);
//echo $rrr;
foreach ($Fetch as $record){
	 echo '[';
	//$response=array("ITotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData"=>$Fetch);
	//echo json_encode($record);
	echo'"',$record['pnumber'],'", "',$record['fname'],'","',$record['lname'],'","',$record['dob'],'","',$record['phone'],'';
	$count++;
	if($rrr!=$count){
		echo '"],';
	}else{
	echo '"]';
	}
}
echo ']}';
?>