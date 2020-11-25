<?php

// redirect to https 
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
} // redirect to https end


require 'php_files/clasess/dataBase_class.php';
 
     create_invoice();

/*  $lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som
if(trim($lang) != 'en'){
  header("location: ../$lang/");
}*/
$compan_name_ = mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0);
 
?>

<!DOCTYPE html>
<html>
<head>
  <title> <?php echo $compan_name_ ?> 
   </title>

  <meta name="description" content="Software kan waxaa loogu talagalay collage yada   ">
  <meta name="keywords" content="somapps.tech, collage.somapps.tech, somapps.tech,  waa collage system college management system">
  <meta name="author" content="somapps.tech">


<meta name="viewport" id="desktop_style" content="width=100%, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="fav.png"/>
   
<!--theme --->
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />



<link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">


 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    
 <link rel="stylesheet" media="print" href="css/print.css">

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
 
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

<script src="js/register_form.js
"></script>

 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 
 <link   rel="stylesheet" href="css/loading.css"    /> 


<style type="text/css">
  

table.amount_t  .chzn-results li:nth-child(2) {
font-weight:normal !important;
color:black !important;

}

</style>



<script type="text/javascript">$('document').ready(function(){
  
  $('#coppywright-div').load( "coppywright.html" );
//alert(444)
}); </script>
 


</head>
<body id="body_wrapper">

<div>
<div class="logo" style="/* margin-top: 11px; */margin-bottom: 12px;float: left;padding: 0px;margin-right:5px;">

 
</div>
<?php  

 if(if_logged_in('')){
 
  ?>



 
 
<div id="main_nav" style="
    clear: both;
">
    <ul  class='hide_for_print' style="
    height: 46px;
">
     <li class="overdue_li"> <a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/clasess.php');"> Classes  </a></li>
     
     <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/all_students.php');">  Students </a></li>
      

    <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/exams.php');">  Exams </a></li>
      


 <?php 


     if (is_admin($current_user)) {
 echo "  <li><a href=\"#view\" class=\"\"  onclick=\"get_template.customers('','all_customers','pages/other_pages/subjects.php');\"> Subjects </a></li>

 

  <li> <a href=\"#view\"   onclick=\"request_template('','','pages/other_pages/reports_page.php'); \"> Reports </a></li>

 
  <li> <a href=\"#view\"   onclick=\"request_template('','','pages/other_pages/users.php'); \"> Users </a></li>


 ";

    }
  
 ?>     
    
     <li> <a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/expense_page.php');");" >  Expenses </a></li>

     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left:3px; font-size: 13px;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/register_student.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text"> Register student </span></button> 

 
<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick="r_page('','','pages/forms/make_other_payment.php');" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Make other payments</span></button>



 


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
  <div id="error" title="Error" style="display:none; margin-top: 57px;" ></div>
  <div id="success" title="Success" style="display:none;" ></div>
  <div  class="horizantal_loading"  id="horizantal_loading" style="display:none; position: fixed;
    top: 1px;    z-index: 10000;  " ></div>
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

<div id="landing" style="
    position: absolute;
    top: 11%;
    /* border: 1px solid; */
    width: 37%;
    /* display: none; */
">
 
  </div>
 
  </div>
</div>
      <button id="back_toTop"  onclick="$('html, body').animate({scrollTop: '0px'}, 500);
"> Back to top </button>



 
<script type="text/javascript">$('document').ready(function(){
  
  $('#coppywright-div').load( "coppywright.html" );
 }); </script>

 <div id="coppywright-div"></div>



 
 
 


 

</body>
</html>
 
