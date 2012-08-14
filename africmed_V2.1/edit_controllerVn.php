<?php
include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;
$table = $_GET['table'];
if(($post['oper'])=='edit'){
editTable($post, $table);
}elseif ($post['oper'] == 'del'){
	deleteRowByVnumber($post['id'],$table);
	
}

?>