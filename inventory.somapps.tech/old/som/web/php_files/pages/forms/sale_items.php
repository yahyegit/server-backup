 <?php
    require '../../clasess/dataBase_class.php';
  



 function delevered__auto()
  {


    $parts = array();
    $qq = mysqli_query_("SELECT DISTINCT `delevered_by` from invoices where delete_status !='1'");
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
 
    $(\"input[name='delevered_by']\").autocomplete({minChars: 0 ,  source: ".delevered__auto()." }).focus(
    function() {
        if (this.value == '') {
               $(this).autocomplete('search', ' ');
            }
        }
    ); // display all availble options by default 
   
  
    </script> <br>

 

<div id='register_form'  style=' padding: 20px !important;   box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>

   <p class='title_'> Waxbaad iibinaysaa </p>

<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<button style=\"
    float: right;
\"    onclick=\"$('#register_form').slideUp(); $('.ui-dialog').css('display','none !important;')\" type='button' class='ui-button ui-corner-all ui-widget ui-button-icon-only ui-dialog-titlebar-close' title='Close'><span class='ui-button-icon ui-icon ui-icon-closethick'></span><span class='ui-button-icon-space'> </span>Close</button>

     <input type='hidden' name='customer_id'>

 

    <div  style='  float:left;  ' >


 <table class='table amount_t' style='   margin-left: 0px;width:auto !important; box-shadow: none !important;'>   
<tbody>
<tr class='first_row'>

  <td class='css csn'> <label class=' float_label show_'>item name </label><br> 
       <select name='item_name' error_empty_msg='required' required onchange=\"items_salling($(this).find('option:selected'))\"> ".get_items_avai()." </select>
  </td>


  <td> <label class=' float_label  '>tirada <i>(quantity)</i> </label><br> 
    <input type='number' name='quantity' placeholder='tirada' onkeyup=\"realTimeBl(); \" onchange=\"realTimeBl(); \" error_empty_msg='required'  required  > </td>
 
  <td> <label class=' float_label  '>price </label><br> 
    $ccc<input type='number' placeholder='price' name='price' onkeyup=\"realTimeBl(); \"  disabled='disabled'    > </td>

   <td> <label class=' float_label show_'>remaining </label><br> 
    <input type='number' name='rem'  onkeyup=\"realTimeBl(); \"  disabled='disabled'    > </td>
     </tr>
   </tbody>  
</table> 

  <p>
       <button  title='add more items ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 
</p>
</div>
<table class='table' style='     margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr  style='border-bottom:none !important;'>
        <td class='csn'> <label class='float_label show_'>customer Name <i>(khasab maahan)</i></label> 

             <select  onchange=\"chosen_custtomer($(this).find('option:selected'))\"> ".get_customers_list()." </select>
             <input type='text'    name='customer_name' placeholder=\"enter new customer name \" value=''  style='display:none;

    position: relative;
    top: 10px;


             ' > 
      </td> 
  <td class='c_info' style='display:none;'> <label class=' float_label'>mobile <i>(khasab maahan)</i></label> <br> 
    <input type='text' name='mobile' placeholder=\"mobile (khasab maahan)  \" value='' > </td>    
 <td class='c_info' style='display:none;'> <label class=' float_label'>address <i>(khasab maahan)</i></label>  </br>
    <input type='text' name='address' placeholder=\"address (khasab maahan)  \" value='' > </td>
 </tr>

 


 
<tr style='border-bottom:none !important;'>
  <td> <label class='show_'>Balance</label><br> 
     $ccc<input type='text' name='balance' value=''  disabled='disabed' style='display:;border-left:none;' > 
    </td>


<td> <label class=''>date</label><br> 
     <input type='date' name='date' value='".date('Y-m-d')."'   style='display:;' > </div>
    </td>



</tr> 

<tr style=\"border-bottom:none !important;\" >
    <td> 
 <label class=''>Paid <i>(khasab maahan)</i></label><br> 
   $ccc<input type='number' onkeyup='realTimeBl()' onchange='realTimeBl()' name='amount' placeholder=\"  paid (khasab maahan)\" value=''   style='display:; border-left:none; ' > </div>
  </td> <td> <div  style=\"
    margin-left: 12px;    margin-top: 7px;

\"><label class=''>discount<i>(khasab maahan)</i></label><br> 
   $ccc<input type='number' onkeyup='realTimeBl()'   onchange='realTimeBl()'   name='discount' placeholder=\" discount (khasab maahan)\" value=''   style='display:; border-left:none; ' >  
  </td>


 <td>  <label class='show_'>delivered by <i>(khasab maahan)</i></label><br> 
     <input type='text' name='delevered_by' value=''   style=' ' >  
    </td>



</tr>






</tr> 





  </table>







<div class=\"form_footer_btns\" style=\"width: 72%;margin-bottom: 42px;\">   
<a href='#'  file_name=\"php_files/clasess/sale_items_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

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
