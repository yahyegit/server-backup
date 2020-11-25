<?php
  require '../includes/inc_func.php';
  // validate other query using witelisting 
 //  $allowed_in_otherQuery = array('=','%','"',"'",);

 

   

  	// date validator


	$date_valid = str_replace(' ', '-', str_replace('/', '-', str_replace('\\', '-', sanitize($_GET['sSearch']))));
  	$date_valid_split = explode('-',$date_valid);
	$dateCount = explode('-',$date_valid);
	$date_status = '';
	$th_date = '';

	if(date('Y',strtotime($date_valid)) != '1969'){

		if(preg_match('/-/', $date_valid) && count($dateCount) == '3'){  // day
		
				if(end($date_valid_split) < 10 && strlen(end($date_valid_split)) != 2){
		 			 $_GET['sSearch'] = date('d-m-Y',strtotime("$date_valid_split[0]-$date_valid_split[1]-0$date_valid_split[2]"));
		 			 $th_date = date('d-M-Y',strtotime("$date_valid_split[0]-$date_valid_split[1]-0$date_valid_split[2]"));
				}else{
					 $_GET['sSearch'] = date('Y-m-d',strtotime($date_valid));
					 $th_date = date('d-M-Y',strtotime($date_valid));
				}
		}else if(preg_match('/-/', $date_valid) && count($dateCount) == '2'){  // month	 
		 	 $_GET['sSearch'] = date('Y-m',strtotime($date_valid));

		 	$th_date = date('M-Y',strtotime($date_valid));
		}else{ // year

			$th_date = date('Y',strtotime($date_valid));
		}   

		$date_status = 'on';
	}else{
		$date_status = 'off';
	}
	// detect mobile 
	if(date('Y',strtotime($date_valid)) == '1969'){
		$mobile_valid = trim(implode('',explode('-',trim(sanitize($_GET['sSearch'])))));
		 if(ctype_digit(str_replace('+','',$mobile_valid))){
		 		$_GET['sSearch'] = $mobile_valid;	
		 }
	 }



	 // due-date correction 
	$currentDate = date('Y-m-d');

	$aColumns = explode(",",trim(str_replace(' ','',sanitize($_GET['colmns']))));  
	$sIndexColumn =  trim(sanitize($_GET['primary_key']));  
	$where_other_query = str_replace('`due_date`!=0000-00-00',"`due_date`!='0000-00-00'", str_replace('`due_date`<=111',"`due_date`<='$currentDate'", str_replace('~','%',str_replace('|',"'",$_GET['where_query']))));  // can't start with 'where' or 'and'

	$where_other_query2 = $where_other_query;



 	$not_deleted = '`delete_status`!=1';
 	/* DB table to use */    	 
	$sTable =  trim(sanitize($_GET['table']));
	$table_type =  trim(sanitize($_GET['table_type']));

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
	if ( isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1' )
	{
		
		if(trim(sanitize($_GET['iDisplayLength'])) == 'NaN'){
				 $sLimit = '';
			}else{
				
		        $sLimit = "LIMIT ".intval( sanitize($_GET['iDisplayStart']) ).", ".
			     intval( sanitize($_GET['iDisplayLength']) );
			
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
		if($date_status == 'on'){ // only accept date  
			$date_colmn = ($sTable == 'rented_cars')?'`from`':'`date`';
			$sWhere .= "$date_colmn LIKE '%".mysql_real_escape_string( sanitize($_GET['sSearch']) )."%'";
		}else{
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
				{
					

					$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( sanitize($_GET['sSearch']) )."%' OR ";
				}
			}
		}
		if($date_status != 'on'){ // only accept date  	
			$sWhere = substr_replace( $sWhere, "", -3 );
		}
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && sanitize($_GET['sSearch_'.$i]) != '' )
		{
			
		if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string(sanitize($_GET['sSearch_'.$i]))."%' ";
		}
	}
	

 
 
	
	/* Total data set length */

	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM $sTable WHERE ".((empty($where_other_query))?"":"$where_other_query and")." $not_deleted";


	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_error() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	// custom arrays
	$formarted_colms = Array('quantity','price','cost','paid','balance','customer_name');
	$not_Allowed_colms = Array('id','car_id','customer_id');
    $red_collms = Array('balance');
	

     $where_other_query = (empty($sWhere))?((!empty($where_other_query))?"WHERE $where_other_query and $not_deleted":"where $not_deleted"):((!empty($where_other_query))?"AND $where_other_query AND $not_deleted":"AND $not_deleted");

     $totals = '';	// table totals

	 $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM  $sTable
		$sWhere
		$where_other_query
		$sOrder
		$sLimit
		"; 
 	  //die($sQuery);
  
	     $rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_error() );	
		

	$date_search_st = '';  


	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_error() );
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	 /*
	 * Output
	 */
	 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
 
 	

  
 // car_account_income, car_account_expense   customer_account_cars  customer_account_debts    customer_account_overDue      customer_account_payments        others          
	     while($aRow = mysql_fetch_array( $rResult ))
			{
				$row = array();
				$row_edit = array();
				$current_Row_id = '';
				$current_price = '';
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					
					 
				   if(in_array($aColumns[$i],$not_Allowed_colms)) //  detect IDs collms 
					 {
		
					 	 if( $aColumns[$i] == 'customer_id' && $table_type == 'income'){
							   $row[] = get_customer_account($aRow[ $aColumns[$i] ],'2');
					 	 }else if( $aColumns[$i] == 'customer_id' && $table_type == 'expense'){
					 	 	     $row[] = get_customer_account($aRow[ $aColumns[$i] ],'2');
								$row_edit['customer_name'] = mysql_result(mysql_query("SELECT `customer_name` FROM `customers` WHERE `customer_id`=".$aRow[ $aColumns[$i] ].""), 0);
					 	 }else if( $aColumns[$i] == 'customer_id' && $sTable == 'rented_cars'){
					 	 		$cust_id = mysql_result(mysql_query("SELECT `customer_id` FROM $sTable WHERE `id`='$current_Row_id'"),0);
					 	 		$row[] = get_customer_account($cust_id,'2');
					 	 }else if( $aColumns[$i] == 'car_id' && $table_type == 'expense'){
							$row[] = get_car_account($aRow[ $aColumns[$i] ],'2');
							$row_edit['car_name'] = $carNameEx;
					 	 }else{
					 	 			 // skip colls are not allowed 
						 $current_Row_id = $aRow[ $aColumns[$i] ]; 
		 	
					 	 }
						

					 }else{	 // continue allowed collms
					 
 
						  if( $aColumns[$i] != '' )
						  	{	

				 						
										if(in_array($aColumns[$i],$formarted_colms)) // detect the colms to formart 22,22,22,
											  {
											 
																																					 
																																																				 
														   // quantity
														  if($aColumns[$i] == 'quantity') // detect the colms to formart 22,22,22,
														  {
														  	 $row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 

															 $row[] = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ]):$aRow[ $aColumns[$i] ];
														  
														  }else{
														  	if($aColumns[$i] == 'customer_name' && trim($sTable) == 'customers'){
																
																$row[] = get_customer_account($current_Row_id,'2');
														 		$row_edit[$aColumns[$i]] = $aRow[ $aColumns[$i] ]; 

																$val = number_format(mysql_result(mysql_query("SELECT sum(`balance`) FROM `rented_cars` WHERE `customer_id`=$current_Row_id AND `delete_status`!='1' "), 0),2);

																if(trim($val) != '0.00') {
														  	 		 $row[] = "<pre>$us_<b class='redBalance'> $val</b> $ksh , ".'<a href="#" onclick=\'make_payment({current_date:"'.$currentDate.'",title:"'.$aRow[$aColumns[$i]].'",status:"ready",customer_id:'.$current_Row_id.',current_debt:"'.mysql_result(mysql_query("SELECT sum(`balance`) FROM `rented_cars` WHERE `customer_id`=$current_Row_id AND `delete_status`!='1' "), 0).'"})\'  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> Pay now </span></a>'." </pre> ";
														  	 	}else{
														  	 		 $row[] = "$us_<b>  $val</b> $ksh";
														  	 	}		
														  	 }else if($aColumns[$i] == 'balance'){

																	$val = (!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ],2):$aRow[ $aColumns[$i] ];
														  	 


																	$row_edit[$aColumns[$i]] =  str_replace(',','',$val); 
															  	 	
															  	 	if(!empty($val)){
															  	 		 $row[] = "<pre> $us_<b class='redBalance'>$val</b> $ksh </pre>";
															  	 	}else{
															  	 		 $row[] = "<pre> $us_<b>$val</b> $ksh </pre>";
															  	 	}
														  	 
														  	  }else if($aColumns[$i] == 'price' && $sTable == 'cars'){
 																	$current_price = "$us_".number_format($aRow[ $aColumns[$i] ],2)." $ksh".' per '.mysql_result(mysql_query("select price_type from cars where car_id=$current_Row_id"), 0);
 														 			 $row[] = "<pre>$current_price</pre>";
 														 			  $row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i]]; 

														  	  }else{
														  	  $row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i]]; 

															    $row[] = "<pre>$us_".((!empty($aRow[ $aColumns[$i]]))?number_format($aRow[ $aColumns[$i] ],2):$aRow[ $aColumns[$i] ])." $ksh</pre>";
														      }
														  }
											 
											 
											}else{
											
											   // date formating 
				 if(trim($sTable) == 'cars' && $aColumns[$i] == 'car_name'){

			$row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 
													$row[] = $aRow[ $aColumns[$i] ].',   
 <a href="#" onclick=\'add_({"carName":"'.$aRow[ $aColumns[$i] ].'"}) \'  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text">Rent Now </span></a> ';


											}else if(trim($sTable) == 'rented_cars' && $aColumns[$i] == 'from'){
															
															$from = $aRow[ $aColumns[$i] ];
															$to = mysql_result(mysql_query("select `to` from rented_cars where id=$current_Row_id"), 0);
															$price_type_ = mysql_result(mysql_query("select price_type from rented_cars where id=$current_Row_id"), 0);

												 			$row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 
												 			$row_edit['to'] = $to;

															// 	e.g: // from sun, Y/M/d to sun, Y/M/d, 3 weeks
															$row[] = '<span style="font-weight: bold;">from </span>'.date('D, d/M/Y',strtotime($from)).' <span style="font-weight: bold;"> to </span>'.date('D, d/M/Y',strtotime($to)).', '.format_rented_date($from,$to,$price_type_);
												}else if($aColumns[$i] == 'date'){
													     $row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 
														 $row[] = date('D, d/M/Y',strtotime($aRow[ $aColumns[$i] ]));
												}else if( $aColumns[$i] == 'due_date' ){

														if(trim($aRow[ $aColumns[$i] ]) != '0000-00-00'){

		 												$row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 


																 if(strtotime($aRow[ $aColumns[$i]]) <= strtotime(date('Y-m-d')) && !empty(mysql_result(mysql_query("select balance from rented_cars where id=$current_Row_id"), 0))){
												 					 $row[] = date('D, d/M/Y',strtotime($aRow[ $aColumns[$i] ])).', <span style="color:red">'.timeago($aRow[ $aColumns[$i]]).'</span>';

																	 }else{
																			$row[] = date('D, d/M/Y',strtotime($aRow[ $aColumns[$i] ])).', '.timeago($aRow[ $aColumns[$i]]);
																	 }
														}else{
															$row[] = '';
														}
												}else if( $aColumns[$i] == 'car_name' && $sTable != 'payments'){
													$car_id_ac = mysql_result(mysql_query("SELECT `car_id` FROM `cars` WHERE `car_name`='".$aRow[ $aColumns[$i] ]."'"), 0);	
														if(empty($car_id_ac)){
															 $row[] = $aRow[ $aColumns[$i] ]; 
														}else{
															 $row[] = get_car_account($car_id_ac,'2');
												    	}

											    	 	$row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 
											    	}else{

													// other colmns 
													$row_edit[$aColumns[$i]] =  $aRow[ $aColumns[$i] ]; 
													$row[] = $aRow[ $aColumns[$i] ]; 

												}

											  }

    
					 
						}
					 }
					  
				} 
				
		 






if(trim($sTable) == 'customers'){
	$customer_account_id = $current_Row_id; 
	$customer__name = mysql_result(mysql_query("SELECT `customer_name` FROM `customers` WHERE `customer_id`='$current_Row_id'"), 0);
}else{
	$customer_account_id = mysql_result(mysql_query("SELECT `customer_id` FROM $sTable WHERE `id`='$current_Row_id'"), 0);
	$customer__name = mysql_result(mysql_query("SELECT `customer_name` FROM `customers` WHERE `customer_id`='$customer_account_id'"), 0);
}	

 $delete_ = array(
					 'id' => "$current_Row_id",
					 	"table" => "$sTable",
					 	"colmn" => "$sIndexColumn"
					  );


	if($table_type == 'cars'){

		$car_acount = get_car_account($current_Row_id);

//  <th> status </th><th> Last Rented </th>
// // status e.g: availble = green color or rented by <a> customer name link </a>  , Last Rented e.g : <td>Date</td>

	  //$cars_status
// $row[] =  $car_acount['car_status'];
	  //$last_rented
  
 $row[] = $car_acount['car_last_rented_date'] ;

	// updating edit 	
	$row_edit['price_type'] =  mysql_result(mysql_query("select price_type from cars where car_id='$current_Row_id'"), 0);
   $car_acount['car_last_rented_date'] = '';
	$view_page_btn = '<a href="#" onclick=\'data_table_creator('.htmlentities(json_encode($car_acount)).','.$current_Row_id.')\'  class="view_account ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> '.$car_acount['carName'].' </span></a>';
      
    $row[] = $view_page_btn; //  more collumn 
    $delete_['msg'] = 'Deleting <strong>'.$car_acount['carName'].'</strong>';

	}else if($table_type == 'customers' ){   

//die(json_encode($customer_acount));
		$view_page_btn = '<a href="#" onclick=\'data_table_creator('.str_replace('"',"'", htmlentities(json_encode(get_customer_account($customer_account_id,'')))).')\'  class="view_account ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> '.$customer__name.' </span></a>';

		$t_balance = mysql_result(mysql_query("select sum(balance) as t_balance from rented_cars where $where_other_query2 and $not_deleted "),0,'t_balance');
		$pay_now = (empty($t_balance))?'':'<a href="#" onclick=\'make_payment({current_date:"'.$currentDate.'",title:"'.$customer__name.'",status:"ready",customer_id:'.$customer_account_id.',current_debt:"'.$t_balance.'"})\'  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> Pay now </span></a>';

		$row[] = $view_page_btn; //  more collumn
		$delete_['msg'] = 'Deleting <strong>'.$customer__name.'</strong> !';
		$row_edit['customer_name'] = $customer__name;
	}else{
		$view_page_btn = '';
	}

	if($sTable == 'rented_cars'){
		$delete_['msg'] = 'Deleting Rented car !';
	}else if($sTable == 'payments'){
		$delete_['msg'] = 'Deleting Payment !';
	}else if($sTable == 'expense'){
		$delete_['msg'] = 'Deleting Expense !';
	}

 // car row 
/*	"<>"
 		$car_id = mysql_result(mysql_query("select car_id from `$sTable` "), row)
 		$view_page_btn = 'data_table_creator('.htmlentities(json_encode($car_acount)).',$(this).parent().parent().html();'
  	
*/
	 			 if($sTable == 'payments' | $sTable == 'rented_cars'){
	 			 	$edit_btn ='';
	 			 }else{

					

					 $row_edit['tableName'] = $sTable;
					 $row_edit[(($sTable == 'cars')?'car_id':'customer_id')] = $current_Row_id;

					 	if($sTable == 'cars'){
					 			$funcName = 'add_car';
					 	}else if($sTable == 'customers'){
					 			$funcName = 'edit_customer';
					 	}else if($sTable == 'expense'){
					 			$funcName = 'add_expense';
					 	}else{
					 		$funcName = '';
					 	}
		 
		 			 	$row_edit['status'] = 'edit';
		 			 	$row_edit['x_id'] = $current_Row_id;
		 			 	$row_edit =  json_encode($row_edit);
		 			 	$edit_btn = '<a href="#"   class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"   onclick=\''.$funcName.'('.$row_edit.')\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Edit</span></a>';
	 			 }

	 			 		 $delete_btn = 	'<a href="#" class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-state-hover" onclick=\'delete_('.json_encode($delete_).')\' role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-trash"></span><span class="ui-button-text">Delete</span></a>';	
 



				$buttons = $edit_btn." ".$delete_btn;

		


/*//  date
if($date_search_st == ''){
	$date_colmn = ($sTable == 'rented_cars')?'`from`':'`date`';
	$date_search = '<div class="date_search" style="display:none;"><select data-placeholder="choose..." onchange="searh_date($(this),$(this).parent().parent())"> <option>choose...</option>';
	if(@$q = mysql_query("SELECT DISTINCT $date_colmn FROM $sTable WHERE ".((empty($where_other_query2))?"":"$where_other_query2 and")." $not_deleted")){

		while($row = mysql_fetch_assoc($q)){
				if($sTable == 'rented_cars'){
					$date_search .= "<option>".$row['from']."</optoin>";
				}else{
					$date_search .= "<option>".$row['date']."</optoin>";
				}
		}
	}
	$date_search .= "$date_search</select> </div>";
	$date_search_st = 'done';
}*/

	// totals start 
if($totals ==''){

	if(preg_match('/customer_id/', $where_other_query2) && $sTable == 'payments'){ //  customer payments no date filtering
		$where_other_query2 = (!empty($where_other_query2))?"where $where_other_query2 and $not_deleted":"where $not_deleted";
	}else if(date('Y',strtotime($date_valid)) != '1969'){
     	$where_other_query2 = (!empty($where_other_query2))?"$sWhere and $where_other_query2  and $not_deleted":"$sWhere and $not_deleted";
	}else{
		$where_other_query2 = (!empty($where_other_query2))?"where $where_other_query2 and $not_deleted":"where $not_deleted";
	}

	if($sTable == 'rented_cars'){  // rants

  		$totol_query = mysql_query("select sum(price) as t_price, sum(paid) as t_paid, sum(balance) as t_balance from rented_cars $where_other_query2");
		$redBalance = (number_format(mysql_result($totol_query,0,'t_balance'),2) != '0.00')?'redBalance':'';
		$date_for = (date('Y',strtotime($date_valid)) != '1969')?"for $th_date":'';

		
		if($table_type != 'customers' ){ 
			$action = (number_format(mysql_result($totol_query,0,'t_balance'),2) != '0.00')?'<th>Action</th>':'';
		 		$pay_now_btn = '<a href="#" onclick=\'make_payment({current_date:"'.$currentDate.'", title:"'.$customer__name.'",status:"ready",customer_id:'.$customer_account_id.',current_debt:"'.mysql_result($totol_query,0,'t_balance').'"})\'  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> Pay now </span></a>';
				$action_btn = (number_format(mysql_result($totol_query,0,'t_balance'),2) != '0.00')?"<td> $pay_now_btn </td>":'';
		}else{
			$action = '';
			$pay_now_btn = '';
			$action_btn = '';
		}


		if(preg_match('/due_date/',$where_other_query2)){
		$totals = "<div class='totals_'> <table class='table totals_table' style='
    width: 50%;
    margin-left:0;
';  ><thead><tr><th>Total Over-due $date_for </th> $action </tr></thead> <tbody> <tr><td class='$redBalance'> $us_".number_format(mysql_result($totol_query,0,'t_balance'),2)." $ksh".'</td> '.$action_btn.' </tr></tbody></table> </div>';
		}else{
		$totals = "<div class='totals_' > <table class='table totals_table' width='100%'><thead><tr> <th> Total Price $date_for</th><th>Total Paid $date_for</th><th>Total Balance $date_for </th> $action  </tr></thead> <tbody> <tr> <td> $us_".number_format(mysql_result($totol_query,0,'t_price'),2)." $ksh ".' </td> <td>'."$us_".number_format(mysql_result($totol_query,0,'t_paid'),2)." $ksh ".' </td> <td class="'.$redBalance.'"> '."$us_".number_format(mysql_result($totol_query,0,'t_balance'),2)." $ksh".'</td> '.$action_btn.' </tr></tbody></table> </div>';
		}

	}else if($sTable == 'payments' || $sTable == 'expense'){  // income
		// only accept date filter 
		if($sTable == 'expense' && trim($where_other_query2) == 'car_id=21'){
			$totol_paid = mysql_result(mysql_query("select  sum(paid) as t_paid from payments ".str_replace('car_id=', "car_id like '%,",$where_other_query2.",%'")),0,'t_paid');
		}else{
			$totol_paid = mysql_result(mysql_query("select  sum(paid) as t_paid from payments $where_other_query2"),0,'t_paid');
		}
  		

		$totol_expense = mysql_result(mysql_query("select  sum(cost) as t_cost from expense $where_other_query2"),0,'t_cost');
		$current_balance = mysql_result(mysql_query("select  sum(balance) as t_balance from rented_cars $where_other_query2"),0,'t_balance');
		$redBalance = (number_format($current_balance) != '0.00')?'redBalance':'';
		$date_for = (date('Y',strtotime($date_valid)) != '1969')?"for $th_date":'';

		$profit = $totol_paid - $totol_expense;
		$profit_ = (preg_match('/-/',$profit))?'red':'green';

		if(preg_match('/customer_id/', $where_other_query2)){ // customer payments
		

				$action = (number_format($current_balance) != '0.00')?'<th>Action</th>':'';
			 		$pay_now_btn = '<a href="#" onclick=\'make_payment({current_date:"'.$currentDate.'", title:"'.$customer__name.'",status:"ready",customer_id:'.$customer_account_id.',current_debt:"'.$current_balance.'"})\'  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon "></span><span class="ui-button-text"> Pay now </span></a>';
					$action_btn = (number_format($current_balance) != '0.00')?"<td> $pay_now_btn </td>":'';
		 

			$thead = "<tr><th>Total paid </th><th>Current Balance </th> $action </tr>";	
			$td = '<tr> <td>'."$us_".number_format($totol_paid,2)." $ksh".' </td> <td class="'.$redBalance.'"> '."$us_".number_format($current_balance,2)." $ksh".' </td> '.$action_btn.'</tr>';	

		}else if($sTable == 'expense'){  // car expense or all expense 
			$thead = "<th>Total Expense $date_for</th> <th>Total Income $date_for</th><th> profit $date_for</th> ";	
			$td = '<tr>  <td>'."$us_".number_format($totol_expense,2)." $ksh".' </td><td>'."$us_".number_format($totol_paid,2)." $ksh".' </td> <td style="color:'.$profit_.';"> '."$us_".number_format($profit,2)." $ksh".' </td></tr>';	
		}else{  // car income or all income 
			$thead = "<th>Total Income $date_for</th><th>Total Expense $date_for</th><th> profit $date_for</th> ";	
			$td = '<tr> <td>'."$us_".number_format($totol_paid,2)." $ksh".' </td>  <td>'."$us_".number_format($totol_expense,2)." $ksh".' </td><td style="color:'.$profit_.';"> '."$us_".number_format($profit,2)." $ksh".' </td></tr>';	
		}


 		$totals = '<div class="totals_" style="display:hidden;"> <table class="table totals_table" width="100%"><thead>'.$thead.'</thead> <tbody> '.$td.' </tbody></table> </div>';

	}
}	
	// end of totals




				
			/*	if($date_search_st == 'sent'){
					$date_search = '';
				}else{
					$date_search_st = 'sent';
				}*/
				$row[] = $totals.$buttons;	// action collumn
				
				

				$output['aaData'][] = $row;  
		
                 $totals = ' ';
		 
		   }
      echo json_encode( $output );
	 
	 ?>
	
 
 
