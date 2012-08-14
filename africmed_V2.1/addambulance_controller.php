 <?php
 require_once 'includes/connect.php';
 require_once("includes/receptionFunctions.php"); 
 $post = $_POST;

 $ambulanceName= mysql_real_escape_string(trim(ucfirst($post['ambulanceName'])));
 $ambulanceNo= mysql_real_escape_string(trim(ucfirst($post['ambulanceNo'])));

	$sql = "insert into ambulance_gen values('','AMBULANCE','$ambulanceName','$ambulanceNo',CURRENT_TIMESTAMP)";
	
	$result = mysql_query($sql);
	if($result){
		echo 0;
	}else{
		echo "Sorry:  ".mysql_error();
	}

 
 
 ?>