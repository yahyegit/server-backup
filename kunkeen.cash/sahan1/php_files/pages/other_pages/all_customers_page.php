<?php
    include '../../clasess/db_connector.php';

   require '../../clasess/reports_class.php';

function get_categoreis()
{
    $data = array();
    $li = '  <li><a href="#all"  > All students</a></li>';
    $div = "<div id='all' ><h3 class='title_'>All (".number_format(mysqli_result_(mysqli_query_("select count(id) from students where delete_status!='1'  "), 0))
.")  students  </h3>
 
         
  
  
 <table class='table ' style='
    width: 50%;background:rgba(128, 80, 162, 0.1) !important; 
    margin-top: 20px;
    margin-bottom:20px;
    /* margin-left: 0px; */
'> <thead> <tr><th class=\"title_2\"> </th> </tr></thead>
<tbody>
  <tr> <td   >
 Total balance: <span class='debt_color'>$".number_format(mysqli_result_(mysqli_query_("select sum(balance) from students where delete_status !='1'")),2)."</span>
       
   </td>
  </tr>

</tbody>
 </table>
 
 
 

 <table  class='table dataTable' other_query='' table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>Name</th> <th>courses</th>  <th> paid </th><th>Balance</th><th>Class time </th> <th>address</th> <th>Description</th>  <th>date</th> <th  class='hide_for_print'> action </tr></thead>
<tbody>
 </tbody></table>  </div>
 
";

$qq = mysqli_query_("SELECT DISTINCT `category` from students where delete_status !='1'");
    
    while ($q = mysqli_fetch_assoc_($qq)) {
          $id = 'id_'.rand();
   $li .= '  <li><a href="#'.$id.'"  > '.$q['category'].' </a></li>';

   $div .=  "<div id='$id' > <h3 class='title_'>{$q['category']} (".number_format(mysqli_result_(mysqli_query_("select count(id) from students where category='{$q['category']}' and delete_status!='1'  "), 0))
.")  students  </h3>
 
 
 <table  class='table dataTable' other_query=\"category='{$q['category']}'\"  table_file='php_files/pages/server-side-tables/customers_all.php' ><thead><tr> <th>Name</th> <th>courses</th>  <th> paid </th><th>Balance</th><th>Class time </th> <th>address</th> <th>Description</th>  <th>date</th> <th  class='hide_for_print'> action </tr></thead>
<tbody>
 </tbody></table>  </div>
 ";



 
    }

    return array('li' => $li,'div' => $div);

}



function get_all_customers(){
 
  $students_cate = get_categoreis();
  return "  

<div id='students_tabs'>

      <ul> 
            ".$students_cate['li']."
      </ul>

".$students_cate['div']."

</div>


  <script type='text/javascript' > 

   
       $( '#students_tabs' ).tabs();
 
       $( '#students_tabs a[href=\"#all\"]').click();

    </script>
";

}

// submited 
if(isset($_POST['data'])){
    if_logged_in('die');
   echo get_all_customers();


}

?>