 <?php
   include '../../clasess/db_connector.php';
 

 function get_limit_history($data){ // y,m,d
     $id  = sanitize($data['id']);

     $username =  mysqli_result_(mysqli_query_("select username from users where id='$id' and delete_status!='1' "),0);
     $Remaining =  number_format(mysqli_result_(mysqli_query_("select current_remaining_limit from users where id='$id' and delete_status!='1' "),0),2);

      
      
$data = "<div class='reports_page'>
 
  <p class='' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> Limit history for <b>$username</b> </p>

 
 <label class=\"show_ float_label\" > Remaining limit</label> <b class='debt_color'>".'$'."$Remaining<b> <br><br><br>


   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{user_id:$id},'pages/forms/add_limit_form.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add limit to <b>$username</b></span></button> <br>

 <table  class='table dataTable'  other_query=\"user_id='$id' \"   table_file='php_files/pages/server-side-tables/limit_history.php' ><thead> <tr> 
							   <th> Amount </th>   <th> username </th>  <th> description </th>   <th> Date </th> <th> action </th> 
							 </tr> </thead>
<tbody>
 </tbody></table>
 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_limit_history($_POST['data']);

}







?>
