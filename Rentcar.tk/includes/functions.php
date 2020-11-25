<?php



  function get_dueDate_th($id_collmn,$value){
  		$query = (trim($id_collmn) == '')?'':'and $id_collmn=$value';
		return (mysql_result(mysql_query("select count(id) from rented_cars where due_date!='0000-00-00' $query and delete_status!='1'"), 0) != '0')?'<th> Due-date </th>':'';
	}


?>