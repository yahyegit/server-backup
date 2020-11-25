<?php
   include '../../clasess/db_connector.php';
 

 function students(){ // y,m,d
       
    
      
    $qq = mysqli_query_(" select * from students where active='new' and delete_status!='1'  order by id DESC");
    $students_grid = "  <div class='course_grid'>
    ";
       while($aRow = mysqli_fetch_assoc_($qq))
         {
   
            $_age = floor((time() - strtotime($aRow['birthDate'])) / 31556926);
            $id_cust = $aRow['id'];


            $students_grid .= " <div>
                       <p><b>{$aRow['full_name']}</b></p>
                       <p><label class='gray'>Course</label>  {$aRow['course']} </p>
                    <p><label class='gray'>Mobile</label> <a href='tel:{$aRow['mobile']}'>{$aRow['mobile']}</a> </p>
                   <p> <label class='gray'>Dagmada</label> {$aRow['address']} </p>
                    <p><label class='gray'>Sanadka dhalashada</label> ".date('Y',strtotime($aRow['birthDate']))."  <b>$_age</b> years old  <br> </p>
  <p><label class='gray'>Registration Date</label>  ".date('d-M-Y',strtotime($aRow['r_date']))." </p>                    
                    <button class='primary_button change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"
                   data =  {id:$id_cust,active:'1'};
                    $.post('php_files/clasess/toggle_class_approve.php',{data:data}, function (feadback) { });

                    request_template(current_open_page.position,current_open_page.data,current_open_page.file);

                    \" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'> Approve </span></button> 

                    <button class='change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"get_template.customers({$aRow['id']},'edit_customer_info_form','pages/forms/edit_student_form.php');\" role='button' aria-disabled='false' style=' display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-pencil'></span><span class='ui-button-text'>Edit </span></button> <button class='  ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' onclick=\"delete_({table:'students',id:{$aRow['id']},msg:'deleting <strong>{$aRow['full_name']}</strong> ?'}); \" role='button' aria-disabled='false' style='  display:inline;'><span class='ui-button-icon-primary ui-icon ui-icon-trash'></span><span class='ui-button-text'>Delete  </span></button>  </div>
       
       
                    ";

         }
         $students_grid .= '</div>';
 
 
$data = "<div class='reports_page'>
 
  <h4 class='title_'> (".number_format(mysqli_result_(mysqli_query_("select count(id) from students where delete_status!='1' and active='new' 	") )).") New students  </h4>

   <button  style=\"
    margin-left:  ; font-size: 13px;
\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary\" onclick=\"get_template.customers('','','pages/forms/register_student_form.php');\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-icon-primary ui-icon ui-icon-plus\"></span><span class=\"ui-button-text\"> Add student </span></button> 
 $students_grid



 ";
 
return $data;
 
 }




 
 
if(isset($_POST['data'])){
    if_logged_in('die');

 
   echo students();

   
}







?>
