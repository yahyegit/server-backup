 <?php
    require '../../clasess/dataBase_class.php';

function get_transction_form($data){
     //  $data = clean_security($data,'2');
global $ccc;
     $customer_id = sanitize($data['id']);

   $customer_name = mysqli_result_(mysqli_query_("select customer_name from customers where id='$customer_id' and delete_status!='1'"),0); 
        
   $data['balance'] =  mysqli_result_(mysqli_query_("select current_balance from customers where delete_status!='1' and id='$customer_id' "),0);
 return "
    <script type='text/javascript' > 

   
      // $( '#register_form' ).dialog();
 
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='id' value='$customer_id'>


<h4 class='title_'> <strong> $customer_name </strong> is making payment. </h4>

<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

 

<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_'>Balance</label><br> 
    $ccc<input type='text' name='balance' value='".number_format($data['balance'],2)."'  bl='{$data['balance']}' disabled='disabed'   > </div>
    </td>
</tr> 

<tr>
    <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>Paid</label><br> 
   $ccc<input type='number'  onchange='display_balance_calc();' onkeyup='display_balance_calc();' name='amount' placeholder=\"enter paid \" value=''  style='display:;' > </div>
  </td> 
</tr>

 <tr>   <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''> Discount <i>(optional)</i></label><br> 
   $ccc<input type='number' onchange='display_balance_calc();'  onkeyup='display_balance_calc();' name='discount' placeholder=\"   Discount (optional)   \" value=''  style='display:;' > </div>
  </td></tr>

 

<tr style='border-bottom:none !important;'>
    <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is not required ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  ></textarea>  
</div>
      </td>
</tr> 

   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/make_payment_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"$('#register_form').slideUp();\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>
</div>
";

}


 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    echo get_transction_form($_POST['data']);


}







?>