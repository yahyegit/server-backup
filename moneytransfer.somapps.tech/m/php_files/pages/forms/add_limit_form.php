 <?php
    require '../../clasess/dataBase_class.php';



   function get_users($id){ 
  
         $options = " <option  >choose..</option> ";
         $cust_q = mysqli_query_("select `id`,`username`, `full_name`,`current_send_limit`, `current_remaining_limit` from users where delete_status !='1'   ORDER BY username ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
 
            $selected  = ($id == $aRow['id'])?"selected='selected'":'';

               $options .= "<option $selected  send_rem=\"{$aRow['current_send_limit']}\" rem=\"{$aRow['current_remaining_limit']}\" user_id=\"{$aRow['id']}\">{$aRow['username']}</option>";  




    }
    return $options;
 } 

 

 

 

 

function get_form($data){
     //  $data = clean_security($data,'2');
global $current_user;

     $id = sanitize($data['id']);
          $user_id = sanitize($data['user_id']);

   $data = mysqli_fetch_assoc_(mysqli_query_("SELECT `id`, `amount`, `user_id`, `description`, `date` FROM `limit_history` where id='$id' ")); 
        
 $current_limit = mysqli_result_(mysqli_query_("select current_remaining_limit from users where id=$current_user "), 0);

  $current_send_limit = mysqli_result_(mysqli_query_("select current_send_limit from users where id=$current_user "), 0);


 return "

<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;       
    margin-left: 1px !important;
     ' class='form'>

<input type='hidden' name='user_id'  value='$user_id'> 

<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='id' value='{$data['id']}'>

<p style='text-align:center; color:#7c11a2;'>".(!empty($id)?'Editing limit. ':'Adding limit to User. ')."</p>
<br> 
<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr  > <td  > <div style='display:;margin-left: 12px;'><label class='show_'>username</label> 
 

 <select  error_empty_msg='required' class='cu' onchange=\"chosen_user($(this).find('option:selected'))\" > ".get_users($user_id)." </select>

 
  </div></td>

<tr>
   <td > <div style='display:;margin-left: 12px;'><label class='show_'>Remaining limit</label><br> 
 
   <input type='text' class='rem'  disabled='disabled'    value=''> 
  </div></td></tr>

 <tr>

   <td > <div style='display:;margin-left: 12px;'><label class=''>Amount</label><br> 
 
   $<input type='text' error_empty_msg='required'  onkeyup=\"remaining_calc_();\"   format_comma='true' required name='amount' placeholder=\" amount \" value='{$data['amount']}'     > 
  </div></td>





 </tr>







   <tr>

   <td > <div style='display:;margin-left: 12px;'><label class=''>Sending Amount</label><br> 
 
   $<input type='text'   onkeyup=\"remaining_calc_();\"   format_comma='true'   name='send_amount' placeholder=\" Sending Amount \" value='{$data['send_amount']}'     > 
  </div></td>
   </tr>
   <tr>

   <td > <div style='display:;margin-left: 12px;'><label class='show_'>current sending limit</label><br> 
 
   <input type='text' class='rem_s'     disabled='disabled'   value=''> 
  </div></td>




 </tr>

  
 
 


  
 

<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder=\"Description is optional\" style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  >{$data['description']}</textarea>  
</div>
      </td> 

         <td  style='display:none;' > <div style='display: ;margin-left: 12px;'><label class='show_'>Date</label><br> 
 
   <input  type='date' error_empty_msg='required'   name='date' required value='".date('Y-m-d')."'> 
  </div></td>

  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/add_limit_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".((!empty($data['id']))?'Update':'Add')."</span></a>


<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"$('#register_form').slideUp();\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>
</div>



    <script type='text/javascript' > 

           
           chosen_user($('select.cu').find('option:selected')) 
          

    </script> <br>


    
";

}


 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    echo get_form($_POST['data']);


}







?>