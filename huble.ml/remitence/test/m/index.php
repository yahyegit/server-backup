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
  $desktop_site ='';
}else{
  $desktop_site = "<a href=\"#\" id=\"des-sit-toggle\" style=\" color: #7c11a2;\" onclick=\"window.location.href='../web';\">view desktop site </a>";
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
 
        if (is_admin($current_user)) {           
              $menu_left ='320px;';
              $box_height = '121px;';
              $s_top ='42px;';  
              $l_top = '52px;';
        }else{
              $box_height = '97px;';
              $s_top ='12px;';  
              $l_top = '21px;';
              $menu_left ='234px;';     
        }
?>

<!DOCTYPE html>
<html>
<head>
  <title> welcome 
   </title>

<meta name="viewport" id="desktop_style" content="width=100%, initial-scale=1">
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

<div>
<div class="logo" style="/* margin-top: 11px; */margin-bottom: 12px;float: left;padding: 0px;margin-right:5px;">

 
</div>
<?php  

 if(if_logged_in('')){
 
  ?>


  <div style="float: right; display:none;  <?php echo $hide;?>">
 <label class='show_ float_label'> Luqada:</label>

<select remove_filter='true' onchange="request_template('',{val:$(this).find('option:selected').attr('v')},'clasess/change_lang.php');">
  <?php echo $lo;?>
</select>
</div>



<div style="
    position: relative;
    top: 53px;
    cursor: pointer;
    /* background: red; */
    width: 40px;
    left: <?php echo $menu_left; ?>;
    z-index: 100;
    /* border: 1px solid; */
"><img src="css/images/menu.png" onclick="if ($('.toggle_m_v').is(':visible')){$('.toggle_m_v').hide();}else{$('.toggle_m_v').show();}"></div>
<div id="main_nav" style="
    clear: both;
">
    <ul  class='hide_for_print' style="
    height: 46px;
">
     <li class="overdue_li"> <a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/unpaid.php');"> unpaid <span class="counts"></span> </a></li>
     
     <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/all_payments.php');"> All payments </a></li>
      
      <?php   

          if (is_admin($current_user)) { 
echo "  <li><a href=\"#view\" style=\"
    position: absolute;
\"  onclick=\"get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php');\">Reports</a></li>";
}
?>

 
 
  </ul>


  <div class="toggle_m_v" style="width: 181px;position: relative;top: -12px;right: -166px;height: <?php echo $box_height; ?> box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;"> 

      <?php   

          if (is_admin($current_user)) {
        echo "<a href=\"#view\"  onclick=\"get_template.customers('','all_customers','pages/other_pages/users.php');\" style=\"
    color: gray !important;
    /* margin-top: 0; */
    padding-right: 3px !important;
    position: relative;
    top: 10px;
    right: -124px;
    text-decoration: none;
\">Users</a>";
}
?>

 <a href="#view" style="
    color: gray !important;
    /* margin-top: 0; */
    padding-right: 3px !important;
    position: relative;
    /* right: -106px; */
    left: 54px;
    top: <?php echo $s_top; ?>
    text-decoration: none;
"  onclick="$('.toggle_m_v').hide();get_template.settings('/pages/other_pages/settings_page.php');" > Settings  </a> 


<a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="$('.toggle_m_v').hide();get_template.settings('logout.php');" role="button" aria-disabled="false" style="/* float: right; *//* color: gray; */position: relative;top: <?php echo $l_top; ?> left: 37px;/* margin-left: -149px; *//* display: block; */"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text">Logout(<?php echo $username;?>  )</span></a>

</div>
 

 
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



<p id=" " class="dashboard_panel" style=" display:none;

 
/* background: black; */width: 51%;margin: auto;font:italic 14px arial;clear: both;text-align:center;position: relative; display:  ; " >  <i> whatsApp </i><img src="css/images/what.png" style="width: 32px;height: 20px;border:none;margin-left: 1px; ">   <b>+25261-6311-168 </b> 
 
  or call <b>+25261-6311-168 </b>  </p>
 

 <?php echo $desktop_site;?>
 
 

</body>
</html>
