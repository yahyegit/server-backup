<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	}
	  
 
    $current_reports = get_report_totals($_POST['date1']);
    $query  = 'SELECT * FROM `history` WHERE `date` LIKE \"%'.$_POST['date1'].'%\" ORDER BY `id`';
	$exportBtn = "<a href='#' style='position: relative;top: 35px;left: 200px;' onclick='exporter(&quot;$query&quot;,&quot;ll&quot;,&quot;6-all&quot;,&quot;exports/others/Reports-for-(".str_replace('/','-',$_POST['date1']).").pdf&quot;,&quot;rep&quot;)'   class='button'>Export Reports for (".$_POST['date1'].") </a>";
				 

    echo $exportBtn.''.$current_reports;
 		
?>