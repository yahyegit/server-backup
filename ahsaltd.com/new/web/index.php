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

<meta name="viewport" content="width=100%, initial-scale=0">
<link rel="shortcut icon" type="image/png" href="css/images/favicon.png"/>
   
<!--theme --->
 
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
   window.jQuery || document.write('<script src="js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script>');

    if (jQuery.ui) {
      // UI loaded
    }else{
        document.write('<link rel="stylesheet" href="css/theme/jquery-ui.css">');  
        document.write('<script src="js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>'); 
    }






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

 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 
 <link   rel="stylesheet" href="css/loading.css"    /> 


</head>
<body id="body_wrapper">



<?php  

 if(if_logged_in('')){
     
 
  ?>


<div class="languages" style="margin-top: 11px;margin-bottom: 12px;float: right; margin-right:5px;"> 
 

 </div>


<div id="main_nav" style="
    clear: both;
">
    <ul>
     <li><a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/all_customers_page.php');"> customers </a></li>
     <li> <a href="#view"  onclick="get_template.customers('','debts','pages/other_pages/debts_page.php');"> debts </a></li>
     <li><a href="#view"  onclick="get_template.customers('','credits','pages/other_pages/credits_page.php');"> Credits</a></li>
     <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');">Reports</a></li>
     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left: 13%; font-size: 13px;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Make Transaction </span></button> 

 
  <button class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="
           request_template('','latest_report','pages/forms/open_day_form.php');" role="button" aria-disabled="false" style="font-size: 13px;"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Add Open Cash </span></button>




     <a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.settings('logout.php');" role="button" aria-disabled="false" style="float: right;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout</span></a>

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
  <div  class="horizantal_loading"  id="horizantal_loading" style="display:none;" ></div>
</div>


<?php  

 if(!if_logged_in('')){
   // request login form  
echo '   
 <script  charset="utf-8"  type="text/javascript">
    $(\'document\').ready(function(){
          get_template.settings(\'pages/forms/login_form.php\');
      });

 </script>
';

  } 
 
  ?>






  <div class="forms_container" id="forms_container_">
    
  </div>

  <div id="view">


 
  </div>
</div>
     <a href="#body_wrapper" id="back_toTop"  > Back to top </a>





 
<a href="../m" target="_self" style="padding: 5px;"> view in mobile site </a>
</body>
</html>
