 <?php
   include '../../clasess/db_connector.php';
 

 function get_users(){ // y,m,d
       
    
      
$data = "<div class='reports_page'>
 
  
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','','pages/forms/users_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add User </span></button> 

 <table  class='table dataTable' id='users_table_remi' other_query=\"\" table_file='php_files/pages/server-side-tables/users.php' ><thead>   <th>   </th>  </tr></thead>
<tbody>
 </tbody></table> 
 
 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');

      if (is_admin($current_user)) {
          echo get_users();

    }


}







?>