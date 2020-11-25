<?php

// redirect to https 
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
} // redirect to https end




require 'php_files/clasess/dataBase_class.php';
require 'php_files/clasess/service_class.php';

/*  $lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som
if(trim($lang) != 'en'){
  header("location: ../$lang/");
}*/
$compan_name_ = mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0);
$days_left = get_days_left($compan_name_);

?>

<!DOCTYPE html>
<html>
<head>
  <title> <?php  echo $compan_name_;?> | somApps</title>

<meta name="viewport" id="desktop_style" content="width=100%, initial-scale=0">
<link rel="shortcut icon" type="image/png" href="css/images/favicon.png"/>
   
<!--theme --->
 
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    
 <link rel="stylesheet" media="print" href="css/print.css">

 

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159007928-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-159007928-1');
</script>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    <?php  echo 'body_hide = "'.mysqli_result_(mysqli_query_("select body_hider from settings limit 1"), 0).'";';  ?>
   window.jQuery || document.write('<script src="js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script><link rel="stylesheet" href="css/theme/jquery-ui.css"><script src="js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>');


logined_ = 0;
<?php if(if_logged_in('')){


echo "
logined_ = 1"; 
}
 ?>

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
 <link   rel="stylesheet" href="css/main_style_2.css"    /> 


 <link   rel="stylesheet" href="css/loading.css"    /> 





<link type="text/css" rel="stylesheet" href="css/lightslider.css" />                  
<script src="js/lightslider.js"></script>



<link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

<style type="text/css">

		*{
		  font-family: 'Kalam', cursive !important;

		}
</style>



</head>
<body id="body_wrapper">

<div>
<div class="logo" style="/* margin-top: 11px; */margin-bottom: 12px;float: left;padding: 0px;margin-right:5px;">

 

</div>
<?php  

 if(if_logged_in('')){



echo "<script type=\"text/javascript\">
logined_ = 1;//    get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');
  
</script>";     
 

  ?>



 <p style="
    margin-top: 1px;
    padding: 5px;
    box-shadow: 5px 5px 27px 0px rgba(46,61,73,0.2) !important;
 display:none">
    Tijaabadu waxay kaadhamanaysaa 15 maalin kadib. hadaad rabtid in wax lagaaga badalo ama lagugu soodaro ama software  ah nalasooxiriir. 
<br>   lacagta system ka waa halmar bixi <b class='debt_color'>$800</b>  ama kukirayso <b class='debt_color'>$60</b> bishii   

</p>







 
<div id="main_nav" style="
    clear: both;
">
    <ul  class='hide_for_print'>
     <li><a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/all_customers_page.php');"> All Customers </a></li>
     <li> <a href="#view"  onclick="get_template.customers('','debts','pages/other_pages/debts_page.php');"> Debts </a></li>
     <li><a href="#view"  onclick="get_template.customers('','credits','pages/other_pages/credits_page.php');"> Credits</a></li>
     <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');">Reports</a></li>
     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left: 13%; font-size: 13px;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/make_transction_form_page.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Make Transaction </span></button> 

 
   



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