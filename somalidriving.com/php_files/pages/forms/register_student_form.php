<?php
    require '../../clasess/dataBase_class.php';
  


 
   function get_courses($course_id){ 
    $account = mysqli_result_(mysqli_query_("SELECT `account` FROM `settings` LIMIT 1"), 0);

         $options = "<option course_name=''  course_id='' >choose..</option> ";
         $cust_q = mysqli_query_("select * from courses where delete_status !='1' ORDER BY course ASC ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       
        $cost = '$'.$aRow['cost'];
        
       if ($course_id == $aRow['id']) {
              $selected = 'selected="selected"';
          }else if($course_id == trim("{$aRow['course']}, ($cost) ({$aRow['duration']})")){
            $selected = 'selected="selected"';
        }else{
              $selected = '';
          }


             $options .= "<option   $selected account='$account' cost='{$aRow['cost']}' > {$aRow['course']}, ($cost) ({$aRow['duration']}) </option>";  



    }
    return $options;
 } 


 

 
function edit_student_form($data){
     //  $data = clean_security($data,'2');


       $id = sanitize($data['id']);
      
  // $data = mysqli_fetch_assoc_(mysqli_query_("select * from students where id=$id "));
     
   $xD = explode('-',$data['birthDate']);
   $data['birthDate'] = $xD[2];
 
 return "
 <p class='title_'> Fadlan isdiiwaangali. </p>

<div id='register_form'  style='    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>
<input type='hidden' name='id'  value=''> 


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

 
<input type='hidden' id='payment_number' account='$account' cost=''  value='$de'>

<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>
 
            <tr style='border-bottom:none !important;'>
            <td> <label class=''>course ka </label><br> 
            <select error_empty_msg='required' id='payment_amount_selected'  required name='course'>".get_courses($id)." </select>
                
            </td>
            </tr>

   <tr style='border-bottom:none !important;'> <td> <label class=' '>Magacaaga oo sadexan</label><br> 
       <input type='text' name='full_name'  placeholder=\"Magacaaga oo sadexan   \" value='{$data['full_name']}'  error_empty_msg='required' required  >
   </td>   
   </tr>

     <tr style='border-bottom:none !important;'>
        <td> <label class=''>Telefoonka:</label><br> 
             <input type='number' name='mobile'  placeholder=\"Telefoonka \" value='{$data['mobile']}'  error_empty_msg='required' required  >
         </td>
     </tr>


     <tr style='border-bottom:none !important;'>
       <td> <label class=''>Sanadka dhalashada</label><br> 
          <input type='number' name='birthDate' style=\"
          width: 172px;
      \"  placeholder=\"Taariikhda dhalashada   \" value='{$data['birthDate']}'  error_empty_msg='required' required  >
      </td>
      </tr>

     <tr style='border-bottom:none !important;'>
       <td> <label class=''>Dagmada</label><br> 
          <input type='text' name='address'  placeholder=\"Dagmada   \" value='{$data['address']}'  error_empty_msg='required' required  >
      </td>
      </tr>



</table>



   

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/students_class.php\" class=\"submit_btn payment_account_no change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Bixi lacagta</span></a>

 
</div>
</div>
";

}


 
// submited 
if(isset($_POST['data'])){
     echo edit_student_form($_POST['data']);


}







?>

