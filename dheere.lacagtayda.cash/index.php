<?php
require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
    die();
  
  }
 
$backup_email = mysql_result(mysql_query("select backup_email from login_in limit 1 "), 0);

   

if(empty($backup_email)){   // email 
  mysql_query("ALTER TABLE login_in
ADD backup_email varchar(100); ");

}




if(isset($_POST['backup_email'])){

 

$backup_email   =    mysql_real_escape_string(strtolower(htmlentities($_POST['backup_email'])));
 

 
     
             mysql_query("UPDATE `login_in` SET `backup_email`='$backup_email'"); 
 

        
 }



 
 
 if(if_logged_in() != true){
    session_destroy();
     echo '<script type="text/javascript" > location.href ="login.php";  </script>';
   die();
 }  
 
$current_visitors =  file_get_contents('c.txt').$_SERVER['REMOTE_ADDR'];
$file = fopen("c.txt","w");
fwrite($file,$current_visitors."\n");
fclose($file);


?>

  
<?php
// count
 $text = floor(file_get_contents('count.txt')) + 1;  
$myfile = fopen("count.txt", "w");
 
fwrite($myfile, $text );
fclose($myfile);
  
  
// ips
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
  
    $te = file_get_contents('ip.txt');

  $myfile = fopen("ip.txt", "w");

fwrite($myfile,  $te. PHP_EOL .$ip);
fclose($myfile);
  
  
 ?>



<html>

<head>



<title> Welcome  </title>

<link checkAds="1" rel="stylesheet" href="js/jquery-ui-and-jquery/css/le-frog/jquery-ui-1.10.3.custom.css" >

<link checkAds="1" rel="shortcut icon" href="images/farvicon.ico" />



<link checkAds="1" rel="stylesheet" href="css/main.css" type="text/css">

<link checkAds="1" rel="stylesheet" href="css/styles.css" >

  <script checkAds="1" src="js/jquery-ui-and-jquery/js/jquery-1.9.1.js"  charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
  <script checkAds="1" src="js/jquery-ui-and-jquery/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 <script checkAds="1" type="text/javascript" src="js/index.js"></script>
 <script checkAds="1" type="text/javascript" src="js/search.js"></script>

</head>

<body>



<form id="backup_email_form" style="display:none;" action="index.php" method="post">  
<p style="color:#fff;"> email ka xisaabadkaaga backup ahaan lagugusoodiro maalinkasta kuqor. </p><br><br><br>
<input type="email" placeholder="backup email" name="backup_email"   style=" padding: 5px; 
    width: 254px;
"  <?php echo "value='$backup_email' "; ?> > <br><br> <input type='submit' value="update" class="button " ></form>




<div id="wrapper" class="container">

<div id="register_feadback" class="th_new" style="    background: wheat !important; margin-bottom: 27px;float: right;width: 72%;box-shadow: rgba(46, 61, 73, 0.2) 5px 5px 25px 0px !important;font-weight: normal !important;color: rgba(128, 80, 162, 0.77);font-family: Arial, Helvetica, sans-serif;font-size: 18px;padding: 8px;/* margin: 0px; */ background: #fff;">
 

   <a href="#" onclick="$('.th_new').hide();" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close" style="
   float: right;
   height: 23px;
"><span class="ui-button-icon-primary ui-icon ui-icon-closethick">close</span><p id="error_line" class="hide"></p><span class="ui-button-text">close</span></a>



<a href="https://simpleremittance.com">  https://simpleremittance.com/ </a> Waa barnaamij lacagaha layskugu diro sida xawaaladaha oo company gaaga kubilaabankartid khaska kuu ah.



</div>

<input style="clear:both;" type="button" class="button" value="Log Out" id="logout" />



  <div class="clear"></div>



      <ul id="main-nav">

        <li class="current" id="home"><a href="#">Home</a></li>
        <li id="all_customers" style="width: 146px;" ><a href="#" style=" width: 116px;padding-left: 19px;" >All Customers </a></li>

                                <li id="credit_custmers"><a href="#">Credit</a></li>


        <li id="debt_custmers"><a href="#">Debts </a></li>
        <li id="main_details"><a href="#">Main </a></li>

          <!--  <li id="oppen_day" ><a href="#">Oppen day</a></li>   -->  

        <li id="settings"><a href="#">Settings & backup</a></li>

      </ul>

    

    <div class="clear"></div>

  



    <div id="container">





      <div id="home_bage">

      <div id="searchbox">

          <input type="text" id="search" placeholder="name or mobile"  ><input type="button"   id="search_button" value="Search" >

      </div>

      

      

      <div id="search_resalt" style="display:none;" >

      <div class="styled" id="selpos2"  style="display:none;"  ><select id="choosetim2" title="select The Date:" > </select></div>

      <div id="totals2"></div>

     
      

       <div   id="castomer_details2" >

      </div>

      </div>

    

        

        

        

          <div id="blance_sidbar">

           

         

          </div>

       

          

      

          



          

        

      </div> <!--  home bage  -->  

      





      <div id="main_details_bage">

        <a href="#" id="new_exp" class="buttons add" hover="click to add new oppen day">ADD New Oppen day</a>

        <a href="#" id="new_cast" class="buttons add"  hover="click to add new custom">Add new custom</a>

        <div class="styled" id="selpos" ><select id="choosetim"  title="select The Date:" > </select></div>

        <div class="styled" id="selpos3" ><select id="fuck"  title="select The Date:" > </select></div>

        <div id="totals"></div>

          <hr id="hr"> <br>

    

  <div id="hover_div"></div>

  <!-- cosomers table -->

  

    <div  id="castomer_details">

      

       

   </div>

            

            <!-- wornings  to  and other feedbacks  -->

          <div id="worning_to_delete" title="Worning"  style="display:none;">  <p class="error" id="error3" style="display:none;"  >   </p> Are you sure want to delete This person?  <br> <p><label>  Password: </label> <input type="password" class="input" id="dellPassword" /> </p></div>

          <div id="worning_to_delete_exp" title="Worning"  style="display:none;">  <p class="error" id="error12" style="display:none;"  >  </p> Are you sure want to delete </div>

          <div id="Deleted"  title="Deleted" style="display:none;"></div>

          <div id="feedback"  style="display:none;"></div>

          <div id="error_del" title="Error" style="display:none;"></div>

          <div id="feedback_log"   title="Logout" style="display:none;"></div>

          <div id="feedback_3"  title="Changed" style="display:none;"></div>

          

          <!-- ADD new custom   -->

          <div id="add_div" style="display:none;" title="Add New Custom">

           <span class="error" id="error" style="display:none;"  >  </span>
                <h3 style="margin-left:0;"><strong style="color:blue;">C</strong>ash:</h3>   
              <table class="table">

                <tr> <th> Full Name </th><th> Cash In </th> <th>Cash Out</th><th>  Cash balance </th>  </tr> 

                <tr>



                      <td> <input type="text" class="input" id="new_ful_name" /> </td>

                      <td> <input type="text" class="input" style="width:100px; color:red;" id="new_cash_in"/> </td>

                      <td><input class="input" type="text" id="new_cash_out"  style="width:100px; color:red;"  value=""/> </td>

                      <td> <pre class="input" style="width: auto; background:#fff; color:red;min-width: 100px !important;" id="show_blnc_new" >0</pre>  </td>

                 
                     
                </tr> 

              </table>

               <h3 style="margin-left:0;"><strong style="color:blue;">D</strong>ollar:</h3>                 
              <table class="table">

                <tr>  <th>  Dollar In </th> <th>  Dollar Out </th> <th>  Dollar balance </th>  </tr> 

                <tr>
  
                      <td>$ <input type="text" class="input" style="width:153px; color:red;" id="new_d_in"/> </td>

                      <td>$<input class="input" type="text" id="new_d_out"  style="width:153px; color:red;"  value=""/> </td>

                      <td> <pre class="input" style="width: auto;background:#fff; color:red;min-width: 100px;color: black;;"  >$<span style=" color: red; " id="show_d_new">0</span></pre>  </td>

               
                     
                </tr> 

              </table>
              
               <h3 style="margin-left:0;"><strong style="color:blue;">O</strong>thers:</h3>                 
              <table class="table" style=" width: 700px; margin-left: 0; margin-top: 7px; ">
                           <tr><th> Number </th> <th> Description </th>  <th> ID/Passport </th> <th>Date </th></tr> 
                     <tr> <td> <input type="text" class="input" style="color:red;"  id="new_number" value=""/> </td><td> <input type="text" class="input" size="35"  style="color:red;"  id="description"   > </td>  <td> <input type="text" class="input" size="35"  style="color:red;"  id="id_or_passport"   > </td>     |  <td> <input type="text" class="input date_manual" size="35"   id="date_customer_a"   > </td>      </tr>
               </table>



          </div>







          <!-- edit record -->

          <div id="edit_div" style="display:none;" title="Update"> 

                    <span class="error" id="error2" style="display:none;"></span>

              
                   <h3 style="margin-left:0;"><strong style="color:blue;">C</strong>ash:</h3>   
                <table class="table">

                  <tr> <th> Full Name </th><th> Cash In </th> <th>Cash Out</th><th> Cash balance </th>  </tr> 

                  <tr>

                    <td><input type="text" class="input" id="ful_name"/></td>

                    <td><input type="text" class="input" style="width:153px; color:red;" id="cash_in"/> </td>

                    <td><input class="input" type="text" id="cash_out"  style="width:153px; color:red;"  value=""/> </td>

                    <td><pre class="input" id="edi_blan" style="width: auto;background:#fff; color:red;min-width: 100px;" > 0 </pre></td>
 
                  </tr> 

                </table>  
                
                <h3 style="margin-left:0;"><strong style="color:blue;">D</strong>ollar:</h3>   
                <table class="table">

                  <tr> <th>  Dollar In </th> <th>  Dollar Out </th> <th>  Dollar balance </th> </tr> 

                  <tr>
                                        <td>$<input type="text" class="input" style="width:153px; color:red;" id="dol_in"/> </td>

                    <td>$<input class="input" type="text" id="dol_out"  style="width:153px; color:red;"  value=""/> </td>

                    <td><pre class="input" style="width: auto;background:#fff; color:red;min-width: 100px;color: black;;" >$<span style="color:red;" id="dol_blance" >0</span></pre></td>
 
                  </tr> 

                </table>
                
               <h3 style="margin-left:0;"><strong style="color:blue;">O</strong>thers:</h3>   
              <table class="table" style=" width: 700px; margin-left: 0; margin-top: 7px; " >
                           <tr><th> Number </th> <th> Description </th> <th> ID/Passport </th>   <th> Date </th> </tr> 
                     <tr> <td> <input type="text" class="input" style=" color:red;"  id="edit_number" value=""/> </td><td>  <input type="text" class="input" size="35"style=" color:red;"  id="description2" value=""/> </td> <td> <input type="text" class="input" size="35"  style="color:red;"  id="id_or_passport_edit"   > </td>    <td> <input type="text" class="input date_manual" size="35"   id="date_customer_e"   > </td></tr> 
               </table>  
                
                
          </div>



          

          

          

          <!--new oppen day -->

          <div id="new_exp_div" style="display:none;" title="new open day">

          

            <span class="error" id="error_exp2" style="display:none;" >  </span>



          

                <table class="table">

                  <tr> <th>Title</th><th>Open Cash</th> <th> Cash balance </th> <th> Open Dollar</th>  <th> Dollar balance </th>    </tr> 

                  <tr>

                    <td><input type="text" id="name_exp" class="input" value="untitled day"/> </td>

                    <td><input type="text" class="input" style="width:100px; color:red;" id="cashin_exp"/></td>

                   
                     <td> <span class="input" style=" background:#fff; color:red;" id="show_blance_cash" >0</span>  </td>
 
                  <td>$<input type="text" class="input" style="width:100px; color:red;" id="dollin_exp"/></td>
 
                 <td>$<span class="input" style=" background:#fff; color:red;" id="show_blance_doller" >0</span> </td>

               
                  

                  </tr> 

                </table>
 
          
          
                <table class="table" style="
    width: 50%;
    margin-left: 0;
    margin-top: 5px;
">

                  <tr>  <th> Rate </th> <th> Date </th>   </tr> 

                  <tr>
 
                    
                  <td>$<input type="text" class="input" style="width:100px; color:red;" id="dollRate"/></td>

                   <td ><input type="text" class="input date_manual" style="width:100px; color:;" id="date_openday_a"/></td>

                  </tr> 

                </table>
          

          

          </div>

          

          

          

          

          

            <!--edit oppen day -->

          <div id="edit_exp_div" style="display:none;" title="Edit day">

          

            <span class="error" id="error_exp" style="display:none;" >  </span>

          

                <table class="table">

                  <tr> <th>Name</th> <th>Open Cash</th> <th> Cash balance </th> <th>Open Dollar</th> <th> Dollar balance </th>    </tr> 

                  <tr>

                    <td><input type="text" id="name_expx" class="input"/> </td>

                    <td><input type="text" class="input" style="width:100px; color:red;" id="cashin_expx"/></td>

                     
                     <td> <span class="input" style=" background:#fff; color:red;" id="show_blance_cashx" >0</span>  </td>

                  

                  <td>$<input type="text" class="input" style="width:100px; color:red;" id="dollin_expx"/></td>
 
                 <td>$<span class="input" style=" background:#fff; color:red;" id="show_blance_dollerx" >0</span> </td>

                  
               

                  </tr> 

                </table>

          

          
                <table class="table" style="
    width: 50%;
    margin-left: 0;
    margin-top: 5px;
">

                  <tr>     <th> Dollar Rate </th>   <th> Date </th>   </tr> 

                  <tr>
 
                  

                  <td>$<input type="text" class="input" style="width:100px; color:red;" id="dollRate_"/></td>

                                    <td ><input type="text" class="input date_manual" style="width:100px; color:;" id="date_openday_e"/></td>
                  </tr> 

                </table>


          

          </div>

          

      </div> <!-- main Details bage -->



 
      <div id="settings_bage">

              <p>

              <label id="label"> username:</label>  <b id="chack_if_us"></b>

            <a href="#" id="change_user" class="button ">change </a>

              </p>

              

              <p>

            <label id="label"> password:</label>   <b id="chack_if_pw"></b>

            <a href="#" id="change_passw" class="button " >change </a>

              </p>

              <p>

            <label id="label"> Delete password:</label>   <b>************</b>

                       <a href="#" id="change_delete_pass_a" class="button"  onclick=" changeDeletePass();" >change </a>

              </p>


              <p>

              <label id="label"> backup email:</label>  <b> <?php echo $backup_email; ?> </b>

            <a href="#"  class="button " onclick=" $('#backup_email_form').show().dialog({ position:'top',buttons:{}, closeOnEscape: true, draggable: false, resizable: false, modal: true, show:'fadeIn' });  

   $('.ui-dialog-titlebar').show(); "> change </a>

              </p>

              
                       <!----  <p>

            <label id="label"> Backups : </label>  

            <a href="#" onclick="make_backup()" class="button" > Create Backup Now !</a>

              </p>  ----->

              

            <img src="changing.gif" alt="changing..." title="loading.." style="display:none;" id="changing"/> 

                



            <div id="change_username"  title="Change Username" style="display:none;"  >

             <p class="error" id="error5" style="display:none;"></p>

             current username:<br>

            <input type="text" class="input" id="username" value=""><br>

            current password:<br>

            <input type="password"  class="input" id="password" value=""/><br>

             new username:<br>

            <input type="text" class="input" id="new_username" />

            </div> <!-- change username only -->

            

            <div id="change_pass"  title="Change Password" style="display:none;">

             <p class="error" id="error6" style="display:none;"></p>

             current username: <br>

            <input type="text" class="input" id="username1" ><br>

             current password: <br>

            <input type="password"  class="input" id="password1" ><br>

             new password: <br>

            <input type="password" class="input" id="new_password" ><br>

             <br>confirm new password:<br>

            <input type="password"  class="input" id="con_password" >



            </div> <!-- change password only-->

       

       
           <div id="change_delete_pass"  title="Changing delete Password"... style="display:none;">

             <p class="error" id="error3333" style="display:none;"></p>
 
             Enter Login password: <br>

            <input type="password"  class="input" id="password1_" ><br>

             new password: <br>

            <input type="password" class="input" id="new_password_" ><br>

             <br>confirm new password:<br>

            <input type="password"  class="input" id="con_password_" >



            </div> <!-- change password only-->

       
       
       
       
              

      </div>  <!-- settings bage -->

      



<?php
if (empty($backup_email)) {
    // open change backup email form     

echo ' <script type="text/javascript">


$("document").ready( function () {


    $("#backup_email_form").show().dialog({model:true,position:"center"});

   $("#wrapper, .ui-dialog-titlebar").hide(); 

});

</script> ';



}






 

?>



















      



    </div>


<p id="contact_us" style="margin: auto;margin-top: 30px;padding: 5px;box-shadow: 5px 5px 25px 0px rgba(46,61,73,0.2) !important;/* background: black; */width: 300px;margin-left: 34%;font:italic 14px arial;text-align:center;">  <i> </i><i src="images/wpng" style="width: 32px;height: 20px;border:none;margin-left: 1px;">   </b>  </p>

</div>  
 <script checkAds="1" type="text/javascript">


$('document').ready( function () {



 // remove hosting Adds 
    $('script,link,style').each(function(){
       if($(this).attr('checkAds') != '1'){  
         $(this).remove();
       }
        });
      $('div.container').next('div').remove();
      $('div.container').next('div').remove();
      $('div.container').next('div').remove();
        $('div.container').next('div').remove();
        $('div.container').next('div').remove();
          $('div.container').next('div').remove();
          $('div.container').next('div').remove(); 
   });  

</script>







</body>

</html>
