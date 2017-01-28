<?php
$access_token = '3NSrwxoBmoc/JzYfi/TeeAWDfjMXPkl+pK2smX+/wlptcnGgM/ysws0jfUfuaXInCd8/tPGW4MhzFYTyXlGB/8Ue8p8irgrbaXnFk8dz6vGieKqDaPgzPfI2SgrjG7f+dJ9+J+sbGISzY+GGSa07gwdB04t89/1O/w1cDnyilFU=';
$ch_secret = 'd47d8ecbdda055d3e577e5bc0cd7db97'
$ composer require linecorp/line-bot-sdk
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('$access_token');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '$ch_secret']);
$response = $bot->replyText('<reply token>', 'hello!');
