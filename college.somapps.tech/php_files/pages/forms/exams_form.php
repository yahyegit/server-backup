 <?php
    require '../../clasess/dataBase_class.php';
  


 
   function get_courses($course){ 
  
         $options = "<option course_name=''  course_id='' >choose..</option> ";
         $cust_q = mysqli_query_("select id,subject,teacher,time,cost from subjects where delete_status !='1' ORDER BY subject ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       

       if ($course == "{$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']})") {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option  subject_id='{$aRow['id']}'  subject='{$aRow['subject']}' cost='{$aRow['cost']}'  $selected > {$aRow['subject']}, ({$aRow['time']}) ({$aRow['teacher']}) </option>";  



    }
    return $options;
 } 




   function get_names($id){ 
  
         $options = "<option student_id='' >choose..</option>  ";
         $cust_q = mysqli_query_("select student_id,name,mobile from students where delete_status !='1' and status='1' ORDER BY name ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       
         if ($id == $aRow['student_id']) {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option    $selected  mobile='{$aRow['mobile']}' student_id='{$aRow['student_id']}'> {$aRow['name']}, ({$aRow['mobile']}) </option>";  



    }
    return $options;
 } 



 
function get_transction_form($data){
     //  $data = clean_security($data,'2');


  $billing_date = explode('-', date('Y-m-d'));

      $id = sanitize($data['id']);
        
         $student_id = sanitize($data['student_id']);
 
      if (!empty( $id )) {
         $data = mysqli_fetch_assoc_(mysqli_query_("select * from exams where id=$id "));
          $student_id  = $data['student_id'];

         $hide ='display:none  !important;';
      }

 return "
    <script type='text/javascript' > 

  
   
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>
 
<input type='hidden' name='id'  value='{$data['id']}'> 



<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

 

<table class='table amount_t' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr class='more_exams' style='border-bottom:none !important;'> <td> <label class='show_'>student name</label><br> 
 <select error_empty_msg='required' required   onchange=\"$(this).closest('tr').find('input.exam_student_id:first').val($(this).find('option:selected').attr('student_id')) \"  > ".get_names($student_id)." </select>
 <input type='hidden' name='student_id' class='exam_student_id' value='$student_id'> 


  </td>
    
  <td>  


<label class=' float_label show_'>subject </label><br> 
       <select name='subject' error_empty_msg='required' required  > ".get_courses($data['subject'])." </select>
      </td>


 <td> <label class=' float_label'>marks </label><br> 
    <input type='text'    error_empty_msg='required'   required style=\"display='none'\" name='marks' placeholder=\"Marks\" value='{$data['marks']}'  > </td>


      <td> <div style=\"
    margin-left: 12px;    

\"><label class=''> date</label><br> 
     <input type='date' name='date' value='".((!empty($data['id']))?$data['date']:date('Y-m-d'))."'    error_empty_msg='required' required  style='display:;'  > </div>
    </td>

 


</tr> </table>
 
  
       <button  title='add more subjects ' style='$hide font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_exams();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more exams </button> 
 




<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/exams_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

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

