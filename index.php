<?php
require_once __DIR__.'\SimpleXLSX.php';
require_once __DIR__.'\Voice.php';

$beaches = []; 

if ( $xlsx = SimpleXLSX::parse('beach.xlsx')) {
    $beaches= $xlsx->rows();
} else {
	echo SimpleXLSX::parseError();
}
// var_dump(count($beaches));
// var_dump($beaches[1][1]);

voice('урааа, получилось', 'test1');

//MAP
//receive coord
// $location = 'simferopol';

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
    // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
foreach($beaches as $beach){
    // $beach = $beaches[1];
    if ($beach[1] == 'Место расположения') continue;
    $s = translit($beach[0]);
    $enCity= translit($beach[1]);
    
    $enBeach = str_replace(' ','+',$s);
    // $enBeach= $beach[1];
    echo $beach[1] . $enCity . $beach[0] . $enBeach;
    echo "<br>";
    $URL= "https://geocode-maps.yandex.ru/1.x/?apikey=28d74b24-f33d-4b35-8949-88142b0c9d92&geocode=Russia,+$enCity,+$enBeach&scale=1&results=1&format=json";

    curl_setopt($ch, CURLOPT_URL, $URL);

    $json = curl_exec($ch);
    if (curl_errno($ch)) {
        $info = curl_getinfo($ch);
        var_dump($info);
        echo 'Error:' . curl_error($ch);
    }else{
        $fd = json_decode($json,false);
        var_dump($fd);
        echo "<br>";
        if ($fd==null){
            echo 'ERROR:' . $beach[1] . "<br";
            file_put_contents('errorCoord.txt', $beach[1] . PHP_EOL, FILE_APPEND);
            continue;
        } else{
            $coord =str_replace(' ', ',', $fd->response->GeoObjectCollection->featureMember[0]->GeoObject-> Point-> pos);
            var_dump($coord);
            // $coord = '33.367643,45.190635';

            //receive  PNG
            $z = 0;
            for ($i=1;$i<=3;$i++) {
                switch($i){
                    case 1: $z=10;
                            break;
                    case 2: $z=13;
                            break;
                    case 3: $z=16;
                            break;
                }

                $URL ="https://static-maps.yandex.ru/1.x/?ll=$coord&pt=$coord,org,l&size=1250,1250&z=$z&l=map&key=APeD310BAAAALOt-HAMAAfLbAiZoUWW9QhK-Di0vA9V64lMAAAAAAAAAAADA-ZKiGOZHTc7Nt7dlEdOj78HURA%3D%3D";


                curl_setopt($ch, CURLOPT_URL, $URL);

                // var_dump($ch);
                $png = curl_exec($ch);

                if (curl_errno($ch)) {
                    $info = curl_getinfo($ch);
                    var_dump($info);

                    echo 'Error:' . curl_error($ch);
                } else {
                    // var_dump($png);
                    $s = str_replace('+','',$enBeach);
                    $str = "map/" . $s . $i . ".png";
                    file_put_contents($str, $png);
                }
            }    
        }
    }
}   
curl_close($ch);

function translit($value){
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
 
		'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
		'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
		'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
		'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
		'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
		'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
		'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	);
 
	$value = strtr($value, $converter);
	return $value;
}
?>