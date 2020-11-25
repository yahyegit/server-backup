<?php
    include '../../clasess/db_connector.php';

 
function get_courses(){
 
   $mobile = mysqli_result_(mysqli_query_("SELECT `mobile` FROM `settings` LIMIT 1"), 0);
   $address = mysqli_result_(mysqli_query_("SELECT `address` FROM `settings` LIMIT 1"), 0);
   $account = mysqli_result_(mysqli_query_("SELECT `account` FROM `settings` LIMIT 1"), 0);

 


  $whatMobile =  preg_replace ('/[^\p{L}\p{N}]/u', '', $mobile);
  

  $whatsApp_btn = '<a style="postion:fixed;bottom:0;padding: 5px;   text-decoration: none; color: #fff;position: absolute;bottom:0;right:0;    padding-right: 12px; background: #5ac351;border-radius: 1em;" href="https://wa.me/'.$whatMobile.'" >  <img src="wat-icon.png" style="width: 32px;height: 20px;  border:none;margin-left: 1px; "/> Chart </a>';



   if(if_logged_in('')){
    $chuser_btn  = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/change_username_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> change </span></button> ";
    $change_pass_btn  = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/change_password_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> change </span></button> ";

    $username = mysqli_result_(mysqli_query_("SELECT `username` FROM `settings` LIMIT 1"), 0);
   $user_pass = " <p> username $username $chuser_btn </p>";
   $user_pass .= " <p> password: ******** $change_pass_btn </p>";
      


     $addCoursesBtn = "    <button  style=\"
     margin-left:  %; font-size: 13px;
 \" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','transction_form','pages/forms/courses_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add course </span></button> <br>       
   
 <br>";
 $change_account_btn = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/change_account.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> change </span></button> ";

      $change_mobile_btn = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/change_mobile.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> change </span></button> ";
      $change_address_btn  = "<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers('','edit_customer_info_form','pages/forms/change_address.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> change </span></button> ";
  }
 
 
    $qq = mysqli_query_(" select * from courses where delete_status!='1'");
  //  Koorsooyinka Qiimo Dhimista Lagu Sameeyay <br><br>  <span style=\"color: gray !important;font-weight: normal;\"> Fadlan Dooro Koorsada aad Rabto  </span></p> 
    $courses_gird = "
 
 <pre  style='
    font-weight: normal;
    color: #32b8ef;
    font-size: 13px;
    '>

    FADLAN ISKA DIIWAANGALI KOORSOOYINKA SDTS
    </pre>
    <div class='course_grid'>
   ";
      while($aRow = mysqli_fetch_assoc_($qq))
        {
   
          if(if_logged_in('')){
            $actions = " <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/courses_form.php');\" role='button' aria-disabled='false' style=' display:inline; '><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button>   <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'courses',id:{$aRow['id']},msg:' deleting  <strong>{$aRow['course']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;  '><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete</span></button>  ";             
          }
          $course_id = $aRow['id'];
          $courses_gird .= " <div  > <span  onclick=\"get_template.customers($course_id,'edit_customer_info_form','pages/forms/register_student_form.php');\" >       <img src=\"logo.png\" style=\"float:left; border-radius:0.5em;      width: 53px;
          height: 48px; \">
         <p style=\"
    margin-top: 14px;
    position: relative;
    left: 7px;
    margin-bottom: -9px;
\"> {$aRow['course']} {$aRow['duration']} <span class='debt_color'>$".number_format($aRow['cost'],2)." </span> </span></p> <br> $actions
      </div>    ";

        }
        $courses_gird .= '</div>';

 
  return "
 
    $addCoursesBtn 
$courses_gird
 
 
 <br><br>
 <div style='background:whitesmoke; padding:5px '>
 <p> Account No  $account $change_account_btn </p>
 <p> Our address  $address $change_address_btn </p>

$user_pass
<p> Call: <a href='tel:$mobile'>$mobile</a> $change_mobile_btn </p>





".'<p><div class="fb-like" data-href="https://www.facebook.com/Somalidriving/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="false"></div></p> </div>'.$whatsApp_btn;


}

  echo get_courses();
 

?>

