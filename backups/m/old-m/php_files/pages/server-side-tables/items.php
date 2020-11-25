 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'id,item_name,price,remainings,remaining_cost');

	$sIndexColumn =  'id';  
	$other_query =   trim(str_replace('~', '', $_GET['other_query']));


  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'items';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`item_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `price` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `remainings` LIKE '%".sanitize($_GET['sSearch'])."%'   ";
 	$default_order = 'item_name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 
// <th> item  </th> <th>  remainings </th><th> price </th>  <th> balance </th> <th> action </th> 
 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult)){
 	
          $row = array();	
 
 
$row[] = "{$aRow['item_name']}  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/other_pages/received_history.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>show received history</span></button> ";
 
$row[] = number_format($aRow['remainings'])." <span class='gray'> oo kuugu fadhiya </span>$ccc.".number_format($aRow['remaining_cost'],2)." <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/receive_items_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'></span></button>  ";


$row[] = $ccc.number_format($aRow['price'],2)." <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/change_price_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button>  ";


 
 
 
			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/change_price_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting {$aRow['item_name']} ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button> </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
