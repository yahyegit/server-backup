
<?php

require 'connet.php';

	if (isset($_POST['id4'])){

  
$id		=   trim(mysql_real_escape_string(htmlentities($_POST['id4'])));


				$select_all_dates = "SELECT DISTINCT `months` FROM `history` WHERE `id_card` = $id  ORDER BY `months`"; 	
			
										
								if(@$query_run2 = mysql_query($select_all_dates)){
								
									while($sql_row_2 = mysql_fetch_assoc($query_run2)){
																		 
									$all_dates  = 	$sql_row_2['months'];
									echo "<option> $all_dates </option>";
															
									}	
							
								}
	}		


?>