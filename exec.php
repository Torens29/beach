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


$zoompanupto = 1.5;
$duration = 1;
$zoomdelta = ($zoompanupto - 1) / 25 / $duration;

$lengthArr = count($arrayOfBeaches);

while($j != $lengthArr){
    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    // echo $receiveBeach[2];
    $j++;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    $infrastructure = explode("\n", $infoBeach[5]);
    var_dump($infrastructure);

    $strInrast='';

    video($infoBeach,$receiveBeach[1],$zoompanupto,$zoomdelta);
}
 

function video($infoBeach, $enBeach, $zoompanupto, $zoomdelta){
 
echo '<br> VIDEO ' . $infoBeach[0];

    //ДОБАВИТЬ 5 .JPG КАРТИНКУ+ 1 ПАТОК
    $comm = "ffmpeg  
        -loop 1 -t 2 -i img\\" . $enBeach . "0.jpg 
        -loop 1 -t 3 -i img\\" . $enBeach . "1.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "2.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "3.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "4.jpg

        -loop 1 -t 1 -i map\\" . $enBeach . "1.png
        -loop 1 -t 1 -i map\\" . $enBeach . "2.png
        -loop 1 -t 1 -i map\\" . $enBeach . "3.png

        -loop 1 -t 2 -i img\\" . $enBeach . "5.jpg
        -loop 1 -t 2 -i img\\" . $enBeach . "6.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "7.jpg   

        -filter_complex 
        \"
        [0:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$infoBeach[0]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       в $infoBeach[1]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split[pre][pbv0];[pbv0]fifo[bv0]; 
        [pre]fade=t=in:st=0:d=1[v0]; 
        [1:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Длина береговой линии $infoBeach[2]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       в $infoBeach[2]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split=3[pbv1a][pbv1b][v1];[pbv1a]fifo[bv1a];[pbv1b]fifo[bv1b]; 
        [2:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Поверхность пляжа':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       в $infoBeach[3]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split=3[pbv2a][pbv2b][v2];[pbv2a]fifo[bv2a];[pbv2b]fifo[bv2b];
        [3:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Морское дно':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       в $infoBeach[4]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split=3[pbv3a][pbv3b][v3];[pbv3a]fifo[bv3a];[pbv3b]fifo[bv3b]; 
        [4:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Оценка поситителей':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       в $infoBeach[8]':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,
        split[pbv4][v4];[pbv4]fifo[bv4]; 

        [5]split[bv1m][m1],[m1] zoompan=z=min(max(zoom\,pzoom)+$zoomdelta\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [map1];
        [6]zoompan=z=min(max(zoom\,pzoom)+$zoomdelta\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [map2];
        [7]split[bv3m][m3], [m3]zoompan=z=min(max(zoom\,pzoom)+$zoomdelta\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [map3];
        
        [8:v]split=3[bv8a][bv8b][v8];
        [9:v]split=3[bv9a][bv9b][v9];
        [10:v]split=3[bv10a][bv10b][v10];
        
        [bv1m][bv0]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[0v1m];
        [bv1a][bv3m]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[3m1v]; 
        [bv2a][bv1b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[12v]; 
        [bv3a][bv2b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[23v]; 
        [bv8a][bv3b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[38v];
        [bv9a][bv8b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[89v];
        [bv10a][bv9b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[910v];
        [bv4][bv10b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[104v]; 
        [v0][0v1m][map1][map2][map3][3m1v][v1][12v][v2][23v][v3][38v][v8][89v][v9][910v][v10][104v][v4]concat=n=19,format=yuv420p[v]\" -map \"[v]\" -s \"1280x720\" -y $enBeach.mp4";
    
    
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    //  echo $text;
    exec($text);
    
    $addVoice = "ffmpeg  -async 1 -i video\Yashmovyy+plyazh.mp4
        -itsoffset 00:00:01 -i voice\\nameBeach.ogg 
        -itsoffset 00:00:04 -i voice\\placeBeach.ogg 
        -itsoffset 00:00:07 -i voice\\length.ogg 
        -itsoffset 00:00:10 -i voice\\surface.ogg 
        -itsoffset 00:00:10 -i voice\bottom.ogg 
        -itsoffset 00:00:10 -i voice\\receive.ogg
        -itsoffset 00:00:10 -i voice\score.ogg
        -f lavfi -t 4 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t 7 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t 14 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t 1 -i anullsrc=channel_layout=stereo:sample_rate=44100 

        -filter_complex \"
            [8:a][5:a]concat=v=0:a=1 [addSilence1],
            [9:a][6:a]concat=v=0:a=1 [addSilence2],
            [10:a][7:a]concat=v=0:a=1 [addSilence3],
            [11:a][4:a]concat=v=0:a=1 [addSilence4],
            
            [0][1][2][3][addSilence4][addSilence1][addSilence2][addSilence3]amix=inputs=8\" 
        -c:v copy -c:a aac  -y test.mp4";


    
        $text2= str_replace(array("\n\r","\r\n"), "", $addVoice);
        // exec($text2);
    // unlink("$enBeach.mp4");
}