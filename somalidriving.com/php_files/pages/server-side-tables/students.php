 
 <?php
 
 include '../../clasess/db_connector.php';


$aColumns = explode(",",'id,full_name,mobile,address,course');
$sIndexColumn =  'id';  
 
if (!empty(trim($_GET['other_query']))) {
     $other_query = (trim($_GET['other_query']) != 'undefined')?sanitize_other_query_3(str_replace('~','%',trim($_GET['other_query']))):'';	
}else{

 $other_query = '';
}

if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  $other_query = '';
} 


      $sTable =  'students';
$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';
$sWhere_query = "`mobile` LIKE '%".sanitize($_GET['sSearch'])."%' OR `full_name` LIKE '%".sanitize($_GET['sSearch'])."%' OR `course` LIKE '%".sanitize($_GET['sSearch'])."%' OR `address` LIKE '%".sanitize($_GET['sSearch'])."%'";
 $default_order = 'students'; 

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




     $row[] ="<label class='gray'> " $aRow['full_name'];
     $row[] = $aRow['course'];
     $row[] = $aRow['address'];
     $row[] = $aRow['mobile'];
            
             $row[] = " <div  class='hide_for_print' style='

margin: 0px !important;
 
'>   <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edit_student_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button> <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'deleting <strong>{$aRow['full_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </div>


             ";
                      $output['aaData'][] = $row;  
                     
        } 
            

 /*
 * Output
 */

 
       $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
             echo json_encode( $output );
 
 ?>



