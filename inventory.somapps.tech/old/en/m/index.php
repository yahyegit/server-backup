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



 $lang = (empty($lang))?'en':$lang;

if(trim($lang) != 'en'){
  header("location: ../$lang/");
}
$compan_name_ = mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0);
if_logged_in('');

$username = "<b>".mysqli_result_(mysqli_query_("select username from users where id='$current_user'"),0)."</b>";
 
?>

<!DOCTYPE html>
<html>
<head>
  <title> welcome 
   </title>


  <meta name="description" content="waa inventory system oo somali ah .">
  <meta name="keywords" content="somsimple.com ">
  <meta name="author" content="somsimple.com">





<meta name="viewport" id="desktxop_style" content="width=100%, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="css/images/favicon.png"/>
   
<!--theme --->
 
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
  <script    src="js/sell_items.js"  charset="utf-8"  type="text/javascript"></script>
 <script    src="js/template_loader.js" charset="utf-8"  type="text/javascript"></script>

<script src="js/send_money_form.js
"></script>

 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 
  <link   rel="stylesheet" href="css/main_style_2.css"    /> 

 <link   rel="stylesheet" href="css/loading.css"    /> 


 <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">


<style type="text/css">
  

*{
  font-family: 'Kalam', cursive !important;

}

</style>


</head>
<body id="body_wrapper">
  <div  class="horizantal_loading"  id="horizantal_loading" style=" z-index: 1000; width: 100%; position: fixed; top: 3px; z-index: 1000; visibility: visible;  display:none;" ></div>

<div style="float: right; display:none ; ">
 <label class='show_ float_label'> Language:</label>

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
 

     <?php  

      $ddd =  "<div class='drop_menu_' style='
      position: absolute;/* text-align: center; */top: 80px;left: 280px;z-index: 1000;background: rgb(255, 255, 255);padding: 10px;padding-left: 16px;box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;display: block;

'>   <p class=\"gray \" onclick=\"get_template.customers('','all_customers','pages/other_pages/expenses.php');\"> Expenses </p>  ";
          if (is_admin($current_user)) {

     $ddd .= " <p  class='gray' onclick=\" get_template.reports( {date_from:'latest'},'pages/other_pages/reports_page.php'); \" > Reports   </p>  <p class='gray'  #view\"  onclick=\"get_template.customers('','all_customers','pages/other_pages/items.php');\"   > Items  </p> <p  class='gray'  onclick=\"get_template.customers('','all_customers','pages/other_pages/users.php');\"> staffs   </p>";
    }
     $ddd .= " <p class=\"gray\" onclick=\"get_template.settings('/pages/other_pages/settings_page.php');\">Settings</p>

<p>     <a href=\"#\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.settings('logout.php');\" role=\"button\" aria-disabled=\"false\" style=\"float:;\"><span class=\"ui-button-icon-primary ui-icon\"></span><span class=\"ui-button-text\">Logout($username)</span></a>  </p>


      </div>";
echo $ddd;
?>







 
<div id="main_nav" style="
    clear: both;
">
    <ul  class='hide_for_print' style="
    height: 46px; width: 410px;
">
     <li class="overdue_li"> <a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/remainder.php');"> Home <span class="spg"></span> </a></li>

      <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/customers.php');"> Customers </a></li>    
     <li> <a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/debts.php');"> Debts </a></li>
 
      <li> <a href="#view" > <img  src="css/images/menu.png" onclick="
      $('.btns_rotate').hide();
              $('#add_r_btn').removeClass('rotate_close');

     $(this).removeClass('rotate_close');

      if ($('.drop_menu_').is(':visible')){$('.drop_menu_').hide();}else{$('.drop_menu_').show();} return false" style="
    
" > </a>    </li>
 
 

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



<?php  

 if(if_logged_in('')){
 
  ?>
 <p style="float: right;
    margin-top: 1px;display: none;
    padding: 5px;margin-right: 8px;
    color:gray;
    box-shadow: 5px 5px 27px 0px rgba(46,61,73,0.2) !important;
">
    Tijaabadu waxay kaadhamanaysaa 15 maalin kadib. hadaad rabtid in wax lagaaga badalo ama lagugu soodaro system ka nalasooxiriir
   lacagta system ka macal hosting kiisa waa <b class="debt_color">$1,100</b>.  

</p>
<?php  
    }
?>




<div class="btns_rotate" style="display: none;z-index: 1000;
    /* border: 1px solid; */
    width: 147px;
    padding: 5px;
    position: fixed;
    bottom: 451px;
    background: none;
    right: 8px;
    text-align: right;
">

<p><button  class='receive_items change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick="r_page('','','pages/forms/receive_items_form.php');" role='button' aria-disabled='false' style=' display:inline; box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;    position: relative;
    right: 107px;  '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Alaab kudar </span></button> </p>

<p>
<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick="r_page('','','pages/forms/sale_items.php');" role='button' aria-disabled='false' style=' display:inline; box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;    position: relative;
    right: 85px; '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'>Waxiibi  </span></button> </p>

 
<p>
<button  class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick="r_page('','','pages/forms/expense_form.php');" role='button' aria-disabled='false' style=' display:inline;  box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important; '><span class='ui-button-icon-primary ui-icon ui-icon-plus '></span><span class='ui-button-text'> Expense kudar</span></button> </p>


</div>

<img src="css/plus.svg"  id="add_r_btn" onclick="  if(!$('.btns_rotate').is(':visible')){
    $('.btns_rotate').show();
     $(this).addClass('rotate_close');
    
 }else{

  $('.btns_rotate').hide();
     $(this).removeClass('rotate_close');
 }
 "   style="    box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important; background:#7c11a2 !important;  <?php echo $hide;?>position: fixed;
    bottom: 409px;
    right: 17px;
     border-radius: 2em;
    padding: 11px;">  

 
<?php  

 if(if_logged_in('')){
 
  ?>
 <p class="h_default" style=" clear: both;
    margin-top: 1px;display:  ;
    padding: 5px;margin-right: 8px;
    color:gray;
    box-shadow: 5px 5px 27px 0px rgba(46,61,73,0.2) !important;
">
    Tijaabadu waxay kaadhamanaysaa  <b class="debt_color"><?php echo $days_left; ?></b> maalin kadib hadaad rabtid nalasoo xiriir update kuna waa free. <b class="debt_color"></b>.  

</p>
<?php  
    }
?>








      <button id="back_toTop"  onclick="$('html, body').animate({scrollTop: '0px'}, 500);
"> Back to top </button>


<script type="text/javascript">$('document').ready(function(){
  
  $('#coppywright-div').load( "coppywright.html" );
 }); </script>

 <div id="coppywright-div"></div>



 <a href="../web">view desktop site </a>
 


 

</body>
</html>
