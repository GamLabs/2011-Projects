<?php
require_once 'includes/receptionFunctions.php';
require_once 'includes/financeFunctions.php';
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'date', 'visitNumber', 'pnumber','totalAmount' );
	
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "date";
	
	/* DB table to use */
	$sTable = "patient_bills";
	
	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "gamlabs";
	$gaSql['db']         = "africmed";
	$gaSql['server']     = "localhost";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	
	 $comp = $_GET['comp'];
	 $month = $_GET['month'];
	 $year = $_GET['year'];
	$sWhere = "WHERE  month(date) = $month and year(date) = $year and pnumber in (select pnumber from patientrecord where statusName='$comp')  ";
	
	if ( $_GET['sSearch'] != "" )
	{
		$col = count($aColumns);
		$sWhere = "WHERE month(date) = $month and year(date) = $year and pnumber in (select pnumber from patientrecord where statusName='$comp') and ";
		
			//$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			if(($col-1) == $i){
				$sWhere .= getWhere($aColumns)."  ";		
			}else{
				$sWhere .= getWhere($aColumns)."  ";
			}
		
		//$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= '';
	}
	function getWhere($aColumns){
		$str = trim(mysql_real_escape_string( $_GET['sSearch'] ));
		$val = explode(' ',$str);
		$val = array_unique($val);
		$lastEle = end($val);
		reset($val);
		$ret="";
		$col = count($aColumns);
		$last = false;
		foreach( $val as $v )
		{	
			$ret .= "( ";
			if($val[0] == $v){
			for ( $i=0 ; $i<$col ; $i++ )
			{
		
					if(($col-1) == $i){
						$ret .= $aColumns[$i]." LIKE "."'".$v."%'" . "  ";
					}else{
						$ret .= $aColumns[$i]." LIKE "."'".$v."%'" . " OR ";
					}
		
			}
			}else{
				for ( $i=0 ; $i<$col ; $i++ )
				{
		
						if(($col-1) == $i){
							$ret .= $aColumns[$i]." LIKE "."'%".$v."%'" . "  ";
						}else{
							$ret .= $aColumns[$i]." LIKE "."'%".$v."%'" . " OR ";
						}
		
				}
			
			}
			$ret .= ") ";
			if($lastEle == $v){
				
			}else{
				$ret .= " AND ";
			}
		}
		$ret .= " ";
		return $ret;		
}


	/* Individual column filtering 
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " OR ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	*/
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	//echo $sQuery;
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "pnumber")
			{
				
					$row[] = getName($aRow[ $aColumns[$i] ]);
				
				/* Special output formatting for 'version' column */
				//$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
?>