<?php
//@session_start();
 require 'php_files/clasess/dataBase_class.php';  
//die();

?>

<!DOCTYPE html>
<html>
<head>
  <title> hi, <?php echo mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0); ?> </title>

<meta name="viewport" content="width=100%, initial-scale=0">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> -->

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




$('document').ready(function(){


     if(!jQuery().tee_form || !jQuery().chosen  || !jQuery().input_comma_formated || !jQuery().dataTable_loader  || !jQuery().DataTable) {
        document.write('<h4> page didn\'t load correctly please <a href="#" onclick="window.location.reload();" style="color:#7c11a2;" >reload</a> again !</h4>');
      }

});


 


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


 
 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 


</head>
<body  id="body_wrapper">



<?php  
//echo if_logged_in('');
 if(if_logged_in('')){
     
 
  ?>
<div id="main_nav">
    <ul>
     <li><a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/all_customers_page.php');"> All customers</a></li>
     <li> <a href="#view"  onclick="get_template.customers('','debts','pages/other_pages/debts_page.php');"> Debts</a></li>
     <li><a href="#view"  onclick="get_template.customers('','credits','pages/other_pages/credits_page.php');"> Credits</a></li>
     <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');">Reports</a></li>
     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left: 13%;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Make Transaction </span></button> 

     <a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.settings('logout.php');" role="button" aria-disabled="false" style="float: right;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout</span></a>

  </ul>

<?php } ?> 


<!---feedbacks --->
<div id="action_feedbacks">
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



<p id=" " class="dashboard_panel" style="/* background: black; */width: 51%;margin: auto;font:italic 14px arial;clear: both;text-align:center;position: relative;bottom: -24px;/* left: 16%; */left: 0px;">  <i> whatsApp </i><img src="css/images/what.png" style="width: 32px;height: 20px;border:none;margin-left: 1px; ">   <b>+25261-631-1168 </b> 
 
  or call <b>+25261-631-1168 </b>  </p>

  
<a href="#body_wrapper" id="back_toTop"  > Back to top </a>



</body>
</html>
