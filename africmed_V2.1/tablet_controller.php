<?php
require_once 'includes/connect.php';
$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];


$ops = array(
    'eq'=>'=',
    'ne'=>'<>',
    'lt'=>'<',
    'le'=>'<=',
    'gt'=>'>',
    'ge'=>'>=',
    'bw'=>'LIKE',
    'bn'=>'NOT LIKE',
    'in'=>'LIKE',
    'ni'=>'NOT LIKE',
    'ew'=>'LIKE',
    'en'=>'NOT LIKE',
    'cn'=>'LIKE',
    'nc'=>'NOT LIKE' 
);
function getWhereClause($col, $oper, $val){
    global $ops;
    if($oper == 'bw' || $oper == 'bn') $val .= '%';
    if($oper == 'ew' || $oper == 'en' ) $val = '%'.$val;
    if($oper == 'cn' || $oper == 'nc' || $oper == 'in' || $oper == 'ni') $val = '%'.$val.'%';
    return " WHERE $col {$ops[$oper]} '$val' ";
}
$where = "";
$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
$searchOper = isset($_GET['searchOper']) ? $_GET['searchOper']: false;
$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
if ($_GET['_search'] == 'true') {
    $where = getWhereClause($searchField,$searchOper,$searchString);
}



if(!$sidx) $sidx =1;


$result = mysql_query("SELECT COUNT(*) AS count FROM tablet_config ");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
    $total_pages = ceil($count/$limit);
} else {
    $total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
$SQL = "SELECT id, type,quantity,amount FROM tablet_config  ".$where." ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
   // $responce->rows[$i]['pnumber']=$row['pnumber'];
    $responce->rows[$i]['cell']=array($row['id'],$row['type'],$row['quantity'],$row['amount']);
    $i++;
}       
echo json_encode($responce);

?>