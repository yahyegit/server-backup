<?php
   include '../../clasess/db_connector.php';

    require '../../clasess/reports_class.php';


 function get_open_cash_form($data){
 		$data = clean_security($data);

$data['date'] =  date('Y-m-d');
 if($data['id'] ==''){
     // add
        $latest_date = mysqli_result_(mysqli_query_("SELECT `date` from transactions  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0);
        $totals = get_report_totals($latest_date,'','');
		$data['amount_ksh'] = $totals['on_hand_balance']['ksh'];
		$data['amount_dollar'] = $totals['on_hand_balance']['dollar'];
 }else{
 	// update  

 }
 
 

 return "


  <form id='open_cash_form' action='#' style='width:60%; margin:auto;'  >



<div class=\"ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix\" style=\"
    text-align: left;
    margin-bottom: 4px;
    padding-left: 17px;
\"><span id=\"ui-id-13\" class=\"ui-dialog-title\">Adding Open Cash </span><a href=\"#\" onclick=\"close_element('form#open_cash_form');\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close\" role=\"button\" aria-disabled=\"false\" title=\"close\" style=\"
    margin-left: 10px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\">close</span><span class=\"ui-button-text\">close</span></a></div>


<table class='table'>

<tr>
 
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 


 <input type='hidden' name='id'  value='{$data['id']}'> 

 <input type='date' placeholder='date' name='date' value=\"{$data['date']}\" error_empty_msg='date is required !' required> <p id='error_line' class=' hide'></p> </td></tr>


 <tr>
 
 <td> $<input  type='text' placeholder='open dollar' name='amount_dollar' format_comma='true'  value='{$data['amount_dollar']}'>  </td> 
 </tr>



 <tr>
  <td>  <input  type='text' placeholder='open cash' format_comma='true'  name='amount_ksh' value='{$data['amount_ksh']}'> <span>Ksh</span> </td> 
 </tr>
 

 </table>

<div class=\"form_footer_btns\">   
<a href='#' style='  margin-left: 0px;'  file_name=\"php_files/clasess/open_cash_class.php\" class=\"primary_button submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".(($data['id'] !='')?'update':'add')."</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#open_cash_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</form>";

}





 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_open_cash_form($_POST['data']);

}









?>