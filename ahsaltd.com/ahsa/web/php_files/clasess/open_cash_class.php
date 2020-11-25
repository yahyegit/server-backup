<?php
 include 'db_connector.php';

 include 'reports_class.php';
 

function open_cash($data){
 		 $data = clean_security($data);
 
	if(check_token($data['crf_code'],'check')){

		 	if(!empty($data['id']) && ctype_digit($data['id'])){
					   // edit open cash
		 			    mysqli_query_("UPDATE `open_cash` SET  `title`='{$data['title']}',`amount_ksh`='{$data['amount_ksh']}',`amount_dollar`='{$data['amount_dollar']}',`date`='{$data['date']}', `dollar_rate`='{$data['dollar_rate']}' where id='{$data['id']}'");
			 
			}else{  

			    // create open cash 
		 			 if(mysqli_result_(mysqli_query_(" select count(id) from open_cash where date='{$data['date']}'  and delete_status!='1'"),0) != 0 ){
		 			    	return "open cash for {$data['date']} is already exists ".'<a href="#" title="view reports for ('.date('d/M/Y',strtotime($data['date'])).')" class="change ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary"
				 	onclick="get_template.reports({date_from:\''.$data['date'].'\'},\'pages/other_pages/reports_page.php\');" role="button" aria-disabled="false" style="font-size: 11px;"><span class="ui-button-icon-primary ui-icon ui-icon-clock"></span><span class="ui-button-text">'.$data['date'].'</span></a>';

		 			    }else{

		 			    	  mysqli_query_("INSERT INTO `open_cash`(`id`,`title`, `amount_ksh`, `amount_dollar`,`date`, `delete_status`,`dollar_rate`) VALUES ('','{$data['title']}','{$data['amount_ksh']}','{$data['amount_dollar']}','{$data['date']}',0,'{$data['dollar_rate']}')");
		 			    }
			}

			 check_token($data['crf_code'],'');    // remove_crf
						return 'ok';
	}else{
		echo 'login';
	}	
		
}


// submited request handler
if(isset($_POST['data'])){
	 if_logged_in('die');//  echo "44444444"; die();
	  echo open_cash($_POST['data']);
}

?>





