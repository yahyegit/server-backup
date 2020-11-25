<?php

   include '../../clasess/db_connector.php';

function get_account($id)
{
					 
				 $id = sanitize($id);


if (mysqli_result_(mysqli_query_("select student_id from students where delete_status='1' and student_id='$id'"),0)) {
	exit('login');
	
}



				$page = '';
				 
				$student_balance =  mysqli_result_(mysqli_query_("select sum(balance) from invoices where delete_status!='1' and balance!='0' and student_id='$id'"),0);

				$make_payment_btn = ($student_balance !='0' )?"<button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"r_page('',{id:$id},'pages/forms/make_payment.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon- '></span><span class='ui-button-text'>Pay</span></button>":'';

					$q_row = mysqli_query_("select student_id,name,status,mobile,gender,description,address from students where student_id='$id' and delete_status!='1'");
					      $aRow = mysqli_fetch_assoc_($q_row); 
							 

				$student_name = $aRow['name'];

				$page = "  <script type='text/javascript' > 

   
      $('#studet_tabs').tabs();
 
  
    </script> <br>



<h5 class=\"title_\">  {$aRow['name']} ( ".$aRow['mobile'].") </h5>

    <table  class='table '   ><thead><tr>          </tr></thead>
				<tbody>
				<tr>     <td class='debt_color'><label class=\"float_label show_\"> Balance </label>: <b>$".number_format($student_balance,2)."</b> $make_payment_btn </td> ".((!empty($aRow['description']))?"   <td><label class=\"float_label show_\"> description: </label>:  {$aRow['description']}</td>":'')." 

									      		        <td>
				 <div  class='hide_for_print' style='
				    
				    margin: 0px !important;
				     
				'> <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['student_id']},'edit_customer_info_form','pages/forms/edite_student.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit info</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"toggle_disable_({table:'students',id:{$aRow['student_id']},msg:'".(($aRow['status'] == '1')?'Disabling':'enabling') ." <strong>{$aRow['name']}</strong> are you sure ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-'></span><span class='ui-button-text'>".(($aRow['status'] == '1')?'Disable':'enable') ."</span></button>  <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'students',id:{$aRow['student_id']},msg:'deleting student please confirm <strong>{$aRow['name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete student</span></button>      </div>
				 


									      		       </td>  </tr>
				 </tbody></table>";

				if ($aRow['status'] == '0'){
					$page .= "<h3 style='font-style:italic; color:#8050a2;'> this student is disabled you will not get any invoices from {$aRow['name']}</h3>";
				}

 





				//tabs 


				$count_unpaid = mysqli_result_(mysqli_query_("select count(id) from invoices where delete_status!='1' and balance!='0' and student_id='$id'"),0);

				$page .= "


				<div id='studet_tabs' style=\"
    margin-top: 34px;  
   
\" >
 <ul style=\"
   
\" >  
       
          
          <li> <a href='#unpaid'> Unpaid invoices  </a> </li> 
           <li> <a href='#subjects'> subjects  </a> </li> 

            <li> <a href='#exams'> Exams  </a> </li> 
 
          <li> <a href='#payments'> Payments  </a> </li> 
          <li> <a href='#paid_invoices'> Paid invoices </a> </li> 

      </ul>
				


	 <div id='paid_invoices'>

										   <p style='color:#7c11a2;/* margin-bottom:35px; */'>paid invoices for <strong>   $student_name </strong></p>
								 
													 

									 <table  class='table dataTable'  other_query=\"student_id='$id' and balance='0' \" table_file='php_files/pages/server-side-tables/paid_invoices.php' ><thead><tr> 
									 <th> subject </th>   <th> cost </th>    <th> monthly discount </th>  <th> balance </th>  
									 </tr>
									</thead> 
									<tbody>
									 
									</tbody>
									</table>

						</div>



				 

				<div id='unpaid'>

".((empty($count_unpaid))?" <p class='' style='color:green; !important; '> <strong>   $student_name </strong> has No unpaid invoices to show . </p> ":"
								   <p style='color:#7c11a2; margin-bottom:35px'>unpaid invoices for <strong>   $student_name </strong></p>
							  
							 <table  class='table dataTable'  other_query=\"student_id='$id' and balance!='0' \"  table_file='php_files/pages/server-side-tables/unpaid_invoices.php' ><thead><tr> 
							 <th> subject </th>    <th> cost </th>    <th> monthly discount </th>       <th> balance </th>   
							 </tr>
							</thead> 
							<tbody>
							 
							</tbody>
							</table>
")."
				</div>


				<div id='payments'>

								   <p style='color:#7c11a2;/* margin-bottom:35px; */'>Payment history for <strong>   $student_name </strong></p>
							
											 

							 <table  class='table dataTable '  other_query=\"student_id='$id' \"  table_file='php_files/pages/server-side-tables/payment_history.php' ><thead><tr> 
							      <th>Paid</th>     <th>discount</th>     <th>taken by</th>      <th>date</th>     <th>description</th>  
							 </tr>
							</thead> 
							<tbody>
							 
							</tbody>
							</table>

				</div>



				<div id='exams'>
	   <p style='color:#7c11a2;/* margin-bottom:35px; */'> Exams for <strong>   $student_name </strong></p>
							 
						    <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{student_id:$id},'pages/forms/exams_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Exam to <b> $student_name</b>  </span></button> 

							 <table  class='table dataTable '  other_query=\"student_id='$id' \"  table_file='php_files/pages/server-side-tables/exams.php' ><thead><tr> 
							       <th>student name</th> <th>subject</th><th>marks</th> <th>date</th>   <th>Action</th> 
							 </tr>
							</thead> 
							<tbody>
							 
							</tbody>
							</table>

				</div>
				<div id='subjects'>

								   <p style='color:#7c11a2;/* margin-bottom:35px; */'> Subjects for <strong>   $student_name </strong></p>
							 
											 
   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"r_page('',{id:$id},'pages/forms/register_student.php');\"  role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add Subjects to <b> $student_name</b> </span></button> 


							 <table  class='table dataTable '  other_query=\"student_id='$id' \" table_file='php_files/pages/server-side-tables/student_subjects.php' ><thead><tr> 
							 <th> subject </th>  <th> monthly discount </th>  <th> cost </th> <th> Billing date </th> <th> action </th>
							 </tr>
							</thead> 
							<tbody>
							 
							</tbody>
							</table>

				</div>


			


				 

				</div>
				";

return $page;
}


 
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_account($_POST['data']['id']);

}




?>
