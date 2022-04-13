<?php
require_once __DIR__.'\SimpleXLSX.php';
// require_once __DIR__.'\Exec.php';
include('SimpleImage.php');
$beaches = []; 

if ( $xlsx = SimpleXLSX::parse('beach.xlsx')) {
    $beaches= $xlsx->rows();
} else {
	echo SimpleXLSX::parseError();
}

$image = new \claviska\SimpleImage();


//MAP
//receive coord

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$j=1; // n-1
$mapTrue= false;

foreach($beaches as $beach){
    $j++;

    if ($beach[1] == 'Место расположения') continue;
    $s = translit($beach[0]);
    $enCity= translit($beach[1]);
    
//cбор координат

    $enBeach = str_replace(' ','+',$s);
    // $enBeach= $beach[1];
//     echo $beach[1] . $enCity . $beach[0] . $enBeach . "\n";
//     $URL= "https://geocode-maps.yandex.ru/1.x/?apikey=28d74b24-f33d-4b35-8949-88142b0c9d92&geocode=Russia,+$enCity,+$enBeach&scale=1&results=1&format=json";

    // curl_setopt($ch, CURLOPT_URL, $URL);
    
//     $json = curl_exec($ch);
    
//     $fd = json_decode($json,false);
    
//     if (curl_errno($ch)) {  //ошибка в получении координат
//         $info = curl_getinfo($ch);
//         var_dump($info);
//         echo 'Error:' . curl_error($ch);
//         file_put_contents('errorBeach.txt', $j . ": " . $enBeach .'- Error with receive coord - '. $info . PHP_EOL, FILE_APPEND);
//     } 
// //получили координаты
//     elseif ($fd==null || count($fd->response->GeoObjectCollection->featureMember) == 0)
//     { // проблема с координатами
//         echo $j . ' ERROR:coord ' . $enBeach . "\n";
//         file_put_contents('errorBeach.txt', $j . ": " . $enBeach .'- Error with search coord'. PHP_EOL, FILE_APPEND);
//         continue;
//     } 
//     else{
//получаем карту
            $coord = "33.93899724470521,44.39642381233141";

            // $coord =str_replace(' ', ',', $fd->response->GeoObjectCollection->featureMember[0]->GeoObject-> Point-> pos);
            
            echo "COORD of $beach[0]: ";
            // var_dump($coord);

            //receive map .PNG
            $zoom = 0;
            for ($z=1;$z<=3;$z++) {
                switch($z){
                    case 1: $zoom=10;
                            break;
                    case 2: $zoom=13;
                            break;
                    case 3: $zoom=16;
                            break;
                }

                $URL = "https://static-maps.yandex.ru/1.x/?ll=$coord&pt=$coord,org,l&size=1280,720&z=$zoom&l=map&key=APeD310BAAAALOt-HAMAAfLbAiZoUWW9QhK-Di0vA9V64lMAAAAAAAAAAADA-ZKiGOZHTc7Nt7dlEdOj78HURA%3D%3D";


                curl_setopt($ch, CURLOPT_URL, $URL);

                $png = curl_exec($ch);

                if (curl_errno($ch)) {
                    $info = curl_getinfo($ch);
                    var_dump($info);

                    echo 'Error:' . curl_error($ch);
                } else {
                    // var_dump($png);
                    $s = str_replace('"','',$enBeach);
                    $str = "F:\ПляжиВидео\map\\" . $s . $z . ".png";
                    file_put_contents($str, $png);
                    $mapTrue= true;
                    
                }
            }    

        if ($mapTrue){
//receive img (6)
            $receiveIMG=true;
            $imgArr = explode("\n", $beach[9]);
            for($i=0; $i<8;$i++){
                curl_setopt($ch, CURLOPT_URL, $imgArr[$i]);
                    
                $img = curl_exec($ch);

                $src= "F:\ПляжиВидео\img\\" . $s . $i . ".jpg";
                file_put_contents($src, $img);
                try {
                    $image  ->fromFile($src)
                            ->resize(1280,720)
                            -> toFile($src,'image/jpeg');
                            
                } catch(Exception $err) {
                    $msg= $err->getMessage();
                    file_put_contents('errorBeach.txt', $j . ": " . $enBeach . "- ". $msg . PHP_EOL, FILE_APPEND);
                    
                    unlink($src);
                    $receiveIMG=false;
                    continue;
                }   
            }
            if($receiveIMG){
                $nameBeach = str_replace(" ", "+",$beach[0]);
                file_put_contents('receive_img.txt', $j . " " . $s . " $nameBeach" . PHP_EOL, FILE_APPEND);
            }
        
        }
                    
    }
    
    if($j>2) break;
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