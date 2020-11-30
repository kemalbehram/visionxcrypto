<?php    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/getvirtualaccount",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n    \"virtualaccount\": \"4460894093\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: SK-0000993932865280971-PROD-0C1EBA8BA84344A28B72219F6F01FE588ADE6A85FB584759B62987435993B74A",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);


$result = json_decode($response, true);
curl_close($curl);
echo $response;

 
?>





