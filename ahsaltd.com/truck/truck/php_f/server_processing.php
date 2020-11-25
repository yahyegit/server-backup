<?php
  require '../includes/inc_func.php';
  
  
 
  
	$aColumns =  explode(",",trim($_GET['collms_'])); // collumn names for the database
//echo $_GET['collms'] die();
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn =  trim($_GET['primaryKey_']);  
	$_GET['other_query_'] = str_replace('~','%',$_GET['other_query_']);
	
	$trashCond = (trim($_GET['other_query_']) == 'trash')?true:false;
	$filteredTotalsStatus = false;
// other query 
    if(trim($_GET['other_query_']) == 'unique_tracks' || trim($_GET['other_query_']) == 'unique_drivers'){
	  $other_query = '';
	  $other_query2 = '';  
	  
      $filteredTotalsStatus = false;
	}else{
		$filteredTotalsStatus = true;
			$other_query =   (trim($_GET['other_query_']) == 'trash')?'':trim($_GET['other_query_']);
	         $other_query2 =   (trim($_GET['other_query_']) == 'trash')?'':trim($_GET['other_query_']);
	}
	
	
 
   if(trim($_GET['other_query_']) == 'unique_tracks' || trim($_GET['other_query_']) == 'unique_drivers'){
	    $distinct = 'DISTINCT';
	}else{
		$distinct ='';
	}
		
	
	
	
	
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
		
		if(trim($_GET['iDisplayLength']) == 'NaN'){
				 $sLimit = '';
			}else{
				
		        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			     intval( $_GET['iDisplayLength'] );
			
			}
			
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
				
				if (!empty($aColumns[ intval( $_GET['iSortCol_'.$i] ) ])){
					
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
				
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";	
				}else{
					$sOrder = "ORDER BY `$aColumns[0]` DESC, ";
				}

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
		SELECT  $distinct COUNT(`".$sIndexColumn."`)
		FROM   $sTable1 WHERE $other_query2 
	";
 
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	// custom arrays
	$formarted_colms = Array('w_single_cost','total_quantity','unit_price','total_total-Cost','total_paid','total_balance','total_cost','quantity','single-cost','total-Cost','paid','balance','cost','number-or-workers');
	$not_Allowed_colms = Array('id');
    $blue_collms = Array('total_balance','balance');
	

	 $sQuery = "
		SELECT $distinct SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM  $sTable1
		$sWhere
		$other_query
		$sOrder
		$sLimit
		"; 
	//	echo  $sQuery;  die();
  
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
	 
	 
	 
	 
	 	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable1 WHERE $other_query2 
	";
 
 
 
 
 	
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
 
 
         $filterdTotals = '';
 
 
	     while($aRow = mysql_fetch_array( $rResult ))
			{
				$row = array();
				$row_edit = array();
                $truckNo = '';
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
											  if($aColumns[$i] == 'quantity') // detect the colms to formart 22,22,22,
											  {
												 $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ]):$aRow[ $aColumns[$i] ];
											  
											  }else{
												 $colVal = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ],2):$aRow[ $aColumns[$i] ];
											   
											  }
											 
											 
											 $row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
											  $row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ];
											}else{
											
											 
												$colVal =  $aRow[ $aColumns[$i] ];  
												$row[] = (in_array($aColumns[$i],$blue_collms))?"<b style='color:blue; font-weight:bold;'>$colVal</b>":$colVal;
												$row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ]; // ($aColumns[$i] == 'date')?date('d/M/Y',$aRow[$aColumns[$i]]):
											    
												
												
											  }
											  
							      if($aColumns[$i] == 'truck_no'){
									 $truckNo = $aRow[ $aColumns[$i] ];
								  }else if($aColumns[$i] == 'cost'){
									  $filterdTotals['cost'] = $filterdTotals['cost'] + $aRow[ $aColumns[$i] ];
							      }else if($aColumns[$i] == 'quantity'){
									   $filterdTotals['quantity'] = $filterdTotals['quantity'] + $aRow[ $aColumns[$i] ];
								  }
								  
								  
								 
								   
					 
						}
					 }
					  
				} 
				
				$id_dell = ($sTable == 'suppliers')?'supplier-account-id':'id';
		
				 
				 
				 $row_edit['tableName'] = $sTable;
				  $row_edit['id'] = $current_Row_id;
				  $dellTable = $sTable;
				  $dellValue = $current_Row_id;
			    if(trim($_GET['other_query_']) == 'unique_tracks'){
					 $addStatus = 'editTruck'; 
					 $viewID = 
					 $row_edit['id'] = $row_edit['truck_no'];  
					 $dellTable = 'dellTruck';
					 $dellValue = $row_edit['truck_no'];
					 
					 $restoreValue = $row_edit['truck_no'];
					$restsTable = 'restTruck';
				}else if(trim($_GET['other_query_']) == 'unique_drivers'){
					 $addStatus = 'editDriver';
					 $viewID = $row_edit['driverLicenseNo'];
					 $row_edit['id'] = $row_edit['driverLicenseNo'];				 
				}else{
					 $addStatus = 'edit';
				}
				
				if($sTable == 'expense'){
					$exName = explode(',',$row_edit['name']);				
					$row_edit['name'] = str_replace(')','',str_replace(' Truck No (','',str_replace(')','',str_replace(' Driver license No (','',$exName[0]))));
					$row_edit['truck_no'] =  str_replace(')','',str_replace(' Truck No (','',$exName[2]));    
					$row_edit['driverLicenseNo'] = str_replace(')','',str_replace(' Driver license No (','',$exName[1]));
				}
				$onclick_view = (trim($_GET['other_query_']) == 'unique_tracks')?"load_function('','truckHistry','$viewID','truckHistry')":"load_function('','driverHistry','$viewID','driverHistry')";
				 $view = '<button onclick="'.$onclick_view.'" class="viewHistory delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to see more"   role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-circle-edit"></span><span class="ui-button-text">Show Truck info ('.$row_edit['truck_no'].')</span></button>';	
			   
				
				$row_edit['addStatus'] = $addStatus;
				$editJson = str_replace('-',"_",json_encode($row_edit));
 
				$edit = '<button onclick="edit($(this).parents().parents().parents().parents().parents().find(\'th:first\'),'.str_replace('"',"'",$editJson).');" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" message="" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Edit</span></button>';
				$delete = '<button onclick=\'delete_($(this).parents().parents().parents().parents().parents().find("th:first"),'.$current_Row_id.',"'.$dellTable.'","'.$dellValue.'")\'   class="delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Delete "  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-trash"></span><span class="ui-button-text">Delete</span></button>';	
		        $restorBtn = '<button onclick=\'restore($(this).parents().parents().parents().parents().parents().find("th:first"),'.$current_Row_id.',"'.$restsTable.'","'.$restoreValue.'")\'   class="delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to Restore "    role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon  arrowreturnthick-1-s"></span><span class="ui-button-text">Restore</span></button>';	
 

				$showTripHistory ='';
				  $add_btn = '';
				if( $sTable == 'trucks'){
					// profit 
					$add_btn = '<h3 class="h3"> <a class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: right; font-size: 0.7em; float: left;" title=" " role="button" aria-disabled="false" onclick="add($(this).parents().parents().find(\'table.dataTable:first th:first\'),$(this).parents().parents().find(\'table.dataTable:last th:first\'),getAddArgs(\'trucks\',\'\',\'\',\'add\'),'.str_replace('"',"'",$editJson).');"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text">Add Trip to Truck ('.$row_edit['truck_no'].') </span></a></h3>';
	                $add_exp = '<a onclick=\"add($(this).parents().parents().find(\'table.dataTable:first th:first\'),\'\',getAddArgs(\'expense\',\'\',\'\',\'add\'),'.str_replace('"',"'",$editJson).')\" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="float: left; font-size: 0.7em;" title="" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span><span class="ui-button-text"> Add Expenses to Truck ('.$row_edit['truck_no'].') </span></a>  ';
	     	         $add_btn = (empty($other_query))?$add_btn.' | '.$add_exp:'';
					$rowExp = mysql_result(mysql_query("SELECT sum(`cost`) FROM `expense` WHERE `name` like '%, Truck No (".$row_edit['truck_no'].")' AND `tripId`='".$current_Row_id."' AND `delete_status` !='1' "),0);

				    $profitCalc = $row_edit['cost'] - $rowExp;
					$filterdTotals['profit'] = $filterdTotals['profit'] + $profitCalc; 
					
					$profit_row = '<b style=color:'.((preg_match('/-/',$profitCalc))?'red':'green').'>'.number_format($profitCalc,2).'</b>';
				  $row[] = $profit_row;
				$showTripHistory = '<button onclick="trip_exp_history(\''.number_format($rowExp,2).'\',\''.$profit_row.'\',\''.number_format($row_edit['cost'],2).'\',\''.$row_edit['truck_no'].'\',\''.$row_edit['date'].'\',\''.$row_edit['source'].'\',\''.$row_edit['distination'].'\',\''.$current_Row_id.'\')" class="viewHistory delell ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" hover="click to see more"   role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-circle-edit"></span><span class="ui-button-text">Show Expenses for trip</span></button>';	
			   
				
				}
				
				 // actions
				$view = (!$filteredTotalsStatus)?$view:$showTripHistory;
				$btns = (preg_match('/project-name/',$other_query2))?'':'<pre>'.$view .' | '.$edit.' | '.$delete .' </pre>';
			 
				$row[] = ($trashCond == true)?$restorBtn: $add_btn.' | '.$btns;
				
				$output['aaData'][] = $row;  
		
			  
			}
		 
	
		 
		 
			//	filterd totals
         if($filteredTotalsStatus){
			 $fiterd_title_price = (preg_match('/-/',$_GET['sSearch']))?"Total Price for (".$_GET['sSearch'].')':'total Filterd Price';  
			 $fiterd_title_profit = (preg_match('/-/',$_GET['sSearch']))?"Total Income for (".$_GET['sSearch'].')':'total Filterd Income';  
	          $fiterd_title_cost = (preg_match('/-/',$_GET['sSearch']))?"Total Cost for (".$_GET['sSearch'].')':'total Filterd Cost';  
             $fiterd_title_Quantiy = (preg_match('/-/',$_GET['sSearch']))?"Total Quantity for (".$_GET['sSearch'].')':'total  Filterd Quantity';  


			   if( $sTable == 'trucks'){ // trucks
				$profitFormat = '<b style="color:'.((preg_match('/-/',$filterdTotals['profit']))?'red':'green').';">'.number_format($filterdTotals['profit'],2).'</b>';

				$output['aaData'][] = Array("<div class='weaklyTotals'><table class='table'><tbody><tr><th>$fiterd_title_price</th> <td  class='td_not_remove_dt'>".number_format($filterdTotals['cost'],2)."</td> <th>$fiterd_title_profit</th> <td  class='td_not_remove_dt'>".$profitFormat."</td>  </tbody></table></div>");
			 
				}else if( $sTable == 'expense'){  // expense
				
				$output['aaData'][] =   Array("<div class='weaklyTotals'><table class='table'><tbody><tr><th>$fiterd_title_Quantiy</th> <td  class='td_not_remove_dt'>".number_format($filterdTotals['quantity'],2)."</td> <th>$fiterd_title_cost</th> <td  class='td_not_remove_dt'>".number_format($filterdTotals['cost'],2)."</td>  </tbody></table></div>");
			 
				} 
		 
		   }
      echo json_encode( $output );
	 
	 ?>
	
 
 
