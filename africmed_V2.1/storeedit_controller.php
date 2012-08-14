<?php
include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;
if(($post['oper'])=='edit'){
editTableByColumn($post, 'phar_store_config', 'id');
}elseif ($post['oper'] == 'del'){
      deleteRowByColumn($post['id'],'phar_store_config', 'id');
}
?>