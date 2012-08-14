<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';

$post = $_POST;
$table = $post['table'];
//print_r($post);
//saveTable($post);
editTableByColumn($post,$table, "id")

?>