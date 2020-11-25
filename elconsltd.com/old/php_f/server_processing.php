<?php
  require '../includes/inc_func.php';
  
  
  
  
  mysql_query('ALTER TABLE workers ADD w_single_cost VARCHAR(60)');
  
  
  
  
  
  
  
  
	$aColumns =  explode(",",trim($_GET['collms_'])); // collumn names for the database
//echo $_GET['collms'] die();
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn =  trim($_GET['primaryKey_']);  
	
	$trashCond = (trim($_GET['other_query_']) == 'trash')?true:false;
	
	$other_query =   (trim($_GET['other_query_']) == 'trash')?'':trim($_GET['other_query_']);
	$other_query2 =   (trim($_GET['other_query_']) == 'trash')?'':trim($_GET['other_query_']);
	
	
 
	
	/* DB table to use */    
	$sTable1 =  '`'.trim($_GET['tableName_']).'`';
	$sTable =  trim($_GET['tableName_']);
	
	/* Database connection information */
	$gaSql['user']       = $myUser;
	$gaSql['password']   = $myPass;
	$gaSql['db']         = $myDB;
	$gaSql['server']     = $myServer;
 
 
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * Local functions
	 */
	
	$dellCondition = ($trashCond == 'trash')?'`delete_status`=1':'`delete_status`!=1';
	
	
	
	
	
	function fatal_error ( $sErrorMessage = '' )
	{
		header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		die( $sErrorMessage );
	}

	
	/* 
	 * MySQL connection
	 */
	if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
	{
		fatal_error( 'Could not open connection to server' );
	}

	if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
	{
		fatal_error( 'Could not select database ' );
	}

	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}else{
		
		$sOrder = "ORDER BY `$aColumns[0]` DESC";
 
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
			{
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	 $deleteCollm1 =  " AND $dellCondition";
		 
	   if(trim($other_query) != ''){
		   $other_query = (trim($sWhere) == '')?' WHERE '.$other_query." $deleteCollm1 ":" AND $other_query  $deleteCollm1 ";   
	   }else  if(trim($other_query) == ''){
		    $other_query =  (trim($sWhere) == '')?" WHERE $dellCondition ":" AND  $dellCondition "; 	  
	   }


	   

	

	
	/* Total data set length */
	
	   $deleteColll =  "$dellCondition";
	   $other_query2 = (trim($other_query2) == '')?" $deleteColll ":"$other_query2  AND $deleteColll";   
	 
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable1 WHERE $other_query2 
	";
 
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	// custom arrays
	$formarted_colms = Array('w_single_cost','total_quantity','total_single-cost','total_total-Cost','total_paid','total_balance','total_cost','quantity','single-cost','total-Cost','paid','balance','cost','number-or-workers');
	$not_Allowed_colms = Array('supplier-account-id','id');
    $blue_collms = Array('total_balance','balance');
	
 
 	 if($sTable == 'suppliers' || $trashCond == true){
	 $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM  $sTable1
		$sWhere
		$other_query
		$sOrder
		$sLimit
		"; 
 // echo  $sQuery;  die();
  
	     $rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );	
		

	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	 /*
	 * Output
	 */
 	
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
 
 
	     while($aRow = mysql_fetch_array( $rResult ))
			{
				$row = array();
				$row_edit = array();

				$current_Row_id = '';
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					
					
					
				   if(in_array($aColumns[$i],$not_Allowed_colms)) //  detect IDs collms 
					 {
									 // skip colls are not allowed 
						 $current_Row_id = $aRow[ $aColumns[$i] ]; 
		 
					 }else{	 // continue allowed collms
						if ( $aColumns[$i] == "version" )
						{
							/* Special output formatting for 'version' column */
							$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
							
						}
						else if ( $aColumns[$i] != ' ' )
						{
							/* General output */
							
				 
										if(in_array($aColumns[$i],$formarted_colms)) // detect the colms to formart 22,22,22,
											  {
											 
											 
											 
											   // quantity
											  if($aColumns[$i] == 'total_quantity') // detect the colms to formart 22,22,22,
											  {
												 $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ]):$aRow[ $aColumns[$i] ];
											  
											  }else{
												 $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ],2):$aRow[ $aColumns[$i] ];
											   
											  }
											 
											 
											 $row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
											  $row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ];
											}else{
											
											 	if($aColumns[$i] == 'created_date' || $aColumns[$i] == 'date') { // detect created_date then formart
												$row[] =  date('d/M/Y',$aRow[$aColumns[$i]]);  
												$row_edit[$aColumns[$i]] = date('d/M/Y',$aRow[$aColumns[$i]]);  
										       }else{
												$colVal =  $aRow[ $aColumns[$i] ];  
												$row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
												$row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ]; // ($aColumns[$i] == 'date')?date('d/M/Y',$aRow[$aColumns[$i]]):
											   }
												
											
												
											  }
							   
					 
						}
					 }
					  
				} 
				
				$onclick_view = "load_function('','suppliers-history','$current_Row_id','suppliers-history')";
				$id_dell = ($sTable == 'suppliers')?'supplier-account-id':'id';
		      
		     
				$view = ($sTable == 'suppliers')?'<button onclick="'.$onclick_view.'" class="delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to view the Account  "   role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-circle-edit"></span><span class="ui-button-text">View</span></button>':'';	
			   
				 $row_edit['tableName'] = $sTable;
				 $row_edit['id'] = $current_Row_id;
				 $row_edit['product_type'] = ($sTable == 'suppliers-history')?mysql_result(mysql_query("SELECT `product-type` FROM $sTable1 WHERE `id`=$current_Row_id "),0):'';
			 
			  
				$editJson = str_replace('-',"_",json_encode($row_edit));

				$edit = '<button onclick=" edit($(this).parents().parents().parents().parents().parents().find(\'th:first\'),'.str_replace('"',"'",$editJson).'); " class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" message="" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Edit</span></button>';
				$delete = '<button onclick=\'delete_($(this).parents().parents().parents().parents().parents().find("th:first"),'.$current_Row_id.',"'.$sTable.'","'.$id_dell.'")\'   class="delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Delete "  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-trash"></span><span class="ui-button-text">Delete</span></button>';	
		        $restorBtn = '<button onclick=\'restore($(this).parents().parents().parents().parents().parents().find("th:first"),'.$current_Row_id.',"'.$sTable.'","'.$id_dell.'")\'   class="delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Restore "    role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon  arrowreturnthick-1-s"></span><span class="ui-button-text">Restore</span></button>';	

				$btns = (preg_match('/project-name/',$other_query2))?'':'<pre>'. $view.' | '.$edit.' | '.$delete .' </pre>';
				
				
				
               
					// add suppName and mobile for trash payment_history
				  if(trim($sTable) == 'payment_history' && $trashCond == true){
					    $suppAccoundId  = mysql_result(mysql_query("SELECT `supplier-account-id` FROM  $sTable1 WHERE `id`=$current_Row_id"),0);
		                 $row[] =  mysql_result(mysql_query("SELECT `supplier-name` FROM suppliers WHERE `supplier-account-id` = '$suppAccoundId' "),0);
	                     $row[] =mysql_result(mysql_query("SELECT `mobile` FROM suppliers WHERE `supplier-account-id` = '$suppAccoundId' "),0);
		   	  
				      }
				  // actions
				$row[] = ($trashCond == true)?$restorBtn:$btns;
				
				$output['aaData'][] = $row;  
			  
			}
		 echo json_encode( $output );
	 }else{
		 
 
	$firstDate =  mysql_result(mysql_query("SELECT `date` FROM   $sTable1 $sWhere $other_query ORDER BY `date` ASC LIMIT 1"),0);	
    $lastDate =   mysql_result(mysql_query("SELECT `date` FROM   $sTable1 $sWhere $other_query ORDER BY `date` DESC LIMIT 1"),0);
 // echo "fist date :".$firstDate."  last Date:".$lastDate;
 //echo "<br>days $number_of_days   dd:$firstDate  ddf: $lastDate";
 
      $number_of_days = $lastDate - $firstDate;	
	  $number_of_days  =  floor($number_of_days/(60*60*24));
	   $number_of_days  =  $number_of_days + 1;
 
     $from = '';
     $to = '';	 
		function nex_featuredDay($date){ 
		    $date = date('d-M-Y',$date);
		     $totalDayName =  mysql_result(mysql_query("SELECT `total_days` FROM `adminSettings` LIMIT 1 "),0);
		 	return strtotime("next $totalDayName",strtotime($date));
           }
		
  $dayName = '';
  $timeToggle =  mysql_result(mysql_query("SELECT `total_days` FROM `adminSettings` LIMIT 1 "),0).', ';
  
   $row_int = 0;   
   $row_int2 = 0;  
 
 
 	 /*
	 * Output
	 */
 	
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"aaData" => array()
	);
 
       // limit dataTable rows
     
	 $limit_array = explode(',',$sLimit);
	  $limit_array[0] =  (!$sLimit)?0:intval(str_replace('LIMIT','',$limit_array[0]));
	  
	  $limit_array[1] =  (!$sLimit)?mysql_result(mysql_query("SELECT count(`$sIndexColumn`) FROM  $sTable1 $oo $weakly $sOrder"),0):intval($limit_array[1]);  
	  
	  
	 
	  
	  
 // echo 'down :'.$limit_array[0];
// echo "<br> ofset:".$limit_array[1];
 
 
 
     for($i=0;$i<$number_of_days;$i++){
 
 
				
	 if($from == ''){
			 // first loop 
			 $from = $firstDate; 
			 $to = nex_featuredDay($firstDate); 
	    }else{
			
			if($dayName == ''){
			      $dayName =  mysql_result(mysql_query("SELECT `total_days` FROM `adminSettings` LIMIT 1 "),0);	
			}
 	
		  // in  loop 
			$from = $to;   
			$to = nex_featuredDay($to); 
	    }
	 
	

     // stop the loop if the current Date is > lastDate
    // echo 'from: '.date('d/M/Y',$from); echo '  to : '.date('d/M/Y',$to).'<br>';
     if($from > $lastDate){
 	      break;
	 }else{
		// echo date('d/M/Y',$from); echo '<br>';
	 }

	$oo = "$sWhere $other_query";
	$wlCond = (trim($oo) == '')?' WHERE ':'AND'; 
	$weakly = " $wlCond `date` >= '$from' AND `date` <= '$to'";
	 
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM  $sTable1
		$oo
		$weakly
		$sOrder
		";
 
		
	   // echo $sQuery;  
	 // echo '<br>';  
		// skip empty weak
 	   if(mysql_result(mysql_query("SELECT count(`$sIndexColumn`) FROM  $sTable1 $oo $weakly $sOrder"),0) !='0'){
	 $rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );	
 
			while ( $aRow = mysql_fetch_array( $rResult ) )
			{
				
			    if($limit_array[1] == '0'){ // break the loop limit is finished
					break;    
				  }
				
				$row = array();
				$row_edit = array();

				$current_Row_id = '';
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{	
					
					
				   if(in_array($aColumns[$i],$not_Allowed_colms)) //  detect IDs collms 
					 {
									 // skip colls are not allowed 
						 $current_Row_id = $aRow[ $aColumns[$i] ]; 
		 
					 }else{	 // continue allowed collms
						if ( $aColumns[$i] == "version" )
						{
							// Special output formatting for 'version' column
							$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
							
						}
						else if ( $aColumns[$i] != ' ' )
						{
							///General output
				  
										if(in_array($aColumns[$i],$formarted_colms)) // detect the colms to formart 22,22,22,
											  {
											 
											  // quantity
											  if($aColumns[$i] == 'quantity') // detect the colms to formart 22,22,22,
											  {
												    $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ]):$aRow[ $aColumns[$i] ];
											  
											  }else{
												 $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ],2):$aRow[ $aColumns[$i] ];
											   
											  }
											 
											  
											  
											  $row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
											  $row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ];
											
											
											}else{
											
											if($aColumns[$i] == 'created_date' || $aColumns[$i] == 'date') { // detect created_date then formart
												$row[] =  date('d/M/Y',$aRow[$aColumns[$i]]);  
												$row_edit[$aColumns[$i]] = date('d/M/Y',$aRow[$aColumns[$i]]);  
										       }else{
												$colVal =  $aRow[ $aColumns[$i] ];  
												$row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
												$row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ]; // ($aColumns[$i] == 'date')?date('d/M/Y',$aRow[$aColumns[$i]]):
											   }
									  
												
											  }
							   
					 
						}
					 }
					  
				} 
				
				$onclick_view = "load_function('','suppliers-history','$current_Row_id','suppliers-history')";
				$id_dell = ($sTable == 'suppliers')?'supplier-account-id':'id';
		 
				$view = ($sTable == 'suppliers')?'<button onclick="'.$onclick_view.'" class="delell ui-button ui-widget ui-state-default ui-corn