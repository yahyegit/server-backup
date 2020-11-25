<?php

$x =  shell_exec("sudo du -hs  /var/lib/mysql/");

 $x = "1G"; //trim(str_replace('/var/lib/mysql/','', $x)); 


  if (preg_match('/G/', $x)) {
         $x = str_replace('G','', $x);

                if ($x > 4) {
                      shell_exec("sudo service apache2 stop");
                }

}

file_put_contents("c.txt", 'cron is working ');
?>


