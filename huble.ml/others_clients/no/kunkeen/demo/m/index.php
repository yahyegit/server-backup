<?php
require 'php_files/clasess/dataBase_class.php';
  $lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som
if(trim($lang) != 'en'){
  header("location: ../$lang/");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title> hi, <?php echo mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0); ?> </title>

<meta name="viewport" content="width=100%, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="css/images/favicon.png"/>
   
<!--theme --->
 
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    <?php  echo 'body_hide = "'.mysqli_result_(mysqli_query_("select body_hider from settings limit 1"), 0).'";';  ?>
   window.jQuery || document.write('<script src="js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script><link rel="stylesheet" href="css/theme/jquery-ui.css"><script src="js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>');



 

 </script>
 

 
 <!---DataTable js plugin----->
 <script    src="js/jquery.dataTables.js"  charset="utf-8" type="text/javascript"></script>

 <!----chosen plugin js-->
 <script    src="js/chosen.jquery.js"  charset="utf-8" ></script>



 <!----- custom plugin  ---->
 <script    src="js/plugins/dataTable_loader.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="js/plugins/tee_form.js" charset="utf-8"  type="text/javascript"></script>
<script    src="js/plugins/input_comma_formated.js" charset="utf-8"  type="text/javascript"></script>

 

 <!----- app js ---->

  <script  src="js/app_jquery_ui.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="js/functions.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="js/template_loader.js" charset="utf-8"  type="text/javascript"></script>

<script src="js/transaction_form.js
"></script>
 

 <!---- style .css---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 
 <link   rel="stylesheet" href="css/loading.css"    /> 
 

</head>
<body id="body_wrapper">

<div id='body_hider'>


<?php  

 if(if_logged_in('')){
     
 
  ?>


<div class="languages" style="margin-top: 11px;margin-bottom: 12px;float: right; margin-right:5px;"> 


 

 </div>

<img alt="menu" src="  css/images/menu.png" class="menu_icon" style="
    position: fixed;
    z-index: 99;
    top: 21px;
    right: 20px;
  
" onclick="$('html, body').animate({scrollTop: '0px'}, 500);

if(
  $('.nav-dropdown').is(':visible')){$('.nav-dropdown').slideUp();
      $('.rotate_wrapper').css('top','6%');

}else{
  $('.nav-dropdown').slideDown();

  rotate.close();
    $('.rotate_wrapper').css('top','52%');

}">
<div id="main_nav" style="
    clear: both;
    padding: 0px;

"> 
<div id="main_nav" style="
    clear: both;
    padding: 0px;

">    
    <ul  class="nav-dropdown" style="display: none;">
     <li onclick="get_template.customers('','all_customers','pages/other_pages/all_customers_page.php');"><a href="#view"  > All Customers </a></li>
     <li onclick="get_template.customers('','debts','pages/other_pages/debts_page.php');"> <a href="#view"  > Debts </a></li>
     <li  onclick="get_template.customers('','credits','pages/other_pages/credits_page.php');"><a href="#view" > Credits</a></li>
     <li onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');"><a href="#view"  >Reports</a></li>
     <li  onclick="get_template.settings('/pages/other_pages/settings_page.php');"> <a href="#view" >Settings</a></li>

 

 
     <a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.settings('logout.php');" role="button" aria-disabled="false" style="background:#da69eb;float: right;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout</span></a>

  </ul>
<?php } ?> 


<!---feedbacks --->
<div id="action_feedbacks">

<div id="loading_cycle" style="display:none;"> 
      <div  class="loading_cycle lds-css ng-scope" style="
          width: 100px;
      "> <div style="/* width:100%; *//* height:100% */" class="lds-eclipse">  <div></div>

      </div>
       
      </div>
</div>


  <div id="warning" style="display: none;"></div>
  <div id="error" title="Error" style="display:none;" ></div>
  <div id="success" title="Success" style="display:none;" ></div>
  <div  class="horizantal_loading"  id="horizantal_loading" style="margin-top: 20px;display:none;" ></div>
</div>


<?php  

 if(!if_logged_in('')){
   // request login form  
echo '   
 <script  charset="utf-8"  type="text/javascript">
    $(\'document\').ready(function(){
          get_template.settings(\'pages/forms/login_form.php\');
           $(".rotate_wrapper").hide();
      });

 </script>
';

  }else{
    echo '   
 <script  charset="utf-8"  type="text/javascript">
    $(\'document\').ready(function(){
            $(".rotate_wrapper").show();
      });

 </script>
';
  }
 
  ?>






  <div class="forms_container"  style="margin-top: 79px; padding:0px; " id="forms_container_">
    
  </div>

  <div id="view" style="position:relative; margin-top: 30px;padding:0px;     padding-top: 25px;" >


 
  </div>
</div>
     <button id="back_toTop"  onclick="$('html, body').animate({scrollTop: '0px'}, 500);
"> Back to top </button>



<div class="rotate_wrapper" style="    position: fixed;
    right: 4%;
    top: 6%;
    ">

    <div class="add_buttons_main" style="display: none;">
    <button class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="
               request_template('','latest_report','pages/forms/open_day_form.php');" role="button" aria-disabled="false" style="font-size: 13px;"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Add Open Cash </span></button>
    <button style="
        margin-left: 13%; font-size: 13px;
    " class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Make Transaction </span></button>

   </div>          


 <img  onclick="rotate_()" title="click to add transaction or open cash." class="rotate_btn_add" alt="add" style="
    width: 41px;
    height: 35px;
    border-radius: 2em;
     float: right;
"  src="css/images/plus.jpeg">
 
</div>
 

<a href="../web" target="_self" style="padding: 5px;"> view in desktop site </a></div>
</body>
</html>
