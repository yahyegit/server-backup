<?php

  if_logged_in('die'); 
	$not_deleted = '`delete_status`!=1';

    $default_order = ($default_order =='')?$sIndexColumn:$default_order;


	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1' && $_GET['iDisplayLength'] != 'All' )
	{
		
		if(trim(sanitize($_GET['iDisplayLength'])) == 'NaN'){
				 $sLimit = '';
			}else{
				// check max limit
				if( (intval( sanitize($_GET['iDisplayLength']) ) - intval( sanitize($_GET['iDisplayStart'])  )) >= '1000' ){
					$sLimit = '';
				}else{
					  $sLimit = "LIMIT ".intval( sanitize($_GET['iDisplayStart']) ).", ".
			     intval( sanitize($_GET['iDisplayLength']) );
				}

		      
			
			}
			
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0']) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( sanitize($_GET['iSortingCols']) ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i])] == "true" )
			{
				
				if (!empty($aColumns[ intval( sanitize($_GET['iSortCol_'.$i]) ) ])){
					
					$sOrder .= "`".$aColumns[ intval( sanitize($_GET['iSortCol_'.$i]) ) ]."` ".
				
					(sanitize($_GET['sSortDir_'.$i])==='asc' ? 'asc' : 'desc') .", ";	
				}else{
					$sOrder = "ORDER BY `$default_order` asc, ";
				}

			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}else{
		
		$sOrder = "ORDER BY `$default_order` asc";
 
	}
	if(preg_match('/id/',$sOrder) || preg_match('/customer_id/',$sOrder) && $sTable !='customers'){
		$sOrder = "ORDER BY `$default_order` asc";
	}
	
 
 		 
	$sWhere = '';
		if ( isset($_GET['sSearch']) && sanitize($_GET['sSearch']) != '')
		{
			$sWhere = $sWhere_query; 	
		}

 
	/* Total data set length */

	  $sWhere  = str_replace('#','',  $sWhere);
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM $sTable WHERE $sWhere ".((empty($sWhere))?'':'and')." $not_deleted $sOrder";


	$rResultTotal = mysqli_query_( $sQuery); 
	$aResultTotal = mysqli_fetch_array($rResultTotal,MYSQLI_NUM); 
	$iTotal = $aResultTotal[0];
 
 
 
	 $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM $sTable WHERE  ".((empty($sWhere))?'':"($sWhere)")." ".((empty($sWhere))?'':'and')."  $other_query ".((empty($other_query))?'':'and')."  $not_deleted $sOrder  $sLimit
		"; 
 
   // die($sQuery);
	     $rResult = mysqli_query_( $sQuery);	
		
 

	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query_($sQuery);
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal,MYSQLI_NUM); 
	$iFilteredTotal = $aResultFilterTotal[0];


  

?>