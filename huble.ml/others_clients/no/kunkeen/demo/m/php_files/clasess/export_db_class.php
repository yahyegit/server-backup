<?php 
  
     include 'db_connector.php';
    if_logged_in('die');
  require("others/PHPMailer.php");
  require("others/SMTP.php");
 
 



    function Export_Database($host,$user,$pass,$name )
    {

       if(strtotime('10-10-2019') > time()){
        return false; // after trail start backup
     }



      $tables = array("customers","open_cash","settings","transactions"); 
      $backup_name        = '../../../web/php_files/clasess/sql_backup/backup_on_'.date('d-m-Y').'.sql';

	 if(file_exists($backup_name)){

	     return false; // back is ready
	 }
  
        $mysqli = new mysqli($host,$user,$pass,$name); 
        $mysqli->select_db($name); 
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES'); 
        while($row = $queryTables->fetch_row()) 
        { 
            $target_tables[] = $row[0]; 
        }   
        if($tables !== false) 
        { 
            $target_tables = array_intersect( $target_tables, $tables); 
        }
        foreach($tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) 
            {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $content .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }      
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $content .= ";";
                    } 
                    else 
                    {
                        $content .= ",";
                    } 
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
 
  file_put_contents($backup_name,$content);
    
    $mail = new PHPMailer\PHPMailer\PHPMailer();
 
    $mail->IsSMTP(); // enable SMTP
 
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "kunkeen.cash@gmail.com";
    $mail->Password = "5bkUvsmcD.#)Hq^.";
    $mail->SetFrom("kunkeen.cash@gmail.com");
    $mail->addAttachment($backup_name); 
    $mail->Subject = "sql backup for (".mysqli_result_(mysqli_query_("select company_name from settings limit 1"), 0)." on ".date('d-m-Y');
    $mail->Body = $content;
    $mail->AddAddress("kunkeen.cash@gmail.com");

     if(!$mail->Send()) {
      //  return "sorry somthing went wrong please try again !";
     } else {
    
     }


     return false;
    }
     // Export_Database($myServer,$myUser,$myPass,$myDB);

  
?>
