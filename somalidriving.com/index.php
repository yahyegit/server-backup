


<?php
 

require 'php_files/clasess/dataBase_class.php';
  
/*  $lang = mysqli_result_(mysqli_query_("select current_lang from settings limit 1"),0); // result is folder name en or som
if(trim($lang) != 'en'){
  header("location: ../$lang/");
}*/

?>

<!DOCTYPE html>
<html        style="background:#4190c9 !important;"
>
<head>
  <title> Somali driving  
   </title>

  <meta name="description" content=" somali driving school  ">
  <meta name="keywords" content="somalidriving.com">
  <meta name="author" content="somalidriving.com">


<meta name="viewport" id="desktop_style" content="width=97%, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="logo.png"/>
   
<!--theme --->
 
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    
 <link rel="stylesheet" media="print" href="css/print.css">

 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
 
   window.jQuery || document.write('<script src="js/lib/jquery-1.12.1.js"  charset="utf-8"><\/script><link rel="stylesheet" href="css/theme/jquery-ui.css"><script src="js/lib/jqueryui-1.12.1.js"  charset="utf-8"><\/script>');


 
$('document').ready(function (){

//$('.logo_m').show();

//$('.logo_m img').effect( "bounce", {times:4}, 500 );
$('.logo_m div').hide()


 setTimeout(function(){

$('.logo_m').fadeIn();


//$('.logo_m img').effect( "bounce", {times:3}, 500 );
$(".logo_m").animate({ 
        left: "+=10%",
	top: "+=35%"
      }, "slow" , function(){ 
$(this).find('img').effect( "bounce", {times:3}, 500 );  $(this).find('div').slideDown();  });

}, 2000);


});

 
login_check = setInterval(function() {


  if (!$('.form').is(':visible')) { 
   window.location.reload();
}
 
}, 1200000); 



 
function logo_only (){
   $('.logo_m').fadeOut();
   $('#wr-dive-a').fadeIn();




}
  
 setTimeout(logo_only, 7000);





 </script>
 

      
 
 <!----chosen plugin js-->
 <script    src="js/chosen.jquery.js"  charset="utf-8" ></script>



 <!----- custom plugin  ---->
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
body div ,html{
    background: whitesmoke !important;
}
</style>

 


</head>
<body         style="background:#006699 !important;"
   id="body_wrapper">

<div class='logo_m' style="
   display: none;   width: 90%;
     background: #4190c9  !important;

    /* margin: auto auto; */
    position: absolute;
    top: 0;
"> 
<img src="llhome.jpeg" style="width: 300px;height: 256px;/* border-radius: 1em; */">
  <div style="

  font: 17px bold italic;
  line-height: 10px;
  font-weight: bold;
  color: #fff;
  font-size: 21px;
    background: #4190c9 !important;
    display: block;
    text-align: center;
    position: relative;
    right: 25px;
" ><p>WELCOME TO</p> <p>SOMALI DRIVING</p></div>
</div>



<div style='display:none;      background: #016699 !important;
' id="wr-dive-a">
<img style="  
      padding-right: 6px;
    padding-top: 6px;
    position: absolute;
    color: #fff;
    right: 15px; width:20px "
src="menu.png"

    <?php echo (!if_logged_in(''))?"":'display:none !important;'; ?>

" onclick="get_template.settings('pages/forms/login_form.php');" />
 


 <div class="header_grid" style="
    grid-template-columns: auto;


height: 314px;
">
  <div class="logo">

      <img src="logo.png" style="float: left;
    border-radius: 0.5em;
    width: 53px;
    height: 48px;">
 
      <?php 

$c = mysqli_result_(mysqli_query_("select count(id) from students where active='1'  and delete_status!='1' "),0); // result is folder name en or som
$c = $c+500;

echo      '<div style="    width: 240px; position: relative;top: -118px;left: 126px;  top: -52px;
    left: 50px;"><pre  style="
position: relative;
    left: -46px;
    top: 13px;
"> Somali Driving and Traffic School </pre><pre style="
position: relative;
    top: 13px;
" >Tirada ardayda isdiiwaangalisay <b>'.number_format($c).' </b> </pre></div> 
</div>'

?>
 

 <?php echo (if_logged_in(''))?"<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/advatising_form.php');\" role='button' aria-disabled='false' style=' display:inline;       display: inline;   

    display:inline;
    display: inline;
    position: relative;
    top: -35px;
    width: 109px;
    right: -220px;
    bottom: 81px;
    


 '><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> Update </span></button>":'';  ?>

 <div style="
    background: #fff !important;     position: relative;
    bottom: 66px;
">



    <img src="css/images/<?php echo mysqli_result_(mysqli_query_("select ads_image from settings limit 1"),0); ?> " style="
    width:360px;
    height: 360px;
    ">

</div>

 
 
</div>




 
 
<div id="main_nav" style="       margin-top: 180px; 
    clear: both;
">
    <ul  class='hide_for_print' style="
    height: auto;
    <?php echo (if_logged_in(''))?"":'display:none !important;'; ?>
">

<li > <a href="#view"  onclick="get_template.customers('','all_customers','pages/other_pages/courses.php');"> Courses  </a></li>

<li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/new_students.php');">  New Students </a></li>


     
     <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/students.php');">  Students </a></li>
    
     <li><a href="#view" class=""  onclick="get_template.customers('','all_customers','pages/other_pages/cancelled_students.php');">  Cancelled Students </a></li>



  <li>
     <a href="#" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.settings('logout.php');" role="button" aria-disabled="false" style="float:  ;"><span class="ui-button-icon-primary ui-icon"></span><span class="ui-button-text" style="
    color: black;
" >Logout</span></a>
</li>
  </ul>

 

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
  <div  class="horizantal_loading"  id="horizantal_loading" style="
  
  
  z-index: 10000;
     background: blue !important;
  
  display:none; position: fixed;
    top: 1px; " ></div>
</div>

 





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
   

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="pwVABgdt"></script>

 
 
</body>
</html>

