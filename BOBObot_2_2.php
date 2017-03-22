<?php
require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;

$appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

$authorizeUrl = $webAuth->start();

/* echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
$authCode = \trim(\readline("Enter the authorization code here: ")); */ */
$authCode = "ZWWddZktyTgAAAAAAAAF1lQXrfv-_8Bv-EGyNDclX7E"
list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
print "Access Token: " . $accessToken . "\n";

echo $accessToken;
/* $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
$accountInfo = $dbxClient->getAccountInfo();

print_r($accountInfo);

$f = fopen("working-draft.txt", "w");
$somecontent = "Add this to the file\n";
fwrite($f, $somecontent)
$result = $dbxClient->uploadFile("/working-draft.txt", dbx\WriteMode::add(), $f);
fclose($f);
print_r($result);

$folderMetadata = $dbxClient->getMetadataWithChildren("/");
print_r($folderMetadata);

$f = fopen("working-draft.txt", "w");
$fileMetadata = $dbxClient->getFile("/working-draft.txt", $f);
fclose($f);
print_r($fileMetadata); */
?>