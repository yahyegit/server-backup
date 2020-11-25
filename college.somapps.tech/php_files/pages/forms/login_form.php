<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form(){

 return "



<div id=\"tabs_login\" style=\"
     margin:auto auto;
     width: auto; 
 
 clear:both;
\">
 
  <div id=\"login\" style='display:none;' >
  
 <form file_name=\"php_files/clasess/auth.php\" style=\"
  display:none;
\" id='login_form' action='#'  >

<table class='table'>

<tr><td>  <label class=''> college name </label></br><input type='text' name='company_name' error_empty_msg='college name is required !'  placeholder='college name' autofocus > </td> </tr>
<tr>
 <td><label class=''> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."' autofocus > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class=''> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br>
<a href='#' style='color:#7c11a2;'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</form>
  </div>
  <div id=\"register\"   style='display:none;' >  

 <form id='register_form' style=\"
 display:none;
\" file_name=\"php_files/clasess/register_class.php\"    >
 

<p class='title_'> Register</p>

<table class='table'> 
<tr>   <td>  <label class=''> college name </label></br><input error_empty_msg='college name is required !' type='text' name='company_name' placeholder='college name' autofocus> </td> </tr>

<tr>
 
 <td> <input type='hidden' name='crf_code'  value='".get_unique_code()."'  > <label class=''> New Username </label></br>
 <input type='text' error_empty_msg='Username is required !'  name='username'   placeholder='new username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class=''> New Password </label></br>
 <input type='password' name='password' required error_empty_msg='Password is required !'  placeholder='new password'>  </td></tr>

 



 </table>


<div class=\"form_footer_btns\">   

<a href='#' form_id=\"register_form\" file_name=\"php_files/clasess/register_class.php\" class=\"submit_btn change primary_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon \"></span><span class=\"ui-button-text\">Register trail</span></a>

 
</div>

</form>

  </div>

</div>




 
<div style=\"margin-top: 0px;height: 25px;/* float: right; */position: absolute;width: 235px;/* border: 2px solid; */box-shadow: none !important;/* right: 10%; */top: 34px;z-index: 1000;clear:both;position:fixed;-webkit-backface-visibility: hidden;top: 1px;/* border: 1px solid; */width: 100%;height: 37px;box-shadow: 3px 2px 25px -7px rgba(0,0,0,0.75) !important;left: 0;/* box-shadow: -16px 21px 45px -10px rgba(0,0,0,0.55) !important; */background: #fff;top: 0;padding-top: 14px;/* padding-left: 0; */\">


<a href=\"#\"   id='rlbtnftl2' onclick=\"$('#login').fadeOut(); $('#register').fadeIn(); \" class=\" primary_button  change ui-button ui-widget   ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\" style=\"
  float:right;

\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Register</span></a>

<a  id='rlbtnftl' href=\"#\"  onclick=\"$('#register').fadeOut(); $('#login').fadeIn();\" class=\"  change ui-button ui-widget   ui-state-default ui-corner-all ui-button-text-icon-primary\" style='
 float:right;
' role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\"   >Login</span></a>



</div>



<div class='landing' style=' display:'>

      <div class='img-left' style=\"
    height: 384px; margin-top: 38px;
\" > <h4  class='title_' style=\"
    position: relative;
    top: -14px;
    text-align: left;
    border: none;
 \" >Software kan waxaa loogu talagalay college yada   </h4> 

 <div class='video'

style=' 
position: relative;bottom: 113px;width:auto;left: -112px;float: right;/* border: 2px solid; */height: 480px;box-shadow: none !important;
    
    '

       > 


<iframe style='box-shadow: -16px 21px 45px -10px rgba(0,0,0,0.55);
    float: right;' width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/MDevC1AdjIs\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
 </div>  




       </div>  



      <div class='img-right'><span class='span-text'> Arag maado kasta inta arday dhigata waqtiyada ladhigo, macalimiinta dhiga, iyo wixii maadada laxiriira. </span> <img src='css/images/subjects.png'></div>


      <div class='img-left'><span  class='span-text' > Kumaamul qarashaadka ka baxa college ka sida kirada iyo mushaharaadka </span>  <img src='css/images/expenses.png'></div>

      <div class='img-right'><span  class='span-text' > Student account waxaad ku arkaysaa xiisadaha uuqaato, lacagta uu kudhigto , exams ka ardayga, payment history, lacagaha laguleeyahay...</span> 
 <img src='css/images/student_account.png'></div>

      <div class='img-left'><span  class='span-text' >Sigaar ah u arag ardayda lacagaha bixin iyo kuwa bixiyay </span>
 <img src='css/images/unpaid_clasess.png'></div>

  <div class='img-right' > <span  class='span-text'>Hadaad admin tahay waxaad arkaysaa staff ka lacagaha uu qabtay discounts ka uu sameeyay </span>
 <img src='css/images/staff.png'></div>


 <div class='img-left' > <span  class='span-text'>
     Admin ku wuxuu arkikaraa report ka college sida income,expense iyo profit 
   </span>
 <img src='css/images/reports.png'></div>


<div class='img-right'><span class='span-text' >Automatic daily bakup ayuu lee yahay oo uu google drive kuugu save garaynayo data da pdf ahaan</span> <div>

  <div class='img-left' >  <span  class='span-text'>Waa program user freindly ah oo tooba bar ubaahnayn.<br> Hadaad u baahantahay in wax lagaabado ama lagugusoodaro update ku waa free.</span>


<a href=\"#\"  onclick=\"$('#login').fadeOut(); $('#register').fadeIn(); $('html, body').animate({scrollTop: '0px'}, 500);\"   class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\" style=\"
     margin-left: 100px;
    font-size: 18px !important;
\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\"> Try 14 days for free</span></a>

     

    </div>

 


  </div>



  







<script type=\"text/javascript\">
      
    $(\"input[name='company_name']:first\").autocomplete({
      source: ".json_encode(get_companies_list())."
    });
 
  $('.landing div').fadeIn();




      if ($(window).width() < 1007) {
 $('.landing img,.img-left .img-right').addClass('mobile-img');
              $('.landing iframe').attr('width','365');
 $('#rlbtnftl').css('float','left');
     
 $('#rlbtnftl,#rlbtnftl2').attr('style','float:left !important');


}else{
     $('.landing span.span-text').attr('style','width:404px !important');  

 }
 </script>




 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>
