<?php
$ch = curl_init();
$url = 'http://sms.w3techies.net/smsapi/non-masking?api_key=$2y$10$mp5WNn7jMb9L3jlygECRXeOV.MYVKGNsI5mTaCgHtiEIB217liSnu&smsType=text&mobileNo=8801739622655&smsContent=Test SMS!!!';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
$output = curl_exec($ch);
curl_close($ch);
