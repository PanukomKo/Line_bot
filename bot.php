<?php
$access_token = 'bS4SFo/4mVoGhz/7C+qsExuLp+YjExi9qIPshwhKYaU9GZ+zH3lDFR6+9sdoA13TqsIot2X24c19kP2P2t06udUGjhnebqLmNPdtsY5k4M5IEMap0kNMB8i4IEY3zve9iZ458KiIpRA+dYd350+pvQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
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
			if(stripos($text, 'hosico') != false || stripos($text, 'Hosico') != false || stripos($text, 'โฮสิโกะ') != false || stripos($text, 'โฮสิโก้') != false){
				$messages = [
					'type' => 'image',
					'originalContentUrl' => 'https://scontent.fbkk2-3.fna.fbcdn.net/v/t1.0-9/15391041_223407271401277_8915066001398988487_n.jpg?oh=76244c40efc6933ef2e4b7421357b270&oe=59E88E49',
					'previewImageUrl' => 'https://scontent.fbkk2-3.fna.fbcdn.net/v/t1.0-9/15391041_223407271401277_8915066001398988487_n.jpg?oh=76244c40efc6933ef2e4b7421357b270&oe=59E88E49'
				];
			}
			if(stripos($text, 'nala') != false || stripos($text, 'Nala') != false || stripos($text, 'นาลา') != false){
				$messages = [
					'type' => 'image',
					'originalContentUrl' => 'https://scontent.fbkk2-3.fna.fbcdn.net/v/t1.0-9/18342716_1359791850778970_7634890570901158731_n.jpg?oh=824182918f0103f0775d692ab7daca8a&oe=59A6763E',
					'previewImageUrl' => 'https://scontent.fbkk2-3.fna.fbcdn.net/v/t1.0-9/18342716_1359791850778970_7634890570901158731_n.jpg?oh=824182918f0103f0775d692ab7daca8a&oe=59A6763E'
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
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