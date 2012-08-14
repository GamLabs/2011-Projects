<?php
require_once 'includes/connect.php';

$status = mysql_real_escape_string($_POST["editStatus"]);
$pnumber = $_POST["editStatuspn"];

$statusName = "";
$statusId = "";
				if($status=="INSURANCE"){
					$statusName = mysql_real_escape_string((isset($_POST["editStatusinsurance"])?$_POST["editStatusinsurance"]:""));
					$statusId = mysql_real_escape_string((isset($_POST["editStatuspolicyId"])?$_POST["editStatuspolicyId"]:"0")); 
					
					
				}elseif ($status=="COMPANY"){
					$statusName = mysql_real_escape_string((isset($_POST["editStatuscompany"])?$_POST["editStatuscompany"]:""));
					$statusId = mysql_real_escape_string((isset($_POST["editStatuscompanyno"])?$_POST["editStatuscompanyno"]:"0"));
				}else{
					
				}
				
			$sql = "update patientrecord set status = '$status', statusName = '$statusName', statusId = '$statusId' where pnumber = $pnumber";
			//echo $sql;
			$result = mysql_query($sql);
			if(mysql_affected_rows() >0){
				echo 0;
			}else{
				echo 1;
				//echo mysql_error();
			}

?>