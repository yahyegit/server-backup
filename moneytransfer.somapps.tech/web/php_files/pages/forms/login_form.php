<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form(){

 return "

 <img src='../r.jpg'  style='
 
    position: absolute;
    width: 307px;
    height: 153px;
    /* border: 1px solid; */
    left: 60px;
    top: 64px;

'  alt='responsive' >


<div class=\"l_page_list\"   style=\"

    width: 700px;
    position: absolute;
    top: 249px;
\">



     <p>Waa barnaamij lacagaha layskugu diro sida xawaaladaha oo company gaaga kubilaabankartid khaska kuu ah. </p>
     
     <p> Waxayaabaha uulee yahay waxaa kamida, Shaqaaluhu wuxuu leyahay <b>limit uu dirikaro</b> iyo <b>limit uu qaban karo</b> 
        Shaqaalo kasta report kiisa bes ayuu arkayaa 
    Maamulkuna report ka company ga ayuu arkayaa.
      program ku  <b>sms</b> na wuu leeyahay iyo waxyaabo kale. </p>

    <p> Hadaad ubaahantahay inaad ku isticmaashid Domain khaas kuu ah example: <b>myDomain.com</b> waa laguugu samaynayaa  </p>
     
    <p> Automated google drive backup buu leeyahay. </p>

    <p> Bilaash kutijaabi hadaad hadaad u baahantahay in waxlagaaga badalo ama wax lagugu soodaro waa diyaar .  </p>



    <p style=\"      
  \">  Hadaad ubaahantahay software User friendly ah oo baahida ganacsigaaga daboola oo waqti Badan kuu badbaadinaya waa laguu samaynayaa.  </p>

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

<tr><td>  <label class='show_'> Company name </label></br><input type='text' name='company_name' error_empty_msg='Company name is required !'  placeholder='your company name' > </td> </tr>
<tr>
 <td><label class='show_'> Username </label></br> <input type='hidden' name='crf_code'  verror_empty_msg='Username is required !'  alue='".get_unique_code()."'  > 
 <input type='text'  placeholder='username'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' error_empty_msg='password can't be empty !'  placeholder='password' name='password' required >  </td></tr>
 </table>




<div class=\"form_footer_btns\">   

<a href='#' form_id=\"login_form\" file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget primary_button ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon  \"></span><span class=\"ui-button-text\">Login</span></a>

 <br>
<a href='#' style='color:#7c11a2;'  title='click to get your login credentials .'   onclick=\"get_template.settings('pages/forms/reset_form.php');\"> forgot password ? </a>
 
</div>


</form>
  </div>
  <div id=\"register\" style='margin-left:-20px;'>  

 <form id='register_form_l' style=\"
 
\" file_name=\"php_files/clasess/register_class.php\"    >
 
<table class='table'> 
<tr>   <td>  <label class='show_'> Company name </label></br><input error_empty_msg='Company name is required !' type='text' name='company_name' placeholder='your company name' > </td> </tr>

<tr>
 
 <td> <input type='hidden' name='crf_code'  value='".get_unique_code()."'  > <label class='show_'> Username </label></br>
 <input type='text' error_empty_msg='Username is required !'  name='username' value=''  required>  </td></tr>
<tr>
 
 <td>  <label class='show_'> Password </label></br>
 <input type='password' name='password' required error_empty_msg='Password is required !' >  </td></tr>

 <tr>  
<td><label class='show_'>Email (<i>optional</i>)</label></br>
<input type='email' name='email' value='' placeholder='optional' > 
 </td></tr>



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


 


</script>
<div style=\"
    width: 2px;
    height: 608px;
\">
 </div>
 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>


