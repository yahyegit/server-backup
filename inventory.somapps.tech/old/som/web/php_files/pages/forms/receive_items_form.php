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

 function get_items_form($id){
        $data = $id;
        global $ccc;

 return "



<script type=\"text/javascript\">
      
 chosen_item($('.csn select').find('option:selected'));

</script> 

 <div class='form' id='com_name_form' action='#' style=\"
    width: 45%;
    margin: auto;
\" >

<p class='title_'> Alaab ayaad kudaraysaa </p>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
<table class='table'>

   <tr>
 
 <td class='csn'><label>item name</label><br>	<input type='text' error_empty_msg='required' style='display:none;' placeholder='new item name' name='item_name'  required> <select onchange=\"chosen_item($(this).find('option:selected'))\"> ".get_items($id)." </select>  </td></tr>

   <tr>
 
 <td><label class=''>tirada <i>(quantity)</i>  </label><br>	<input   type='number' error_empty_msg='required' onkeyup=\"update_bl_item()\" placeholder='tirada' onchange=\"update_bl_item()\"  name='quantity' value='' required>      </td>  </td>   <td><label class='show_' >remainings</label><br> <input type='text'  placeholder='remainings' name='remainings' value='' disabled='disabled'  >      </td>  </tr>

   <tr>

<td><label>Qarashka kusogaday xabadiiba <i>(cost)</i></label><br>  $ccc<input type='number' style=\"
    width: 324px;
\" onkeyup=\"update_bl_item()\" error_empty_msg='required'  placeholder='Qarashka kusogaday xabadiiba (cost) ' name='cost' value=''  required>  </td> <td><label class=''>Inta iibinaysid <i>(price)</i></label><br>  $ccc<input type='number' error_empty_msg='required'  placeholder='Inta iibinaysid (price)' name='price' value=''  required>  </td></tr>


   

<tr>   

               <td colspan=\"3\"><div  style=\"
            margin-left: 12px;    margin-top: 7px;

        \"><label>Description <i>(khasab maahan)</i></label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  ></textarea>  
        </div>
              </td> 


 </tr>
</table>

<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/recieve_items_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#com_name_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>

</form>";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_items_form($_POST['data']['id']);

}









?>