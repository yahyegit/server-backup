<?php

 include '../../clasess/db_connector.php';
  // require '../../clasess/extra_functions.php';
     include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

	$aColumns = explode(",",'id,customer_id,cash_in,cash_out,cash_balance,dollar_in,dollar_out,dollar_balance,date,description');  
	$sIndexColumn =  'id';  
	$default_order = 'date'; 
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));   
	$other_query2 = sanitize_other_query2(trim($_GET['other_query2']));   
	 $other_query  = (!empty($other_query2))?$other_query.' and '.$other_query2:$other_query;

 	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`cash_out` LIKE '%".sanitize($_GET['sSearch'])."%' OR `cash_in` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%'";
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
				$cust_name = '';
				if(!preg_match('/customer_id/', $other_query)){
					// add name  for reports 
					$cust_name = "<div class=\"underline pl\">  <button  title=\"click to see all transactions for $customer_name_  \" class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{customer_id:{$aRow['customer_id']}},'pages/other_pages/customer_acount_page.php')\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon  '></span><span class='ui-button-text'>$customer_name_</span></button>".'<i style="margin-left: 7px;font-weight:normal; border-bottom:1px solid #fafbfc; "  >'.mysqli_result_(mysqli_query_("select mobile from customers where customer_id={$aRow['customer_id']}"), 0).'</i> </div>';
					 
				}   








	 

				 if(preg_match('/customer_id/', $other_query)){
				 	$trans_date = '<a href="#" title="view transactions for '.$customer_name_.' on ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="r_page(\'\',{customer_id:'.$aRow['customer_id'].',date_from:\''.$aRow['date'].'\'},\'pages/other_pages/customer_acount_page.php\'); " role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';// link 
				}else{
					$trans_date = '<a href="#" title="view reports for ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$aRow["date"].'\'},\'pages/other_pages/reports_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';// link 
 				}


 

	$edit_btn = '';//"<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'','pages/forms/make_transction_form_page.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit</span></button>  ";
		// edit btn and delete btn   
 	 
$row[] = '
<div class="trans_panel_box dashboard_panel " style="margin-top:0px;">
'.$cust_name.'  
<div class="underline pl"> <span class="gray">In:</span> '.'<span >ksh'.number_format($aRow["cash_in"],2).' </span>'.'<span class="hr_"></span> '.'<span   >$'.number_format($aRow["dollar_in"],2).'</span>'.' </div>
<div class="underline pl"> <span class="gray">Out:</span> '.'<span >ksh'.number_format($aRow["cash_out"],2).' </span>'.'<span class="hr_"></span> '.'<span   >$'.number_format($aRow["dollar_out"],2).'</span>'.' </div>

<div class="underline pl">  <span class="gray">  Balance:</span> '.'<span class="'.toggle_debt_color($aRow["cash_balance"]).'" >ksh'.number_format($aRow["cash_balance"],2).'  </span><span class="hr_"></span>'.'<span class="'.toggle_debt_color($aRow["dollar_balance"]).'" >$'.number_format($aRow["dollar_balance"],2).'  </span> </div>

<div class="underline pl">   <span class="gray">Date:</span> '.$trans_date.' </div>
<div class="underline pl"><span class="gray">Description:</span> '.$aRow['description'].' 
</div>
        '." $edit_btn   <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Delete this transaction only for <strong>$customer_name_</strong> ?'})\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete</span></button>".'
</div>
';



  
			    $output['aaData'][] = $row;  
			} 
				

		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?count($output['aaData']):$output['iTotalRecords'];  
      echo json_encode( $output );
	 
	 ?>
	
 
 
