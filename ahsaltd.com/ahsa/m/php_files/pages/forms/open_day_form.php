<?php
   include '../../clasess/db_connector.php';

    require '../../clasess/reports_class.php';


 function get_open_cash_form($data){
 		$data = clean_security($data);

 if($data['id'] ==''){
     // add
  $data['date'] =  date('Y-m-d');

        $latest_date = mysqli_result_(mysqli_query_("SELECT `date` from transactions  where delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0); 
 
        $totals = current_balance_all_ksh(array('date' =>$latest_date ,'date_to'=>''));  
		$data['amount_ksh'] = $totals['balance_ksh'];
  }else{
 	// update  
$data['dollar_rate'] = mysqli_result_(mysqli_query_("SELECT `dollar_rate` from open_cash  where id={$data['id']} "),0);
 }
 
 

 return "


  <form id='open_cash_form' action='#' style='width:43%; margin:auto;'  >



<div class=\"ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix\" style=\"
    text-align: center;
    margin-bottom: 4px;
\"><span id=\"ui-id-13\" class=\"ui-dialog-title\">Adding Open Cash </span><a href=\"#\" onclick=\"close_element('#open_cash_form');\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close\" role=\"button\" aria-disabled=\"false\" title=\"close\" style=\"
    margin-left: 10px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\">close</span><span class=\"ui-button-text\">close</span></a></div>


<table class='table'>

<tr>
  
 <td> <label> Title (optional)</label></br>
<input type='text' placeholder='title (optional)' name='title' value='{$data['title']}'  > </td> 
 
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 

 <input type='hidden' name='id'  value='{$data['id']}'> 
 </tr><tr><td>
<label> Date </label></br>
 <input type='date' name='date' value=\"{$data['date']}\" error_empty_msg='date is required !' required> <p id='error_line' class=' hide'></p> </td></tr>


 <tr>

 <td>  <label> Open dollar </label></br>$<input placeholder='Open dollar' type='text' name='amount_dollar' format_comma='true'  value='{$data['amount_dollar']}'>  </td> 
 </tr>

 <tr>

 <td>
 <label> Open Ksh </label></br>
 <span>Ksh</span>  <input   placeholder='Open ksh'  type='text' format_comma='true'  name='amount_ksh' value='{$data['amount_ksh']}'>  </td> 
 </tr>
 
 <tr>
 
 <td>  <label> Rate </label></br> Ksh <input  placeholder='Rate' type='number' name='dollar_rate' error_empty_msg='rate is required !' required  value='{$data['dollar_rate']}'>   </td> 
 </tr>

 </table>

<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/open_cash_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".(($data['id'] !='')?'update':'add')."</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#open_cash_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 10px;
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