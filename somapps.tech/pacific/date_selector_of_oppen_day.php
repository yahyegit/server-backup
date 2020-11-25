
<?php

require 'connet.php';

	if (isset($_POST['oppen2'])){
 
				$select_all_dates = "SELECT DISTINCT `month` FROM `oppen_day` ORDER BY `month` "; 	
			
										
								if(@$query_run2 = mysql_query($select_all_dates)){
								
									while($sql_row_2 = mysql_fetch_assoc($query_run2)){
																		 
									$all_dates  = 	$sql_row_2['month'];
									echo "<option> $all_dates </option>";
															
									}	
							
								}
	}		


?>