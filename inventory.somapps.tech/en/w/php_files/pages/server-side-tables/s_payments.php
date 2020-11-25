 
 <?php
 
 include '../../clasess/db_connector.php';


$aColumns = explode(",",'id,s_id,date,paid,description,discount');

$sIndexColumn =  'id';  
$other_query =   trim(str_replace('~', '', $_GET['other_query']));


if(trim($other_query) == "''" || trim($other_query) == "undefined''"){
  $other_query = '';
}  	 
$sTable =  's_payments';
$_GET['sSearch'] = (trim($_GET['sSearch']) !='')?date_corrector($_GET['sSearch']):'';

$sWhere_query = "`paid` LIKE '%".sanitize($_GET['sSearch'])."%' OR LIKE '%".sanitize($_GET['sSearch'])."%' OR  `description` LIKE '%".sanitize($_GET['sSearch'])."%' ";


 $default_order = 'id'; 

include 'dataTable_exra.php';


$output = array(
    "sEcho" => intval(sanitize($_GET['sEcho'])),
    "iTotalRecords" =>  mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')."  delete_status!='1'  "),0),
    "aaData" => array()
);



    // <thea 
     while($aRow = mysqli_fetch_assoc_($rResult)){
 
      $row = array();

                  
              

                if(!preg_match('/s_id/',$other_query)){
                $row[] = mysqli_result_(mysqli_query_("select s_name from suppliers where id='{$aRow['s_id']}' "),0);
                }



                $row[] = $ccc.number_format($aRow['paid'],2);
                $row[] = $ccc.number_format($aRow['discount'],2);

                 $row[] = date('Y-M-d',strtotime($aRow['date']));
                $row[] =  $aRow['description'];
                 
 
                   
                 $customer = mysqli_result_(mysqli_query_("select s_name from suppliers where id={$aRow['s_id']}"),0);
                 $row[] = " <div  class='hide_for_print' style='
                    
                    margin: 0px !important;
                     
                '>    <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'$sTable',id:{$aRow['id']},msg:'Deleting payment from <b>$customer</b> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete   </span></button>  </div>
                 

                                 ";
        
                      $output['aaData'][] = $row;  
                     
        } 
            

 /*
 * Output
 */

 
       $output['iTotalDisplayRecords'] = (trim($_GET['sSearch']) != '')?mysqli_result_(mysqli_query_("select count($sIndexColumn) from $sTable where $other_query ".((empty($other_query))?'':'and')." $sWhere_query and delete_status!='1'  "),0):$output['iTotalRecords'];
             echo json_encode( $output );
 
 ?>



