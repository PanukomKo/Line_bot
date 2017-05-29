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
   
			/*if(strpos($text, 'hosico') !== false){
				$messages = [
					'type' => 'imagemap',
					"baseUrl" => "https://imgza.xyz/i/ow65i9zb.jpg",
					"altText" => "Hosico naja",
					"baseSize" => [
      					"height" => 1040,
      					"width" => 1040
  					],
  					"actions" => [
  						[
					        "type" => "uri",
					        "linkUri" => "https://www.facebook.com/thehosicocat/videos/273666003042070/",
					        "area" => [
					              "x" => 0,
					              "y" => 0,
					              "width" => 520,
					              "height" => 1040
					        ]
					    ],
	      				[
	          				"type" => "message",
	          				"text" => "แบบนี้อ่ะนะ คอลอสเซล",
	          				"area" => [
	              				"x" => 520,
	              				"y" => 0,
	              				"width" => 520,
	              				"height" => 1040
	          				]
	      				]
  					]
				];
			}*/
			if(strpos($text, 'hosico') !== false){
				$messages = [
				  "type" => "template",
				  "altText" => "this is a buttons template",
				  "template" => [
				      "type" => "buttons",
				      "thumbnailImageUrl" => "https://imgza.xyz/i/ow65i9zb.jpg",
				      "title" => "โหสิโก้",
				      "text" => "แบบนี้ป่ะ คอลอสเสล",
				      "actions" => [
					          [
					            "type" => "uri",
					            "label" => "มาดู Hosico",
					            "uri" => "https://www.facebook.com/thehosicocat/videos/273666003042070/"
					          ]
				        ]
				    ]
				]
			}

			if(strpos($text, 'ใช่มะ') !== false){
				$messages = [
				  "type" => "template",
				  "altText" => "this is a confirm template",
				  "template" => [
				      "type" => "confirm",
				      "text" => "ตอบสิ",
				      "actions": [
				          [
				            "type" => "message",
				            "label" => "Yes",
				            "text" => "เออดี"
				          ],
				          [
				            "type" => "message",
				            "label" => "No",
				            "text" => "กำ แล้วมันคือไรอ่า"
				          ]
				      ]
				   ]
				]
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