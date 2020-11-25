 <?php
    require '../../clasess/dataBase_class.php';


  

 function get_names(){ 
 
         $tags = array();
 $cust_q = mysqli_query_("select `id`,`pay_to_name`, `pay_to_mobile`,`pay_to_id` from payments where delete_status !='1'   ORDER BY pay_to_name ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
      $id = (!empty($aRow['pay_to_id']))?"ID/Passport No:{$aRow['pay_to_id']}":'';

     $tags[] = "{$aRow['pay_to_name']}, ({$aRow['pay_to_mobile']}), $id"; 
 }

      $cust_q = mysqli_query_("select  `id`, `sender_id_no`, `sender_name`, `sender_mobile` from payments where delete_status !='1'   ORDER BY sender_name ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
         $id = (!empty($aRow['sender_id_no']))?"ID/Passport No:{$aRow['sender_id_no']}":'';
          $tags[] = "{$aRow['sender_name']}, ({$aRow['sender_mobile']}), $id";
   }

$va =  array();
$ta = array_unique($tags);
foreach ($ta as $key => $value) {
$va[] = $value;
}
    return json_encode($va);
 }
 
 

function get_form($data){
     //  $data = clean_security($data,'2');
global $current_user;

$names = get_names();

     $id = sanitize($data['id']);
   $data = mysqli_fetch_assoc_(mysqli_query_("SELECT `id`,`commission`, `sender_id_no`, `sender_name`, `sender_mobile`, `pay_to_name`, `pay_to_mobile`, `delete_status`, `description`, `amount`,`status`, `pay_to_id`, `user_id` FROM `payments` WHERE id='$id' and delete_status!='1'")); 
        
 $current_limit = mysqli_result_(mysqli_query_("select current_send_limit from users where id=$current_user "), 0);
 return "

<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 76%;
    margin-left: 1px !important;
     ' class='form' autocomplete=\"off\">


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='id' value='{$data['id']}'>

<p style='text-align:center; color:#7c11a2;'>".(!empty($id)?'Editing sent money. ':'Sending money. ')."</p>
<br> 
<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr  > <td  class='csn' > <div style='display:;margin-left: 12px;'><label class=' '>sender</label><br> 
 
   <input type='text' error_empty_msg='required'      name='sender_name' placeholder=\"sender name\" value='{$data['sender_name']}'  style=\"display: ;\"  > 
  </div></td>


   <td > <div style='display:;margin-left: 12px;'><label class=''>sender mobile</label><br> 
 
   <input type='text' error_empty_msg='required'  required required name='sender_mobile' placeholder=\"sender mobile\" value='{$data['sender_mobile']}'     > 
  </div></td>

   <td  > <div style='display:;margin-left: 12px;'><label class=''>sender ID/Passport: <i>(optional)</i></label><br> 
 
   <input type='text'  name='sender_id_no' placeholder=\"sender ID/Passport (optional) \" style=\"
    width: 213px;
\"  value='{$data['sender_id_no']}'  > 
  </div></td>
  
 </tr>

  

   <tr  style='border-bottom:none !important;' > <td  class='csn'  > <div style='display:;margin-left: 12px;'><label class=' '>Receiver name</label><br> 
 
   <input type='text' error_empty_msg='required'  required required name='pay_to_name' placeholder=\"Receiver name \" value='{$data['pay_to_name']}'  style=\"display: ;\" autocomplete=\"off\" > 
  </div></td>


   <td > <div style='display:;margin-left: 12px;'><label class=''>Receiver mobile </label><br> 
 
   <input type='text' error_empty_msg='required'  required required name='pay_to_mobile' placeholder=\"Receiver  mobile \" value='{$data['pay_to_mobile']}' title='Enter full mobile with zip code to send the sms e.g: +252-61555-55-55'    > 
  </div></td>

 
  
 </tr>




<tr>


   <td > <div style='display:;margin-left: 12px;'><label class=''>amount</label><br> 
 
   $<input type='text' onkeyup=\"remaining_calc();\"  error_empty_msg='required'       format_comma='true' required name='amount' placeholder=\" amount \" value='{$data['amount']}'     > 
  </div></td>

   <td   > <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_'>Current sending limit </label><br> 
     <input type='text' class='remaining_limit'  value='".number_format($current_limit,2)."'  bl='$current_limit' disabled='disabed'   > </div>
    </td>
</tr> 



<tr>


   <td > <div style='display:;margin-left: 12px;'><label class=''>commission </label><br> 
 
   $<input type='text' error_empty_msg='required'   required name='commission' placeholder=\" commission \" value='{$data['commission']}'     > 
  </div></td>
</tr>




<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  >{$data['description']}</textarea>  
</div>
      </td>  <td  style='display:none;' > <div style='display: ;margin-left: 12px;'><label class='show_'>Date</label><br> 
 
   <input  type='date' error_empty_msg='required'   name='date' required value='".date('Y-m-d')."'> 
  </div></td> 
  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/send_money_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".((!empty($data['id']))?'Update':'Send')."</span></a>


<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"$('#register_form').slideUp();\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>
</div>



    <script type='text/javascript' > 

 
  $('document').ready(function(){

       $('input[name=sender_name], input[name=pay_to_name]').autocomplete({
        source:  ".$names."   
       }); 
 
    });

       $('input[name=sender_name], input[name=pay_to_name]').autocomplete({
        source:  ".$names."   
       }); 


 $('input[name=sender_name], input[name=pay_to_name]').keyup(function(){



   if($(this).attr('name') == 'sender_name'){

      if($.trim($(this).val()) !=''){
   // show 

        $('input[name=sender_mobile]').closest('td').show();
        $('input[name=sender_id_no]').closest('td').show();
      }else{
        $('input[name=sender_mobile]').closest('td').show(); 
        $('input[name=sender_id_no]').closest('td').show();  
      }

}else{
      if($.trim($(this).val()) !=''){
   // show 
      $('input[name=pay_to_mobile]').closest('td').show();

      }else{
      $('input[name=pay_to_mobile]').closest('td').show(); 

      }

} 

 });


 $('input[name=sender_name], input[name=pay_to_name]').change(function(){

if($.trim($(this).val()) !=''){
 
 data = $(this).val().split(',');

 if($(this).attr('name') == 'sender_name'){
    // sender info 
    $(this).val(data[0]);

       $('input[name=sender_id_no],input[name=sender_mobile]').closest('td').show();

     m = data[1].toString().replace('(','').replace(')','');

    $('input[name=sender_mobile]').val(m).closest('td').show();

    id = data[2].toString().split(':');

    $('input[name=sender_id_no]').val(id[1]).closest('td').show();


 }else{
   // pay to info
    $(this).val(data[0]).closest('td').show();
    m = data[1].toString().replace('(','').replace(')','');
    $('input[name=pay_to_mobile]').val(m).closest('td').show();

 }
}else{
      $('input[name=sender_mobile]').closest('td').show(); 
      $('input[name=pay_to_mobile]').closest('td').show(); 
      $('input[name=sender_id_no]').closest('td').show(); 

}

  });

 

    </script> <br>


    
";

}


 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    echo get_form($_POST['data']);


}







?>