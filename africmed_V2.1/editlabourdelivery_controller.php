<?php
require_once 'includes/connect.php'; 
require_once 'includes/receptionFunctions.php';
$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 

//===
/*
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
*/
//======
function constructWhere($s){
    $qwery = "";
	//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
    $qopers = array(
				  'eq'=>" = ",
				  'ne'=>" <> ",
				  'lt'=>" < ",
				  'le'=>" <= ",
				  'gt'=>" > ",
				  'ge'=>" >= ",
				  'bw'=>" LIKE ",
				  'bn'=>" NOT LIKE ",
				  'in'=>" IN ",
				  'ni'=>" NOT IN ",
				  'ew'=>" LIKE ",
				  'en'=>" NOT LIKE ",
				  'cn'=>" LIKE " ,
				  'nc'=>" NOT LIKE " );
    if ($s) {
        $jsona = json_decode($s,true);
        if(is_array($jsona)){
			$gopr = $jsona['groupOp'];
			$rules = $jsona['rules'];
            $i =0;
            foreach($rules as $key=>$val) {
                $field = $val['field'];
                $op = $val['op'];
                $v = $val['data'];
				if($v && $op) {
	                $i++;
					// ToSql in this case is absolutley needed
					$v = ToSql($field,$op,$v);
					if ($i == 1) $qwery = "";
					else $qwery .= " " .$gopr." ";
					switch ($op) {
						// in need other thing
					    case 'in' :
					    case 'ni' :
					        $qwery .= $field.$qopers[$op]." (".$v.")";
					        break;
						default:
					        $qwery .= $field.$qopers[$op].$v;
					}
				}
            }
        }
    }
    return $qwery;
}

function ToSql ($field, $oper, $val) {
	// we need here more advanced checking using the type of the field - i.e. integer, string, float
	
			//mysql_real_escape_string is better
			if($oper=='bw' || $oper=='bn') return "'" . addslashes($val) . "%'";
			else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
			else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
			else return "'" . addslashes($val) . "'";
	
}

$where = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$searchstr = Strip($_REQUEST['filters']);
	$where .= "WHERE ";
	$where .= constructWhere($searchstr);
	//echo "Error:  ".$where." :rorrE";
}

////=====

if(!$sidx) $sidx =1;


$result = mysql_query("SELECT COUNT(*) AS count FROM delivery ".$where);
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; 
$SQL = "SELECT * FROM delivery  ".$where." ORDER BY $sidx $sord LIMIT $start , $limit";
//echo "SQL: ".$SQL;
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
   // $responce->rows[$i]['pnumber']=$row['pnumber'];
    $responce->rows[$i]['cell']=array($row['visitNumber'],$row['pnumber'],$row['date'],$row['time'],$row['place'],
    $row['delivered_by'],$row['designation'],$row['delivery_mode'],$row['outcome'],$row['baby_weight'],$row['apgar_score']);
    $i++;
}        
echo json_encode($responce);

?>