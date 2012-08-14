<?php
// test the table functions
		error_reporting(E_ALL);
		include('pdf/class.ezpdf.php');
		require_once 'includes/connect.php';
		require_once 'includes/requireFile.php';
		//max_execution_time 
		//safe_mode 
		
		$pdf = new Cezpdf();
		$pdf->selectFont('fonts/Helvetica');
		function getFullName($pnumber){
			$sql=mysql_query("select fname,lname from patientrecord where pnumber='$pnumber'") or die(mysql_error());
			$row=mysql_fetch_array($sql);
			$fname=$row['fname'];
			$lname=$row['lname'];
			return $fname." ".$lname;
		
		}
		
	if (isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "eodSummary"){ 
	
	
	$drw = getDrawerNumber();
	$sql="SELECT date as Date,drawerNumber as 'Drawer No', sum(totalAmount) as 'Total Amount',sum(paidAmount) as 'Paid Amount' from 
	    patient_bills where drawerNumber = '$drw'";

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		//
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","CASH SALES TRANSACTION SUMMARY");
		
		
		$pdf->ezText("");
		
		$pdf->stream();
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "eodDetail"){
		$drw = getDrawerNumber();
		$sql="SELECT pb.date as Date,pb.drawerNumber as 'Drawer No',concat(pr.fname,' ',pr.lname) as 'Full Name', pb.totalAmount as 'Total Amount',pb.paidAmount as 'Paid Amount' from 
	    patient_bills as pb,patientrecord as pr where drawerNumber = '$drw' and pb.pnumber= pr.pnumber";

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		//====
		$sql="SELECT sum(totalAmount) as total,sum(paidAmount) as paid from 
	    patient_bills where drawerNumber = '$drw'";
		$result = mysql_query($sql) or die(mysql_error());
		$arr = mysql_fetch_array($result);
		$total = $arr['total'];
		$paid = $arr['paid'];
		$data[] = array('Date'=>'Total','Drawer No'=>'','Full Name'=>'','Total Amount'=>$total,'Paid Amount'=>$paid);
		//===
		$pdf->ezText("");
		$pdf->ezTable($data,"","CASH SALES TRANSACTION DETAIL");
		$pdf->ezText("");
		$pdf->stream();
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "pharSales"){
		$date = $_GET['date'];
		$sql="SELECT date_format(date,'%e %M, %Y') as Date, pb.pnumber as 'Patient No',concat(pr.fname,' ',pr.lname) as 'Full Name',pb.category as Type,pb.medication as Medication,pb.amount as Amount
		   from pharbooking as pb,patientrecord as pr where date='$date' and pr.pnumber=pb.pnumber";

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		//====
		$sql="SELECT sum(amount) as total from 
	    pharbooking where  date='$date'";
		$result = mysql_query($sql) or die(mysql_error());
		$arr = mysql_fetch_array($result);
		$total = $arr['total'];
		
		$data[] = array('Date'=>'Total','Patient No'=>'','Full Name'=>'','Type'=>'','Medication'=>'','Amount'=>$total);
		//===
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","ALL DRUGS SOLED ON ".formatDate($date));
		$pdf->ezText("");
		$pdf->stream();
		
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "labSales"){
		$date = $_GET['date'];
		$sql="SELECT date_format(date,'%e %M, %Y') as Date, concat(pr.fname,' ',pr.lname) as 'Full Name',lb.testType as 'Test Type',lb.amount as Amount
		   from labbooking as lb,patientrecord as pr where date='$date' and pr.pnumber = lb.pnumber";

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		//====
		$sql="SELECT sum(amount) as total from 
	    labbooking where  date='$date'";
		$result = mysql_query($sql) or die(mysql_error());
		$arr = mysql_fetch_array($result);
		$total = $arr['total'];
		
		$data[] = array('Date'=>'Total','Full Name'=>'','Test Type'=>'','Amount'=>$total);
		//===
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","ALL LAB TEST(S)  ON ".formatDate($date));
		$pdf->ezText("");
		$pdf->stream();
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "expenses"){
		$sql = "";
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select * from  expenses where date = '$date'";
		//$sql="select * from  expenses where month(date) = 10 and year(date) = 2011";
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			//$sql="select * from  expenses where date = '$date'";
			$sql="select * from  expenses where month(date) = $month and year(date) = $year";
			//echo $sql;
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql = "select * from  expenses where year(date) = $year";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","Expenses In  ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "dayBooks"){
		$sql = "";
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date
		from patient_bills where  date = '$date' order by date desc";
		//$sql="select * from  expenses where month(date) = 10 and year(date) = 2011";
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			//$sql="select * from  expenses where date = '$date'";
			$sql="select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date
			 from patient_bills where  month(date) = $month and year(date) = $year order by date desc";
			//echo $sql;
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date,
			pay_method from patient_bills where   year(date) = $year order by date desc";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		//====
		$total=0;
		if($_GET['status'] == "bydate"){
			$sql = "SELECT sum(totalAmount) as total,sum(paidAmount) as paid ,(totalAmount - paidAmount) as balance from 
	   		 patient_bills where date = '$date' order by date desc";
			$result = mysql_query($sql) or die(mysql_error());
			$arr = mysql_fetch_array($result);
			$total = $arr['total'];
			$paid = $arr['paid'];
			$bal = $arr['balance'];
			$data[] = array('visitNumber'=>'Total','pnumber'=>'','date'=>'','totalAmount'=>$total,'paidAmount'=>$paid,'Balance'=>$bal,'paid_date'=>'');
		}else if($_GET['status'] == "bymonth"){
		
		}if($_GET['status'] == "byyear"){
			
		}
		
		
		//===
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","Daily Transactions In  ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "cashSales"){
		$sql = "";
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select visitNumber,pnumber,date,paidAmount,paid_date
		from patient_bills where  date = '$date' order by date desc";
		//$sql="select * from  expenses where month(date) = 10 and year(date) = 2011";
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			//$sql="select * from  expenses where date = '$date'";
			$sql="select visitNumber,pnumber,date,paidAmount,paid_date
			 from patient_bills where  month(date) = $month and year(date) = $year order by date desc";
			//echo $sql;
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql = "select visitNumber,pnumber,date,paidAmount,paid_date
			 from patient_bills where   year(date) = $year order by date desc";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","Cash Sales In  ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "debtors"){
	$sql = "";
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date
		 from patient_bills where totalAmount <> paidAmount and date = '$date' order by date desc";
		//$sql="select * from  expenses where month(date) = 10 and year(date) = 2011";
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			//$sql="select * from  expenses where date = '$date'";
			$sql="select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date
		 from patient_bills where totalAmount <> paidAmount and month(date) = $month and year(date) = $year order by date desc";
			//echo $sql;
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql = "select visitNumber,pnumber,date,totalAmount,paidAmount,(totalAmount - paidAmount) as Balance,paid_date
		 from patient_bills where totalAmount <> paidAmount and year(date) = $year order by date desc";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","Debtors In  ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "pettyCash"){
	$sql = "";
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select date as Date,name as Name,comment as Comment,payment_method as 'Payment Method',cheque_number as 'Cheque Number',bank_code as 'Account Code',amount as Amount from  petty_cash where date = '$date'";
		//$sql="select * from  expenses where month(date) = 10 and year(date) = 2011";
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			//$sql="select * from  expenses where date = '$date'";
			$sql="select date as Date,name as Name,comment as Comment,payment_method as 'Payment Method',cheque_number as 'Cheque Number',bank_code as 'Account Code',amount as Amount from  petty_cash where month(date) = $month and year(date) = $year";
			//echo $sql;
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql = "select date as Date,name as Name,comment as Comment,payment_method as 'Payment Method',cheque_number as 'Cheque Number',bank_code as 'Account Code',amount as Amount from  petty_cash where year(date) = $year";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data[] = mysql_fetch_array($result, MYSQL_ASSOC)) {}
		
		$pdf->ezText("");
		$pdf->ezTable($data,"","Petty Cash   In ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
	
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "companyBills"){
		$sql = "";
		$company = $_GET['company'];
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select * from  patient_bills where date = '$date' and pnumber in (select pnumber from patientrecord where statusName = '$company')";
		//echo $sql;
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			
			$sql="select * from  patient_bills where  pnumber in (select pnumber from patientrecord where statusName = '$company')
			and  month(date) = $month and year(date) = $year";
			
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql="select * from  patient_bills where  pnumber in (select pnumber from patientrecord where statusName = '$company')
			and   year(date) = $year";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
			$totalCost = 0;
			$vn = $data['visitNumber'];
			$pn = $data['pnumber'];
			$pdf->ezText("Africmed Limited\nSenegambia Junction\nKombo Coastal Highway\nKololi\nThe Gambia                                                           Invoice\n\nTelephone: +220 4465359\n");
			$pdf->ezText("\n\n\n\n$company");
			$name = getName($pn);
			$pdf->ezText("$name");
			$dateV = formatDate($data['date']);
			$pdf->ezText("\n\n\n\n$dateV\n\n");
			
			$hd = sprintf("%' -15s %' -100s %' 25s %' 20s","Quantity","Details","Unit Price","Amount");
			$pdf->ezText("\n\n\n\n$hd\n\n");
			
			$confee = getTotalConsulationFee($vn);
			$desc = $confee['conType'];
			$amt = $confee['total'];
			$totalCost += $amt;
			if($amt != 0){
				$consul = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00",$desc,$amt,$amt);
				$pdf->ezText("$consul");
			}
			
			$labfee = getTotalLabTestsFee($vn);
			$totalCost += $labfee;
			if($labfee != 0){
				$lab = sprintf("% -15s %' -100s %' 25.2f %' 20.2f","1.00","Laboratory Tests",$labfee,$labfee);
				$pdf->ezText("$lab");
			}
			
			$drugfee = getTotalDrugsFee($vn);
			$totalCost += $drugfee;
			if($drugfee != 0){
				$drug = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00","Drugs",$drugfee,$drugfee);
				$pdf->ezText("$drug");
			}
			
		$genArray = getTotalGeneralFee($vn);
		$count = count($genArray);
		$x=0;
		while($x<$count){
			$n = $genArray['Data'][1];
			$v = $genArray['Data'][0];
			$totalCost += $v;
			if($v != 0){
				$gen = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00",$n,$v,$v);
			 	$pdf->ezText("$gen");
			}
			$x++;
		 	
		}
		
			$net = sprintf("%' 60s%' 20.2f","Total Net Amount",$totalCost);
			$pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n$net");
			$net = sprintf("%' 60s %' 25.2f ","Carriage Net    ",0);
			$pdf->ezText("$net");
			$net = sprintf("%' 60s%' 25.2f","Invoice Total   ",$totalCost);
			$pdf->ezText("$net");
			
			$pdf->ezNewPage();
			
		}
		
		$pdf->ezText("");
		//$pdf->ezTable($data,"","Detail Company Bills  On ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
	
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "insuranceBills"){
		$sql = "";
		$company = $_GET['insurance'];
		if($_GET['status'] == "bydate"){
		$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select visitNumber,pnumber,date from  patient_bills where date = '$date' and pnumber in (select pnumber from patientrecord where statusName = '$company')";
		//echo $sql;
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			
			$sql="select visitNumber,pnumber,date from  patient_bills where  pnumber in (select pnumber from patientrecord where statusName = '$company')
			and  month(date) = $month and year(date) = $year";
			
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql="select visitNumber,pnumber,date from  patient_bills where  pnumber in (select pnumber from patientrecord where statusName = '$company')
			and   year(date) = $year";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$totalCost = 0;
			$vn = $data['visitNumber'];
			$pn = $data['pnumber'];
			$pdf->ezText("Africmed Limited\nSenegambia Junction\nKombo Coastal Highway\nKololi\nThe Gambia                                                           Invoice\n\nTelephone: +220 4465359\n");
			$pdf->ezText("\n\n\n\n$company");
			$name = getName($pn);
			$pdf->ezText("$name");
			$dateV = formatDate($data['date']);
			$pdf->ezText("\n\n\n\n$dateV\n\n");
			
			$hd = sprintf("%' -15s %' -100s %' 25s %' 20s","Quantity","Details","Unit Price","Amount");
			$pdf->ezText("\n\n\n\n$hd\n\n");
			
			$confee = getTotalConsulationFee($vn);
			$desc = $confee['conType'];
			$amt = $confee['total'];
			$totalCost += $amt;
			if($amt != 0){
				$consul = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00",$desc,$amt,$amt);
				$pdf->ezText("$consul");
			}
			
			$labfee = getTotalLabTestsFee($vn);
			$totalCost += $labfee;
			if($labfee != 0){
				$lab = sprintf("% -15s %' -100s %' 25.2f %' 20.2f","1.00","Laboratory Tests",$labfee,$labfee);
				$pdf->ezText("$lab");
			}
			
			$drugfee = getTotalDrugsFee($vn);
			$totalCost += $drugfee;
			if($drugfee != 0){
				$drug = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00","Drugs",$drugfee,$drugfee);
				$pdf->ezText("$drug");
			}
			
		$genArray = getTotalGeneralFee($vn);
		$count = count($genArray);
		$x=0;
		while($x<$count){
			$n = $genArray['Data'][1];
			$v = $genArray['Data'][0];
			$totalCost += $v;
			if($v != 0){
				$gen = sprintf("%' -15s %' -100s %' 25.2f %' 20.2f","1.00",$n,$v,$v);
			 	$pdf->ezText("$gen");
			}
			$x++;
		 	
		}
		
			$net = sprintf("%' 60s%' 20.2f","Total Net Amount",$totalCost);
			$pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n$net");
			$net = sprintf("%' 60s %' 25.2f ","Carriage Net    ",0);
			$pdf->ezText("$net");
			$net = sprintf("%' 60s%' 25.2f","Invoice Total   ",$totalCost);
			$pdf->ezText("$net");
			
			$pdf->ezNewPage();
		}
		
		$pdf->ezText("");
		//$pdf->ezTable($data,"","Detail Insurance Bills  On ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
	
}else if(isset($_GET['getWhatPDF']) && $_GET['getWhatPDF'] == "privateBills"){
		$sql = "";
		$pnumber = $_GET['pnumber'];
		if($_GET['status'] == "bydate"){
		//$header = $_GET['date'];
		$date = $_GET['date'];
		$sql="select visitNumber,pnumber,totalAmount,paidAmount,date from  patient_bills where date = '$date' and pnumber='$pnumber'";
		//echo $sql;
		}else if($_GET['status'] == "bymonth"){
			
			$month = $_GET['month'];
			$year = $_GET['year'];
			$header = getMonthName($month)." Of ".$year;
			
			$sql="select visitNumber,pnumber,totalAmount,paidAmount,date from  patient_bills where  month(date) = $month and year(date) = $year and pnumber='$pnumber'";
			
		}if($_GET['status'] == "byyear"){
			$year = $_GET['year'];
			$header = $year;
			$sql="select visitNumber,pnumber,totalAmount,paidAmount,date from  patient_bills where  year(date) = $year and pnumber='$pnumber'";
			
		}

		$data = array();
		$result = mysql_query($sql) or die(mysql_error());
		while($data = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$totalCost = 0;
			$vn = $data['visitNumber'];
			$pn = $data['pnumber'];
			$dep = $data['paidAmount'];
			$balance = ($data['totalAmount'] - $data['paidAmount']);
			$pdf->ezText("Africmed Limited\nSenegambia Junction\nKombo Coastal Highway\nKololi\nThe Gambia                                                           Invoice\n\nTelephone: +220 4465359\n");
			$pdf->ezText("\n\n\n\n");
			$name = getName($pn);
			$pdf->ezText("$name");
			
			$pdf->ezText("Deposited D$dep");
			$pdf->ezText("Balanced With D$balance");
			$dateV = formatDate($data['date']);
			$pdf->ezText("\n\n\n\n$dateV\n\n");
			
			$hd = sprintf("%' -10s %' -60s %' 20s %' 10s","Quantity","Details","Unit Price","Amount");
			$pdf->ezText("\n\n\n\n$hd\n\n");
			
			$confee = getTotalConsulationFee($vn);
			$desc = $confee['conType'];
			$amt = $confee['total'];
			$totalCost += $amt;
			if($amt != 0){
				$consul = sprintf("%' -10s %' -60s %' 20.2f %' 10.2f","1.00",$desc,$amt,$amt);
				$pdf->ezText("$consul");
			}
			
			$labfee = getTotalLabTestsFee($vn);
			$totalCost += $labfee;
			if($labfee != 0){
				$lab = sprintf("% -10s %' -60s %' 20.2f %' 10.2f","1.00","Laboratory Tests",$labfee,$labfee);
				$pdf->ezText("$lab");
			}
			
			$drugfee = getTotalDrugsFee($vn);
			$totalCost += $drugfee;
			if($drugfee != 0){
				$drugs = sprintf("%' -10s %' -60s %' 20.2f %' 10.2f","1.00","Drugs",$drugfee,$drugfee);
				$pdf->ezText("$drugs");
			}
			
		$genArray = getTotalGeneralFee($vn);
		$count = count($genArray);
		$x=0;
		while($x<$count){
			$n = $genArray['Data'][1];
			$v = $genArray['Data'][0];
			$totalCost += $v;
			if($v != 0){
				$gen = sprintf("%' -10s %' -60s %' 20.2f %' 10.2f","1.00",$n,$v,$v);
			 	$pdf->ezText("$gen");
			}
			$x++;
		 	
		}
		
			$net = sprintf("%' 60s%' 20.2f","Total Net Amount",$totalCost);
			$pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n$net");
			$net = sprintf("%' 60s %' 25.2f ","Carriage Net    ",0);
			$pdf->ezText("$net");
			$net = sprintf("%' 60s%' 25.2f","Invoice Total   ",$totalCost);
			$pdf->ezText("$net");
			
			$pdf->ezNewPage();
		}
		
		$pdf->ezText("");
		//$pdf->ezTable($data,"","Detail Insurance Bills  On ".$header);
		$pdf->ezText("");
		$pdf->stream(); 
}
?>
