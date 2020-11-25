 <?php
   include '../../clasess/db_connector.php';
  
 function get_subjects_student($data){ // y,m,d
 // 100 students from 5 classes 
//  total balance $1000

 $c = number_format(mysqli_result_(mysqli_query_("select count(balance) from invoices where balance!='0' and status='1' and delete_status!='1'  "),0));
$c_ = (empty($c))?"display:none":"";

$cno = (empty($c))?"No unpaid invoices to show .":'';


$data = " 
     <script type='text/javascript' > 

  
   $('#classess').tabs();
  
    </script> <br>
 <div id='classess' style=\"
    padding-left: 0px;
    padding-top: 0px;
\"> 
 		<ul style=\"
    width: 444px;
\"> 
 		        <li><a href='#upaid' >Unpaid classes  <span class=\"due_date_bg\" style='$c_'>  $c  </span> </a> </li>
  				<li><a href='#paid'>Paid classes  </a> </li>


 		</ul>

				<div id='upaid'>
				<div style='$c_'>
					  <h4 class='title_' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'> Unpaid classes </strong> </h4>
						<p><label class=\"show_ float_label\"> Total balance for all clasess </label> <b class='debt_color'>$".number_format(mysqli_result_(mysqli_query_("select sum(balance) from invoices where balance!='0' and status='1' and delete_status!='1'  "),0),2)."</b> </p>

					 
					 <table  class='table dataTable'  other_query=\"\"  table_file='php_files/pages/server-side-tables/unpaid_subjects.php' ><thead><tr> <th> class </th> <th> students </th> <th> Total balance </th> </tr></thead>
					<tbody>
					 </tbody></table>
					 </div>
					<p  style=\"color:green; !important; \">   $cno</p>
				</div>


				<div id='paid'>
						 
						  <h4 class='title_' style='margin:auto auto;color:#7c11a2 !important;text-align: center;margin-bottom: 13px;margin-top: 20px;'>  paid classes </strong> </h4>


						 
						 <table  class='table dataTable'  other_query=\"\"  table_file='php_files/pages/server-side-tables/paid_subjects.php' ><thead><tr> <th> class </th> <th> students </th> <th> Total balance </th> </tr></thead>
						<tbody>
						 </tbody></table>
						 
 
				</div>

 


  </div>
 
 ";
 
return $data;
 
 }



  
 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_subjects_student($_POST['data']);

}







?>
