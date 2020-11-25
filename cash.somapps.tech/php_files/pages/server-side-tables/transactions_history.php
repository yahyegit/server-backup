<?php

   require '../../clasess/dataBase_class.php';
  // require '../../clasess/extra_functions.php';

	$aColumns = explode(",",'id,customer_id,type,msg_type,date,description');  
	$sIndexColumn =  'id';  
	$default_order = 'date'; 
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));     
 	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`msg_type` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%'";

	$sTable =  'transactions'; // reports and customer account 

	include 'dataTable_exra.php';
 
 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" => mysqli_result_(mysqli_query_("select count(id) from $sTable where ".((trim($other_query) !='')?$other_query.' and ':'')." delete_status!='1'  "), 0),
 		"aaData" => array()
	);
 

      
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
				$row = array();
				$customer_name_ = mysqli_result_(mysqli_query_("select customer_name from customers where customer_id={$aRow['customer_id']}"), 0);
				if(!preg_match('/customer_id/', $other_query)){
					// add name  for reports 
					$row[] = "<button   class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['customer_id']},'customer_acount','pages/other_pages/customer_acount_page.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon  '></span><span class='ui-button-text'>$customer_name_</span></button>".'<i style="margin-left: 7px;font-weight:normal;" class="underline">'.mysqli_result_(mysqli_query_("select mobile from customers where customer_id={$aRow['customer_id']}"), 0).'</i>';
					 
				}   


				


 
				 $row[] = html_entity_decode($aRow['msg_type']);

				 if(preg_match('/date/', $other_query)){
				 	$row[] = '<a href="#" title="view reports for ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$aRow["date"].'\'},\'pages/other_pages/reports_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';// link 
				}else{
					 $row[] = date('d/M/Y',strtotime($aRow['date']));
				}

				 $row[] = $aRow['description']; 
			 



		// edit btn and delete btn   
 	$row[] = " <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Delete this transaction only for <strong>$customer_name_</strong> ?'})\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete</span></button>";
  
			    $output['aaData'][] = $row;  
			} 
				

		   $output['iTotalDisplayRecords'] =  count($output['aaData']); 
  
      echo json_encode( $output );
	 
	 ?>
	
 
 
