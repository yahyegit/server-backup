<?php
    require '../../clasess/dataBase_class.php';

     require '../../clasess/service_class.php';
 


 function get_login_form(){

 return "

<div id=\"landing\"  style='float:left;clear: both;'>
 
    <div class=\"clearfix\" style=\"display:none;max-width:474px;\">
               
<ul id=\"image-gallery\" class=\"gallery list-unstyled cS-hidden\"> 
  <li>
      <img src='images/form.png'>
  </li>
  <li>
     <img src='images/all_cust.png'>  </li>


  <li>
      <img src='images/cust_account.png'>
  </li>


  <li>
      <img src='images/reports.png'>  </li>

  <li>
      <h3>more</h3>
     <p> more cool features</p> 

      </li>

  
</ul>


</div>



  <div class='lading_page_list'>


    <div  > Wuxuu kaacaawinayaa <b>sarifka</b>, <b>lacag haynta</b> iyo <b> Daymaha </b>  </div> 
    <div  ><b>Lacag kasta</b> waad ku isticmaali kartaa </div>
    <div  > <b>Xisaab xirka</b>,<b>daymaha</b>, <b>dadkad lacagaha uhaysid</b>,  <b>faaiidooyinka</b> iyo wax yaabo kale </div>
    <div  >Daily backup na wuu leeyahay oo google drive ah </div>
    <div  > Bilaash kutijaabi kadib nalasoo xiriir  </div> 
    <div  > Waa program easy ah tooba bar uuma baahna. </div>
    <div  > Hadaad rabtid in wax lagaaga badalo waa diyaar for free </div>

<div> hadaad ubaahantahay inaad ku isticmaashid Domain khaas kuu ah example: <b>myDomain.com</b> waa diyaar.</div>

<div> system ka backup buu leeyahay oo email kaaga daily lagugu soo dirayo <b>xisaabadkaaga oo pdf </b> wada ah. </div>


<div style=\"
    width: 400px;
\">PROGRAM KAN MAAHAN  <b>FOREX TRADING</b> </div>
   </div>



<div style=\"
    padding: 5px;
    /* position: absolute; */
    margin-top: 119px;

margin-bottom: 36px;


    /* box-shadow: 1px 1px 1px 2px rgba(57,61,71,0.3) !important; */
    width: 752px;
    color: #804fa2;
    background: whitesmoke;
    border-left: 3px solid #804fa2;
\">
Hadaad ubaahantahay software User friendly oo tooba bar ubaahnayn sida facebook ga oo kale oo baahida ganacsigaaga daboola waa Diyaar.<br> oo  waqti Badan kuu badbaadinaya. </div>



</div>



<div id=\"tabs_login\" style=\"
    width: 34%;    float: right;
    
\">
  <ul style=\"
 
\"> <li style=\"
    margin-bottom: 3px;  
\"><a href=\"#register\"   onclick=\"$('#login_form').fadeOut(); $('#register_form').fadeIn(); \" >Register</a></li>
    <li><a href=\"#login\"  onclick=\"$('#register_form').fadeOut(); $('#login_form').fadeIn();\" >Login</a></li>
   
  </ul>
  <div id=\"login\" style='margin-left:-20px;'>
  
 <form file_name=\"php_files/clasess/auth.php\" style=\"
  
\" id='login_form' action='#'  >

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

 <form id='register_form' style=\"
 
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

 ";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form();

}









?>


