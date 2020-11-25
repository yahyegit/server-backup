 <?php
    require '../../clasess/dataBase_class.php';

 
 

function get_form($data){
     //  $data = clean_security($data,'2');
global $current_user;

     $id = sanitize($data['id']);
   $data = mysqli_fetch_assoc_(mysqli_query_("SELECT `id`, `sender_id_no`, `sender_name`, `sender_mobile`, `pay_to_name`, `pay_to_mobile`, `delete_status`, `description`,`amount`, `status`, `pay_to_id`, `user_id` FROM `payments` WHERE id='$id' and delete_status!='1'")); 
        
 $current_limit = mysqli_result_(mysqli_query_("select current_remaining_limit from users where id=$current_user "), 0);
 return "
    <script type='text/javascript' > 

   
      // $( '#register_form' ).dialog();
 
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 76%;
    margin-left: 1px !important;
     ' class='form'>

<input type='hidden' name='status'  value='paid'> 

<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='id' value='{$data['id']}'>
    <input type='hidden' name='paid_user_id' value='$current_user'>

<p style='text-align:center; color:#7c11a2;'>Making payment.</p>
<br> 
<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>



   <tr  style='border-bottom:none !important;' >

     <td > <div style='display:;margin-left: 12px;'><label class=''> ID/Passport: <i>(optional)</i></label><br> 
 
   <input type='text'  name='pay_to_id' placeholder=\" ID/Passport (optional) \" value='{$data['pay_to_id']}'  > 
  </div></td>


    <td > <div style='display:;margin-left: 12px;'><label class=''>Pay to </label><br> 
 
 
   <input type='text'   disabled='disabled' error_empty_msg='required'  required required name='pay_to_name' placeholder=\"Pay to (full name)\" value='{$data['pay_to_name']}'  style=\"display:;\"  > 
  </div></td>


   <td > <div style='display:;margin-left: 12px;'><label class=''>mobile</label><br> 
 
   <input type='text' error_empty_msg='required'  required required name='pay_to_mobile' placeholder=\" mobile \" value='{$data['pay_to_mobile']}'    disabled='disabled'  > 
  </div></td>

 
 </tr>




<tr>


   <td > <div style='display:;margin-left: 12px;'><label class=''>amount</label><br> 
 
   $<input type='text' error_empty_msg='required'  onkeyup=\"remaining_calc();\"  disabled='disabled' format_comma='true' required name='amount' placeholder=\" amount \" value='".number_format($data['amount'],2)."'     > 
  </div></td>

  <td   > <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_'>Current remaining limit </label><br> 
     <input type='text' class='remaining_limit'  value='".number_format($current_limit,2)."'  bl='$current_limit' disabled='disabed'   > </div>
    </td>
 
</tr> 




   <tr  > <td > <div style='display:;margin-left: 12px;'><label class=''>sender name</label><br> 
 
 

   <input type='text' error_empty_msg='required'  required required name='sender_name' placeholder=\"Sender full name \" value='{$data['sender_name']}'  disabled='disabled'  style=\"display: ;\"  > 
  </div></td>


   <td > <div style='display:;margin-left: 12px;'><label class=''>sender mobile</label><br> 
 
   <input type='text' error_empty_msg='required'  required required name='sender_mobile' placeholder=\"sender mobile \" value='{$data['sender_mobile']}'    disabled='disabled'   > 
  </div></td>


  
 </tr>

  



<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  > {$data['description']} </textarea>  
</div>
      </td>  <td  style='display:none;' > <div style='display: ;margin-left: 12px;'><label class='show_'>Date</label><br> 
 
   <input  type='date' error_empty_msg='required'   name='paid_date' required value='".date('Y-m-d')."'> 
  </div></td> 
  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/pay_money_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Pay now</span></a>


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
    echo get_form($_POST['data']);


}







?>