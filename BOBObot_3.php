<?php
$access_token = '3NSrwxoBmoc/JzYfi/TeeAWDfjMXPkl+pK2smX+/wlptcnGgM/ysws0jfUfuaXInCd8/tPGW4MhzFYTyXlGB/8Ue8p8irgrbaXnFk8dz6vGieKqDaPgzPfI2SgrjG7f+dJ9+J+sbGISzY+GGSa07gwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
//Train_message
$file = fopen('Train_message_2.csv', 'r');
#$log_out = fopen('Log_chat.csv', 'a');
//$log_out = fopen('Log_chat_2.txt', 'w');

while (($line = fgetcsv($file)) !== FALSE) {
	//if (($key = array_search('', $line)) !== false) {
    //unset($line[$key]);}
	$data_ary[$line[0]]=array_slice($line,1);
}
$temp_in = 'ask';
$temp_out = 'ans';
//fwrite($log_out, $temp_in);
//fwrite($log_out, 'ask');
//fwrite($log_out, $temp_out);
//fwrite($log_out, '\n');
//fclose($log_out);

$filename = 'Log_chat_2.txt';
$somecontent = "Add this to the file\n";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }
	$handle = fopen($filename, 'w');
	fwrite($handle, $somecontent);
    echo "Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}


if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$temp_in = $text;
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			if (in_array($data_ary[$text], $data_ary)) {
				if (strlen($data_ary[$text][array_rand($data_ary[$text], 1)])>1){
					$messages = [
					    'type' => 'text',
					    'text' => $data_ary[$text][array_rand($data_ary[$text], 1)]
					  ];
					$temp_out = $data_ary[$text][array_rand($data_ary[$text], 1)];
				} else{
					$messages = [
					    'type' => 'text',
					    'text' => "TeachMe"
					];
					$temp_out = "TeachMe";
				}
						
			 $data = [
			    'replyToken' => $replyToken,
			    'messages' => [$messages]
			 ];
			} 
			
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
//fwrite($log_out, $temp_in);
//fwrite($log_out, ',');
//fwrite($log_out, $temp_out);
//fwrite($log_out, '\n');
//fclose($log_out);
fclose($file);

echo "OK";
