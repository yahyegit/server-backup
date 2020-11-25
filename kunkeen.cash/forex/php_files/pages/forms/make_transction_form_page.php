 <?php
    require '../../clasess/dataBase_class.php';
   require '../../clasess/customers_class.php';

   function get_all_currencies(){ 
      
      
        $currencies = array("KSH ","AED ","AFN ","ALL ","AMD ","AOA ","ARS ","AUD ","AWG ","AZN ","BAM ","BBD ","BDT ","BGN ","BHD ","BIF ","BMD ","BND ","BOB ","BRL ","BSD ","BTN ","BWP ","BYN ","BZD ","CAD ","CDF ","CHF ","CLP ","CNY ","COP ","CRC ","CUP ","CVE ","CZK ","DJF ","DKK ","DOP ","DZD ","EGP ","ERN ","ETB ","EUR ","FJD ","FKP ","GBP ","GEL ","GHS ","GIP ","GMD ","GNF ","GTQ ","GYD ","HKD ","HNL ","HRK ","HTG ","HUF ","IDR ","ILS ","INR ","IQD ","IRR ","ISK ","JMD ","JOD ","JPY ","KES ","KGS ","KHR ","KPW ","KRW ","KWD ","KYD ","KZT ","LAK ","LBP ","LKR ","LRD ","LSL ","LYD ","MAD ","MDL ","MGA ","MKD ","MMK ","MNT ","MOP ","MRU ","MUR ","MVR ","MWK ","MXN ","MYR ","MZN ","NAD ","NGN ","NIO ","NOK ","NPR ","NZD ","OMR ","PAB ","PEN ","PGK ","PHP ","PKR ","PLN ","PYG ","QAR ","RON ","RSD ","RUB ","RWF ","SAR ","SBD ","SCR ","SDG ","SEK ","SGD ","SHP ","SLL ","SOS ","SRD ","STN ","SYP ","SZL ","THB ","TJS ","TMT ","TND ","TOP ","TRY ","TTD ","TWD ","TZS ","UAH ","UGX ","USD ","UYU ","UZS ","VEF ","VND ","VUV ","WST ","XAF ","XCD ","XPF ","YER ","ZAR ","ZMW ","ZWL ");
        $cust_q = mysqli_query_("select  currency, conv_to_currency from transactions where delete_status !='1' "); 
   while($aRow = mysqli_fetch_assoc_($cust_q) ){
        $currencies[] =  $aRow['conv_to_currency'].' ';
        $currencies[] =  $aRow['currency'].' ';
  }

 
       return json_encode(array_values(array_unique($currencies)));
  } 
   function get_customers_select($customer_id){ 
  
         $options = "<option customer_name=''  customer_id='' balance='{}' >choose..</option><option customer_name=''  customer_id='' balance='{}' >Add New</option>";
         $cust_q = mysqli_query_("select customer_id, mobile, customer_name from customers where delete_status !='1' ");   
         $current_currencies = array();  // for the current customer
    while($aRow = mysqli_fetch_assoc_($cust_q) ){
       

       if ($customer_id == $aRow['customer_id']) {
              $selected = 'selected="selected"';
          }else{
              $selected = '';
          }


             $options .= "<option customer_name='{$aRow['customer_name']}' mobile='{$aRow['mobile']}'  balance='".json_encode(get_balance($aRow['customer_id']))."'  customer_id='{$aRow['customer_id']}' $selected > {$aRow['customer_name']} ".'('." {$aRow['mobile']} ".')'." </option>";  



    }
    return $options;
 } 

function get_transction_form($data){
     //  $data = clean_security($data,'2');
      $customer_id = sanitize($data['id']);
 return "
    <script type='text/javascript' > 

   
      // $( '#transacion_form' ).dialog();
 
 
        louch_form();
   /* $('#transacion_form').dialog({position: { my: \"center bottom\", at: \"left top\", of: window }, show: \"blind\", hide: \"explode\", width: 'auto',  height:'auto',  modal: true}); 
*/
 
    </script> <br>
<div id='transacion_form'  no_erro_p='1' curencies='".get_all_currencies()."'  style=' margin-left:20px;  box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;      width: 95%;
    margin-left: 1px !important;
     ' class='form'>


<input type='hidden' name='crf_code'  value='".get_unique_code()."'> 
 

    <input type='hidden' name='customer_id' value='$customer_id'>


<table class='table' style='    margin-left: 0px;width:auto !important; box-shadow: none !important;'>

   <tr style='border-bottom:none !important;'> <td class='customer_names_select'> <label class='show_'>Customer name</label><br> 
  <select onchange=\"chosen_customer($(this).find('option:selected'));\" > ".get_customers_select($customer_id)."
    </select>

  <br>
   <input type='text' name='customer_name' placeholder=\"name \" value=''  style='display:none;' > 
  </td>
  
  <td> <label class=' float_label'>mobile</label><br> 
    <input type='text' name='mobile' $disabled_input placeholder=\"mobile is optional\" value='{$data['mobile']}'    > </td> </tr>

<tr>  
 <td class='bl_box'> <label class=' blcc'>Balance:</label> <div class='bl_list' >  </div></td>
</tr>
</table>
<table class='table amount_t' style='box-shadow: none !important; width:auto;margin-left:0px;margin-top: 5px;'>
   <tr class='amount_row dont_r  '  id='jk' > 

               <td class='type_'>

                 </td>  <td> <label>Amount</label><br> 

              <input type='text'  class='currency_input' name='currency' placeholder='currency' autocomplete='off'  error_empty_msg=' currency is required ' onkeyup=\"  currency_to_upper($(this))
\"   >

               <input type='text' onkeyup=\"auto_calc($(this).closest('tr'));\" format_comma='true' placeholder='amount' autocomplete='off'  name='amount'    required   error_empty_msg=' amount is required '  style=\"
    width: 132px;
\" > 

          </td>


                 <td class='conv_check1'>
                <label style='position: relative;top: 8px;' class='conv_check'><input type='checkbox' name='convert' id='convert' onclick=\"


   if($(this).is(':checked')){ 

              $(this).closest('tr').find('.convert_div').show();
          
        }else{  
  
          $(this).closest('tr').find('.convert_div').hide();
          
    
        }

auto_calc($(this).closest('tr'));
                \"> Convert </label></td>
 <td  >
                <table  class=' table convert_div'  style='display:none; box-shadow: none !important;'>
                <tr class='dont_r' style='
    border-bottom: none !important;
'>
       <td class='mu_td'> 
             </td> 



    <td>  <label> Currency </label><br>
            <input type='text' style=\"
    margin-right: -16px;
\" class='currency_input conv_to_currency' name='conv_to_currency' placeholder='currency' onkeyup=\"currency_to_upper($(this));\"   autocomplete='off'   ></td>

                <td>
                      <label> Sell rate </label><br> <input onkeyup=\"auto_calc($(this).parents().closest('tr'));  \"  type='text'  placeholder='sell rate' autocomplete='off'  style='width:60px'  name='sell_rate'   > 
                  </td>

                 <td>  <label> Buy rate </label><br> <input   onkeyup=\"auto_calc($(this).parents().closest('tr')); \"  type='text'  placeholder='Buy rate' autocomplete='off'  style='width:60px'  name='buy_rate'        >
                  </td>

                <td>  <label class='show_'> Result </label><br> <input type='text' disabled='disabled'   class='converted_result'   name='converted_result' > 
                </td>

                <td>  <label class='show_'> Profit </label><br> <input type='text' disabled='disabled'     name='profit' > </td>


        </tr>



        </table>  

   </tr></table>
<table class='table' style='margin-left:0px; box-shadow: none !important;width:auto !important;' >

<tr style='border-bottom:none !important;'>
 <td>
       <button  title='add more ' style='font-size: 13px;
    ' class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick='add_more_row();' role='button' aria-disabled='false'><span class='ui-button-icon-primary ui-icon ui-icon-plus'></span>  add more </button> 
 </td>
</tr>

<tr style='border-bottom:none !important;'>
   <td colspan=\"3\"> <label>Description (optional)</label><br>  <textarea id='description' name='description' placeholder='Description is optional' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 85px;'  ></textarea>  

</td> <td><label class='show_'> Date</label><br> <input type='date' name='date' required  error_empty_msg='date is required!' value='".date('Y-m-d')."'>   </td> </tr>

    </table>

<div class=\"form_footer_btns\" style='width: 72%;'>   
<a href='#'  file_name=\"php_files/clasess/transactions_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"$('#transacion_form').slideUp();\" role=\"button\" aria-disabled=\"false\" style=\"
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
