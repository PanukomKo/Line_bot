<?php
$access_token = 'XXXXXXXXXXXXXXXXXXXXXXX';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . 'bS4SFo/4mVoGhz/7C+qsExuLp+YjExi9qIPshwhKYaU9GZ+zH3lDFR6+9sdoA13TqsIot2X24c19kP2P2t06udUGjhnebqLmNPdtsY5k4M5IEMap0kNMB8i4IEY3zve9iZ458KiIpRA+dYd350+pvQdB04t89/1O/w1cDnyilFU=');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;