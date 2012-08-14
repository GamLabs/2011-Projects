<?php 
require_once 'includes/connect.php';
require_once 'includes/labFunctions.php';
require_once 'includes/receptionFunctions.php';

if (isset($_POST['testType']) && isset($_POST['labAmount'])){
	
	$post = $_POST;
	$test=$post['testType'];
	$amount=$post['labAmount'];
	$val=insertIntoLabConfig($test,$amount,"alf");
	if($val)
		echo "Success";
}else{

	//count existing records
$r=mysql_query("select count(id) as id from lab_config") or die(mysql_error());;
$row=mysql_fetch_array($r);
$total=$row['id'];

//start displaying records
echo '{"total records": '. $total.',"TotalDisplayRecords": '. $total.',"aaData": [';

$Fetch=dbAll("select id, type, amount, user, date_format(timeStamp,'%e %M %Y') as timeStamp from lab_config order by id limit 0,$total");
$start=0;
$count=0;
$rrr=count($Fetch);
foreach ($Fetch as $record){
	 echo '[';
	echo'"',$record['id'],'", "',$record['type'],'","',$record['amount'],'","',$record['user'],'","',$record['timeStamp'],'';
	$count++;
	if($rrr!=$count){
		echo '"],';
	}else{
	echo '"]';
	}
}
echo ']}';
	
	
	
}
?>
