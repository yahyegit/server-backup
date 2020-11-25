 
 <?php
 
 include '../../clasess/db_connector.php';

$distinct = '';
$aColumns = explode(",",'id,s_name,mobile,current_balance');

$sIndexColumn =  'id';  
 $other_query =   trim(str_replace('~', '', $_GET['other_query']));

if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  $other_query = '';
}  	 
$sTable =  'suppliers';
$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
$sWhere_query = "`s_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `mobile` LIKE '%".sanitize($_GET['sSearch'])."%' OR  `current_balance` LIKE '%".sanitize($_GET['sSearch'])."%'   ";

 $default_order = 's_name'; 

include 'dataTable_exra.php';


$output = array(
    "sEcho" => intval(sanitize($_GET['sEcho'])),
    "iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
    "aaData" => array()
);

//  <th> customer_name  </th> <th>  mobile </th><th> balance </th> <th> items </th>  <th> action </th> 

    // all queries is static 
     while($aRow = mysqli_fetch_assoc_($rResult)){
             
        $row = array();

        $row[] =  $aRow['s_name'];

        $row[] =  $aRow['mobile'];



        $row[] = $ccc.number_format($aRow['current_balance'],2)." <button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']} },'pages/forms/make_sup_payments_form.php');\" role='button' aria-disabled='false' style='".((empty($aRow['current_balance']))?'display:none':'inline')."'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay now</span></button> ";


          $row[] =  " <button  class='change ui-button ui-widget ui-state-default ui-corner-all  ui-button-text-icon-primary' onclick=\"r_page('',{id:{$aRow['id']}},'pages/other_pages/supplier_account.php');\" role='button' aria-disabled='false' style='font-size: 11px;'><span class='ui-button-icon-primary ui-icon-   '></span><span class='ui-button-text'>show items and payment history for <b>{$aRow['s_name']}</b></span></button>
           "; 

     

             $row[] = " <div  class='hide_for_print' style='

margin: 0px !important;
 
'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edit_customer.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit supplier  </span></button>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting all items and payments for {$aRow['s_name']} ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete supplier </span></button>      </div>


             ";
                      $output['aaData'][] = $row;  




                     
        } 
            

 /*
 * Output
 */

 
       $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
             echo json_encode( $output );
 
 ?>



