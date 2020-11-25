<?php

$zip = new ZipArchive;
$res = $zip->open('file.zip');
if ($res === TRUE) {
  $zip->extractTo('t');
  $zip->close();
  echo 'woot!';
} else {
  echo 'doh!';
}

?>