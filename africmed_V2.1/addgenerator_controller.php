 <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 
 
 $post = $_POST;

 $generatorName= mysql_real_escape_string(trim(ucfirst($post['generatorName'])));
 $generatorNo= mysql_real_escape_string(trim(ucfirst($post['generatorNo'])));

	$sql = "insert into ambulance_gen values('','GENERATOR','$generatorName','$generatorNo',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}
	
 
 
 
 
 ?>