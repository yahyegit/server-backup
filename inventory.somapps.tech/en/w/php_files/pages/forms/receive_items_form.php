 


<?php
    require '../../clasess/dataBase_class.php';
   
    function get_items($id){ 
  
        $options = "<option items_name=''  item_id='' >choose..</option><option items_name=''  item_id='' >Add new</option>";
        $cust_q = mysqli_query_("select id,price, item_name,remainings from items where delete_status!='1' ");   
    while($aRow = mysqli_fetch_assoc_($cust_q) ){
      
      if ($id == $aRow['id']) {
             $selected = 'selected="selected"';
         }else{
             $selected = '';
         }


            $options .= "<option  price='{$aRow['price']}'  item_id='{$aRow['id']}'  remainings='{$aRow['remainings']}'  $selected >{$aRow['item_name']}</option>";

   }
   return $options;
} 
   function get_customers_list(){ 
  
         $options = "<option >choose..</option><option>Add new</option>";
         $cust_q = mysqli_query_("select id, s_name,mobile from suppliers where s_name!='No name' and delete_status !='1' ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){  
             $options .= "<option  customer_id='{$aRow['id']}'  mobile='{$aRow['mobile']}'>{$aRow['s_name']}</option>";  
    }
    return $options;
 } 
 
 
 

function get_form($data){
      global $ccc;
      $last_order = mysqli_result_(mysqli_query_("SELECT order_number FROM `recieved_history` order by id desc limit 1 "), 0);
      $last_order = $last_order+1;
      
     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);
 return "
    <script type='text/javascript' > 
 
  
    </script> <br>

 

<div id='register_form'  style=' padding: 20px !important;   box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form receive_form'>

   <p class='title_'> Receiving items </p>

<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

     <input type='hidden' name='customer_id'>

 

     
<table class='table' style='     margin-left: 0px;width:auto !important; box-shadow: none !important;'>

<tr  style='border-bottom:none !important;'>
     <td class='csn'> <label class='float_label show_'> Supplier <i>(optional)</i></label> 

          <select  onchange=\"chosen_custtomer($(this).find('option:selected'))\"> ".get_customers_list()." </select>
          <input type='text'    name='customer_name' placeholder=\"enter new supplier name \" value=''  style='display:none;

 position: relative;
 top: 10px;


          ' > 
   </td> 
<td class='c_info' style='display:none;'> <label class=' float_label'>mobile <i>(optional)</i></label> <br> 
 <input type='text' name='mobile' placeholder=\"mobile (optional)  \" value='' > </td>  
</tr>

</table>







 <table class='table amount_t' style='   margin-left: 0px;width:auto !important; box-shadow: none !important;'>   



 <tr class='first_row' >
 
 <td class='csn'><label class='show_'>item name</label><br>	<input type='text' error_empty_msg='required' style='display:none;' placeholder='new item name' name='item_name'  required> <select onchange=\"chosen_item($(this).find('option:selected'))\"> ".get_items($id)." </select>  </td>

    
 <td><label class=''>Quantity  </label><br>	<input   type='number' error_empty_msg='required' onkeyup=\"update_bl_item($(this).closest('tr')); currentTotalCost();\" placeholder='Quantity' onchange=\"update_bl_item(); currentTotalCost(); \"  name='quantity' value='' required>      </td>  </td>  

   
<td><label>Cost </label><br>  $ccc<input type='number' style=\"
    width: 324px;
\" onkeyup=\"currentTotalCost(); update_bl_item(); \" error_empty_msg='required'  placeholder='Cost' name='cost' value=''  required>  </td> <td><label class=''>Price</label><br>  $ccc<input type='number' error_empty_msg='required'  placeholder='Price' name='price' value=''  required>  </td>

<td> <label class='show_' >Remainings</label><br> <input type='text'  placeholder=' ' name='remainings' value='' disabled='disabled'  >  </td>
</tr>

 
</table> 

  <p>
       <button  title='add more items ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 
</p>
 

<table class='table' style='    width: 70%;
margin-left: 0;'>

<tr style='border-bottom:none !important;'>

<td> <label class='show_'>Total cost</label><br> 
  $ccc<input type='text' name='balance' value=''  error_empty_msg='required'  style='display:;border-left:none;' > 
 </td>

 <td> 
 <label class=''>Paid <i>(optional)</i></label><br> 
 $ccc<input onkeyup=\" currentTotalCost();\" onchange=\"currentTotalCost(); \"  type='number'  name='amount' placeholder=\"  paid (optional)\" value=''   style='display:; border-left:none; ' > </div>
 </td> 
 <td> <label class=''>date</label><br> 
 <input type='date' name='date' value='".date('Y-m-d')."'   style='display:;' > </div>
</td>

<td> <label class=''>Order No</label><br> 
<input type='number' name='order_number' value='$last_order' placeholder='Order No' error_empty_msg='required'  > </div>
</td>


</tr> 


<tr style='border-bottom:none !important;'>
    <td colspan=\"3\"><div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label>Description <i>(optional)</i></label><br>  <textarea id='description' onfocus=\" $(this).attr('style','border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;');  \" onblur=\" $(this).attr('style','border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px; width: 203px; height: 27px;'); \"
 name='description' placeholder='Description (optional) ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px; width: 203px; height: 27px; '  ></textarea>  
</div>
      </td>
</tr>  


</table>


<div class=\"form_footer_btns\" style=\"width: 72%;margin-bottom: 42px;\">   
<a href='#'  file_name=\"php_files/clasess/recieve_items_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"$('#register_form').slideUp();\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>
</div>
";

}

/*<td>  <label class='show_'>rasiidka maxaa kusamayn? </label> 
 <select remove_filter='true' error_empty_msg='required'  name='receipt_type'     onchange=\"if($(this).val() =='send to email' || $(this).val() =='both'){ $('.email').show(); }else{ $('.email').hide();}  \"   > <option>choose..</option><option>print</option><option>send to email</option> <option>both</option></select>

     <input type='text' name='email' class='email' value=''  style='display:none' >    
    </td>*/
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
    echo get_form($_POST['data']);


}







?>

