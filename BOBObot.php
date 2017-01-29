<?php
$access_token = '3NSrwxoBmoc/JzYfi/TeeAWDfjMXPkl+pK2smX+/wlptcnGgM/ysws0jfUfuaXInCd8/tPGW4MhzFYTyXlGB/8Ue8p8irgrbaXnFk8dz6vGieKqDaPgzPfI2SgrjG7f+dJ9+J+sbGISzY+GGSa07gwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
//Train_message
$file = fopen('data_test.csv', 'r');
//$data_ary=array("u");
$i=0;
//$f_test=array("test","hello");
//$data_ary=array($f_test);
while (($line = fgetcsv($file)) !== FALSE) {
  //$line is an array of the csv elements
  //print_r($line);
  //array_push($data_ary, $line);
  $data_ary[$line[0]]=array_slice($line, 1);
  $i++;
}
//print_r($data_ary[1]);
//echo $data_ary['a'];
//print_r($data_ary['a']);
// echo array_rand($data_ary['a'], 1);
// fclose($file);
// try {
//   echo "hi";
// } catch (Exception $e) {
//   echo "awww";
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
			//($data_ary[0])[0])   $data_ary[$j][0])
			//[($data_ary[0])[1]
// 		      try {
			  $messages = [
			    'type' => 'text',
			    'text' => array_rand($data_ary[$text], 1);
			  ];
			  $data = [
			    'replyToken' => $replyToken,
			    'messages' => [$messages],
			  ];
// 		      } catch (Exception $e) {
// 			  echo "awww";
// 		      }
			
//       try {
//           $messages = [
//             'type' => 'text',
//             'text' => array_rand($data_ary[$text], 1);
//           ];
//           $data = [
//             'replyToken' => $replyToken,
//             'messages' => [$messages],
//           ];
//       } catch (Exception $e) {
//           $messages = [
//             'type' => 'text',
//             'text' => "สอนฉันหน่อย"
//           ];
//           $data = [
//             'replyToken' => $replyToken,
//             'messages' => [$messages],
//           ];
//       }
      
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
