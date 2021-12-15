
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



//НАДО ОТСЫЛАТЬ ПОЧЕМУ-ТО АДРЕСС НА АНГЛИЙСКОМ, ЕПТ!
//не отсылается 2 раза

//28d74b24-f33d-4b35-8949-88142b0c9d92

$URL= "https://geocode-maps.yandex.ru/1.x/?apikey=28d74b24-f33d-4b35-8949-88142b0c9d92&geocode=simferopol&scale=1&results=1&format=json";

$ch = curl_init();
// curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);


$html = curl_exec($ch);
// $info = curl_getinfo($ch);


// echo "<br>" . var_dump($info);


$fd =json_decode($html,false);
$coord =str_replace(' ',',', $fd->response->GeoObjectCollection->featureMember[0]->GeoObject-> Point-> pos);
echo($coord);


// $coord = '33.367643,45.190635';
// curl_reset($ch);

//достаем PNG
$URL ="https://static-maps.yandex.ru/1.x/?ll=$coord&pt=$coord,org,l&size=450,450&z=10&l=map";
// &key=APeD310BAAAALOt-HAMAAfLbAiZoUWW9QhK-Di0vA9V64lMAAAAAAAAAAADA-ZKiGOZHTc7Nt7dlEdOj78HURA%3D%3D";
// $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $URL);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_HEADER, false);

var_dump($ch);
$png = curl_exec($ch);

if (curl_errno($ch)) {
    $info = curl_getinfo($ch);
    var_dump($info);
    echo 'Error:' . curl_error($ch);
}

var_dump($png);
file_put_contents("map1.png", $png);

curl_close($ch);
 //->ymaps->GeoObjectCollection->featureMember->GeoObject->Point;//->metaDataProperty->GeocoderResponseMetaData->Point->pos;
?>
</body>
</html>
