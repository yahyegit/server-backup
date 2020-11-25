 
 <?php
 
     include '../../clasess/db_connector.php';

 
	$aColumns = explode(",",'id,name,courses,mobile,category,date,balance,address,due_date,description');
	$sIndexColumn =  'id';  
	$other_query = sanitize_other_query(str_replace('~','',trim($_GET['other_query'])));  

  if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  	$other_query = '';
  }  	 
	$sTable =  'students';
	$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
    $sWhere_query = "`name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' OR `date` LIKE '%".sanitize($_GET['sSearch'])."%' OR `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";
 	$default_order = 'name'; 

	include 'dataTable_exra.php';

 
	$output = array(
		"sEcho" => intval(sanitize($_GET['sEcho'])),
		"iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
		"aaData" => array()
	);
 

// th>name</th> <th>mobile</th> <th>Current Balance</th> <th> more </th><th>Action</th> 
        include '../../global_functions/toggle_debt_or_in_color.php'; // toggle_debt_color

        // all queries is static 
	     while($aRow = mysqli_fetch_assoc_($rResult))
			{

					 				 
						 $row = array();
					      		      $row[] = " {$aRow['name']}<br> ({$aRow['mobile']}) ";
 
		      $row[] = $aRow['courses'];
			  // view btn 
			  $paid_ = mysqli_result_(mysqli_query_("select sum(`paid`) from payments where student_id='{$aRow['id']}'"),0);
			  if (!empty($paid_)) {
			  $gg = "<button  title='see payment history for {$aRow['name']}' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/show_history_.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>show history </span></button>";
			  }else{
			  	$gg = '';
			  }
		      $row[] = '$'.number_format($paid_,2)."<br> $gg";
		      

			 if ($aRow['due_date'] != '0000-00-00' && !empty($aRow['balance'])){
					$dueDAte = (strtotime($aRow['due_date']) <= time())?'<br><i class="debt_color" style=" font-weight:normal !important;
    margin-left: 5px;
" >debt remainder was  : '.time_Ago(strtotime($aRow['due_date'])).'('.date('d-M-Y',strtotime($aRow['due_date'])).')</i>':'<br><i style="
    margin-left: 5px;
">remainder was set to '.date('d-M-Y',strtotime($aRow['due_date'])).'</i>';
			}else{
				$dueDAte = '';
			}
			 		
				if (!empty($aRow['balance'])) {
					$make_payment ="<button  title='make payment or set remainder ' class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/forms/make_payment.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-person  '></span><span class='ui-button-text'>make payment </span></button>";
				}else{
					$make_payment = '';
				}

		      $row[] = "<span class='debt_color'>$".number_format($aRow['balance'])."</span>

 $dueDAte 
<br>
		       $make_payment";
		      $row[] = $aRow['category'];

		      $row[] = $aRow['address'];
		      $row[] = $aRow['description'];

		 		      $row[] = date('d-M-Y',strtotime($aRow['date']));



			 	$row[] = " <div  class='hide_for_print' style='
    
    margin: 0px !important;
     
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edite_student.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting please confirm <strong>{$aRow['name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete student</span></button>  </div>
 

			 	";
 	                     $output['aaData'][] = $row;  
			 	        
			} 
				
	
	 /*
	 * Output
	 */

 	
		   $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
		         echo json_encode( $output );
	 
	 ?>
	
 
 
