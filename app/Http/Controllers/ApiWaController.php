<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiWaController extends Controller
{
public function sendWa($target, $message, $Country = '62'){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
'target' => $target,
'message' => $message, 
'countryCode' => $Country, //optional
),
  CURLOPT_HTTPHEADER => array(
    'Authorization: ZXHMd21vJAbfUwbw3cJY' //change TOKEN to your actual token
  ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
 echo $error_msg;
}
echo $response;

}
}