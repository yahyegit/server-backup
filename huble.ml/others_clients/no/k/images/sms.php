
<?php
require_once(__DIR__ . '/../autoload.php');
$MessageBird = new \MessageBird\Client('O60JbafhEnSclG2BTG0V0WoX3');

$Message = new \MessageBird\Objects\Message();
$Message->originator = '898';
$Message->recipients = array('+252906229565');
$Message->body = '[SAHAL]This is a test message.';
$MessageBird->messages->create($Message);
?>
