 
 <?php
 
     include '../../clasess/db_connector.php';
 
 
	$aColumns = explode(",",'commission,paid_date,id,status,amount,sender_id_no,pay_to_id,sender_name,sender_mobile,pay_to_name,pay_to_mobile,description,user_id');

	$sIndexColumn =  'id';  
	$other_query =   trim(str_replace('~', '', $_GET['other_query']));



  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'payments';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`sender_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `sender_id_no` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `sender_mobile` LIKE '%".sanitize($_GET['sSearch'])."%'   OR  `pay_to_name` LIKE '%".sanitize($_GET['sSearch'])."%'     OR  `pay_to_mobile` LIKE '%".sanitize($_GET['sSearch'])."%'     OR  `description` LIKE '%".sanitize($_GET['sSearch'])."%'      OR  `id` LIKE '%".sanitize($_GET['sSearch'])."%'   OR  `pay_to_id` LIKE '%".sanitize($_GET['sSearch'])."%'  ";
 	$default_order = 'id'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

 
        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult)){
 	
          $row = array();
	  $s_id  = (!empty($aRow['sender_id_no']))?"<br>
	<label class=\"show_ float_label\">Sender ID/Passport No:</label>{$aRow['sender_id_no']}":'';

	  $p_id  = (!empty($aRow['pay_to_id']))?"<br>
	<label class=\"show_ float_label\">Sender ID/Passport No:</label>{$aRow['pay_to_id']}":'';

 
$row[] = "#{$aRow['id']}";
$row[] = "<label class=\"show_ float_label\">Pay to :</label>{$aRow['pay_to_name']}<br><label class=\"show_ float_label\">mobile:</label>{$aRow['pay_to_mobile']} $p_id
";
$row[] = '$'.number_format($aRow['amount'],2);
$row[] = '$'.number_format($aRow['commission'],2);
$row[] = (trim($aRow['status']) == 'unpaid')?"<span class='debt_color'>{$aRow['status']} </span> <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/make_payment_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay </span></button>  ":"<span style='color:green;' >{$aRow['status']} </span> on ".date('d/M/Y',strtotime($aRow['paid_date']));


$row[] = "<label class=\"show_ float_label\">Sender name:</label>{$aRow['sender_name']}<br><label class=\"show_ float_label\">Sender mobile:</label>{$aRow['sender_mobile']} $s_id
";

 
$row[] = "{$aRow['description']}";
 



// delete if
      if (is_admin($current_user) || $current_user == $aRow['user_id']){
        $actions = " <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/send_money_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting Transaction ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>   ";
       }else{
       	$actions = '';
       }

			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'>  $actions  </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
