<?php
require_once __DIR__.'\SimpleXLSX.php';

$beaches = []; 

if ( $xlsx = SimpleXLSX::parse('beach.xlsx')) {
    $beaches= $xlsx->rows();
} else {
	echo SimpleXLSX::parseError();
}
// var_dump(count($beaches));
// var_dump($beaches[1][1]);



//MAP
//receive coord
// $location = 'simferopol';

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
    // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
foreach($beaches as $beache){

    if ($beache[1] == 'Место расположения') continue;
    echo $beache[1] . "<br>";
    $URL= "https://geocode-maps.yandex.ru/1.x/?apikey=28d74b24-f33d-4b35-8949-88142b0c9d92&geocode=$beache[1]&lang=ru_RU&scale=1&results=1&format=json";

    curl_setopt($ch, CURLOPT_URL, $URL);

    $json = curl_exec($ch);
    if (curl_errno($ch)) {
        $info = curl_getinfo($ch);
        var_dump($info);
        echo 'Error:' . curl_error($ch);
    }else{
        $fd = json_decode($json,false);
        // var_dump($coord);
        $coord =str_replace(' ',',', $fd->response->GeoObjectCollection->featureMember[0]->GeoObject-> Point-> pos);

        // $coord = '33.367643,45.190635';

        //receive  PNG
        $URL ="https://static-maps.yandex.ru/1.x/?ll=$coord&pt=$coord,org,l&size=1250,450&z=10&l=map&key=APeD310BAAAALOt-HAMAAfLbAiZoUWW9QhK-Di0vA9V64lMAAAAAAAAAAADA-ZKiGOZHTc7Nt7dlEdOj78HURA%3D%3D";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);

        // var_dump($ch);
        $png = curl_exec($ch);

        if (curl_errno($ch)) {
            $info = curl_getinfo($ch);
            var_dump($info);
            echo 'Error:' . curl_error($ch);
        }else{
            var_dump($png);
            $str = "map/" . $beache[1] . ".png";
            file_put_contents($str, $png);
        }
    }
}
curl_close($ch);

?>