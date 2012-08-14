<?php 
require_once 'includes/requireFile.php';
$status=$_POST['status'];
$sql = "select pnumber, date, fullname, status,	date_format(arrivaltime,'%h: %i%p') as arrivaltime from queue where status='$status'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$address=getAddress($row['pnumber']);
		$phone=getContact($row['pnumber']);
		echo "<tr style='white-space:nowrap;'><td><a href='#'>".$row['pnumber']."</a></td><td>".$row['fullname']."</td><td>".$address."</td><td>".$phone."</td><td>".$row['arrivaltime']."</td></tr>";
	}
?>