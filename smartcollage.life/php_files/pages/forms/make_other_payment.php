 <?php
    require '../../clasess/dataBase_class.php';


   function get_names(){ 
  
         $options = "<option student_id='' >choose..</option> ";
         $cust_q = mysqli_query_("select student_id,name,mobile from students where delete_status !='1' and status='1' ORDER BY name ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       
 

             $options .= "<option mobile='{$aRow['mobile']}' student_id='{$aRow['student_id']}'> {$aRow['name']}, ({$aRow['mobile']}) </option>";  



    }
    return $options;
 } 



function get_transction_form(){
     //  $data = clean_security($data,'2');

 
 return "
    <script type='text/javascript' > 

   
      // $( '#register_form' ).dialog();
 
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>

<input type='hidden' name='student_id'  value=''> 

<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    
<h4 class='title_'> making other payments </h4>

<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

 <tr> <td> <div  id='other_payments_form' style=\"
    margin-left: 12px;    margin-top: 7px;

\"> <label class=\"float_label show_\" style=\"display:  ;\"> Name </label> <br> 
 <select error_empty_msg='required' onchange=\"$('input[name=student_id]').val($(this).find('option:selected').attr('student_id'))\" id='no'> ".get_names()." </select>
</div>  </td>

   </tr>
<tr>
    <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>Paid</label><br> 
   <input type='number'   name='amount' placeholder=\"enter amount \"   > </div>
  </td>  
    <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>One time Discount</label><br> 
   <input type='number' name='discount' placeholder=\"One time Discount   \" value=''  style='display:;' > </div>
  </td>

</tr>

  

<tr style='border-bottom:none !important;'>
  <td> <div style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>payment date</label><br> 
     <input type='date' name='date' value='".date('Y-m-d')."'   style='display:;'  > </div>
    </td>   <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is not required ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  ></textarea>  
</div>
      </td> 
</tr> 

   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/make_payment_other_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

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
