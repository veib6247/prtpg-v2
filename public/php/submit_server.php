<?php
// read posted data
$post = file_get_contents('php://input');

// parse json string to object
$data_object = json_decode($post);

echo post($data_object->endPoint, $data_object->parameters, $data_object->token);

function post($url, $data, $token)
{
 # initialize cURL
 $ch = curl_init();

 # setup cURL parameters
 curl_setopt_array($ch, array(
  CURLOPT_URL            => $url,
  CURLOPT_POST           => 1,
  CURLOPT_POSTFIELDS     => $data,
  CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER     => array('AuthToken: ' . $token),
 ));

 $responseData = curl_exec($ch);

 # error handling
 if (curl_errno($ch)) {
  return curl_error($ch);
 }

 curl_close($ch);

 return $responseData;
}