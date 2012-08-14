<?php
require_once 'includes/connect.php';
require_once 'includes/receptionFunctions.php';
$get = $_GET;

if (isset($get['companyId'])){
$assocCol = array("name"=>"titleForm","address"=>"Address","contact"=>"Conatct","email"=>"Email");
$table = "company_config";

$keyCol = "id";
$keyVal = $get['companyId'];
editTableById($assocCol,$table,$keyCol,$keyVal);


}elseif (isset($get['insuranceId'])){
$assocCol = array("name"=>"titleForm","address"=>"Address","contact"=>"Conatct","email"=>"Email");
$table = "insurance_config";

$keyCol = "id";
$keyVal = $get['insuranceId'];
editTableById($assocCol,$table,$keyCol,$keyVal);


}elseif (isset($get['pharPricingId'])){
$assocCol = array("name"=>"titleForm","amount"=>"Selling Pricing Per Unit");
$table = "drug_names";

$keyCol = "id";
$keyVal = $get['pharPricingId'];
editTableById($assocCol,$table,$keyCol,$keyVal);


}elseif (isset($get['labPricingId'])){
$assocCol = array("name"=>"titleForm","amount"=>"Selling Pricing Per Unit");
$table = "test_types";

$keyCol = "id";
$keyVal = $get['labPricingId'];
editTableById($assocCol,$table,$keyCol,$keyVal);


}



?>
