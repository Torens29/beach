<?php
require_once __DIR__.'\SimpleXLSX.php';

if ( $xlsx = SimpleXLSX::parse('beach.xlsx')) {
    $beaches= $xlsx->rows();
} else {
    echo SimpleXLSX::parseError();
}
    
$filename = __DIR__ . '/receive_img.txt';
$arrayOfBeaches = file($filename);
$j=0;

$lengthArr = count($arrayOfBeaches);

while($j != $lengthArr-1){
    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    // echo $receiveBeach[2];
    $j++;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    // var_dump($infoBeach);
    video($infoBeach,$receiveBeach[1]);
}
 

function video($infoBeach, $enBeach){
 
echo '<br> VIDEO ' . $infoBeach[0];

    //ДОБАВИТЬ 5 .JPG КАРТИНКУ+ 1 ПАТОК
    $comm = "ffmpeg  
        -loop 1 -t 6 -i img\\" . $enBeach . "0.jpg 
        -loop 1 -t 5 -i img\\" . $enBeach . "1.jpg 
        -loop 1 -t 5 -i img\\" . $enBeach . "2.jpg 
        -loop 1 -t 5 -i img\\" . $enBeach . "3.jpg 
        -loop 1 -t 5 -i img\\" . $enBeach . "4.jpg 
        -loop 1 -t 3 -i map\\" . $enBeach . "1.png
        -loop 1 -t 3 -i map\\" . $enBeach . "2.png
        -loop 1 -t 3 -i map\\" . $enBeach . "3.png
        -filter_complex 
        \"
        [0:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FIRST TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$infoBeach[0]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split[pre][pbv0];[pbv0]fifo[bv0]; 
        [pre]fade=t=in:st=0:d=1[v0]; 

        [1:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$infoBeach[2]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        split=3[pbv1a][pbv1b][v1];[pbv1a]fifo[bv1a];[pbv1b]fifo[bv1b]; 

        [2:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='THIRD TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        split=3[pbv2a][pbv2b][v2];[pbv2a]fifo[bv2a];[pbv2b]fifo[bv2b];

        [3:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FOURTH TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        split=3[pbv3a][pbv3b][v3];[pbv3a]fifo[bv3a];[pbv3b]fifo[bv3b]; 

        [4:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FIFTH TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        split[pbv4][v4];[pbv4]fifo[bv4]; 

        [5]zoompan=z='min(max(zoom,pzoom)+0.0015,1.5)':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[map1];
        [6]zoompan=z='min(max(zoom,pzoom)+0.0015,1.5)':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[map2];
        [7]zoompan=z='min(max(zoom,pzoom)+0.0015,1.5)':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[map3];
        
        [bv1a][bv0]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[01v]; 
        [bv2a][bv1b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[12v]; 
        [bv3a][bv2b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[23v]; 
        [bv4][bv3b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[34v]; 
        [map1][map2][map3][v0][01v][v1][12v][v2][23v][v3][34v][v4]concat=n=12,format=yuv420p[v]\" -map \"[v]\" -s \"1280x720\" -y $enBeach.mp4";
    
    
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    //  echo $text;
     exec($text);
    $addVoice = "ffmpeg -i $enBeach.mp4 -itsoffset 00:00:05 -i voice\\v1.ogg -map 0:v -map 1:a -y .\\video\\$infoBeach[0].mp4";
    exec($addVoice);
}
