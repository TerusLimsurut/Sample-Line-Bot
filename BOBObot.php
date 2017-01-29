<?php
$access_token = '3NSrwxoBmoc/JzYfi/TeeAWDfjMXPkl+pK2smX+/wlptcnGgM/ysws0jfUfuaXInCd8/tPGW4MhzFYTyXlGB/8Ue8p8irgrbaXnFk8dz6vGieKqDaPgzPfI2SgrjG7f+dJ9+J+sbGISzY+GGSa07gwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
//Train_message
$file = fopen('Train_message_2.csv', 'r');
//$data_ary=array("u");
//$i=0;
//$f_test=array("test","hello");
//$data_ary=array($f_test);

  //$line is an array of the csv elements
  //print_r($line);
  //array_push($data_ary, $line);
while (($line = fgetcsv($file)) !== FALSE) {
  $data_ary[$line[0]]=array_slice($line, 1);
}
//echo $data_ary['a'];
//print_r($data_ary['a']);
//echo $data_ary['b'][array_rand($data_ary['b'], 1)];
// fclose($file);
// try {
//   echo "hi";
// } catch (Exception $e) {
//   echo "awww";
// }
// if (in_array($data_ary["แอล"], $data_ary)) {
// 	print_r($data_ary["แอล"]);
// }
// else{
// 	echo "hi";
// }

if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
// 			try {
// 			    $messages = [
// 			    'type' => 'text',
// 			    'text' => $data_ary[$text][array_rand($data_ary[$text], 1)]
// 			  ];
// 			} catch (Exception $e) {
// 			    $messages = [
// 			    'type' => 'text',
// 			    'text' => "TeachMe"
// 			  ];
// 			}
			
			if (in_array($data_ary[$text], $data_ary)) {
				if (strlen($data_ary[$text][array_rand($data_ary[$text], 1)])>1){
					$messages = [
					    'type' => 'text',
					    'text' => $data_ary[$text][array_rand($data_ary[$text], 1)]
					  ];
				} else{
					$messages = [
					    'type' => 'text',
					    'text' => "TeachMe"
					];
				}

			 $data = [
			    'replyToken' => $replyToken,
			    'messages' => [$messages]
			 ];
			} 
// 			else{
// 			    $messages = [
// 			    'type' => 'text',
// 			    'text' => "TeachMe"
// 			  ];
// 			 $data = [
// 			    'replyToken' => $replyToken,
// 			    'messages' => [$messages]
// 			 ];
// 			}
			
// 			$data = [
// 			    'replyToken' => $replyToken,
// 			    'messages' => [$messages]
// 			 ];
			
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
echo "OK";
