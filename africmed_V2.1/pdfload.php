<?php 
function getParams(){
	$ot = "";
foreach($_GET as $k => $v){
	$ot .= $k."=".$v."&";
}
 echo $ot;
}
?>
<iframe src="pdfPrint.php?<?php getParams();?>" width="100%" height="100%"> </iframe> 