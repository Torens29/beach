<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
function voice($text, $nameVoice){
    $token = 't1.9euelZqdmI2ckZuZmc2VxsvNmJTJi-3rnpWay86KipSbmpGalJCQzI_Kzpjl8_cPMgNy-e9PO2lz_t3z909gAHL57087aXP-.TKxG_7U6VhLtbnm3ldLkPns_sRr0RksDfBRbHobIYPomnN4AuVnd8fVuz4uJjMLWQ2F1EvaQDlDwSKoT3xe5Aw'; # IAM-токен
    $folderId = "b1gs3vv3dolr9bj7k3eh"; # Идентификатор каталога

    $url = "https://tts.api.cloud.yandex.net/speech/v1/tts:synthesize";

    $post = "text=" . urlencode($text) . "&lang=ru-RU&voice=filipp&folderId=${folderId}";
    $headers = ['Authorization: Bearer ' . $token];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    if ($post !== false) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        print "Error: " . curl_error($ch);
    }
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        $decodedResponse = json_decode($response, true);
        echo "Error code: " . $decodedResponse["error_code"] . "\r\n";
        echo "Error message: " . $decodedResponse["error_message"] . "\r\n";
    } else file_put_contents($nameVoice . ".ogg", $response);
    
    curl_close($ch);
}
// folder-id - b1gnia699nknlj6jhi7p 
// iamtoken - t1.9euelZqdmI2ckZuZmc2VxsvNmJTJi-3rnpWay86KipSbmpGalJCQzI_Kzpjl8_cPMgNy-e9PO2lz_t3z909gAHL57087aXP-.TKxG_7U6VhLtbnm3ldLkPns_sRr0RksDfBRbHobIYPomnN4AuVnd8fVuz4uJjMLWQ2F1EvaQDlDwSKoT3xe5Aw
?>
</body>
</html>