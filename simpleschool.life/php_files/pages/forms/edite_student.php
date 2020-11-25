 <?php
    require '../../clasess/dataBase_class.php';
  
  

 
function get_edit_student_form($data){
     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);

 
   $data = mysqli_fetch_assoc_(mysqli_query_("select * from students where student_id='$customer_id' and delete_status!='1'")); 
      		 
  return "
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='student_id' value='{$data['student_id']}'>


<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td> <label class=''>Name</label><br> 
 
   <input type='text' error_empty_msg='required' required name='name' placeholder=\"name \" value='{$data['name']}'  style='display:;' > 
  </td>
  
  <td> <label class=' float_label'>mobile</label><br> 
    <input type='text' name='mobile'  placeholder=\"mobile\" value='{$data['mobile']}'  error_empty_msg='required' required  > </td>   </tr><tr>
 
 
  

 

<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is not required ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  >{$data['description']}</textarea>  
</div>
      </td> 
  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/edit_student_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">update</span></a>

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
    echo get_edit_student_form($_POST['data']);


}







?>