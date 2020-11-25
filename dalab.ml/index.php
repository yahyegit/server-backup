<?php
require 'php_files/clasess/dataBase_class.php';
  
?>

<!DOCTYPE html>
<html>
<head>
  <title> hi, <?php echo mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0); ?> </title>

<meta name="viewport" content="width=100%, initial-scale=0">
<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
   
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


 <!---- style ---->
 <link   rel="stylesheet" href="css/select plugin.css"  />
 <link   rel="stylesheet" href="css/main_style.css"    /> 

</head>
<body id="body_wrapper">



<?php  

 if(if_logged_in('')){
     
 
  ?>
<div id="main_nav">
    <ul>
     <li><a href="#view"  onclick="get_template.template('pages/other_pages/all_customers_page.php');"> customers</a></li>
     <li> <a href="#view"  onclick="get_template.template('pages/other_pages/debts_page.php');"> Debts</a></li>
 
     <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/income_page.php');">Income</a></li>
      <li><a href="#view"  onclick="get_template.reports( {date_from:'latest'},'pages/other_pages/expenses_page.php');">Expense</a></li>
     <li> <a href="#view"  onclick="get_template.settings('/pages/other_pages/settings_page.php');">Settings</a></li>

   <button  style="
    margin-left: 13%;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="get_template.template('pages/forms/sell_item_form.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text"> Sell item </span></button> 


   <button  style="
    margin-left: 13%;
" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"  onclick="get_template.template('pages/forms/expense_form.php');" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text"> add expense </span></button>

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
     <a href="#body_wrapper" id="back_toTop"  > Back to top </a>
</body>
</html>
