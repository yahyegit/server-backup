<?php
    require '../../clasess/dataBase_class.php';



 function adds_form(){
$qq = mysqli_query_("SELECT * FROM `settings` LIMIT 1");

    $data = mysqli_fetch_assoc_($qq);

     $sawir = $data['ads_image'];
 return "
 <form  id='ads_form' action=\"php_files/clasess/ads_class.php\" method=\"post\" enctype=\"multipart/form-data\"  >
 
<table class='table'><tr>
 
 <td><label> Sawirka  </label><br>

 <img src=\"css/images/$sawir\"  class='sawir_ads' style=\"width: 300px;height: 232px;  ".((empty($sawir))?'display:none !important;':'')."   \">
 <br/>


  <a href='#' style='".((empty($sawir))?'display:none !important;':'')."'  onclick=\"$('.sawir_ads').hide(); $.post('php_files/clasess/remove_pic_class.php', function (feadback) { }); \" class=\" change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Kasaar sawirka </span></a>

 <br> 
 <input type='file' name='ads_image' >  </td></tr> 
 
 <tr> <td><label> Qoraalka xayasiinta  </label><br>	
        <textarea id='ads_text' name='ads_text' placeholder=' Qoraalka xayasiinta ' style='border: 2px groove;border-radius: 0.5em;margin: 3.99306px 0px;width: 500px;height: 50px;'  >{$data['ads_text']}</textarea>  
 </td> </tr> 

</table>
<div class=\"form_footer_btns\">   

<input type='submit' class='primary_button '>  
 
<a href='#'  class=\"change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"close_element('#com_name_form');\" role=\"button\" aria-disabled=\"false\" style=\"
 
\"><span class=\"ui-button-icon-primary ui-icon ui-icon-closethick\"></span><span class=\"ui-button-text\">Close</span></a>
</div>

</form>";

 

 }









 
 
// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
  
  echo adds_form();

}









?>