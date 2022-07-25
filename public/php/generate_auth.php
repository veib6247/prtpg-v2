<?php
#
// read posted data
$post = file_get_contents('php://input');

// parse json string to object
$data_object = json_decode($post);

// build url endpoint
$url = "https://" . $data_object->subDomain . ".prtpg.com/transactionServices/REST/v1/authToken";

// build data string
$data = "authentication.partnerId=" . $data_object->partnerId . "&merchant.username=" . $data_object->username . "&authentication.sKey=" . $data_object->sKey;

// call function to hit API for auth request
echo post_auth($url, $data);

/**
 * call cURL function
 */
function post_auth($url, $data)
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
 ));

 $responseData = curl_exec($ch);

 # error handling
 if (curl_errno($ch)) {
  return curl_error($ch);
 }

 curl_close($ch);

 return $responseData;
}