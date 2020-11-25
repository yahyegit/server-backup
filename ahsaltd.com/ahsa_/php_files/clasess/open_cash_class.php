<?php
 include 'db_connector.php';
 

function open_cash($data){
 		 $data = clean_security($data);
 
	if(check_token($data['crf_code'],'check')){

		 	if(!empty($data['id']) && ctype_digit($data['id'])){
					   // edit open cash
		 			    mysqli_query_("UPDATE `open_cash` SET  `dollar_rate`='{$data['dollar_rate']}', `amount_ksh`='{$data['amount_ksh']}',`date`='{$data['date']}' where id='{$data['id']}'");
			 
			}else{  

			    // create open cash 
		 			 if(mysqli_result_(mysqli_query_(" select count(id) from open_cash where date='{$data['date']}'  and delete_status!='1'"),0) == 1 ){
		 			    	return "open cash for {$data['date']} is already exists ".'<a href="#" title="view reports for ('.date('d/M/Y',strtotime($data['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$data['date'].'\'},\'pages/other_pages/reports_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.$data['date'].'</span></a>';

		 			    }else{
		 			    	  mysqli_query_("INSERT INTO `open_cash`(`id`, `dollar_rate`,`amount_ksh`,`date`, `delete_status`) VALUES ('','{$data['dollar_rate']}','{$data['amount_ksh']}','{$data['date']}',0)");
		 			    }
			}

				check_token($data['crf_code'],'');   // remove_crf
						return 'ok';
	}else{
		echo 'login';
	}	
		
}



// submited request handler
if(isset($_POST)){
	 if_logged_in('die');
	  echo open_cash($_POST['data']);
}

?>





