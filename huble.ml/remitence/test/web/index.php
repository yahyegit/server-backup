<?php

// redirect to https 
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
} // redirect to https end
require 'php_files/clasess/dataBase_class.php';

 
if(!if_logged_in('')){ 
  $hide = 'display:none;';
}



$lang = mysqli_result_(mysqli_query_("select current_lang from users where id=$current_user "),0); // result is folder name en or som
 
  if($lang == 'en'){
$lo = '  <option v="en" selected="selected">English</option>
       <option v="som"   >Somali</option>
';

 }else{
$lo = '  <option v="en">English</option>
       <option v="som"   selected="selected" >Somali</option>
';

 }

/*  $lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som
if(trim($lang) != 'en'){
  header("location: ../$lang/");
}*/
$compan_name_ = mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0);
if_logged_in('');

$username = "<b>".mysqli_result_(mysqli_query_("select username from users where id='$current_user'"),0)."</b>";
 
?>

<!DOCTYPE html>
<html>
<head>
  <title> welcome 
   </title>

<meta name="viewport" id="desktop_style" content="width=100%, initial-scale=0">
<link rel="shortcut icon" type="image/png" href="css/images/favicon.png"/>
   
<!--theme --->
 
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    
 <link rel="stylesheet" media="print" href="css/print.css">

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
 
   window.jQuery || document.write('<script src="js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script><link rel="stylesheet" href="css/theme/jquery-ui.css"><script src="js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>');


 
login_check = setInterval(function() {
        if (!$('.form').is(':visible')){

         
         $.post('php_files/check_login.php', function (feadback) {
               


                          login_ = $.trim(feadback).toLowerCase().replace(/ok/g , '');
                      
                          if(login_ == 'login'){
                                      window.location.reload();
                          }

               });
      }
}, 60 * 1000); 






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

<script src="js/send_money_form.js
"></script>

 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 
  <link   rel="stylesheet" href="css/main_style_2.css"    /> 

 <link   rel="stylesheet" href="css/loading.css"    /> 


</head>
<body id="body_wrapper">


<div style="float: right; display:none;  <?php echo $hide;?>">
 <label class='show_ float_label'> Luqada:</label>

<select remove_filter='true' onchange="request_template('',{val:$(this).find('option:selected').attr('v')},'clasess/change_lang.php');">
  <?php echo $lo;?>
</select>
</div>


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
     <li class="overdue_li"> <a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/unpaid.php');"> unpaid <span class="counts"></span> </a></li>
     
     <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/all_payments.php');"> payments </a></li>
    <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');">Reports</a></li>  <li class="overdue_li"> 

    <?php       if (is_admin($current_user)) {
     echo " <a href=\"#view\"  onclick=\"get_template.customers('','all_customers','pages/other_pages/users.php');\"> users  </a></li>";
    }

?>
  
 
     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left:3px; font-size: 13px;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.customers('','transction_form','pages/forms/send_money_form.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text"> Send money </span></button> 

 
 
     <a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.settings('logout.php');" role="button" aria-disabled="false" style="float: right;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout(<?php echo $username;?> )</span></a>

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






  <div class="forms_container" style="display: block;margin-top: 17px;" id="forms_container_">
    
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



<p id=" " class="dashboard_panel" style="

<?php  

 if(!if_logged_in('') ){
       echo "display:none;";
     }
 
  ?>


/* background: black; */width: 51%;margin: auto;font:italic 14px arial;clear: both;text-align:center;position: relative; display: none; " >  <i> whatsApp </i><img src="css/images/what.png" style="width: 32px;height: 20px;border:none;margin-left: 1px; ">   <b>+25261-6311-168 </b> 
 
  or call <b>+25261-6311-168 </b>  </p>
 


 


 

</body>
</html>
