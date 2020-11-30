<?php    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/ctairtimepurchase",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"973739ddd73792023g33drffasfr\",\n    \"amount\": \"100\",\n    \"mobilenumber\": \"08031975397\",\n    \"telco\": \"mtn\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: SK-0000993932865280971-PROD-0C1EBA8BA84344A28B72219F6F01FE588ADE6A85FB584759B62987435993B74A"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
 
?>





