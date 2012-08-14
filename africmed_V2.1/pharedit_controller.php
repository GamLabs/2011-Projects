<?php
include_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$post = $_POST;
if(($post['oper'])=='edit'){
editTableByColumn($post, 'nontablet_config', 'id');
}elseif ($post['oper'] == 'del'){
      deleteRowByColumn($post['id'],'nontablet_config', 'id');
}
?>
