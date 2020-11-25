<?php
 
  include '../../clasess/db_connector.php';
  include '../../clasess/reports_class.php';
  // require '../../clasess/extra_functions.php';
     include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

	$aColumns = explode(",",'id,title,amount_dollar,amount_ksh,date,dollar_rate');  
	$sIndexColumn =  'id';  
	$default_order = 'date'; 
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));   
	$other_query2 = sanitize_other_query2(trim($_GET['other_query2']));   
	 $other_query  = (!empty($other_query2))?$other_query.' and '.$other_query2:$other_query;

 	$_GET['sSearch'] = date_corrector($_GET['sSearch']);
    
    $sWhere_query = "`amount_dollar` LIKE '%".sanitize($_GET['sSearch'])."%' OR `amount_ksh` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' ";
	$sTable =  'open_cash'; // reports and customer account 

	include 'dataTable_exra.php';
 
   
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" => mysqli_result_(mysqli_query_("select count(id) from $sTable where ".((trim($other_query) !='')?$other_query.' and ':'')." delete_status!='1'  "), 0),
 		"aaData" => array()
	);
 

      
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{
				$row = array();

				if(ctype_digit($aRow['id'])){

			    $row[] =  $aRow["title"];
					  	  // date 
		 	  	 $row[] = '<a href="#" title="view reports for ('.date('d/M/Y',strtotime($aRow['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$aRow["date"].'\'},\'pages/other_pages/reports_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.date('d/M/Y',strtotime($aRow['date'])).'</span></a>';
				 	// open cash 
				$row[] = '<span>$'.number_format($aRow["amount_dollar"],2).' </span> <span  class="hr_"></span><span>ksh'.number_format($aRow["amount_ksh"],2).'</span>';
 
                // open cash balance 
                 $open_c_balance = current_balance_all_ksh(array('date' =>$aRow['date'],'date_to'=>''));

				 $row[] = '<span class="'.toggle_debt_color($open_c_balance['balance_ksh']).'" >ksh'.number_format($open_c_balance['balance_ksh'],2).' </span>'; 

			 	$row[] = '<span>'.number_format($aRow["dollar_rate"],2).' ksh</span>';
  				
  				// actions 
				$row[] = "<button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"
           request_template('',{id:{$aRow['id']},amount_ksh:'{$aRow['amount_ksh']}',date:'{$aRow['date']}',title:'{$aRow['title']}',amount_dollar:'{$aRow['amount_dollar']}'},'pages/forms/open_day_form.php');\" role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-pencil\"></span><span class=\"ui-button-text\">Edit </span></button>

 <button class=' ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'open_cash',id:{$aRow['id']},msg:'Deleting open cash for <strong>{$aRow['date']}</strong> ?'})\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete open cash </span></button>
            ";




	         }else{
					// add 
 /*
					$row[] = '--';
					$row[] = '--';
					$row[] = '--';
					$row[] = '--';
					$row[] = "
					<button class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"
					           request_template('','','pages/forms/open_day_form.php');\" role=\"button\" aria-disabled=\"false\" style=\"font-size: 11px;\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\">Add Open Cash </span></button>";*/
 
				}  
				  $output['aaData'][] = $row;
			} 
				

		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?count($output['aaData']):$output['iTotalRecords'];  
      echo json_encode( $output );
	 
	 ?>
	
 
 
