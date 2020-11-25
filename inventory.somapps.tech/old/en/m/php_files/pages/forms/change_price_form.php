 <?php
    require '../../clasess/dataBase_class.php';

function get_expense_form($data){
     //  $data = clean_security($data,'2');
global $ccc;
     $customer_id = sanitize($data['id']);

   $price = mysqli_result_(mysqli_query_("select price from items where id='$customer_id' and delete_status!='1'")); 
      $name = mysqli_result_(mysqli_query_("select item_name from items where id='$customer_id' and delete_status!='1'")); 
          
 
 return "
    <script type='text/javascript' > 

   
      // $( '#register_form' ).dialog();
 
  
    </script> <br>
<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form sing_no_mar' >


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>
<br> 
    <input type='hidden' name='id' value='$customer_id'>


<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td > <div style='display:;margin-left: 12px;'><label class=''>item</label><br> 
 
   <input type='text' error_empty_msg='required' required name='item_name' placeholder=\"item\" value='$name'     > 
  </div></td>
   
  
 </tr>



<tr>    <td> <div  style=\"
    margin-left: 12px;  
\"><label class=''>price</label><br> 
   $ccc<input type='number'  error_empty_msg='required'  required name='price' placeholder=\"price\" value='$price'  style='display:;' > </div>
  </td>
 </tr>
  


    </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/change_price_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">".((!empty($data['id']))?'Update':'Submit')."</span></a>

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
    echo get_expense_form($_POST['data']);


}







?>