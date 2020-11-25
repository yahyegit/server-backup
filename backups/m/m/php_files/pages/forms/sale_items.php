 <?php
    require '../../clasess/dataBase_class.php';
  




 function delevered__auto()
  {


    $parts = array();
    $qq = mysqli_query_("SELECT DISTINCT `delevered_by` from customer_items where delete_status !='1'");
    while ($q = mysqli_fetch_assoc_($qq)  ) {
          $parts[] = $q['delevered_by'].' ';
   }
return json_encode($parts);
}





   function get_customers_list(){ 
  
         $options = "<option >choose..</option><option>Add new</option>";
         $cust_q = mysqli_query_("select email,id,address,customer_name,mobile from customers where customer_name!='No name' and delete_status !='1' ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
  
             $options .= "<option  customer_id='{$aRow['id']}'   email='{$aRow['email']}'  address='{$aRow['address']}' mobile='{$aRow['mobile']}'>{$aRow['customer_name']}</option>";  
    }
    return $options;
 } 
 


    function get_items_avai(){ 
  
         $options = "<option >choose..</option><option >add new items</option>";
         $cust_q = mysqli_query_("select item_name,price,remainings from items where remainings !='0' and delete_status !='1' ");   
     while($aRow = mysqli_fetch_assoc_($cust_q) ){
       
             $options .= "<option  rem='{$aRow['remainings']}'  price='{$aRow['price']}'>{$aRow['item_name']}</option>";  
    }
    return $options;
 } 
 

function get_form($data){
      global $ccc;

     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);
 return "
    <script type='text/javascript' > 
 
    $(\"input[name='delevered_by']\").autocomplete({
      source: ".delevered__auto()."
    });

   
  
    </script> <br>
<div id='register_form'  style=' padding: 20px !important;   box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

     <input type='hidden' name='customer_id'>

 
 

 <table class='table amount_t' style='   margin-left: 0px;width:auto !important; box-shadow: none !important;'>   
<tbody>
<tr class='first_row'>

  <td class='css csn' style=\"
    border-bottom: 1px solid blue;
\" > <p> <label class=' float_label show_'>item name </label><br> 
       <select name='item_name' error_empty_msg='required' required onchange=\"items_salling($(this).find('option:selected'))\"> ".get_items_avai()." </select> </p>

        <p> <label class=' float_label  '>Quantity </label><br> 
          <input type='number' name='quantity' placeholder='Quantity' onkeyup=\"realTimeBl(); \" onchange=\"realTimeBl(); \" error_empty_msg='required'  required  > </p>
       
        <p> <label class=' float_label  '>price </label><br> 
          $ccc<input type='number' placeholder='price' name='price' onkeyup=\"realTimeBl(); \"  disabled='disabled'    > </p>

         <p> <label class=' float_label show_'>remaining </label><br> 
          <input type='number' name='rem'  onkeyup=\"realTimeBl(); \"  disabled='disabled'    > </p>


  </td>

     </tr>
   </tbody>  
</table> 

  <p>
       <button  title='add more items ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 
</p>
 
<table class='table' style=' float:left;    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr  style='border-bottom:none !important;'>
        <td class='csn'> <label class='float_label show_'>customer Name <i>(optional)</i></label> <br>

             <select  onchange=\"chosen_custtomer($(this).find('option:selected'))\"> ".get_customers_list()." </select>
             <br><input type='text'    name='customer_name' placeholder=\"name \" value=''  style='display:none;' > 
      </td> 
    
 
 </tr>

 <tr>   <td class='c_info' style='display:none;' > <label class=' float_label'>mobile <i>(optional)</i></label>  
    <input type='text' name='mobile' placeholder=\"mobile (optional)  \" value='' > </td>  </tr>


<tr> <td class='c_info' style='display:none;'> <label class=' float_label'>address <i>(optional)</i></label>  </br>
    <input type='text' name='address' placeholder=\"address (optional)  \" value='' > </td> </tr>
 
 
<tr style='border-bottom:none !important;'>
  <td> <label class='show_'>Balance</label><br> 
     $ccc<input type='text' name='balance' value=''  disabled='disabed' style='display:;border-left:none;' > 
    </td>
</tr> 

<tr style=\"border-bottom:none !important;\" >
    <td> 
 <label class=''>Paid <i>(optional)</i></label><br> 
   $ccc<input type='number' onkeyup='realTimeBl()' onchange='realTimeBl()' name='amount' placeholder=\"  paid (optional)\" value=''   style='display:; border-left:none; ' > </div>
  </td> 
</tr>
<tr>  <td>  <label class=''>discount<i>(optional)</i></label><br> 
   $ccc<input type='number' onkeyup='realTimeBl()'   onchange='realTimeBl()'   name='discount' placeholder=\"  discount (optional) \" value=''   style='display:; border-left:none; ' >  
  </td>  </tr>

<tr  style='border-bottom:none !important;'>
 
 <td>  <label class='show_'>delivered by <i>(optional)</i></label><br> 
     <input type='text' name='delevered_by' value=''   style=' ' >  
    </td>
</tr> 

<tr style='display:none;border-bottom:none !important;'>
  <td> <label class=''>date</label><br> 
     <input type='date' name='date' value='".date('Y-m-d')."'   style='display:;' > </div>
    </td>
</tr> 

  </table>







<div class=\"form_footer_btns sing_no_mar \" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/sale_items_class.php\" class=\"submit_btn  change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

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
    echo get_form($_POST['data']);


}







?>
