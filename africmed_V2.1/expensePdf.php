
<?php


if (isset($_GET['Category']) && isset($_GET['StartDate'])&& isset($_GET['endDate'])){
	$cat=$_GET['Category'];
	$startDate=$_GET['StartDate'];
	$endDate=$_GET['endDate'];
	//$datePaid=$month." ".$year;
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

	if ($cat == "ALL"){
		
		$str="SELECT category as 'Description',details as 'Details',date_format(date,'%e %M, %Y') as 'Date',
				amount as 'Amount',payment_method as 'Method',cheque_number as 'Cheque Number',
				date_format(timeStamp,'%e %M %Y %H: %i%p') as 'Date Added',user as 'Added By' from expenses 
				where date BETWEEN '$startDate' AND '$endDate' order by date ";

		$sum="select sum(amount) as amount from expenses where date BETWEEN '$startDate' AND '$endDate'";
	}else{ // IF THEY WANT TO VIEW BY CATEOGRY
		$str="SELECT category as 'Description',details as 'Details',date_format(date,'%e %M, %Y') as 'Date',
				amount as 'Amount',payment_method as 'Method',cheque_number as 'Cheque Number', 
				date_format(timeStamp,'%e %M %Y %H: %i%p') as 'Date Added',user as 'Added By' from expenses 
				where category ='$cat' AND date BETWEEN '$startDate' AND '$endDate' order by category ";
		
		$sum="select sum(amount) as amount from expenses where category ='$cat' AND date BETWEEN '$startDate' AND '$endDate'";
	}

$sumArray=array();
$sumResult = mysql_query($sum) or die(mysql_error());
$sumArray=mysql_fetch_array($sumResult);

$data = array();
$result = mysql_query($str) or die(mysql_error());
while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}

$tblTitle="$cat EXPENSES FROM ".formatDate($startDate)." - ".formatDate($endDate);

$pdf->ezText("");
$pdf->ezTable($data,'',$tblTitle);
$pdf->ezText("");
$pdf->ezText("                                                                                         TOTAL SUM:  D $sumArray[amount]");
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
} else {
	$pdf->stream();
}




?>
