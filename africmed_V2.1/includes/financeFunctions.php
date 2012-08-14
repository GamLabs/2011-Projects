<?php
require_once 'includes/receptionFunctions.php';

function isDrawerOpen($shift,$date){
	$str="SELECT status from cash_drawer where shift='$shift' AND date='$date' AND status='OPEN'";
	$sql=mysql_query($str);
	if (mysql_num_rows($sql) > 0){
		return true;
	}else{
		return false;
	}
}
function drawerOpen($date){
	$str="SELECT shift from cash_drawer where date='$date' AND status='OPEN'";
	$sql=mysql_query($str);
	if (mysql_num_rows($sql) > 0){
		return true;
	}else{
		return false;
	}
}
function addExpense($drawer_id,$expenses,$reason,$user){
	
	$str="INSERT INTO cash_drawer_expenses(drawer_id,expenses,reason,user,timeStamp) 
			VALUES('$drawer_id','$expenses','$reason','$user',CURRENT_TIMESTAMP)";
	$sql=mysql_query($str);	// or die(mysql_error());
	if (mysql_affected_rows()> 0){
		return 0;
	}else{
		return 1;
	}
}

function displayFinanceExpenses($cat,$startDate,$endDate){
	
	// IF THEY WANT TO VIEW ALL
	if ($cat == "ALL"){
		
		$str="SELECT category,details,date_format(date,'%e %M, %Y') as date,amount,payment_method,cheque_number, 
				date_format(timeStamp,'%e %M %Y %H: %i%p') as time,user from expenses 
				where date BETWEEN '$startDate' AND '$endDate' order by date ";

		$sum="select sum(amount) as amount from expenses where date BETWEEN '$startDate' AND '$endDate'";
		
	}else{ // IF THEY WANT TO VIEW BY CATEOGRY
		$str="SELECT category,details,date_format(date,'%e %M, %Y') as date,amount,payment_method,cheque_number, 
				date_format(timeStamp,'%e %M %Y %H: %i%p') as time,user from expenses 
				where category ='$cat' AND date BETWEEN '$startDate' AND '$endDate' order by category ";
		
		$sum="select sum(amount) as amount from expenses where category ='$cat' AND date BETWEEN '$startDate' AND '$endDate'";
	}
  $sql=mysql_query($str) or die(mysql_error());
  
  $counter=false;
  
  $html = "<table border=1><tr class='ui-widget-header'>";
  $html .= "<th>Date</th>";
  $html .= "<th>Description</th>";
  $html .= "<th>Details</th>";
  $html .= "<th>Amount</th>";
  $html .= "<th>Date of Input</th>";
  $html .= "<th>Added By</th></tr>";
	
  while($row = mysql_fetch_array($sql)){
		$counter=true;
       $html .= "<tr>";
       $html .= "<td>$row[date]</td>";
       $html .= "<td>$row[category]</td>";
       $html .= "<td>$row[details]</td>";
       $html .= "<td>D $row[amount]</td>";
	   $html .= "<td>$row[time]</td>";
	   $html .= "<td>$row[user]</td>";

       $html .= "</tr>";
   }
    	$query = mysql_query($sum) or die(mysql_error());
   		$row = mysql_fetch_array($query);
		$html .= "<tr class='ui-widget-header'>";
       $html .= "<td><b><font color=red>TOTAL</font></b></td>";
       $html .= "<td></td>";
       $html .= "<td></td>";
       $html .= "<td>D $row[amount]</td>";
	   $html .= "<td></td>";
	   $html .= "<td></td>";

       $html .= "</tr>";
		$html .= "</table>";
		if ($counter){
			echo $html;
		}else{
			echo 1;
		}
}
function ExpenseAtFinance($cat,$details,$amount,$date,$chequeNo,$user){
	$str="INSERT INTO expenses(category,details,date,amount,cheque_number,user,timeStamp)
		   VALUES('$cat','$details','$date','$amount','$chequeNo','$user',CURRENT_TIMESTAMP)";
	mysql_query($str) or die(mysql_error());
	
	return true;
	
}
function ExpenseAtReception($reason,$expense){
	$str="SELECT cash_sales,expense,balance from cash_drawer where status='OPEN'";
	//return $str;
	$SQL=mysql_query($str); // GET PREVIOUS DATA B4 INSERTING
	$row=mysql_fetch_array($SQL);
	
	$total=$row['cash_sales'];
	
	$OldExp=$row['expense'];
	
	$oldBalance=$row['balance'];
	
	$newBalance=$total-$oldBalance;
	$newExp=($OldExp+$expense);
	$str1="UPDATE cash_drawer set expense=$newExp,balance=$newBalance WHERE status='OPEN'";
	
	$SQL1=mysql_query($str1) or die(mysql_error());
	
	// // //return $SQL1;
	if ($SQL1){
		return true;
	}else{
		return false;
	}
	
}

function diplayCashSalesByDate($date){
	$str="SELECT date_format(date,'%e %M %Y') as date,shift,cash_sales,expense,balance from cash_drawer where date='$date' AND status='CLOSED'";
	$sql=mysql_query($str) or die(mysql_error());
	
	$html = "<center><table border='light' cellpading='10'> ";
	$html .= "<tr class='ui-widget-header'><th>DATE</th><th>DETAILS</th><th>T/C. SALE</th><th>EXPENSE</th><th>BALANCE</th><th>BANK</th></tr>";
	$counter=false;
	while ($row=mysql_fetch_array($sql)){
		$counter=true;
		$html.= "<tr >";
		$html.= "<td><span>".$row['date']."</span></td>";
		$html.= "<td><span>".$row['shift']."</span></td>";
		$html.= "<td><span>".$row['cash_sales']."</span></td>";
		$html.= "<td><span>D ".$row['expense']."</span></td>";
		$html.= "<td><span>D ".$row['balance']."</span></td>";
		$html.= "<td><span>D ".$row['balance']."</span></td>";
		$html.= "</tr>";
	}

	$html.= "</table></div></center>";
	if ($counter){
		echo $html;
	}else{
		echo 0;
	}
}


// DISPLAY CLOSE CASH SALES. THIS WILL MOSTLY BE USED AT THE FINANCE SIDE
function diplayCashSales($shift,$date){
	$str="SELECT cash_sales,balance,date_format(open_timeStamp,'%h: %i%p') as openTime,
		date_format(close_timeStamp,'%h: %i%p') as closeTime,
		name,expense from cash_drawer where shift='$shift' AND date='$date' AND status='CLOSED'";
	
	//GET THE STATUS AND SEE IF IT IS CLOSED
	$sql=mysql_query($str);
	if (mysql_num_rows($sql) <=0 ){
		$html=0; // NO DATA TO DISPLAY
	}else{
			$row=mysql_fetch_array($sql);
			$amount=$row['cash_sales'];
			$balance=$row['balance'];
			$openTime=$row['openTime'];
			$closeTime=$row['closeTime'];
			$name=$row['name'];
			$expense=$row['expense'];
			
			$html ="<center><div><table border='light' width='70%'>
						<tr class='ui-widget-header'>
						<td class='ui-widget-header'><span><i>COLLECTED FROM</i></span></td>
							<td class='ui-widget-header'><span><i>$name</i></span></td>
							</tr><br />";
		
			$html .="<tr>
							<td class='ui-widget-header'><span><i>SHIFT</i></span></td>
							<td class='ui-widget-header'><span><i>$shift</i></span></td>
							</tr><br />";
			$html .="<tr>
							<td class='ui-widget-header'><span><i>START TIME</i></span></td>
							<td class='ui-widget-header'><span><i>$openTime</i></span></td>
						</tr><br />";
			$html .="<tr>
							<td class='ui-widget-header'><span><i>ClOSE TIME</i></span></td>
							<td class='ui-widget-header'><span><i>$closeTime</i></span></td>
						</tr><br />";
					
			$html .="<tr>
							<td class='ui-widget-header'><span><i>CASH SALES</i></span></td>
							<td class='ui-widget-header'><span><i>D$amount</i></span></td>
						</tr><br />";
			$html .="<tr>
						<td class='ui-widget-header'><span><i>EXPENSES</i></span></td>
						<td class='ui-widget-header'><span><i>D$expense</i></span></td>
						</tr><br />";
			$html .="<tr>
							<td class='ui-widget-header'><span><i>BALANCE</i></span></td>
							<td class='ui-widget-header'><span><i>D$balance</i></span></td>
						</tr><br />";
			
			$html .="</div>";
	}
	echo $html;
	
}
function getDrawerNumber(){
	$str='SELECT id from cash_drawer where status="OPEN"'; //get open drawer ID
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);

	$id=$row['id'];

	return $id;
}

// THIS FUNCTION RETURNS THE TOTAL AMOUNT MADE IN A GIVEN DRAWER
function getCashSaleTotal($drawerNumber){
	$str="select sum(paidAmount) as total from patient_bills where drawerNumber=$drawerNumber ";
	$totals= getTotals($str);
	
	return $totals;
}
function getTotalExpenses($drawerNumber){
	// GET THE TOTAL EXPENSES
	$str="select sum(expenses) as totalExpenses from cash_drawer_expenses where drawer_id=$drawerNumber";
	
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$totalExpenses=$row['totalExpenses'];
	
	return $totalExpenses;
	
}
// THIS FUNCTION DISPLAYS THE CASH DRAWER WHERE THE DRAWER IS STILL OPEN(ACTIVE)
function displayCashDrawer($drawerNumber){
	$totals=getCashSaleTotal($drawerNumber); // TOTAL FROM paid_private_bills table
	
	$str="SELECT name,shift FROM cash_drawer WHERE id=$drawerNumber";
	$sql=mysql_query($str) or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$name=$row['name'];
	$shift=$row['shift'];
	$totalExpenses=getTotalExpenses($drawerNumber);
	$balance=($totals-$totalExpenses);
	
	
	$html ="<center><div><table border='light' width='70%'>
				<tr class='ui-widget-header'>
				<td><span><font color='aqua'><i>Cash Sales Transactions By <b>$name</b></i> </font></span>
				</td><td><span><font color='aqua'><i>Details</font></span></td>
				</tr><br />";
	$html .="<tr>
					<td class='ui-widget-header'><span><i>Shift</i></span></td>
					<td class='ui-widget-header'><span><i>$shift</i></span></td>
					</tr><br />";
	$html .="<tr>
					<td class='ui-widget-header'><span><i>Cash Sales</i></span></td>
					<td class='ui-widget-header'><span><i>D$totals</i></span></td>
				</tr><br />";
	$html .="<tr>
				<td class='ui-widget-header'><span><i>Expenses</i></span></td>
				<td class='ui-widget-header'><span><i>D$totalExpenses</i></span></td>
				</tr><br />";
	$html .="<tr style='color:cyan;'>
				<td class='ui-widget-header'><span><i>Balance</i></span></td>
				<td class='ui-widget-header'><span><i>D$balance</i></span></td>
				</tr><br />";		
	$html .="</div>";

	echo $html;
}
function insertOpenCashDrawer($shift,$name,$date,$status){
	$str="INSERT INTO cash_drawer(shift,name,date,status,open_timeStamp) VALUES('$shift','$name','$date','$status',CURRENT_TIMESTAMP)";
	$sql=mysql_query($str) or die(mysql_error());
	if ($sql){
		return true;
	}
	return false;
}
function insertCloseCashDrawer($sales,$expense,$status){
	$bal=($sales - $expense);
	$str="UPDATE cash_drawer set status='$status', expense='$expense', balance='$bal',
			close_timeStamp=CURRENT_TIMESTAMP, cash_sales='$sales' where status='OPEN'";

	$sql=mysql_query($str) or die(mysql_error());
	if ($sql){
		return true;
	}
	return false;
}
function getDrawerStatus(){
	$status="";
	$str="SELECT status from cash_drawer order by open_timeStamp desc limit 1";
	$sql=mysql_query($str);
	
	// IF NOTHING IN THE TABLE. THIS IS ONLY TRUE IF TABLE IS EMPTY
	if (mysql_num_rows($sql) <= 0){
		$status="CLOSED";
	}else{
		$row=mysql_fetch_array($sql);
		$status=$row['status'];
		if(empty($status)){ // IF NO DATA FOR THIS DATE, SET STATUS TO OPEN
			$status="OPEN";
		}
	}
	
	return $status;
}
function insertCompanyBills($pn,$vnumber,$totalAmount,$date,$user){
	$str="INSERT INTO company_bills(pnumber,visitNumber,amount,date,user) VALUES('$pn','$vnumber','$totalAmount','$date','$user')";
	mysql_query($str) or die(mysql_error());
}
function insertInsuranceBills($pn,$vnumber,$totalAmount,$date,$user){
	$str="INSERT INTO insurance_bills(pnumber,visitNumber,amount,date,user) VALUES('$pn','$vnumber','$totalAmount','$date','$user')";
	mysql_query($str) or die(mysql_error());
}
function getContact($pn){	// get patient's contact
	$sql=mysql_query("select phone from patientrecord where pnumber='$pn'") or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$phone=$row['phone'];
	return $phone;
}
function displayDebtors(){
	$str="SELECT date_format(date, '%e %M %Y') as date,balance,action,pnumber from debtors";
	$sql=mysql_query($str);
	
	$counter=false;
	
	$html = "<table border='light' cellpading='10'> ";
	$html .= "<tr class='ui-widget-header'><th>DATE</th><th>DETAILS</th><th>AMOUNT</th><th>CONTACT</th><th width='50%'>ACTION</th></tr>";
	while ($row=mysql_fetch_array($sql)){
		
		$counter=true;
		$pn=$row['pnumber'];
		$phone=getContact($pn);
		$name=getName($pn);
		$html .= "<tr>";
		$html .="<td>".$row['date']."</td><td>".$name."</td><td>D".$row['balance']."</td><td>".$phone."</td><td>".$row['action']."</td>";
		$html .= "</tr>";
	}
	$html .="<table>";
	if ($counter){
		echo $html;
	}else{
		echo 1;
	}


}
function getInsuranceName($pn){
	$str="SELECT statusName from patientrecord where pnumber='$pn'";
	$sql=mysql_query($str) or die(mysql_error());
	$row=mysql_fetch_array($sql);
	$name=$row['statusName'];
	return $name;
}
function monthName($id){
	$store=array('1'=> 'JANUARY','2'=> 'FEBUARY','3'=> 'MARCH','4'=> 'APRIL','5'=> 'MAY','6'=> 'JUNE','7'=> 'JULY','8'=> 'AUGUST','9'=> 'SEPTEMBER','10'=> 'OCTOBER','11'=> 'NOVEMBER','12'=> 'DECEMBER',);

	$monthName=$store[$id];
	return $monthName;
}
function displayInsuranceSummary($name,$month,$year){

	$str="SELECT patientrecord.pnumber,patientrecord.statusId,
			insurance_bills.pnumber,insurance_bills.date,insurance_bills.amount from patientrecord,insurance_bills 
			where patientrecord.pnumber=insurance_bills.pnumber AND patientrecord.statusName='$name' 
			AND month(insurance_bills.date)='$month' AND year(insurance_bills.date)='$year'";

	$sql=mysql_query($str) or die("sasas".mysql_error());
	$counter=false;
	$html = "<center><div><table border='1' width='100%'>
				<tr class='ui-widget-header'>
					<th><span>Date of Visit</span></th>
					<th><span>Name</span></th>
					<th><span>Policy Number</span></th>
					<th><span>Amount</span></th>
				</tr>";
	while ($row=mysql_fetch_array($sql)){
		$counter=true;
		$pn=$row['pnumber'];
		$pname=getName($pn);
		$html.= "<tr>";
		$html.= "<td><span>".$row['date']."</span></td>";
		$html.= "<td><span>".$pname."</span></td>";
		$html.= "<td><span>".$row['statusId']."</span></td>";
		$html.= "<td><span>D ".$row['amount']."</span></td>";
		$html.= "</tr>";
	}
	$str="select patientrecord.pnumber, sum(insurance_bills.amount) as amount from patientrecord, insurance_bills
			where patientrecord.pnumber=insurance_bills.pnumber 
			AND patientrecord.statusName='$name'
			AND month(insurance_bills.date)='$month' 
			AND year(insurance_bills.date)='$year'";

	$sql=mysql_query($str) or die("second ".mysql_error());
	$row=mysql_fetch_array($sql);
	$month=strtoupper(monthName($month));
	$html.= "<tr>";
	$html.= "<td></td>";
	$html.= "<td></td></tr>";
	$html.= "<tr><td></td><td></td>
			<td><b><i>$month TOTALS</i></b></td>";
	$html.= "<td class='ui-widget-header'><span>D $row[amount]</span></td>";

	$html.= "</tr>";



	$html.= "</table></div></center>";
	if ($counter){
		echo $html;	
	}else{
		echo 0;
	}
	

}

function hasInsurancePaid($name,$month,$year){
	$month=monthName($month);
	$paid_date=$month." ".$year;
	$str="SELECT * from paid_insurance_bills where date_paid_for='$paid_date' AND name='$name'";

	$sql=mysql_query($str) or die(mysql_error());
	if(mysql_num_rows($sql) > 0){
		return true;
	}else
	return false;
}
function hasCompanyPaid($name,$month,$year){
	$month=monthName($month);
	$paid_date=$month." ".$year;
	$str="SELECT * from paid_company_bills where date_paid_for='$paid_date' AND name='$name'";

	$sql=mysql_query($str) or die(mysql_error());
	if(mysql_num_rows($sql) > 0){
		return true;
	}else
	return false;
}
function payInsuranceBill($name,$total,$month,$year,$paidDate,$paidAmount,$balance,$pay_method,$check_no,$receivedBy,$receivedFrm){

	$month=monthName($month);
	$date_paid_for=$month." ".$year;
	$str="INSERT INTO paid_insurance_bills (name,total,paidAmount,date_paid_for,paidDate,payment_method,cheque_number,
		received_from,received_by,balance)
		VALUES('$name',$total,'$paidAmount','$date_paid_for','$paidDate','$pay_method','$check_no','$receivedFrm','$receivedBy','$balance')";

	//echo $str;
	$sql=mysql_query($str) or die(mysql_query());

	if($sql){
		return true;
	}else{
		return false;
	}
}
function payCompanyBill($name,$month,$year,$total,$paidDate,$paidAmount,$balance,$pay_method,$check_no,$receivedBy,$receivedFrm){

	$month=monthName($month);
	$date_paid_for=$month." ".$year;
	$str="INSERT INTO paid_company_bills (name,total,paidAmount,date_paid_for,paidDate,payment_method,cheque_number,
		received_from,received_by,balance)
			VALUES('$name','$total','$paidAmount','$date_paid_for','$paidDate','$pay_method','$check_no','$receivedFrm','$receivedBy','$balance')";

	//echo $str;
	$sql=mysql_query($str) or die(mysql_query());

	if($sql){
		return true;
	}else{
		return false;
	}
}

function getCompanyBillTotal($name,$month,$year){
	$str="SELECT sum(company_bills.amount) as total from patientrecord,company_bills
			where patientrecord.pnumber=company_bills.pnumber AND patientrecord.statusName='$name' 
			AND month(company_bills.date)='$month' AND year(company_bills.date)='$year'";

	$sql=mysql_query($str) or die(mysql_error());

	$row=mysql_fetch_array($sql);
	$total=$row['total'];

	return $total;
}

function getInsuranceBillTotal($name,$month,$year){
	$str="SELECT sum(insurance_bills.amount) as total from patientrecord,insurance_bills
			where patientrecord.pnumber=insurance_bills.pnumber AND patientrecord.statusName='$name' 
			AND month(insurance_bills.date)='$month' AND year(insurance_bills.date)='$year'";

	$sql=mysql_query($str) or die(mysql_error());

	$row=mysql_fetch_array($sql);
	$total=$row['total'];

	return $total;
}

function displayCompanySummary($name,$month,$year){
	$str="SELECT patientrecord.pnumber,patientrecord.statusId,
			company_bills.pnumber,company_bills.date,company_bills.amount from patientrecord,company_bills 
			where patientrecord.pnumber=company_bills.pnumber AND patientrecord.statusName='$name' 
			AND month(company_bills.date)='$month' AND year(company_bills.date)='$year'";

	$sql=mysql_query($str) or die("sasas".mysql_error());
	$counter=false;
	$html = "<center><div><table border='1' width='100%'>
				<tr class='ui-widget-header'>
					<th><span>Date of Visit</span></th>
					<th><span>Name</span></th>
					<th><span>Policy Number</span></th>
					<th><span>Amount</span></th>
				</tr>";
	while ($row=mysql_fetch_array($sql)){
		$counter=true;
		$pn=$row['pnumber'];
		$pname=getName($pn);
		$html.= "<tr>";
		$html.= "<td><span>".$row['date']."</span></td>";
		$html.= "<td><span>".$pname."</span></td>";
		$html.= "<td><span>".$row['statusId']."</span></td>";
		$html.= "<td><span>D ".$row['amount']."</span></td>";
		$html.= "</tr>";
	}
	$str="select patientrecord.pnumber, sum(company_bills.amount) as amount from patientrecord, company_bills
			where patientrecord.pnumber=company_bills.pnumber 
			AND patientrecord.statusName='$name'
			AND month(company_bills.date)='$month' 
			AND year(company_bills.date)='$year'";

	$sql=mysql_query($str) or die("second ".mysql_error());
	$row=mysql_fetch_array($sql);
	$month=strtoupper(monthName($month));
	$html.= "<tr>";
	$html.= "<td></td>";
	$html.= "<td></td>";
	$html.= "<td><b><i>$month TOTALS</i></b></td>";
	$html.= "<td  class='ui-widget-header'><span>D $row[amount]</span></td>";

	$html.= "</tr>";



	$html.= "</table></div></center>";
	if ($counter){
		echo $html;
	}else{
		echo 0;
	}

}

function getMonths(){
	$html=  "<option value=\"\">Select One</option>";
	$html .= "<option value=\"1\">January</option>";
	$html .= "<option value=\"2\">February</option>";
	$html .=	"<option value=\"3\">March</option>";
	$html .=	"<option value=\"4\">April</option>";
	$html .=	"<option value=\"5\">May</option>";
	$html .=	"<option value=\"6\">June</option>";
	$html .=	"<option value=\"7\">July</option>";
	$html .=	"<option value=\"8\">August</option>";
	$html .=	"<option value=\"9\">September</option>";
	$html .=	"<option value=\"10\">October</option>";
	$html .=	"<option value=\"11\">November</option>";
	$html .=	"<option value=\"12\">December</option>";
	echo $html;
}




function getYearsFromExpense(){
	$sql = "select distinct year(date) as year from expenses";
	$result = mysql_query($sql);
	$html = "<option>Select Year</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['year']."'>".$row['year']  ."</option>";
		}
		echo $html;
		
	}
	
}

function getMonthsFromExpense(){
	$sql = "select distinct month(date) as month from expenses";
	$result = mysql_query($sql);
	$html = "<option>Select Month</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['month']."'>".getMonthName($row['month']) ."</option>";
		}
		echo $html;
	}
	
}

function getNominalCodes($type){
	$sql = "select  code_num,code_desc from codes where type='$type' order by code_num ";
	$result = mysql_query($sql);
	$html = "<option value=''>Select Code</option>";
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['code_num']."'>[ ".$row['code_num']." ] - ". $row['code_desc'] ."</option>";
		}
		echo $html;
		
	}
	
}


function getYearsFromPettyCash(){
	$sql = "select distinct year(date) as year from petty_cash";
	$result = mysql_query($sql);
	$html = "<option>Select Year</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['year']."'>".$row['year']  ."</option>";
		}
		echo $html;
		
	}
	
}

function getMonthsFromPettyCash(){
	$sql = "select distinct month(date) as month from petty_cash";
	$result = mysql_query($sql);
	$html = "<option>Select Month</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['month']."'>".getMonthName($row['month']) ."</option>";
		}
		echo $html;
	}
	
}
function getMonthName($digit){
	return  date("F",mktime(0,0,0,$digit,1,1997));
}

function getExpenseByMonth($month,$year){
	$total = 0;
	$sql = "select * from  expenses where month(date) = $month and year(date) = $year";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='color: aqua;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".getMonthName($month)." Expenses</legend>";
		$html .= "<center><table style='color: aqua;'>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td style='font-size: 17;'>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Expenses For ".getMonthName($month)." of ".$year."<h2>";
		}

}

function getExpensesByYear($year){
	$total = 0;
	$sql = "select * from  expenses where year(date) = $year";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".$year." Expenses </legend>";
		$html .= "<center><table style='color: aqua;'>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td style='font-size: 19;'>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Expenses For ".$month."<h2>";
		}
}

function getExpensesByDate($date){
	$total =0;
	$sql = "select * from  expenses where date = '$date'";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='color: aqua;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".formatDate($date)." Expenses </legend>";
		$html .= "<center><table style='color: aqua;'>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td style='font-size: 19;'>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Expenses For ".formatDate($date)."<h2>";
		}
	
}

function getDayBooks($date){
	$total =0;
	$owing =0;
	$paid = 0;
$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,paid_date,
	pay_method from patient_bills where  date = '$date' order by date desc";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Day Books For ".formatDate($date)." </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Patient Number</th><th>Name</th><th>Date</th><th>Amount</th><th>Paid</th><th>Balance</th><th>Status</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$bal = ($row['totalAmount'] == $row['paidAmount'])?0:($row['totalAmount']-$row['paidAmount']);
		
		$action ="";
		if($bal == 0){
			$action ="PAID";
		}else{
			if(!isPrivate($row['pnumber'])){
				$action = "NON PRIVATE";
			}else{
				$action = "OWING";
			}
				
		}
		$html .= "<tr>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>D".$row['totalAmount']."</td>";
		$html .= "<td>D".$row['paidAmount']."</td>";
		if(!isPrivate($row['pnumber'])){ $html .= "<td>D<strike>".$bal."</strike></td>";}else{$html .= "<td>D".$bal."</td>";}
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
		$total += $row['totalAmount'];
		$owing += $bal;
		$paid  += $row['paidAmount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td><td>D$paid</td><td>D$owing</td><td></td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Transactions On ".formatDate($date)."<h2>";
		}
}
function getDebtors(){
	$total =0;
	$owing =0;
	$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,paid_date,
	pay_method from patient_bills  order by date desc";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Debtors </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Patient Number</th><th>Name</th><th>Date</th><th>Amount</th><th>Balance</th><th>Status</th></tr>";
	while($row=mysql_fetch_array($result)){
		if(!isPrivate($row['pnumber'])){
			continue;
		}
		$bal = ($row['totalAmount'] == $row['paidAmount'])?0:($row['totalAmount']-$row['paidAmount']);
		$action ="";
		if($bal == 0){
			continue;
		}else{
			
			$action = "OWING";
		}
		$html .= "<tr>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>D".$row['totalAmount']."</td>";
		$html .= "<td>D".$bal."</td>";
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
		$total += $row['totalAmount'];
		$owing += $bal;
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td><td>D$owing</td><td></td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Transactions <h2>";
		}
}

function getPettyCashByMonth($month,$year){
	$total = 0;
	$sql = "select * from  petty_cash where month(date) = $month and year(date) = $year";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".getMonthName($month)." Petty Cash</legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Petty Cash For ".getMonthName($month)." of ".$year."<h2>";
		}
}

function getPettyCashByYear($year){
	$total = 0;
	$sql = "select * from  petty_cash where year(date) = $year";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".$year." Petty Cash </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Petty Cash For ".$month."<h2>";
		}
}

function getPettyCashByDate($date){
	$total =0;
	$sql = "select * from  petty_cash where date = '$date'";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >".formatDate($date)." Petty Cash </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Date</th><th>Name</th><th>Description</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['comment']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Petty Cash For ".formatDate($date)."<h2>";
		}
	
}

function getShiftsByDate($date){
	
	$sql = "select id,shift,open_timeStamp,close_timeStamp  from cash_drawer where date = '$date'";
	//echo $sql;
	$result = mysql_query($sql);
	$html = "<option>Select Shift</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['id']."'>".$row['shift'] ." (".$row['open_timeStamp']." - ".$row['close_timeStamp']." )</option>";
		}
		echo $html;
	}else{
		echo 1;
	}
		
}

function getShiftStartTime($shift){
	$sql = "select open_timeStamp  from cash_drawer where id = $shift limit 1";	
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0){
		$row = mysql_fetch_array($result);		
		return  $row['open_timeStamp'];
	}
}

function getShiftCloseTime($shift){
	$sql = "select close_timeStamp  from cash_drawer where id = $shift limit 1";	
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0){
		$row = mysql_fetch_array($result);	
		if($row['close_timeStamp'] == "0000-00-00 00:00:00"){
			return "9999-12-31 00:00:00";
		}else{
			return  $row['close_timeStamp'];
		}
		
		
	}
}

function getReceptionistByDrw($dr){
$sql = "select name  from cash_drawer where id = $dr limit 1";	
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0){
		$row = mysql_fetch_array($result);		
			return  $row['name'];	
	}
}
function getShiftSales($drNo,$date){
	$total = 0;
	$owing = 0;
	$paid  = 0;
	$start = getShiftStartTime($drNo);
	$close = getShiftCloseTime($drNo);
	$sql = "select drawerNumber,pnumber,date,totalAmount,paidAmount,paid_date,
	pay_method from patient_bills where  drawerNumber = $drNo and  timeStamp between '$start' and '$close' order by date desc";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Shift Sales </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Receptionist</th><th>Patient Name</th><th>Date</th><th>Amount</th><th>Paid</th><th>Balance</th><th>Action</th></tr>";
	while($row=mysql_fetch_array($result)){
		$bal = ($row['totalAmount'] == $row['paidAmount'])?0:($row['totalAmount']-$row['paidAmount']);
		$action ="";
		if($bal == 0){
			
			$action ="PAID";
		}else{
			if(isPrivate($row['pnumber'])){
				$action = "OWING";
			}else{
				$action = "NON PRIVATE";
			}
		}
		$html .= "<tr>";
		$html .= "<td>".getReceptionistByDrw($row['drawerNumber'])."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['totalAmount']."</td>";
		$html .= "<td>".$row['paidAmount']."</td>";
		if(!isPrivate($row['pnumber'])){ $html .= "<td>D<strike>".$bal."</strike></td>";}else{$html .= "<td>D".$bal."</td>";}
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
		$total += $row['totalAmount'];
		$owing += $bal;
		$paid  += $row['paidAmount'];
	}
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$total</td><td>D$paid</td><td>D$owing</td><td></td></tr>";
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Transactions For This Shift<h2>";
		}
}

function getCompanys(){
$sql = "select name  from company_config";
	$result = mysql_query($sql);
	$html = "<option>Select Company</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['name']."'>".$row['name']  ."</option>";
		}
		echo $html;	
	}
}

function getCompanysInJSON(){
$sql = "select name  from company_config";
	$result = mysql_query($sql);
	$html = 'value:"';
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			//$html .= "<option value='".$row['name']."'>".$row['name']  ."</option>";
			$name = $row['name'];
			$html .= $name.":".$name.";";
			 
		}
		$html .='"';
		echo $html;
	}
}

function getInsurances(){
$sql = "select  id,name from insurance_config";
	$result = mysql_query($sql);
	$html = "<option>Select Insurance</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['name']."'>".$row['name']  ."</option>";
		}
		echo $html;
		
	}
}

function getBillingYears(){

	$sql = "select distinct year(date) as year from patient_bills";
	$result = mysql_query($sql);
	$html = "<option>Select Year</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['year']."'>".$row['year'] ."</option>";
		}
		echo $html;
	}
}

function getInsuranceBillsPayments($id){
	
	$sql = "select * from insurance_payments where  bill_id = '$id' order by receipt_no asc";
	
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		
		$html = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Payments </legend>";
		$html .= "<center><table class=' ui-widget ui-widget-content ui-corner-all'>";
		$html .= "<tr style='font-size:14' class='ui-widget-header'><th>Date</th><th>Receipt Number</th><th>Payment Method</th><th>Cheque No.</th><th>Amount</th></tr>";
		$total = 0;
		while($row=mysql_fetch_array($result)){
		
		$html .= "<tr style='font-size:13;color:cyan;'>";
		$html .= "<td>".formatDate($row['paid_date'])."</td>";
		$html .= "<td>".$row['receipt_no']."</td>";
		$html .= "<td>".$row['pay_method']."</td>";
		$html .= "<td>".$row['cheque_no']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header ui-corner-bottom' style='font-size:14'><td>Total</td><td></td><td></td><td></td><td>$total</td></tr>";
	
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>No Payment for this  Month Yet<h2>";
		}
	//getTotalFee($pn);patient_bills
}

function getCompanyBillsPayments($id){
	
	$sql = "select * from company_payments where  bill_id = '$id' order by receipt_no asc";
	
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		
		$html = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Payments </legend>";
		$html .= "<center><table class=' ui-widget ui-widget-content ui-corner-all'>";
		$html .= "<tr style='font-size:14' class='ui-widget-header'><th>Date</th><th>Receipt Number</th><th>Payment Method</th><th>Cheque No.</th><th>Amount</th></tr>";
		$total = 0;
		while($row=mysql_fetch_array($result)){
		
		$html .= "<tr style='font-size:14'>";
		$html .= "<td>".formatDate($row['paid_date'])."</td>";
		$html .= "<td>".$row['receipt_no']."</td>";
		$html .= "<td>".$row['pay_method']."</td>";
		$html .= "<td>".$row['cheque_no']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "</tr>";
		$total += $row['amount'];
	}
	$html .= "<tr class='ui-widget-header ui-corner-bottom' style='font-size:14'><td>Total</td><td></td><td></td><td></td><td>$total</td></tr>";
	
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>No Payment for this  Month Yet<h2>";
		}
	//getTotalFee($pn);patient_bills
}
function getGeneralYears(){
	$sql = "select distinct year(date) as year from phyexam order by year";
	$result = mysql_query($sql);
	$html = "<option>Select Year</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['year']."'>".$row['year'] ."</option>";
		}
		echo $html;
	}
}
function getGeneralMonths(){
$sql = "select distinct month(date) as month from phyexam order by month";
	$result = mysql_query($sql);
	$html = "<option>Select Month</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['month']."'>".getMonthName($row['month']) ."</option>";
		}
		echo $html;
	}
}
function getBillingMonths(){

	$sql = "select distinct month(date) as month from patient_bills";
	$result = mysql_query($sql);
	$html = "<option>Select Month</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['month']."'>".getMonthName($row['month']) ."</option>";
		}
		echo $html;
	}
}

function isBillGenerated($name,$table,$month,$year){
	$sql = "select name from $table where name = '$name' and  month(date) = $month and year(date) = $year and  generated = 'YES'";
	//echo $sql;
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ){
		return true;
	}else{
		return false;
	}
}
function  updateBillGeneration($name,$table,$month,$year){
	$sql = "update $table set generated = 'YES' where name = '$name' and  month(date) = $month and year(date) = $year and  generated = 'NO'";
	$result = mysql_query($sql);
}
function updateNonPrivateBills($name,$month,$year){
	$sql = "update patient_bills set paidAmount = totalAmount where pnumber in 
	(select pnumber from  patientrecord where statusName = '$name' ) and  month(date) = $month and year(date) = $year";
	$result = mysql_query($sql);
}
function generateCompanyBill($name,$month,$year){
	$dt = $year."-".$month."-01";
	$lastDay =  $year."-".$month."-".date('t',strtotime($dt));
	$strLastDate = strtotime($lastDay);
	$strToday = strtotime(date('Y-m-d'));
	if($strToday > $strLastDate){
		if(isBillGenerated($name,"company_bills", $month, $year)){
			echo "<h2 style='color:red'>Bill already Generated For  ".getMonthName($month)."<h2>";
			exit(0);
		}
	$total =0;
	$owing =0;
	$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,paid_date,
	pay_method from patient_bills where  year(date) = $year and month(date) = $month order by date desc";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' > ".$name." Bills  For ".getMonthName($month)." ".$year."</legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Patient Number</th><th>Name</th><th>Date</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		
		if(!belongsToCompany($row['pnumber'], $name)){
			continue;
		}else{
		$bal = ($row['totalAmount'] == $row['paidAmount'])?0:($row['totalAmount']-$row['paidAmount']);
		$action ="";
		if($bal == 0){
			$action ="PAID";
		}else{
			$action = "OWING";
		}
		$html .= "<tr>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>D".$bal."</td>";
		
		
		$html .= "</tr>";
		$total += $row['totalAmount'];
		$owing += $bal;
		}
		
	}
	//updateBillGeneration($name,"company_bills", $month, $year);
	updateNonPrivateBills($name,$month,$year);
	postBill($name, $month, $year, $owing);
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$owing</td></tr>";
	$html .= "</table></center></fieldset>";
	//if(!billExist($name, $month, $year)){
		
	//	postBill($name, $month, $year, $owing);
	//}else{
	//	updateBill($name, $month, $year,$owing);
	//}
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Bills For ".$name."<h2>";
		}
	}else{
		echo "<h2 style='color:red'>Sorry You cannot Generate bill Before (".formatDate($lastDay).") for ".getMonthName($month)."<h2>";
	}
}


function generateInsuranceBill($name,$month,$year){
$dt = $year."-".$month."-01";
	$lastDay =  $year."-".$month."-".date('t',strtotime($dt));
	$strLastDate = strtotime($lastDay);
	$strToday = strtotime(date('Y-m-d'));
	if($strToday > $strLastDate){
		if(isBillGenerated($name,"insurance_bills", $month, $year)){
			echo "<h2 style='color:red'>Bill already Generated For  ".getMonthName($month)."<h2>";
			exit(0);
		}
	
	$total =0;
	$owing =0;
	$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount ,(totalAmount - paidAmount) as Balance ,paid_date,
	pay_method from patient_bills where  year(date) = $year and month(date) = $month order by date desc";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' >";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' > ".$name." Bills  For ".getMonthName($month)." ".$year."</legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>Patient Number</th><th>Name</th><th>Date</th><th>Amount</th></tr>";
	while($row=mysql_fetch_array($result)){
		$bal = $row['Balance'];
		
		if(!belongsToInsurance($row['pnumber'], $name)){
			continue;
		}else{
		//$bal = ($row['totalAmount'] == $row['paidAmount'])?0:($row['totalAmount']-$row['paidAmount']);
		
		
		$html .= "<tr style='color:cyan;'>";
		$html .= "<td>".$row['pnumber']."</td>";
		$html .= "<td>".getName($row['pnumber'])."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>D".$bal."</td>";
		
		
		$html .= "</tr>";
		$total += $row['totalAmount'];
		$owing += $bal;
		}
		
	}
	//updateBillGeneration($name,"insurance_bills", $month, $year);
	//updateNonPrivateBills($name,$month,$year);
	$html .= "<tr class='ui-widget-header'><td>Total</td><td></td><td></td><td>D$owing</td></tr>";
	$html .= "</table></center></fieldset>";
	//	if(isBillGenerated($name,"insurance_bills", $month, $year)){
			
	//	}
	//if(!billExistInsure($name, $month, $year)){
		updateNonPrivateBills($name,$month,$year);
		postBillInsure($name, $month, $year, $owing);
	//}else{
	//	updateBillInsure($name, $month, $year,$owing);
	//}
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Bills For ".$name."<h2>";
		}
	}else{
		echo "<h2 style='color:red'>Sorry You cannot Generate bill Before (".formatDate($lastDay).") for ".getMonthName($month)."<h2>";
	}
}


function belongsToCompany($pn,$comp){
	$sql = "select pnumber  from patientrecord where pnumber='$pn' and 	statusName = '$comp'";
	//echo $sql;
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

function belongsToInsurance($pn,$comp){
$sql = "select pnumber  from patientrecord where pnumber='$pn' and 	statusName = '$comp'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

function billExist($name,$month,$year){
	$sql = "select name  from company_bills where name='$name' and 	month(date) = $month and year(date) = $year";
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

function postBill($name,$month,$year,$amount){
	 if($amount > 0){
	$dt = $year."-".$month."-01";
	$date =  $year."-".$month."-".date('t',strtotime($dt));
	$sql = "insert into   company_bills values('','$name','$date',$amount,0,'','','','YES','User',CURRENT_TIMESTAMP)";
	//echo $sql ;
	$result = mysql_query($sql);	
	 }
}
function updateBill($name ,$month,$year,$amount){
	$date = date('Y-m-d');
	$sql = "update company_bills set amount = $amount where
	month(date) = $month and year(date) = $year and name ='$name' ";
	//echo $sql;
	$result = mysql_query($sql);
}

function payBill($name,$month,$year,$amount){
	$date = date('Y-m-d');
	$sql = "update company_bills set paid_amount = $amount ,paidDate = '$date' balance = (SELECT (amount-$amount) from (select * from company_bills) as x where name='$name')
	month(date) = $month and year(date) = $year and name ='$name' ";
	$result = mysql_query($sql);
}

function billExistInsure($name,$month,$year){
	$sql = "select name  from insurance_bills where name='$name' and 	month(date) = $month and year(date) = $year";
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

function postBillInsure($name,$month,$year,$amount){
	 if($amount > 0){
	$dt = $year."-".$month."-01";
	$date =  $year."-".$month."-".date('t',strtotime($dt));
	$sql = "insert into   insurance_bills values('','$name','$date',$amount,0,'','','','YES','User',CURRENT_TIMESTAMP)";
	$result = mysql_query($sql);	
	 }
	
}
function updateBillInsure($name ,$month,$year,$amount){
	$date = date('Y-m-d');
	$sql = "update insurance_bills set amount = $amount where
	month(date) = $month and year(date) = $year and name ='$name' ";
	//echo $sql;
	$result = mysql_query($sql);
}

function payBillInsure($name,$month,$year,$amount){
	$date = date('Y-m-d');
	$sql = "update insurance_bills set paid_amount = $amount ,paidDate = '$date' balance = (SELECT (amount-$amount) from (select * from insurance_bills) as x where name='$name')
	month(date) = $month and year(date) = $year and name ='$name' ";
	$result = mysql_query($sql);
}


function getCompBillToPay($name,$month,$year){
	$sql = "select id,date,amount,name,paid_amount,paidDate from company_bills where  name = '$name' and
	month(date) = $month and year(date) = $year limit 1";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class='ui-widget ui-widget-content ui-corner-all inputStyle' style='background-color: grey;'>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' > ".$name." Bills  For ".getMonthName($month).", ".$year." </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>ID</th><th>Date</th><th>Name</th><th>Amount</th><th>Balance</th><th>Paid Date</th><th>Action</th></tr>";
	while($row=mysql_fetch_array($result)){
		$bal = ($row['amount'] == $row['paid_amount'])?0:($row['amount']-$row['paid_amount']);
		//$bal = $row['balance'];
		$action ="";
		if($bal == 0){
			$action ="PAID";
		}else{
			$action = "<a class='payCompanyBillLink' href='#'><img src='images/pay.png'></img></a>";
		}
		$html .= "<tr>";
		$html .= "<td>".$row['id']."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "<td>".$bal."</td>";
		$html .= "<td>".$row['paidDate']."</td>";
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
	}
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Bills For ".$name ." On ".getMonthName($month).", ".$year."<h2>";
		}
}

function getInsuranceBillToPay($name,$month,$year){
	$sql = "select id,date,amount,name,paid_amount,paidDate from insurance_bills where  name = '$name' and
	month(date) = $month and year(date) = $year limit 1";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class='ui-widget ui-widget-content ui-corner-all inputStyle' '>";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' > ".$name." Bills  For ".getMonthName($month).", ".$year." </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>ID</th><th>Date</th><th>Name</th><th>Amount</th><th>Balance</th><th>Paid Date</th><th>Action</th></tr>";
	while($row=mysql_fetch_array($result)){
		$bal = ($row['amount'] == $row['paid_amount'])?0:($row['amount']-$row['paid_amount']);
		//$bal = $row['balance'];
		$action ="";
		if($bal == 0){
			$action ="PAID";
		}else{
			$action = "<a class='payInsuranceBillLink' href='#'><img src='images/pay.png'></img></a>";
		}
		$html .= "<tr style='color:cyan;'>";
		$html .= "<td>".$row['id']."</td>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$row['name']."</td>";
		$html .= "<td>".$row['amount']."</td>";
		$html .= "<td>".$bal."</td>";
		$html .= "<td>".$row['paidDate']."</td>";
		$html .= "<td>".$action."</td>";
		$html .= "</tr>";
	}
	$html .= "</table></center></fieldset>";
	echo $html;
		}else{
			echo "<h2 style='color:red'>Sorry No Bills For ".$name ." On ".getMonthName($month).", ".$year."<h2>";
		}
}
function getInsuranceBillId($name,$month,$year){
	$sql = "select id from insurance_bills where  name = '$name' and
	month(date) = $month and year(date) = $year limit 1";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
			$row=mysql_fetch_array($result);
			return $row['id'];
		}
}

function getCompanyBillId($name,$month,$year){
	$sql = "select id from company_bills where  name = '$name' and
	month(date) = $month and year(date) = $year limit 1";
	$result = mysql_query($sql) or die(mysql_error());
		if(mysql_affected_rows() > 0){
			$row=mysql_fetch_array($result);
			return $row['id'];
		}
}

function getTransactions($vn){
	$sqlC = "select visitNumber,amount from consultation where visitNumber='$vn'";
	$resultC = mysql_query($sqlC) or die(mysql_error());
	$row = mysql_fetch_array($resultC);
	$html ="<table border='0' >";
	if(mysql_num_rows($resultC) > 0 ){
	$html .= "<tr><td style='font-weight:bold;text-decoration:underline;'>Consultation</td><td></td></tr><tr><td>Consulation Fee : </td><td>".$row['amount']."</td></tr>";
	}
	$sqlL = "select testType,amount from labbooking where visitNumber='$vn'";
	$resultL = mysql_query($sqlL) or die(mysql_error());
	if(mysql_num_rows($resultL) > 0 ){
		$html .= "<tr><td style='font-weight:bold;text-decoration:underline;'>Lab Tests</td><td></td></tr>";
		while($row=mysql_fetch_array($resultL)){
			
			$html .= "<tr><td>".$row['testType']." : </td><td>".$row['amount']."</td></tr>";
		}
	
	}
	$sqlP = "select medication,amount from pharbooking where visitNumber='$vn'";
	$resultP = mysql_query($sqlP) or die(mysql_error());
	if(mysql_num_rows($resultP) > 0 ){
		$html .= "<tr><td style='font-weight:bold;text-decoration:underline;'>Pharmacy Prescriptions</td><td></td></tr>";
		while($row=mysql_fetch_array($resultP)){
			$html .= "<tr><td>".$row['medication']." : </td><td>".$row['amount']."</td></tr>";
		}
	
	}
	
	$sqlG = "select type,amount from general_booking where visitNumber='$vn'";
	$resultG = mysql_query($sqlG) or die(mysql_error());
	if(mysql_num_rows($resultG) > 0 ){
		$html .= "<tr><td><h4><u>Extra Charges</u></h4></td><td></td></tr>";
		while($row=mysql_fetch_array($resultG)){
			$html .= "<tr><td>".$row['type']." : </td><td>".$row['amount']."</td></tr>";
		}
	
	}
	
	$html .= "</table>";
	return $html;
	
}

function getTotalConsulationFee($vn){
	
	$str="select  sum(amount) as  total,conType from consultation where visitNumber='$vn'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	
	return $row;
	
}

function getTotalDrugsFee($vn){
	
	$str="select  sum(amount) as  total from pharbooking where visitNumber='$vn'";
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$total = $row['total'];
	return $total;
	
}
function getTotalLabTestsFee($vn){
	
	$str="select  sum(amount) as  total from labbooking where visitNumber='$vn'";
	$sql=mysql_query($str);
	if(mysql_num_rows($sql) >0){
	$row=mysql_fetch_array($sql);
	$total = $row['total'];
	return $total;
	}else{
		return 0;
	
	}
	
}

function getTotalGeneralFee($vn){
	$output = array(
		"Data" => array()
	);
	$str="select  sum(amount) as  total,type from general_booking where visitNumber='$vn'";
	$sql=mysql_query($str);
	
	while ( $row = mysql_fetch_array( $sql ) ){
		$rowVal = array();
		$rowVal[] = $row['total'];
		$rowVal[] = $row['type'];
		$output['Data'] = $rowVal;
	}
	
	
	
	return $output;
	
}

function getAccountName($code){
	$str="select  name  from accounts where code='$code' limit 1";
	$sql=mysql_query($str);
	if(mysql_num_rows($sql)){
		$row = mysql_fetch_array( $sql );
		return $row['name'];
	}
	
	
}

function  getAccounts(){
$sql = "select code,name  from accounts";
	$result = mysql_query($sql);
	$html = "<option val=''>Select Account</option>";
	if(mysql_affected_rows() > 0){
		while($row = mysql_fetch_array($result)){
			$html .= "<option value='".$row['code']."'>".$row['name']  ."</option>";
		}
		echo $html;
		
	}
}

function debitAccount($code,$amount){
	$updateStore = "UPDATE accounts set balance = (SELECT (balance-$amount) from (select * from accounts) as x where code='$code') 
	where code = '$code' ";
	mysql_query($updateStore);
}

function isLessThanBalance($code,$amount){
	$sql = "select balance  from accounts where code='$code' limit 1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		$row = mysql_fetch_array( $result );
		$bal = $row['balance'];
		if($amount < $bal){
			return true;
		}else{
			return false;
		}
		
	}else{
		return false;
		
	}
	
}

?>