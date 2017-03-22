#!/usr/bin/env php
<?php
//require_once __DIR__.'/helper.php';
require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;
$sourcePath="Log_chat_2_2.txt";
$fp = fopen($sourcePath, "w");
$somecontent = "123456\n";
fwrite($fp, $somecontent);
fclose($fp);
?>