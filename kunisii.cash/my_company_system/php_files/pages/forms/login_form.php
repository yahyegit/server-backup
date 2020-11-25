<?php
    require '../../clasess/dataBase_class.php';



 function get_login_form($defalut){
/*$url =  str_replace('http://','', str_replace('https://','',  $_SERVER['HTTP_REFERER']));
 
if(trim(substr($url, -1)) == '/'){
$url = substr($url, 0,-1);
} 


$url = explode('/',$url);

if(preg_match('/\./', end($url))){
$url = '';  // skip the domain 
}else{
$url = end($url);
}
*/
 return "

 

 <div id='tabs_activ'>
 <ul style=\"
    width: 50%;
    margin: auto;
    height: 46px;
\">	<li> <a href='#register_form' id=\"registerLink\" >Register</a></li>
	<li> <a href='#login_from' id=\"loginLink\">Login </a></li>
 			
 </ul>
<div id=\"register_form\">


 <form id='register_form_' action='#'  style='
    width: 50%;
    margin: 0 auto;'>


<table class='table'>
<tr>
 <th>Your company name</th>
 <td> <input type='text' name='company_name'  error_empty_msg='company name is required !'  >  </td>
 </tr>

<tr>
 <th>new username</th>
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'  > 
 <input type='text' name='username' error_empty_msg='username is required !'  required>  </td></tr>
<tr>
 <th>new password</th>
 <td>  
 <input type='password' name='password' error_empty_msg='password is required !'  required >  </td></tr>


  <th>Language:</th> <td>
            <select name='current_lang' remove_filter=\"true\" >
                    <option value='en'>English</option>
                    <option value='som'>Somali</option>
            </select>  </td>
 </table>


<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"my_company_system/php_files/clasess/register.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Register trail</span></a>

</a>
</div>

</form>




</div>


<div id=\"login_from\">

 <form id='login_form_' action='#'  style='
    width: 50%;
    margin: 0 auto;' autocomplete=\"on\">

 
<table class='table'>
 <tr>
 <th> company name</th>
 <td> <input type='text' name='company_name'  error_empty_msg='company name is required !'  >  </td>
 </tr>
<tr>
 <th>username</th>
 <td>	<input type='hidden' name='crf_code'  value='".get_unique_code()."'  > 
 <input type='text' name='username'  required>  </td></tr>
<tr>
 <th>password</th>
 <td>  
 <input type='password' name='password' required >  </td></tr>
 </table>


<div class=\"form_footer_btns\">   
<a href='#'  file_name=\"php_files/clasess/auth.php\" class=\"submit_btn change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Login</span></a>

</a>
</div>

</form>

</div>

</div>


<script>  
	$('document').ready(function(){
	 	$('#tabs_activ').tabs();

	 		 	$('#$registerLink').click();

	});
 
</script> 
";

 

 }






 
 
// submited 
if(isset($_POST['data'])){
  
  echo get_login_form($_POST['data']);

}









?>