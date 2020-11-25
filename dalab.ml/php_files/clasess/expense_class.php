
<?php
	require 'customers_class.php';
 // add or edit transaction 
function add_expense($data){
 		$data = clean_security($data);
 $data['date'] = (trim($data['date'])!='')?$data['date']:date('Y-m-d');
	if(check_token($data['crf_code'],'check') ){

								mysqli_query_("INSERT INTO `expenses`(`id`, `name`, `quantity`, `cost`, `description`, `delete_status`, `date`) VALUES ('','{$data['name']}','{$data['quantity']}','{$data['cost']}','{$data['description']}','0','{$data['date']}')  ");
 
 
                      check_token('','');
			
				return 'ok';	
			  
	}else{
		return 'login';
	}
}








// submited 
 
if(isset($_POST['data'])){
    if_logged_in('die');

	echo add_expense($_POST['data']);


}

?>
