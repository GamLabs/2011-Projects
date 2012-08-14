<?php
if (isset($_GET['printComName']) && isset($_GET['printComMonth']) && isset($_GET['printComYear'])){
	$name=$_GET['printComName'];
	$month=$_GET['printComMonth'];
	$year=$_GET['printComYear'];
	$datePaid=$month." ".$year;
}

// test the table functions
error_reporting(E_ALL);
include('pdf/class.ezpdf.php');
include('includes/connect.php');
include 'includes/requireFile.php';
//max_execution_time
//safe_mode

$pdf = new Cezpdf();
$pdf->selectFont('fonts/Helvetica');

/*$query = "select name as 'Company Name',paidAmount as 'Paid Amount',balance as 'Balance', received_from as
 'Received From', received_by as 'Received By' from paid_company_bills where name='$name'
 AND date_paid_for='$datePaid' ";*/

$str="SELECT patientrecord.fname as 'First Name',patientrecord.lname as 'Last Name',patientrecord.statusId as 'CARD NO.',
			date_format(company_bills.date,'%e %M, %Y') as 'DATE',company_bills.amount as 'AMOUNT' from patientrecord,company_bills 
			where patientrecord.pnumber=company_bills.pnumber AND patientrecord.statusName='$name' 
			AND month(company_bills.date)='$month' AND year(company_bills.date)='$year'";
$strSum="select sum(company_bills.amount) as amount from patientrecord, company_bills
			where patientrecord.pnumber=company_bills.pnumber 
			AND patientrecord.statusName='$name'
			AND month(company_bills.date)='$month' 
			AND year(company_bills.date)='$year'";

$sumData=array();
$data = array();
$sumResult = mysql_query($strSum) or die(mysql_error());
$sumData=mysql_fetch_array($sumResult);

$result = mysql_query($str) or die(mysql_error());
while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}

$title=$name." ".monthName($month)." ".$year." Summary Bills";
$pdf->ezTable($data,'',$title);
$pdf->ezText("");
$pdf->ezText("                                                                                                                               TOTAL SUM:  D $sumData[amount]");
//$pdf->execTemplate(0,$data);

// do the output, this is my standard testing output code, adding ?d=1
// to the url puts the pdf code to the screen in raw form, good for
//checking
// for parse errors before you actually try to generate the pdf file.
if (isset($d) && $d){
	$pdfcode = $pdf->output(1);
	$pdfcode = str_replace("\n","\n<br>",htmlspecialchars($pdfcode));
	echo '<html><body>';
	echo trim($pdfcode);
	echo '</body></html>';
}else{
	$pdf->stream();
}

?>
