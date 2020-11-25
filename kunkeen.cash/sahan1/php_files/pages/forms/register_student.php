 <?php
    require '../../clasess/dataBase_class.php';
  



 function part_time()
  {


    $parts = array('morning ','evening ','night ','Friday & Saturday at 2:00pm ');
    $qq = mysqli_query_("SELECT DISTINCT `category` from students where delete_status !='1'");
    while ($q = mysqli_fetch_assoc_($qq)  ) {
          $parts[] = $q['category'].' ';
   }
return json_encode(array_unique($parts));
}
   function get_courses($course_id){ 
  
         $options = "<option course_name=''  course_id='' >choose..</option><option customer_name=''  customer_id='' balance='{}' >Add</option>";
         $cust_q = mysqli_query_("select id,course,cost,duration from courses where delete_status !='1' ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       

       if ($course_id == $aRow['id']) {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option  course_id='{$aRow['id']}'  course_name='{$aRow['course']}' cost='{$aRow['cost']}'  duration='{$aRow['duration']}'  $selected > {$aRow['course']} ".'('." {$aRow['cost']} ".') ('." {$aRow['duration']})  </option>";  



    }
    return $options;
 } 
 
function get_transction_form($data){
     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);
 return "
    <script type='text/javascript' > 

    availble_currencies = JSON.parse('".part_time()."');
  $('input[name=\"category\"]').autocomplete({minChars: 0 , source: availble_currencies }).focus(
    function() {
        if (this.value == '') {
               $(this).autocomplete('search', ' ');
            }
        }
    ); 
   
   
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='student_id' value='$student_id'>


<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td> <label class=''>Name</label><br> 
 
   <input type='text' error_empty_msg='required' required name='name' placeholder=\"name \" value=''  style='display:;' > 
  </td>
  
  <td> <label class=' float_label'>mobile</label><br> 
    <input type='text' name='mobile' $disabled_input placeholder=\"mobile   \" value='{$data['mobile']}'  error_empty_msg='required' required  > </td>   </tr><tr>
 <table class='table amount_t' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>   

<tr class='first_'>

  <td> <label class=' float_label show_'>course </label><br> 
       <select onchange=\"chosen_course($(this).find('option:selected'))\"> ".get_courses($customer_id)." </select>
    <input type='text' error_empty_msg='required' required style=\"display:none\" name='course' placeholder='enter course' value=''    > </td>

  <td> <label class=' float_label'>cost </label><br> 
    <input type='text'  onkeyup=\"$(this).attr('cost',$(this).val()); update_balance();  \"   error_empty_msg='required' required style=\"display='none'\" name='cost' placeholder=\"enter cost\" value='' format_comma='true'   > </td>

      <td> <label class=' float_label'>duration </label><br> 
     <input type='text'  error_empty_msg='required' required   style=\"display='none'\" name='duration' placeholder='enter duration' value=''    > </td>

     </tr>
</table>
 
</td>
</tr>


<tr style='border-bottom:none !important;'>
 <td>
       <button  title='add more courses ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 </td>
</tr>


<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_'>Balance</label><br> 
     $<input type='text' name='balance' value=''  disabled='disabed' style='display:;border-left:none;' > </div>
    </td>
</tr> 

<tr>
    <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>Paid</label><br> 
   $<input type='text' onkeyup='update_balance()' name='paid' placeholder=\"enter paid \" value='' format_comma='true' style='display:; border-left:none; ' > </div>
  </td>
</tr>
<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class='show_'>debt remainder  <i>(optional)</i></label><br> 
     <input type='date' name='due_date' value=''   style=' ' > </div>
    </td>
</tr> 

<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>date</label><br> 
     <input type='date' name='date' value='".date('Y-m-d')."'   style='display:;' > </div>
    </td>
</tr> 

<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>Class time </label><br> 
     <input type='text' name='category' value='' error_empty_msg='Class time is required ' required placeholder=\"Enter Class time\" > </div>
    </td>
</tr> 

<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>Address <i>(optional)</i></label><br> 
     <input type='text' name='address' value=''  placeholder=\"Address is optional\" > </div>
    </td>
</tr> 

<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is not required ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  ></textarea>  
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