<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/ctmobiledatapurchase",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"9737397ewr3af792023hgjg\",\n    \"amount\": \"100\",\n    \"productcode\": \"D-MFIN-5-100MB\",\n    \"mobilenumber\": \"08060118558\",\n    \"telco\": \"MTN\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: SK-000054586-PROD-A7CE79AB58E0483C8A94E9CE14A97566C3CB661201FD4AFEBEB688F65A4A0E5F"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;