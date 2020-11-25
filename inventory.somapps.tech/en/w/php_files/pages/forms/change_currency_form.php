<?php
    require '../../clasess/dataBase_class.php';
// 
   function get_all_currencies(){ 
      
      
        $currencies = array("USD ","SOS ","KSH ","AED ","$ ","AFN ","ALL ","AMD ","AOA ","ARS ","AUD ","AWG ","AZN ","BAM ","BBD ","BDT ","BGN ","BHD ","BIF ","BMD ","BND ","BOB ","BRL ","BSD ","BTN ","BWP ","BYN ","BZD ","CAD ","CDF ","CHF ","CLP ","CNY ","COP ","CRC ","CUP ","CVE ","CZK ","DJF ","DKK ","DOP ","DZD ","EGP ","ERN ","ETB ","EUR ","FJD ","FKP ","GBP ","GEL ","GHS ","GIP ","GMD ","GNF ","GTQ ","GYD ","HKD ","HNL ","HRK ","HTG ","HUF ","IDR ","ILS ","INR ","IQD ","IRR ","ISK ","JMD ","JOD ","JPY ","KES ","KGS ","KHR ","KPW ","KRW ","KWD ","KYD ","KZT ","LAK ","LBP ","LKR ","LRD ","LSL ","LYD ","MAD ","MDL ","MGA ","MKD ","MMK ","MNT ","MOP ","MRU ","MUR ","MVR ","MWK ","MXN ","MYR ","MZN ","NAD ","NGN ","NIO ","NOK ","NPR ","NZD ","OMR ","PAB ","PEN ","PGK ","PHP ","PKR ","PLN ","PYG ","QAR ","RON ","RSD ","RUB ","RWF ","SAR ","SBD ","SCR ","SDG ","SEK ","SGD ","SHP ","SLL ","SOS ","SRD ","STN ","SYP ","SZL ","THB ","TJS ","TMT ","TND ","TOP ","TRY ","TTD ","TWD ","TZS ","UAH ","UGX ","USD ","UYU ","UZS ","VEF ","VND ","VUV ","WST ","XAF ","XCD ","XPF ","YER ","ZAR ","ZMW ","ZWL ");
 
 
        //$currencies[] =  mysqli_result_(mysqli_query_("select currency from settings limit 1 "), 0);
        
 
       str_replace('[', '{', json_encode(array_values(array_unique($currencies))));
       $j =  str_replace('[', '{', json_encode(array_values(array_unique($currencies))));

       $j =  str_replace(']', '}', $j);
       return json_encode(array_values(array_unique($currencies)));

  } 

 function get_mobile_form(){

 return "
<div class='form sing_no_mar' id='com_moblie_form' action='#' style='margin:auto; width:40%' >
<input type='hidden' name='crf_code'  value='".get_unique_code()."'>
<table class='table'><tr>
 
 <td>	 <label>nooca lacagta kushaqaysid</label> </br> <input type='text' placeholder='nooca lacagta'  c='".get_all_currencies()."' class='currency' error_empty_msg='required' required   name='currency' value='".mysqli_result_(mysqli_query_("select currency from settings limit 1 "), 0)."' >  </td></tr></table>

<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/settings_class.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Submit</span></a>

<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#com_moblie_form');\" role=\"button\" aria-disabled=\"false\" style=\"
    margin-left: 32px;
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>


</div>



<script type=\"text/javascript\">
    
  availble_currencies = JSON.parse($('.currency').attr('c'));
  $('.currency').autocomplete({minChars: 0 , source: availble_currencies }).focus(
    function() {
        if (this.value == '') {
               $(this).autocomplete('search', ' ');
            }
        }
    ); // display all availble options by default 




</script>      
  

 

";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo get_mobile_form();

}









?>