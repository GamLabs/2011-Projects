<?php
require_once 'includes/connect.php';

$post = $_POST;

if (isset($post['deleteConFee'])){
	$id = $post['deleteConFee'];
	$sql = "delete from consultationconfig where id = $id";
	
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0 ){
		echo 0;
	}else{
		echo 1;
	}
	
}elseif (isset($post['editConFee'])){
	$id = $post['editConFee'];
	$amount = $post['amount'];
	$sql = "update consultationconfig set amount = $amount where id=$id";
	$result = mysql_query($sql);
	if(mysql_affected_rows() > 0 ){
		echo 0;
	}else{
		echo 1;
	}
	
}

?>