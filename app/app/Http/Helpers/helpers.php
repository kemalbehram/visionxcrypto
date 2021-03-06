<?php

use App\Etemplate;
use App\GeneralSettings;
use App\Advertisment;
use Illuminate\Support\Str;


function send_bulksmsnigeria($number, $body){
    $basic = GeneralSettings::first();

    $url="https://www.bulksmsnigeria.com/api/v1/sms/create?";
    $param="api_token=".$basic->sms_token."&from=VISIONX&to=".$number."&body=".$body;
    file_get_contents($url.$param);

}

function send_smsTermi($number, $code){
    $body="Your Vision-X Crypto confirmation code is ".$code.". Valid for 1hour, One-time use only.";
    $basic = GeneralSettings::first();

    $phone=str_replace_first("0", "234", $number);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://termii.com/api/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '      {
       "to": "'.$phone.'",
       "from": "N-Alert",
       "sms": "'.$body.'",
       "type": "plain",
       "channel": "dnd",
       "api_key": "'.$basic->sms_termi_token.'"
   }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: termii-sms=iizYGwU6UJvPbs7Pw49595Aa157h8zzc5ZMbJs2l'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

}

function send_email_sendgrid($user,$subject, $content)
{

    $template = Etemplate::first();

    $message = $template->header.$content.$template->footer;
    $headers = array(
        'Authorization: Bearer '.$template->sendgrid,
        'Content-Type: application/json'
    );

    $datas = array(
        "personalizations" => array(
            array(
                "to" => array(
                    array(
                        "email" => $user->email,
                        "name" => $user->username
                    )
                )
            )
        ),
        "from" => array(
            "email" => 'no-reply@visionxcrypto.com'
        ),
        "subject" => $subject,
        "content" => array(
            array(
                "type" => "text/html",
                "value" => $message
            )
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking
    curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datas));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT); // request headers
    curl_close($ch);

}


if (!function_exists('send_email')) {
    function send_email_zoho($to,$subject, $message)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mail.zoho.com/api/accounts/731700720/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
   "fromAddress": "ceo_amarenelson@visionxcrypto.com",
   "toAddress": "'.$to.'",
   "subject": "'.$subject.'",
   "content": "'.$message.'",
   "askReceipt" : "yes"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
}

if (!function_exists('send_email')) {

    function send_email($to, $name, $subject, $message)
    {
        $temp = Etemplate::first();
        $gnl = GeneralSettings::first();
        $template = $temp->emessage;
        $from = $temp->esender;
        if ($gnl->email_notification == 1) {
            $headers = "From: $gnl->title <$from> \r\n";
            $headers .= "Reply-To: $gnl->title <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $mm = str_replace("{{name}}", $name, $template);
            $message = str_replace("{{message}}", $message, $mm);

            if (@mail($to, $subject, $message, $headers)) {
                // echo 'Your message has been sent.';
            } else {
                //echo 'There was a problem sending the email.';
            }
        }
    }
}


if (!function_exists('send_sms')) {

    function send_sms($to, $message)
    {
        $temp = Etemplate::first();
        $api = $temp->smsapi;
        $gnl = GeneralSettings::first();
        if ($gnl->sms_notification == 1) {
            $sendtext = urlencode($message);
            $appi = $temp->smsapi;
            $appi = str_replace("{{number}}", $to, $appi);
            $appi = str_replace("{{message}}", $sendtext, $appi);
         }
    }
}


if (!function_exists('notify')) {
    function notify($user, $subject, $message)
    {
        send_email($user->email, $user->fname, $subject, $message);
        send_sms($user->mobile, strip_tags($message));
    }
}


if (!function_exists('send_email_verification')) {
    function send_email_verification($to, $name, $subject, $message)
    {
        $temp = Etemplate::first();
        $gnl = GeneralSettings::first();
        $template = $temp->emessage;
        $from = $temp->esender;

        $headers = "From: $gnl->title <$from> \r\n";
        $headers .= "Reply-To: $gnl->title <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mm = str_replace("{{name}}", $name, $template);
        $message = str_replace("{{message}}", $message, $mm);

        if (@mail($to, $subject, $message, $headers)) {
            // echo 'Your message has been sent.';
        } else {
            //echo 'There was a problem sending the email.';
        }
    }
}


if (!function_exists('send_sms_verification')) {

    function send_sms_verification($to, $message)
    {
        $temp = Etemplate::first();
        $gnl = GeneralSettings::first();
        if ($gnl->sms_verification == 1) {
            $sendtext = urlencode($message);
            $appi = $temp->smsapi;
            $appi = str_replace("{{number}}", $to, $appi);
            $appi = str_replace("{{message}}", $sendtext, $appi);
            $result = file_get_contents($appi);
        }
    }
}


function show_add($size)
{
    $adds = Advertisment::where('size', $size)->inRandomOrder()->first();

    if ($adds) {
        return view('partials.adds', compact('adds'));
    }
}


if (!function_exists('send_contact')) {

    function send_contact($from, $name, $subject, $message)
    {
        $temp = Etemplate::first();
        $to = $temp->esender;

        $headers = "From: $name <$from> \r\n";
        $headers .= "Reply-To: $name <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mm = "Hi Sir," . "<br><br>";
        $thanks = "Thanks, <br> <strong>$name</strong>";
        $message = $mm . $message . $thanks;

        if (@mail($to, $subject, $message, $headers)) {
            // echo 'Your message has been sent.';
        } else {
            //echo 'There was a problem sending the email.';
        }

    }
}



// For Paytm
if(!function_exists("encrypt_e")) {
    function encrypt_e($input, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
}

if(!function_exists("decrypt_e")) {
    function decrypt_e($crypt, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
}

if(!function_exists("pkcs5_pad_e")) {
    function pkcs5_pad_e($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}

if(!function_exists("pkcs5_unpad_e")) {
    function pkcs5_unpad_e($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }
}

if(!function_exists("generateSalt_e")) {
    function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }
}


if(!function_exists("checkString_e")) {
    function checkString_e($value) {
        $myvalue = ltrim($value);
        $myvalue = rtrim($myvalue);
        if ($myvalue == 'null')
            $myvalue = '';
        return $myvalue;
    }
}

if(!function_exists("getChecksumFromArray")) {
    function getChecksumFromArray($arrayList, $key, $sort = 1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str         = getArray2Str($arrayList);
        $salt        = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash        = hash("sha256", $finalString);
        $hashString  = $hash . $salt;
        $checksum    = encrypt_e($hashString, $key);
        return $checksum;
    }
}

if(!function_exists("verifychecksum_e")) {
    function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str        = getArray2StrForVerify($arrayList);
        $paytm_hash = decrypt_e($checksumvalue, $key);
        $salt       = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }
}

if(!function_exists("getArray2Str")) {
    function getArray2Str($arrayList) {
        $findme   = 'REFUND';
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if ($pos !== false || $pospipe !== false)
            {
                continue;
            }

            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
}

if(!function_exists("getArray2StrForVerify")) {
    function getArray2StrForVerify($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
}

if(!function_exists("redirect2PG")) {
    function redirect2PG($paramList, $key) {
        $hashString = getchecksumFromArray($paramList);
        $checksum   = encrypt_e($hashString, $key);
    }
}


if(!function_exists("removeCheckSumParam")) {
    function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }
}

if(!function_exists("getTxnStatus")) {
    function getTxnStatus($requestParamList) {
        return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }
}

if(!function_exists("initiateTxnRefund")) {
    function initiateTxnRefund($requestParamList) {
        $CHECKSUM                     = getChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return callAPI(PAYTM_REFUND_URL, $requestParamList);
    }
}

if(!function_exists("callAPI")) {
    function callAPI($apiURL, $requestParamList) {
        $jsonResponse      = "";
        $responseParamList = array();
        $JsonData          = json_encode($requestParamList);
        $postData          = 'JsonData=' . urlencode($JsonData);
        $ch                = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData)
        ));
        $jsonResponse      = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse, true);
        return $responseParamList;
    }
}

if(!function_exists("sanitizedParam")) {
    function sanitizedParam($param) {
        $pattern[0]     = "%,%";
        $pattern[1]     = "%#%";
        $pattern[2]     = "%\(%";
        $pattern[3]     = "%\)%";
        $pattern[4]     = "%\{%";
        $pattern[5]     = "%\}%";
        $pattern[6]     = "%<%";
        $pattern[7]     = "%>%";
        $pattern[8]     = "%`%";
        $pattern[9]     = "%!%";
        $pattern[10]    = "%\\$%";
        $pattern[11]    = "%\%%";
        $pattern[12]    = "%\^%";
        $pattern[13]    = "%=%";
        $pattern[14]    = "%\+%";
        $pattern[15]    = "%\|%";
        $pattern[16]    = "%\\\%";
        $pattern[17]    = "%:%";
        $pattern[18]    = "%'%";
        $pattern[19]    = "%\"%";
        $pattern[20]    = "%;%";
        $pattern[21]    = "%~%";
        $pattern[22]    = "%\[%";
        $pattern[23]    = "%\]%";
        $pattern[24]    = "%\*%";
        $pattern[25]    = "%&%";
        $sanitizedParam = preg_replace($pattern, "", $param);
        return $sanitizedParam;
    }
}

if(!function_exists("callNewAPI")) {
    function callNewAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
        );
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
}
// For Paytm
