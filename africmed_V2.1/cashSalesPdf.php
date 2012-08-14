<?php

if (isset($_GET['Shift']) && isset($_GET['SalesDate'])){
	
	$shift=$_GET['Shift'];
	$salesDate=$_GET['SalesDate'];
	$str="";
		
		// test the table functions
		error_reporting(E_ALL);
		include('pdf/class.ezpdf.php');
		include('includes/connect.php');
		include 'includes/requireFile.php';
		//max_execution_time 
		//safe_mode 
		
		$pdf = new Cezpdf();
		$pdf->selectFont('fonts/Helvetica');
		
			if ($shift != "WHOLE"){ // IF BOTH DATE AND SHIFT IS CHOOSEN
				
				$str="SELECT name as 'COLLECTED FROM', cash_sales as 'CASH SALES',balance as 'BALANCE',expense as 'EXPENSE',
						date_format(open_timeStamp,'%h: %i%p') as 'TIME OPENED',
						date_format(close_timeStamp,'%h: %i%p') as 'TIME CLOSED'
						from cash_drawer where shift='$shift' AND date='$salesDate' AND status='CLOSED'";
		
			}else{ // IF ONLY DATE IS CHOOSEN
				$str="SELECT date_format(date,'%e %M %Y') as 'DATE',shift as 'DETAILS',cash_sales as 'T/C. SALE',
						expense as 'EXPENSE',balance as 'BALANCE' from cash_drawer where date='$salesDate' AND status='CLOSED'";
			}
		
		//$sumArray=array();
		//$sumResult = mysql_query($sum) or die(mysql_error());
		//$sumArray=mysql_fetch_array($sumResult);
		
		$data = array();
		$result = mysql_query($str) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		//$tblTitle="$cat EXPENSES FROM $startDate TO $endDate";
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","CASH SALES TRANSACTION");
		$pdf->ezText("");
		
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
}
?>
