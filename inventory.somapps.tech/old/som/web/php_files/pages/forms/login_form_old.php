<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 
   function get_all_currencies(){ 
      
      
        $currencies = array("USD ","SOS ","KSH ","AED ","$ ","AFN ","ALL ","AMD ","AOA ","ARS ","AUD ","AWG ","AZN ","BAM ","BBD ","BDT ","BGN ","BHD ","BIF ","BMD ","BND ","BOB ","BRL ","BSD ","BTN ","BWP ","BYN ","BZD ","CAD ","CDF ","CHF ","CLP ","CNY ","COP ","CRC ","CUP ","CVE ","CZK ","DJF ","DKK ","DOP ","DZD ","EGP ","ERN ","ETB ","EUR ","FJD ","FKP ","GBP ","GEL ","GHS ","GIP ","GMD ","GNF ","GTQ ","GYD ","HKD ","HNL ","HRK ","HTG ","HUF ","IDR ","ILS ","INR ","IQD ","IRR ","ISK ","JMD ","JOD ","JPY ","KES ","KGS ","KHR ","KPW ","KRW ","KWD ","KYD ","KZT ","LAK ","LBP ","LKR ","LRD ","LSL ","LYD ","MAD ","MDL ","MGA ","MKD ","MMK ","MNT ","MOP ","MRU ","MUR ","MVR ","MWK ","MXN ","MYR ","MZN ","NAD ","NGN ","NIO ","NOK ","NPR ","NZD ","OMR ","PAB ","PEN ","PGK ","PHP ","PKR ","PLN ","PYG ","QAR ","RON ","RSD ","RUB ","RWF ","SAR ","SBD ","SCR ","SDG ","SEK ","SGD ","SHP ","SLL ","SOS ","SRD ","STN ","SYP ","SZL ","THB ","TJS ","TMT ","TND ","TOP ","TRY ","TTD ","TWD ","TZS ","UAH ","UGX ","USD ","UYU ","UZS ","VEF ","VND ","VUV ","WST ","XAF ","XCD ","XPF ","YER ","ZAR ","ZMW ","ZWL ");
 
 
        //$currencies[] =  mysqli_result_(mysqli_query_("select currency from settings limit 1 "), 0);
        
 
 
       return json_encode(array_values(array_unique($currencies)));

  } 


 function get_login_form(){

 return "
 
<img style=\"
    width: 371px;
    height: 187px;
\" src='css/images/r.jpg'> 

<p class='title_' style='    text-align: left;
    width: 400px;'> Waa simple inventory system oo somali ah. </p>
 

<div class=\"l_page_list\"   style=\"
  width: 707px;
\">



<p>Faaiidayinkiisa waxaa kamida in Macaamiisha daymaha laguleeyahay sigaar ah ayaad u arkaysaa Daymaha daahana sigaar ah ayuu kuusoo xasuusinayaa </p>

<p> Macmiilka account ayuu lee yahay oo ku arkaysid alaabaha uugatay, lacagaha uubixiyay, siduu ukalabixiyay, shaqaalaha kaqaaday iyo daymaha kuharay. Khasab maahan macmiilka magiciisa inaad waydiisid  </p>
<p> 
macmiilka rasiidkiisa email ka ayaad uugudirikartaa </p>
 <p> Hadii alaabta loogeeyay qofka ugeeyayna waad arkays. Khasab maahan qofka alaabta ugaynaya inaad system ka galisid. </p>

<p> Alaabta dhamaatayna sigaar ah ayuu kuusooxasuusinayaa kuwada dhamaan rabana wuu kusooxasuusinaya siaad usii dalbatid intaysan kaadhamaan. </p>


<p> Qarashaadka kaabaxa waad kumaamulikarta sida kirada,mushaharka shaqaalaha, korantada iyo wixii kaabaxa oodhan </p>

<p> Automatic report ayuu leyahay oo ku arkaysid  alaabtaad gaday, lacagaha kusogalay, qarshadka kaabaxay iyo faaiidada (Net profit & gross profit) . </p>


<p>Alaabtana sigaar ah baad umaamulikarta sida alaabta kuu hartay, inta kuuhartay intay kuugufadhido, inta aad gaday, qarashka kusoogaday iyo qiimahad gadaysid . </p>

<p>Shaqaalahaga waad kumaamulikarta waxaad arkaysa shaqalaha alaabtu gaday lacagta uuqabtay, discounts ka uu sameeyay. Shaqaaluhu reports ka ma'arkikaro alaabna kumasodarikaro hadaanlofasixin. Hadii shaqaluhu shaqada katago disable baad sarikarta si uusan system ka usoogalin.</p>

 

<p>System kan waxaa kushaqaynkara company kasa oo shaqadiisu service ahayn sida tukaamada,farmasiyada,carwooyinka, kalintashiidaaka.</p>

<p> Update kuna waa free macnaha hadaad rabtid in system wax lagaagabadalo ama lagugu soo daro waa free  </p>


<p> hadii aad galisay expire date wuxuu kusoo xasuusinayaa alaabta dhicitaankoodu soo dhawaaday iyo kuwa dhacay. khasab maahan inaad expire date galisid. </p>

  <p>Backup kana email ka ayuu kuugu dirayaa maalinkasta </p>
      
    <p> Bilaash kutijaabi kadib nalasooxiriir   .  </p>
 
 
</div>



<div id=\"tabs_login\" style=\"
   
    width: 34%;
    position: absolute;
    top: 5px;
    right: 2px;

    
\">
  <ul style=\"
 
\"> <li style=\"
    margin-bottom: 3px;  
\"><a href=\"#register\"   onclick=\"$('#login_form').fadeOut(); $('#register_form').fadeIn(); \" >Register</a></li>
    <li><a href=\"#login\"  onclick=\"$('#register_form').fadeOut(); $('#login_form').fadeIn();\" >Login</a></li>
   
  </ul>
  <div id=\"login\" style='margin-left:-20px;'>
  
 <form file_name=\"php_files/clasess/auth.php\" style=\"
  
\" id='login_form_l' action='#'  >

<table class='table'>

<tr><td>  <label class=''> magacaga ama company ga </label></br><input type='text' name='company_name' error_empty_msg='Company name is required !'  placeholder='magacaga ama company ga' > </td> </tr>
<tr>
 <td><label class=''> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."'  > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class=''> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br>
<a href='#' style='color:blue'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</form>
  </div>
  <div id=\"register\" style='margin-left:-20px;'>  

 <form id='register_form_l' style=\"
 
\" file_name=\"php_files/clasess/register_class.php\"    >
 
<table class='table'> 
<tr>   <td>  <label class=''> magacaga ama  company ga </label></br><input error_empty_msg='Company name is required !' type='text' name='company_name' placeholder='magacaga ama  company ga' > </td> </tr>

<tr>
 
 <td> <input type='hidden' name='crf_code'  value='".get_unique_code()."'  > <label class=''> Username </label></br>
 <input type='text' error_empty_msg='Username is required !'  name='username' value=''  placeholder='Username' required>  </td></tr>
<tr>
 
 <td>  <label class=''> Password </label></br>
 <input type='password' name='password' required  placeholder='password' error_empty_msg='Password is required !' >  </td></tr>

 <tr style='display:none'>
 
<td><label class=''>Email (<i>khasab maahan</i>)</label></br>
<input type='email' placeholder='email (khasab maahan)' name='email' value='' placeholder='optional' > 
 </td></tr>

<tr style='display:none'>
 
 
 <td>  <label>nooca lacagta kushaqaysid</label> </br> <input type='text'    c='".get_all_currencies()."' class='currency' error_empty_msg='required' required   name='currency' placeholder=\"nooca lacagta kushaqaysid e.g: USD \" value='$' >  </td></tr>



 </table>


<div class=\"form_footer_btns\">   

<a href='#' form_id=\"register_form\" file_name=\"php_files/clasess/register_class.php\" class=\"submit_btn change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon \"></span><span class=\"ui-button-text\">Register trail</span></a>

 
</div>

</form>

  </div>
















</div>



<script type=\"text/javascript\">
      
    $(\"input[name='company_name']:first\").autocomplete({
      source: ".json_encode(get_companies_list())."
    });
 
    $( \"#tabs_login\" ).tabs();


 


 
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
  
  echo get_login_form();

}









?>


