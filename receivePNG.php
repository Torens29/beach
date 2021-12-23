<?php

include('SimpleImage.php');
error_reporting(E_ALL & ~E_NOTICE);

// $source = "https://back.plyazhi.ru/upload/iblock/152/152a86afbe9ebb8364a29324fa957376.jpg https://back.plyazhi.ru/upload/iblock/9ee/9eeba0e7b1f49dadf7341d8acc541603.jpg https://back.plyazhi.ru/upload/iblock/058/05886080d45a3b9b700393636f899b5d.jpg https://back.plyazhi.ru/upload/iblock/c8f/c8f5e35cd948ea2de93f34c6cfaa720f.jpg https://back.plyazhi.ru/upload/iblock/180/180b4ae3d9dc5389683604ffbcc58c27.jpg https://back.plyazhi.ru/upload/iblock/59e/59e90bf113c2e9d12de4c4d16ecf029d.jpg https://back.plyazhi.ru/upload/iblock/ff4/ff4641f6ee56ee1c417a43e5912c5998.jpg https://back.plyazhi.ru/upload/iblock/5cc/5ccb343ea9849d8cfaa38500eecd568d.jpg https://back.plyazhi.ru/upload/iblock/89a/89ae2259c54697a88de16b71c4a4875f.jpg https://back.plyazhi.ru/upload/iblock/153/153aaa9783ae4e09e1217000196a4b58.jpg https://back.plyazhi.ru/upload/iblock/dbc/dbcf322b942130dee6d569307322cd30.jpg https://back.plyazhi.ru/upload/iblock/c8a/c8a598d760401de26dfa2bd89b877c2d.jpg https://back.plyazhi.ru/upload/iblock/ca8/ca8fa6f9f7506db89eed93fae31c2092.jpg https://back.plyazhi.ru/upload/iblock/9b9/9b9580f687577492ea32157821de9a19.jpg https://back.plyazhi.ru/upload/iblock/726/726cb6284dbfbd1e35f55bfa5dd86510.jpg https://back.plyazhi.ru/upload/iblock/1bb/1bb17f96662a8c49a87ae42e8ecf024d.jpg https://back.plyazhi.ru/upload/iblock/eec/eec4e7dc7225da3bc0d0ac27eda6fa95.jpg https://back.plyazhi.ru/upload/iblock/e8b/e8b52b0916c4c8e0bc4833061fba861c.jpg https://back.plyazhi.ru/upload/iblock/eb0/eb02131a601b01ed4ae096239136e21a.jpg https://back.plyazhi.ru/upload/iblock/c89/c89b1ca7279abb4d3297368f5b19393c.jpg https://back.plyazhi.ru/upload/iblock/8e7/8e7cce7752b41dc808d4c3ea7176867a.jpg https://back.plyazhi.ru/upload/iblock/296/29694249778210624d77ff5699ca19ee.jpg https://back.plyazhi.ru/upload/iblock/165/165134d8037b6bce9d00155a5b0d9934.jpg https://back.plyazhi.ru/upload/iblock/f1e/f1e6bd46bc71490210520fd3c8caa4f7.jpg https://back.plyazhi.ru/upload/iblock/e32/e32a01c29481faef3b3a6e0502f86a14.jpg https://back.plyazhi.ru/upload/iblock/977/9778a83dbf0b54be8bf56671b677945a.jpg https://back.plyazhi.ru/upload/iblock/f69/f6992032c52277843810e3979677af4c.jpg https://back.plyazhi.ru/upload/iblock/171/1715bea70fcbf622dc98c37e4ed41236.jpg";
//   $imgArr = explode(" ", $source);
//   var_dump($imgArr[0]);
try {
    
    $image = new \claviska\SimpleImage();
    $image  ->fromFile("img\Yashmovyy+plyazh0.jpg")
            ->resize(1280,720)
            -> toFile("img\\test1.jpg",'image/jpeg');
} catch(Exception $err) {
    echo $err->getMessage();
}

 
