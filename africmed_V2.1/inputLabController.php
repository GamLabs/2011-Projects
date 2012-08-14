<?php
require_once 'includes/connect.php';
require_once 'includes/labFunctions.php';

?>

<?php
if(isset($_POST['submit'])){
	$test = $_POST['Test'];
	$amt = $_POST['Amount'];
	 insertLabStock($test,$amt,"sc");
	/*if (!stockLabExist($test,$amt)){
		if(insertLabStock($test,$amt,"sc")){
			echo 1; // INSERT SUCCESSFUL
		}else{
			echo 0; // FAIL TO INSERT
		}
	}else{
		echo 2; // TEST ALREADY EXIST
	}*/
	
}else{
	
}

?>
