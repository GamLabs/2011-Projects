<?php
require_once 'includes/requireFile.php';

if (isset($_GET['liveSearchPnumber'])){
	echo getPnumberByName($_GET['liveSearchPnumber'],$_GET['page']);
}
else if (isset($_POST['pnumber'])){
		$pn= $_POST['pnumber'];
		$date = date('Y-m-d');
		$visitNumber=getVisitNumber($pn);
		displayTransaction($visitNumber);
		
		
}else if(isset($_POST['pnumberKeyUp'])){
		$pn= $_POST['pnumberKeyUp'];
		$date = date('Y-m-d');
		$visitNumber=getVisitNumber($pn);
		if(bookingExist($visitNumber)){
		
		if (!empty($visitNumber)){
			displayTransaction($visitNumber);
			//echo getTotalFee($pn)." By ".getName($pn);
		}
		}else{
			echo 1; // no Transaction
		}
}
elseif (isset($_POST['getTotal'])){
	$pn=$_POST['getTotal'];
	$vn=getVisitNumber($pn);
	$getTotal=getTransactionTotal($vn);
	echo $getTotal;
}elseif (isset($_POST['Auth']) && isset($_POST['debtorBalance']) && isset($_POST['debtorPnumber']) && isset($_POST['debtorPaidAmount'])){
	$authorizer=$_POST['Auth'];
	$paidAmount=$_POST['debtorPaidAmount'];
	$bal=$_POST['debtorBalance'];
	$pn=$_POST['debtorPnumber'];
	$name=getName($pn);
	$visitNumber=getVisitNumber($pn);
	$total=getTransactionTotal($visitNumber);
	$date=date('Y-m-d');
	$id=getDrawerNumber();
	$val=addDebtor($authorizer,$bal,$pn,$visitNumber,$date,$total,$paidAmount);
	if ($val){
		if(!hasPaid($pn)){
				insertPaidBills($pn,$visitNumber,$total,$date,$paidAmount,$bal,$pay_method,$checkNo,$id);
				updateQueueStatus("DONE",$pn);
				updateVisits($vn);
				echo "$name Was Authorized As A Debtor By $authorizer";
		}
	}else{
		echo 0;
	}
}else if(isset($_POST['checkIfDrawerIsOpen'])){
	$id=getDrawerNumber(); // GETS THE UNIQUE ID FOR THE DRAWER CURRENTLY OPENED
	if (empty($id)){
		echo 1;
	}else{
		echo 0;
	}
}else if (isset($_POST['paidAmount'])){
	$post=$_POST;
	$pn=$post['payPnumber'];
	$paidDate=date('Y-m-d');
	$paidAmount=$post['paidAmount'];
	$bal=$post['Balance'];
	$pay_method=$post['payMethod'];
	$checkNo=$post['CheckNo'];
	$vn=getVisitNumber($pn);
	$total=getTransactionTotal($vn);
	$id=getDrawerNumber(); // GETS THE UNIQUE ID FOR THE DRAWER CURRENTLY OPENED
			if(!hasPaid($pn)){
				insertPaidBills($pn,$vn,$total,$paidDate,$paidAmount,$bal,$pay_method,$checkNo,$id);
				updateQueueStatus("DONE",$pn);
				updateVisits($vn);
				echo getName($pn);
			}
}
?>