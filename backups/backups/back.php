<?php 
  //    ini_set('display_errors', 0);

  error_reporting(0);
    
  require("others/PHPMailer.php");
  require("others/SMTP.php");
 
 

$count = 0;

    function Export_Database($host,$user,$pass,$name,$tables)
    {

      $tables = array_unique($tables);

      //$tables = array("customers","open_cash","settings","transactions"); 
      $backup_name        = 'sql_backup/backup_for('.$name.')_on_'.date('d-m-Y').'.sql';

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
    $mail->Host = 'tls://smtp.gmail.com';
    $mail->Port = 587; // or 587  or 465
    $mail->IsHTML(true);
    $mail->Username = 'kunkeen.cash@gmail.com';
    $mail->Password = '5bkUvsmcD.#)Hq^.';
    $mail->SetFrom('kunkeen.cash@gmail.com');
    $mail->addAttachment($backup_name); 
    $mail->Subject = "sql backup for DB name: $name on ".date('d-m-Y')."hostname: $host";
    $mail->Body = $content;
    $mail->AddAddress("kunkeen.cash@gmail.com");

     if(!$mail->Send()) {
        global $coun; $coun = $coun+1;
      //  return "sorry somthing went wrong please try again !";
     } else {
    
     }
     //unlink($backup_name); // to save disk space 

     }



 


Export_Database('mysqldb.kunisii.cash','gorgor','QbyczMIJR7hoQbyczMIJR7ho]./','gorgor',array("main_details","oppen_day","main_details","history",'login_in')); // gorgor 



Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunisii_girow',array("main_details","oppen_day","main_details","history",'login_in'));
// girow

 Export_Database('mysql.huble.ml','huble_','FPLcT[7MokF<ldfgS45{}8TivHk/.','abdulfatahb3',array("customers","settings","transactions")); // abdulfatahb3



Export_Database('mysql.huble.ml','huble_','FPLcT[7MokF<ldfgS45{}8TivHk/.','huble_system',array("customers","settings","transactions")); // huble 

Export_Database('mysql.huble.ml','huble_','FPLcT[7MokF<ldfgS45{}8TivHk/.','hubleshops',array("customers","settings","transactions")); // hubleShops



Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunisii_tusmo',array("customers","settings","transactions"));  // tusmo

Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunisii_kazmoni',array("customers","open_cash","settings","transactions"));  // kazimoni 

Export_Database('mysql.ahsaltd.com','ahsaltd','tR2QZZV4dr','ahsaltd',array("main_details","oppen_day","main_details","history",'login_in')); // ahsa 1

Export_Database('mysql.ahsaltd.com','ahsaltd','tR2QZZV4dr','hansharoltd',array("main_details","oppen_day","main_details","history",'login_in'));  // ahsa hansharoltd 

Export_Database('mysql.ahsaltd.com','ahsaltd','tR2QZZV4dr','kunisii_ahsa',array("customers","open_cash","settings","transactions"));  // ahsa 3 ahmed 

Export_Database('mysql.ahsaltd.com','ahsaltd','tR2QZZV4dr','harun_rent',array("currency","cars",'customers',"expense","payments",'rented_cars','security','settings')); // harun rent

 
Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunisii_dheere',array("main_details","oppen_day","main_details","history",'login_in')); // dheere 

Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunisii_xarago',array("main_details","oppen_day","main_details","history",'login_in'));  // xarago 

Export_Database('mysqldb.kunisii.cash','kunisii','ssd[Vfs%^d456hfgKMa@tX[','kunkeen_pacific',array("main_details","oppen_day","main_details","history",'login_in')); // pacificocean

 
 echo $count.' done!'; 





?>
