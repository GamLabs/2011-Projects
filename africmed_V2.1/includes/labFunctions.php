<?php
function updateInvestQueue($pn,$category,$status){
	$str="UPDATE investqueue set status='$status' WHERE pnumber='$pn' AND category='$category'";
	$sql=mysql_query($str);
}
function isQueuing($pn,$status){
	$str="SELECT pnumber from queue WHERE pnumber='$pn' AND status='$status'";
	$sql=mysql_query($str);
	
	if (mysql_num_rows($sql) > 0){
		return true;
	}else{
		return false;
	}
}
function numberOfInvest($vn){
	$str="SELECT count(visitNumber) as vnumber from investqueue where visitNumber='$vn'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$numberOfInvest=$row['vnumber'];
	return $numberOfInvest;
}
function numberOfCompletedInvest($vn){
	$str="SELECT count(pnumber) as total from investqueue where visitNumber='$vn' AND status='READY'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$number=$row['total'];
	return $number;
	
}


function displayLabSales($date){
	$str="SELECT date_format(date,'%e %M, %Y') as date, pnumber,testType,amount
		   from labbooking where date='$date'";

	$sql=mysql_query($str) or die(mysql_error());
	
	$counter=false;
	$html = "<center><b><i><font color=blue, size=3> ALL TESTS CONDUCTED ON $date</font></i></b></center><br>";
	$html  .= "<center><table border='1'><tr class='ui-widget-header'>
				<th>Date</th>
				<th>Name</th>
				<th>Test Conducted </th>
				<th>Amount</th>
			</tr>";
	while ($row=mysql_fetch_array($sql)){
		$counter=true;
		$name=getName($row['pnumber']);
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$name."</td>";
		$html .= "<td>".$row['testType']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
	}
	
	$str="select sum(amount) as total from labbooking where date='$date'";

	$sql=mysql_query($str) or die("second ".mysql_error());
	$row=mysql_fetch_array($sql);
	//$month=strtoupper(monthName($month));
	$html.= "<tr class='ui-widget-header'>";
	$html.= "<td><b><i> TOTAL</i></b></td>";
	$html.= "<td></td>";
	$html.= "<td></td>";
	$html.= "<td><span>D $row[total]</span></td>";


	$html.= "</tr>";

	$html.= "</table></div></center>";
	if ($counter){
		echo $html;
	}else{
		echo 0;
	}
	
	
}
function insertResults($pn,$vn,$results,$user){
	
	$results=mysql_real_escape_string($results);
	$sql=mysql_query("INSERT INTO investigation_results(pnumber,visitNumber,results,user) VALUES('$pn','$vn','$results','$user')");
	if($sql){
		return true;
	}else{
		return false;
	}
}
function showTest($vnumber){

	$str="SELECT testType from labbooking where visitNumber='$vnumber' AND bookingCompleted='YES'";

	$sql=mysql_query($str) or die(mysql_error());
	if (mysql_num_rows($sql) <= 0){
		echo 3;
		return;
	}else{
		$name=getNameByVisit($vnumber);
		$html  = "<center><div><table><tr><th><span><i>Test(s) for <i><b><font color=red >$name</font></b></i></span></th></tr><br />";
		$count=1;
		while ($row=mysql_fetch_array($sql)){
			if ($count%3==0){
				$html .= "<tr>";
				$html .= "<td><span>".$row['testType']."</span></td>";
				$html .= "</tr>";
			}else {
				$html .= "<td><span>".$row['testType']."</span></td>";
			}
			$count++;
		}
		$html .= "</table></div></center>";
		echo $html;
	}
}
function bookingCompleted($tableName,$visitNumber){
	mysql_query("UPDATE $tableName set bookingCompleted='YES' where visitNumber='$visitNumber'") or die(mysql_error());
}

function displayAllTest(){
	$sql  = "select type from lab_config";
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		echo '<option value="'.$value["type"].'">'.$value["type"].'</option>';
	}
}
function insertLabBooking($pnumber,$visitNumber,$test,$amount,$date,$code){

	$str="INSERT INTO labbooking(nominal_code,pnumber,testType,visitNumber,amount,date)
		VALUES('$code','$pnumber','$test','$visitNumber','$amount','$date')";
	
	mysql_query($str) or die("Cannot Insert Lab booking ".mysql_error());
	updateFee($pnumber, $visitNumber, $amount);
}

/*function completeLabBooking($pn){
 $sql=mysql_query("UPDATE labbooking set bookingCompleted='YES' where pnumber='$pn'");
 if($sql){
 return true;
 }else
 return false;
 }*/
function insertIntoLabConfig($test,$amount,$user){

	//echo "INSERT INTO lab_config(type,amount,user) values('$test','$amount','$user')";
	$sql=mysql_query("insert into lab_config(type,amount,user) values('$test','$amount','$user')") or die(mysql_error());
	if($sql){
		return true;
	}
	return false;
}
function completeInvestigation($vnumber,$category){
	$sql=mysql_query("update investigations set ready='YES' where visitNumber='$vnumber' AND category='$category'");

	if($sql){
		return true;
	}
	else{
		return false;
	}
	
}

function displayLabBooking($pn){
	$vn = getVisitNumber($pn);
	$sql= "select pnumber, type, category, date from investigations where visitNumber='$vn'  ";
	$result=mysql_query($sql) or die("Cannot display Lab Booking: "+mysql_error());
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle '>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Lab Test Bookings </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>P Number</th><th>Name</th><th>Category</th><th>Date</th></tr>";
	while($row=mysql_fetch_array($result)){

		$html .= "<tr style='color:cyan;'>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".$row['type']."</td>";
		$html .= "<td>".$row['category']."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "</tr>";
	}
	$html .= "</table></center></fieldset>";
	echo $html;


}

function updateInvestigationById($id){
	$sql = "update investigations set ready='YES' where id = $id";
	$result=mysql_query($sql) or die("Treatment Table Error: "+mysql_error());
}

function displayInvestigationTable($pn){
	$vn = getVisitNumber($pn);
	$sql= "select id,pnumber, visitNumber,type,category,date ,forwho  from investigations where pnumber='$pn' AND visitNumber='$vn' and ready='NO' ";
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_affected_rows()>0){
	$html  = "<center><table border='1'><tr class='ui-widget-header'><th>ID</th><th>Test Name</th><th>Category</th><th>For</th><th>Price</th><th>Action</th></tr>";
		while ($row=mysql_fetch_array($result)){
			$price = getTestPrice($row['type'],$row['forwho'],$row['category']);
			$html .= "<tr style='color:cyan;'>";
			$html .= "<td>".$row['id']."</td>";
			$html .= "<td>".$row['type']."</td>";
			$html .= "<td>".$row['category']."</td>";
			$html .= "<td>".$row['forwho']."</td>";
			$html .= "<td>".$price."</td>";
			$html .= "<td><a class='addLabTestFP' href='#'><img src='images/add.png'></img></a></td>";
			$html .= "</tr>";
		}
		$html .= "</table></center>";
		echo $html;
	}else{
		echo "<p style='color:red'>Sorry: No Curent pending Investigations For this Patient</p> ";
	}

}

function getTestPrice($name,$forwho,$cat){
	$dname = trim($name);
	$sql = "select amount from test_types where name='$name' and forwho='$forwho' and category='$cat' limit 1";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['amount'];
	}
}

// FUNCTIONS FROM JARRA

function stockLabExist($typ, $amoun){
	$sql=mysql_query("SELECT type, amount FROM lab_config where type = '$typ' AND amount = '$amoun'");
	if(mysql_num_rows($sql) > 0){
		return true;
	}
	return false;
}

function insertLabStock($type, $amount, $user){
	$str="INSERT INTO lab_config(type,amount,user) VALUES('$type','$amount','$user')";
	$sql=mysql_query($str) or die(mysql_error());
	
	/*if ($sql){
		return true;
	}else{
		return false;
	}*/

}



function displayLabResultEntry($pn){
	$vn = getVisitNumber($pn);
	$sql= "select id,pnumber, type, category, date from investigations where pnumber='$pn' and visitNumber='$vn' and ready='NO'  order by date desc";
	//echo $sql;
	$result=mysql_query($sql) or die("Cannot display Lab Booking: "+mysql_error());
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Pending Lab Results </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>ID</th><th>P Number</th><th>Name</th><th>Category</th><th>Date</th><th>Action</th></tr>";
	while($row=mysql_fetch_array($result)){

		$html .= "<tr>";
		$html .= "<td>".$row['id']."</td>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".$row['type']."</td>";
		$html .= "<td>".$row['category']."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td><a class='addLabTestResultsLk' href='#'><img src='images/add.png'></img></a></td>";
		$html .= "</tr>";
	}
	$html .= "</table></center></fieldset>";
	echo $html;


}

function getTestTypeByName($name){
	$dname = trim($name);
	$sql = "select category from test_types where name='$name'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['category'];
	}
}



?>