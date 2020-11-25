
<?php 
     include 'db_connector.php';
 
 

 
 
 // add or edit transaction 
function students_class($data){
  global $current_user;
  
  $active = (if_logged_in(''))?1:'new';


  $age = date('Y') - $data['birthDate']; 



    if($age > 75 ){
          die('Fadlan sanadka dhalashada iska hubi.   ');
      }else if($age < 15 ) {
        die('Fadlan sanadka dhalashada iska hubi.   ');
      }else{
        $data['birthDate'] = $data['birthDate'].'-09-10';
      }

   if(ctype_digit($data['full_name'])){
 die("fadlan iskafiiri magaca ");
}


    /*if(strlen($data['mobile']) != 10 ){
      die('Fadlan talefoonka iska hubi number ka oo dhamaystiran qor.  hana kudarin +252 ');
      }else if(empty($data['mobile'])){
          die('Fadlan talefoonka iska hubi number ka oo dhamaystiran qor.  hana kudarin +252 ');
      }
*/

  if(check_token($data['crf_code'],'check')){
           $data = clean_security($data);
            
             if (!empty($data['id'])) {
                      // update 
                       mysqli_query_("UPDATE `students` set birthDate='{$data['birthDate']}', full_name='{$data['full_name']}', address='{$data['address']}', mobile='{$data['mobile']}',course='{$data['course']}' where id={$data['id']}"); 
                return 'ok';  

              }else{

                    mysqli_query_("INSERT INTO `students`(`r_date`,`active`, `birthDate`,  `full_name`,`mobile`, `address`, `course`) VALUES('".date('Y-m-d')."','$active','{$data['birthDate']}','{$data['full_name']}','{$data['mobile']}','{$data['address']}','{$data['course']}')");
              } 
              
        // remove_crf
          check_token($data['crf_code'],''); 

        return 'ok';  
          
  }else{
    return 'login';
  }
}








// submited 

   
 
 if(isset($_POST['data'])){
    // echo 'posted';print_r($_POST['data']);


   echo  students_class($_POST['data']);
     // Export_Database($myServer,$myUser,$myPass,$myDB);

}
 


?>
