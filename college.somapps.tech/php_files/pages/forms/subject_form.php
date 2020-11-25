 <?php
    require '../../clasess/dataBase_class.php';

function get_subjecs_form($data){
     //  $data = clean_security($data,'2');

     $customer_id = sanitize($data['id']);

   $data = mysqli_fetch_assoc_(mysqli_query_("select * from subjects where id='$customer_id' and delete_status!='1'")); 
        
 
 return "
    <script type='text/javascript' > 

   
      // $( '#register_form' ).dialog();
 
   $( 'input[name=\"teacher\"]').autocomplete({
      source: ".get_autoComplate("select distinct teacher from subjects where delete_status!='1' ",'teacher')."
    });

   $( 'input[name=\"subject\"]').autocomplete({
      source: ".get_autoComplate("select distinct subject from subjects where delete_status!='1' ",'subject')."
    });

 
 

    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

    <input type='hidden' name='id' value='{$data['id']}'>


<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td > <div style='display:;margin-left: 12px;'><label class=''>Subject</label><br> 
 
   <input type='text' error_empty_msg='required'  required   required name='subject' placeholder=\"subject \" value='{$data['subject']}'     > 
  </div></td>
  
 </tr>

 

   <tr style='border-bottom:none !important;'> <td > <div style='display:;margin-left: 12px;'><label class=''>Teacher</label><br> 
 
   <input type='text' error_empty_msg='required'  required   required name='teacher' placeholder=\"teacher \" value='{$data['teacher']}'     > 
  </div></td>
  
 </tr>


<tr style='border-bottom:none !important;'> <td > <div style='display:;margin-left: 12px;'><label class=''>time</label><br> 
 
   <input type='text' error_empty_msg='required'  required   required name='time' placeholder=\"time \" value='{$data['time']}'     > 
  </div></td>
  
 </tr>



<tr style='border-bottom:none !important;'> <td > <div style='display:;margin-left: 12px;'><label class=''>cost</label><br> 
 
   $<input type='text' error_empty_msg='required'  required   required name='cost' placeholder=\"cost \" value='{$data['cost']}'     > 
  </div></td>
  
 </tr>

 
<tr>
       <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' name='description' placeholder='Description is not required ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  >
{$data['description']}
</textarea>  
</div>
      </td> 
  </tr>   </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/subject_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".((!empty($data['id']))?'Update':'Submit')."</span></a>

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
    echo get_subjecs_form($_POST['data']);


}







?>