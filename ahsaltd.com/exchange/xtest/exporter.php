<?php
require 'includes/functions.php';
 
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}




  if(if_logged_in() != true){
die();
 }
 	


    

if(isset($_POST['query'])){
 
 echo  exporter(str_replace("\\",'',$_POST['query']),$_POST['title'],$_POST['colms'],$_POST['filename'],$_POST['two_tabs']); 	

// echo $_POST['query'].':'.$_POST['title'].':'.$_POST['colms'].':'.$_POST['filename'].':'.$_POST['two_tabs']; 	
}else{
echo "error!";
}






?>