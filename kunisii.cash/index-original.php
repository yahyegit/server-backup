<?php
require 'my_company_system/php_files/clasess/dataBase_class.php';
  
?>

<!DOCTYPE html>
<html>
<head>
  <title> <?php echo file_get_contents('app_name'); ?>  </title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="my_company_system/css/images/favicon.png"/>
   
<!--theme --->
 
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

 <!---- style ---->
 <link   rel="stylesheet" href="my_company_system/css/select plugin.css"  />
 <link   rel="stylesheet" href="my_company_system/css/main_style.css"    /> 


 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
   window.jQuery || document.write('<script src="my_company_system/js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script>');

    if (jQuery.ui) {
      // UI loaded
    }else{
        document.write('<link rel="stylesheet" href="my_company_system/css/theme/jquery-ui.css">');  
        document.write('<script src="my_company_system/js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>'); 
    }


$('document').ready(function(){

 get_template.settings('pages/forms/login_form.php');

 

});




 </script>
 



 <!----- custom plugin  ---->
 <script    src="my_company_system/js/plugins/dataTable_loader.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="my_company_system/js/plugins/tee_form.js" charset="utf-8"  type="text/javascript"></script>
<script    src="my_company_system/js/plugins/input_comma_formated.js" charset="utf-8"  type="text/javascript"></script>

  
 <!----chosen plugin js-->
 <script    src="js/chosen.jquery.js"  charset="utf-8" ></script>
 

 <!----- app js ---->
 <script    src="my_company_system/js/functions.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="my_company_system/js/template_loader.js" charset="utf-8"  type="text/javascript"></script>


  <link rel="stylesheet" href="my_company_system/css/landing_page.css">

</head>
<body>

<div class="logo_sytem"> 
logo her 

 </div>

<!---feedbacks --->
<div id="action_feedbacks">
  <div id="warning" style="display: none;"></div>
  <div id="error" title="Error" style="display:none;" ></div>
  <div id="success" title="Success" style="display:none;" ></div>
  <div  class="horizantal_loading"  id="horizantal_loading" style="display:none;" ></div>
</div>



  <div class="forms_container" id="forms_container_">
    
  </div>

  <div id="view">

video here 
 
  </div>


<div class="responsive_image" style="border:2px solid red;"> 

    add image that tells the app is responsive mobile,tablet and desktop 


 </div>











</div>

</body>
</html>
