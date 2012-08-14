<?php 
require_once 'includes/requireFile.php';
$category = $_POST['category'];
$status = $_POST['status'];
$sql = "select pnumber, date, fullname, status from  investQueue where category='$category' AND status='$status'";

	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$address=getAddress($row['pnumber']);
		$phone=getContact($row['pnumber']);
		echo "<tr style='white-space:nowrap;'><td><a href='#'>".$row['pnumber']."</a></td><td>".$row['fullname']."</td><td>".$address."</td><td>".$phone."</td></tr>";
	}
?>