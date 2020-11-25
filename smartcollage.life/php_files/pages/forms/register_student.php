 <?php
    require '../../clasess/dataBase_class.php';
  


 
   function get_courses($course_id){ 
  
         $options = "<option course_name=''  course_id='' >choose..</option> ";
         $cust_q = mysqli_query_("select id,subject,teacher,time,cost from subjects where delete_status !='1' ORDER BY subject ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       

       if ($course_id == $aRow['id']) {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option  subject_id='{$aRow['id']}'  subject='{$aRow['subject']}' cost='{$aRow['cost']}'  $selected > {$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']}) </option>";  



    }
    return $options;
 } 




   function get_names(){ 
  
         $options = "<option student_id='' >choose..</option> <option student_id='' >Add</option> ";
         $cust_q = mysqli_query_("select student_id,name,mobile from students where delete_status !='1' and status='1' ORDER BY name ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       
 

             $options .= "<option mobile='{$aRow['mobile']}' student_id='{$aRow['student_id']}'> {$aRow['name']}, ({$aRow['mobile']}) </option>";  



    }
    return $options;
 } 



 
function get_transction_form($data){
     //  $data = clean_security($data,'2');


  $billing_date = explode('-', date('Y-m-d'));

      $customer_id = sanitize($data['id']);
 return "
    <script type='text/javascript' > 

  
   
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>
<input type='hidden' name='student_id'  value=''> 


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

 

<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td> <label class=''>Name</label><br> 
 

 <select onchange=\"chosen_student($(this).val(),$(this).find('option:selected').attr('student_id'),$(this).find('option:selected').attr('mobile'));\" id='no'> ".get_names()." </select>
   <input type='text' error_empty_msg='required' required name='name' placeholder=\"name \" value=''  style='display:none;' > 
  </td>
  
  <td> <label class=' float_label'>mobile</label><br> 
    <input type='text' name='mobile'  placeholder=\"mobile   \" value='{$data['mobile']}'  error_empty_msg='required' required  ></td> <td><label class=''>Registration fee</label>  <br>
   $<input   type='number'  name='r_fee' placeholder=\"Registration fee \" value=''   style='display:; border-left:none; ' > </div> </td>   </tr><tr>


 


 <table class='table amount_t' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>   

<tr class='first_'>

  <td> <input type='hidden' name='subject_id'  value=''> 


<label class=' float_label show_'>subject </label><br> 
       <select name='subject' onchange=\"chosen_subject($(this).closest('tr'))\"> ".get_courses($customer_id)." </select>
      </td>

  <td> <label class=' float_label'>cost </label><br> 
    $<input type='text'   disabled='disabled'   error_empty_msg='required'   required style=\"display='none'\" name='cost' placeholder=\"enter cost\" value='' format_comma='true'   > </td>
 
 <td> <label class=' float_label'> monthly discount </label><br> 
    $<input type='number' onchange='display_balance_calc_1();'  onkeyup='display_balance_calc_1(); '      required   name='monthly_discount' placeholder=\"monthly discount\" value='' > </td>

 <td> <label class=' float_label'> One time discount </label><br> 
    $<input type='number' onchange='display_balance_calc_1();'  onkeyup='display_balance_calc_1(); '      required   name='oneTimeDisounct' placeholder=\"One time discount\" value='' > </td>
    <td>
           <div  style=\"
    margin-left: 12px;    margin-top: 7px;
 display:inline;
\"><label class=''>Paid</label>  <br> 
   $<input  type='number' onchange='display_balance_calc_1();'  onkeyup='display_balance_calc_1(); ' name='paid' placeholder=\"enter paid \" value='' format_comma='true' style='display:; border-left:none; ' > </div>
   

    </td>

     </tr>
</table>
 
</td>
</tr>


<tr style='border-bottom:none !important;'>
 <td>
       <button  title='add more subjects ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 </td>
</tr>


<tr style='border-bottom:none !important;'>
  <td> <br><div style=\"
    margin-left: 12px;    margin-top: 7px;
 display:inline;
\"><label class='show_'>Balance</label> 
     $<input type='text' name='balance' value=''  disabled='disabed' style='display:;border:none;' > </div>
     
 <div  style=\" 


    margin-left: 12px;    margin-top: 7px; display:inline;
display:none;

\"><label class=''>One Time Discount</label>  
   $<input   type='number' onchange='display_balance_calc_1();'   onkeyup='display_balance_calc_1(); ' name='discount' placeholder=\"discount \" value='' format_comma='true' style='display:; border-left:none; ' > </div>
  

</tr> 

 
<tr style='border-bottom:none !important;'>
  <td>
 
  
  <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_' style='color: grey !important; '>Billing date</label> 
      <input type='text'  format_comma='true'  error_empty_msg='billing date is required' name='admin_date' value='{$billing_date['2']}'   style='width:38px !important; border:none !important; text-align:right;' >th of every month  </div>
    </td>
</tr> 

 
  

<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  ></textarea>  
</div>
      </td> 
  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/register_student_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

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

