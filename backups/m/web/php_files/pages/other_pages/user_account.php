 <?php
   include '../../clasess/db_connector.php';

 function user_ac($id,$year,$month,$day,$full_date_DB,$date_to){ // y,m,d
        $full_date_DB = sanitize($full_date_DB);
 
    $full_date =  date('d-M-Y',strtotime($full_date_DB)).((trim($date_to) !='')?"<span class='span'> to </span>".date('d-M-Y',strtotime($date_to)):'');
           
        $date_qry_ = ($date_to !='')?" date BETWEEN '~$full_date_DB' AND  '~$date_to' ":"date like'%~$full_date_DB%'";
        $date_qry = ($date_to !='')?" date BETWEEN '$full_date_DB' AND  '$date_to' ":"date like'%$full_date_DB%'";
     
  global $ccc;  //  currency 
  global $current_user;  //  currency 


     $id = sanitize($id);
  
 
 

     $user_query = mysqli_query_("select * from users where id='$id' and delete_status!='1' ");
	 $user = mysqli_fetch_assoc_($user_query);
      $username =  $user['username'];
 
    if ($current_user == $user['id']) {
 		   $del_user = "";     $i = "display:none;";

        }else{
           $i = "";
          $del_user = "     <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'users',id:{$user['id']},msg:'deleting user please confirm <strong>{$user['username']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete user </span></button>";

    }

  $user_status = $user['status'];
  $user['status'] = (($user['status'] == '1')?"<span style='color:green;'>active</span>":"inactive")."  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"toggle_disable_({table:'users',id:{$user['id']},msg:'".(($user['status'] == '1')?'Disabling':'enabling') ." <strong>{$user['username']}</strong> are you sure ?'}); \" role='button' aria-disabled='false' style='   display:; $i '><span class='ui-button-icon-primary ui-icon '></span><span class='ui-button-text'>".(($user['status'] == '1')?'Disable':'enable') ."</span></button>";


  
$data = " 

<p style='width: 50%;background: whitesmoke;color:gray;font-style:italic;margin:auto auto !important;/* margin-bottom: 55px; */padding: 10px; ".(($user_status == '1' )?'display:none !important;':'')." '> this user is disabled he cannot login to the system </p>
<br>

 
 <table  class='table  '  ><thead>   <th>full name</th>     <th>username</th> <th> password </th>   <th>   status  </th>   <th>action </th>  </tr></thead>
<tbody>

<tr> <td> {$user['full_name']} </td><td> {$user['username']} <label style='font-style:italic' class='float_label show_' >({$user['type']})</label> </td><td> ******* <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$user['id']},'edit_customer_info_form','pages/forms/users_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>change</span></button> </td>  
 

<td> {$user['status']} </td>
<td>  $del_user  <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$user['id']},'edit_customer_info_form','pages/forms/users_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>edit</span></button> </td>

 </tr>
 </tbody></table> 



 
 <p class='title_' style=\"
    margin-bottom: 15px;
\" >   date  <input type='date' id='date_from'  user_id='{$user['id']}' value=\"$full_date_DB\"  onchange=\"chosen_report_date('user_account.php');\" >  
  <label for=\"to_input_date\"> To </label>
    <input type='checkbox'  ".(($date_to !='')?'selected_check="true"':'')." onclick=\" if($(this).next('#date_to').is(':visible')){\$(this).next('#date_to').val('').hide();chosen_report_date('user_account.php');}else{
     $(this).next('#date_to').show();
  }  \" id=\"to_input_date\"> 

 <input  type='date' id='date_to'  value=\"$date_to\" style=\"display: ".(($date_to !='')?'':'none').";  \" onchange=\" if($.trim($('#date_from').val()) != ''){chosen_report_date('user_account.php');}\">  </p>




  <div class='it_'>  <ul>  
       
          <li> <a href='#items'> sales by <b> $username </b>  </a> </li> 
          <li> <a href='#payments'> payment for <b> $username </b> </a> </li> 
          <li> <a href='#expenses'> expenses for <b> $username </b> </a> </li> 
    
      </ul>

 <div id='expenses'>
           <p><label class='show_ float_label'> Total cost on $full_date: </label>:$ccc".number_format(mysqli_result_(mysqli_query_("select sum(cost) from expenses where user_id='{$user['id']}' and $date_qry and delete_status!='1' "),0),2)." </p>
   
         <table  class='table dataTable'  other_query=\" user_id='{$user['id']}' and $date_qry_    \"   table_file='php_files/pages/server-side-tables/expenses.php' ><thead> <tr> 
                          <th> name </th><th> cost </th>   <th> date </th> <th> desctiption </th>  <th> by </th> <th> action </th> 
                       </tr> </thead>
        <tbody>
         </tbody></table>
 </div>




 <div id='items'>

		  <p><label class='show_ float_label' > Total price on $full_date: </label>$ccc".number_format(mysqli_result_(mysqli_query_("select sum(price) from customer_items where user_id='{$user['id']}' and $date_qry and delete_status!='1' "),0),2)." </p>
		 
		 <table  class='table dataTable'  other_query=\" user_id='{$user['id']}' and $date_qry_  \"   table_file='php_files/pages/server-side-tables/customer_items.php' ><thead> <tr> 
		                 <th>    </th>  
		               </tr> </thead>
		<tbody>
		 </tbody></table>
 </div>

 <div id='payments'>
		 <div style='text-align:center'>
		  <p><label class='show_ float_label' > Total payments on $full_date: </label>$ccc".number_format(mysqli_result_(mysqli_query_("select sum(amount) from payments where user_id='{$user['id']}' and $date_qry and  delete_status!='1' "),0),2)." </p>

		  <p><label class='show_ float_label' > Total discount on $full_date: </label>$ccc".number_format(mysqli_result_(mysqli_query_("select sum(discount) from payments where user_id='{$user['id']}' and $date_qry and  delete_status!='1' "),0),2)." </p>
		</div>
 <table  class='table dataTable'  other_query=\"  user_id='{$user['id']}' and $date_qry  \"   table_file='php_files/pages/server-side-tables/all_payments.php' ><thead> <tr> 
                  <th> Amount </th><th> discount </th><th> date </th>  <th> desctiption </th>  <th> taken by </th> <th> action </th> 
               </tr> </thead>
<tbody>
 </tbody></table>
 </div>

 </div>




<script type=\"text/javascript\">
      
 
 
    $( \".it_\" ).tabs();


 


</script>
 
 ";
 
 
  
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');
      if (is_admin($current_user)) {
              
            $date_from = $_POST['data']['date']['date_from'];
            $date_to =  $_POST['data']['date']['date_to'];
           $id_u = (empty($_POST['data']['date']['id']))?$_POST['data']['id']:$_POST['data']['date']['id'];
                $last_date = mysqli_result_(mysqli_query_("SELECT `date` from customer_items  where user_id='$id_u' and delete_status!='1' ORDER BY `date` DESC LIMIT 1"),0);
               $date_full = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?date('Y-m-d', strtotime("-1 month $last_date")):sanitize(strtolower($date_from));

              // last month by default 
              $date_to = (strtolower(trim($date_from)) == 'latest' || strtolower(trim($date_from)) == '')?date('Y-m-d', strtotime(" $last_date")):sanitize(strtolower($date_to));
              $date_ = explode('-', $date_full);

              echo user_ac($id_u,$date_[0],$date_[1],$date_[2],$date_full,sanitize(strtolower($date_to)));


        }
}

?>
