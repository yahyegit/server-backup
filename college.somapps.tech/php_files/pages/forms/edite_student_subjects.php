 <?php
    require '../../clasess/dataBase_class.php';
  
  
 
   function get_courses($course_id){ 
  
         $options = "<option course_name=''  course_id='' >choose..</option> ";
         $cust_q = mysqli_query_("select id,subject,teacher,time,cost from subjects where delete_status !='1' ORDER BY subject ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       

       if (trim(" {$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']}) ") == trim($course_id)) {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option  subject_id='{$aRow['id']}'  subject='{$aRow['subject']}' cost='{$aRow['cost']}'  $selected > {$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']}) </option>";  



    }
    return $options;
 } 



function get_edit_student_subject_form($data){
     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);
      $student_id = sanitize($data['student_id']);

  $student_name = mysqli_result_(mysqli_query_("select name from students where student_id='$student_id'"),0);

   $data = mysqli_fetch_assoc_(mysqli_query_("select * from student_subjects where id='$customer_id' and delete_status!='1'")); 
      $data['admin_date'] = explode('-',$data['admin_date']);

  return "
     
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

<p class='title_'>Editing subject for <strong> $student_name  </strong> </p><br>

    <input type='hidden' name='id' value='{$data['id']}'>

<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>


<tr class='first_'>

  <td>   
       <span> {$data['subject']} </span>
        

      </td>

  <td> <label class=' float_label'>cost </label><br> 
    $<input type='text'   disabled='disabled'   error_empty_msg='required'   required style=\"display='none'\" name='cost' placeholder=\"enter cost\" value='{$data['cost']}' format_comma='true'   > </td>
 
 <td> <label class=' float_label'> monthly discount </label><br> 
    $<input type='number' onchange=\"if(parseFloat($(this).val())>{$data['cost']} ){ $(this).val(''); }\"   onkeyup=\"if(parseFloat($(this).val())>{$data['cost']} ){ $(this).val(''); }\"       required   name='monthly_discount' placeholder=\"monthly discount\" value='{$data['discount']}' > </td>

     </tr>
</table>
 
</td>
</tr>

 

   <tr style='border-bottom:none !important;'> <td> <label class=''> billing date </label><br> 
 
   <input type='number'   error_empty_msg='billing date is required '  name='admin_date' placeholder=\"  billing date \" value='{$data['admin_date']['2']}'  style='width:38px !important; border:none !important;' >th of every month 
  </td>
  </tr>
 
 
   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/edit_student_subject_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">update</span></a>

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
    echo get_edit_student_subject_form($_POST['data']);


}




?>