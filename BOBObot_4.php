#!/usr/bin/env php
<?php
//require_once __DIR__.'/helper.php';
require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;
/* @var dbx\Client $client */
/* @var string $sourcePath */
/* @var string $dropboxPath */
list($client, $sourcePath, $dropboxPath) = parseArgs("upload-file", $argv, array(
        array("https://www.dropbox.com/home/Apps/Heroku/php-dropbox/Log_chat_2_2.txt", "A path to a local file or a URL of a resource."),
        array("https://www.dropbox.com/home/Apps/Heroku/php-dropbox", "The path (on Dropbox) to save the file to."),
    ));
$pathError = dbx\Path::findErrorNonRoot($dropboxPath);
if ($pathError !== null) {
    fwrite(STDERR, "Invalid <dropbox-path>: $pathError\n");
    die;
}
$size = null;
if (\stream_is_local($sourcePath)) {
    $size = \filesize($sourcePath);
}
$fp = fopen($sourcePath, "w");
$somecontent = "123456\n";
fwrite($fp, $somecontent);
$metadata = $client->uploadFile($dropboxPath, dbx\WriteMode::add(), $fp, $size);
fclose($fp);
print_r($metadata);
?>