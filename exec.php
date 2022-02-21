<?php
require_once __DIR__.'\SimpleXLSX.php';
require_once __DIR__.'\Voice.php';

if ( $xlsx = SimpleXLSX::parse('beach.xlsx')) {
    $beaches= $xlsx->rows();
} else {
    echo SimpleXLSX::parseError();
}
    
$filename = __DIR__ . '/receive_img.txt';
$arrayOfBeaches = file($filename);
$j=0;

// for zoom
$zoompanupto = 1.5;
$duration = 1;
$zoomdelta = ($zoompanupto - 1) / 25 / $duration;
$services[0] = '';$services[1]='';
$lengthArr = count($arrayOfBeaches);
$stream[0] = 0; $stream[1] = 12; $stream[2] = 13;
$pred[0] = ""; $pred[1]="[11v]";
$endOfstreamService = "";
$whCanvas = "200x200";
$position[0] = 40;
$position[1] = 200;
$cellSize = 64;
$transitionDuration = 0.5;
$timeOfVisService=0;
$voiceOfService = "Инфраструктура пляжа разнообразная. Здесь есть ";


while($j != $lengthArr){
    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    // echo $receiveBeach[2];
    $j++;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    $infrastructure = explode("\n", $infoBeach[5]);

    // var_dump($infrastructure);
    foreach($infrastructure as $srv){
        switch ("$srv") {
            case "Туалет": 
                $services[0] .= " -f lavfi -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0][$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$srv':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-20[x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                    $pred[0] = "[x0$stream[0]];";
                    $pred[1] = "[x0$stream[0]]";
                    

                    if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }

                    $stream[0] = $stream[0] +  1;
                    $stream[1] = $stream[1] +  2;
                    $stream[2] = $stream[2] +  2;
                    $timeOfVisService= $timeOfVisService + 20;

                    $voiceOfService .= " $srv.";
                break;

            case "Терминал оплаты": 
                
                $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Терминал':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-30,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='оплаты':fontcolor=blue:                                fontsize=20:x=(w-text_w)/2:y=h-th-10
                                [x$stream[1]t$stream[2]];
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";

                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }

                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                $timeOfVisService = $timeOfVisService + 20;

                $voiceOfService .= " $srv.";
                break;
            case "Парк": 
                $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$srv':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-20[x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";
                    
                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }

                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                
                $timeOfVisService= $timeOfVisService + 20;

                $voiceOfService .= " $srv.";
                break;
            case "Кабины для переодевания": 
                $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Кабины':fontcolor=blue:fontsize=20:x=(w-text_w)/2:y=h-th-40,
                            drawtext=fontfile=/Library/Fonts/Arial.ttf:text='для':fontcolor=blue:fontsize=20:x=(w-text_w)/2:y=h-th-20,
                            drawtext=fontfile=/Library/Fonts/Arial.ttf:text='переодевания':fontcolor=blue:fontsize=20:x=(w-text_w)/2:y=h-th
                                [x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";

                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }

                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                $timeOfVisService= $timeOfVisService + 20;

                $voiceOfService .= " $srv.";
                break;
            case "Пункт медицинской помощи":
                 $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Пункт':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-40,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='медицинской':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-20,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='помощи':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th
                                [x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";

                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }
                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                $timeOfVisService= $timeOfVisService + 20;

                $voiceOfService .= " $srv.";
                 break;
            case "Спасательная вышка": 
                 $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Спасательная':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-30,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='вышка':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-10
                                [x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";

                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }
                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                $timeOfVisService= $timeOfVisService + 20;
                
                $voiceOfService .= " $srv.";
             break;
            case "Бар": 
                $services[0] .= " -f lavfi  -i color=c=white:s=$whCanvas -loop 1 -i fly.png ";
                $services[1] .= " $pred[0] [$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Бар':fontcolor=blue:
                                fontsize=20:x=(w-text_w)/2:y=h-th-20[x$stream[1]t$stream[2]],
                            [x$stream[1]t$stream[2]]fade=t=in:$timeOfVisService:90:alpha=1[X$stream[1]];
                            $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                            $pred[0] =  "[x0$stream[0]];";
                            $pred[1] = "[x0$stream[0]]";
                $pred[0] =  "[x0$stream[0]];";
                $pred[1] = "[x0$stream[0]]";

                if($position[0] < 880)
                        $position[0] = $position[0] + 200;
                    else{
                        $position[0]=40;
                        $position[1] = 400;
                    }
                $stream[0] =$stream[0] +  1;
                $stream[1] =$stream[1] +  2;
                $stream[2] =$stream[2] +  2;
                $timeOfVisService= $timeOfVisService + 20;

                
                $voiceOfService .= " $srv.";
                 break;
            default: 
                echo "Ниxего не нашлось: $srv\n";
                break;
        }
    }

    // $time = $endOfstreamService + $stream[0]/2;

    if($stream[0] != 0){
        $endOfstreamService = "[endService]";
        $services[2] = "$services[1]$pred[1];";
        $services[3] = 21;
        $time = $stream[0] + 4.5;
        $pred[1] = "$pred[1]trim=0:$time $endOfstreamService;";

        voice($voiceOfService, "voiceService");
    }else {

        $services[2]=null;
        $pred[1]= null;
        $services[3] = 20;
        $endOfstreamService=null;
    }

    video($infoBeach,$receiveBeach[1], $zoompanupto, $zoomdelta, $services, $pred[1], $endOfstreamService, $cellSize, $transitionDuration, $time);
}
 

function video($infoBeach, $enBeach, $zoompanupto, $zoomdelta, $services,$pred, $endOfstreamService, $cellSize, $transitionDuration, $timeOfVisService){

    $infoBeach[4] = mb_strtolower($infoBeach[4]);
    echo "VIDEO $infoBeach[4] \n" ;

    switch($infoBeach[3]){
        case "Бетонные пляжи": $infoBeach[3]="бетонная";
            break;
        case "Галечные пляжи": $infoBeach[3]="галичная";
            break;
        case "Песчаные пляжи": $infoBeach[3]="песчаная";
            break;
        case "Песчано-галечные пляжи": $infoBeach[3]="песчано-галечная";
            break;
        case "Крупно-каменные пляжи": $infoBeach[3]="купно-каменная";
            break;
        case "Ракушечные пляжи": $infoBeach[3]="ракушечная";
            break;
        case "Земляные пляжи": $infoBeach[3]="земляная";
            break;
            }
        // voice("$infoBeach[0]","nameBeach");
        // voice("Месторасположение $infoBeach[1]", "placeBeach");
        // voice("Протяженность береговой линии примерно $infoBeach[2]", "length");
        // voice("Поверхность пляжа $infoBeach[3]","surface");
        // voice("Морское дно $infoBeach[4]", "bottom");
        // voiceService  уже готово
        
        $receiveBeach= "Добраться до пляжа можно на ";
            $l = 0;
            $receive = explode("\n", $infoBeach[7]);
            foreach($receive as $s){
                switch($s){
                    case "Автомобиль":
                        if($l == 0){
                            $receiveBeach .= "автомобиле ";
                            $l = $l +1;
                        }else 
                            $receiveBeach .= "и автомобиле";
                    

                        break;
                    case "Общественный транспорт":
                        if($l == 0){
                            $receiveBeach .= "общественом транспорте ";
                            $l = $l +1;
                        }else 
                            $receiveBeach .= "и общественом транспорте";
                        break;
                    default : $receiveBeach = "";
                }
            }
        // voice($receiveBeach, "receive");
        // voice("Посетители дают оценку $infoBeach[8]", "score");

    $comm = "ffmpeg  
        -loop 1 -t 2 -i img\\" . $enBeach . "0.jpg 
        -loop 1 -t 4 -i img\\" . $enBeach . "1.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "2.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "3.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "4.jpg

        -loop 1 -t 1 -i map\\" . $enBeach . "1.png
        -loop 1 -t 1 -i map\\" . $enBeach . "2.png
        -loop 1 -t 1 -i map\\" . $enBeach . "3.png

        -loop 1 -t 2 -i img\\" . $enBeach . "5.jpg
        -loop 1 -t 2 -i img\\" . $enBeach . "6.jpg 
        -loop 1 -t 2 -i img\\" . $enBeach . "7.jpg
        
        -f lavfi  -i color=c=white:s=1280x720

        $services[0] 

        -filter_complex 
        \"
        [0:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$infoBeach[0]':fontcolor=white:fontsize=30:x=200:y=250,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       $infoBeach[1]':fontcolor=white:fontsize=30:x=300:y=300,
        split[pre][pbv0];[pbv0]fifo[bv0]; 
        [pre]fade=t=in:st=0:d=1[v0]; 
        [1:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Длина береговой линии ':fontcolor=white:fontsize=30:x=200:y=250,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       $infoBeach[2]':fontcolor=white:fontsize=30:x=300:y=300,
        split=3[pbv1a][pbv1b][v1];[pbv1a]fifo[bv1a];[pbv1b]fifo[bv1b]; 
        [2:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Поверхность пляжа':fontcolor=white:fontsize=30:x=200:y=250,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       $infoBeach[3]':fontcolor=white:fontsize=30:x=300:y=300,
        split=3[pbv2a][pbv2b][v2];[pbv2a]fifo[bv2a];[pbv2b]fifo[bv2b];
        [3:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Морское дно':fontcolor=white:fontsize=30:x=200:y=250,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       $infoBeach[4]':fontcolor=white:fontsize=30:x=300:y=300,
        split=3[pbv3a][pbv3b][v3];[pbv3a]fifo[bv3a];[pbv3b]fifo[bv3b]; 
        [4:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Оценка поситителей':fontcolor=white:fontsize=30:x=200:y=250,
        drawtext=fontfile=/Library/Fonts/Arial.ttf:text='       $infoBeach[8]':fontcolor=white:fontsize=30:x=300:y=300,
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

        [bv9a][bv8b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[89v];
        [bv10a][bv9b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[910v];
        [bv4][bv10b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[104v]; 

        [11:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Инфраструктура пляжа':fontcolor=blue:fontsize=70:x=(w-tw)/2:y=40,
        split=3[bv11a][bv11b][11v];
        
        [bv11a][bv3b]blend=all_expr='if((lte(mod(X,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration)+lte(mod(Y,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration))+(gte(mod(X,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)+gte(mod(Y,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)),B,A)':shortest=1[v3v11];

        [bv8a][bv11b]blend=all_expr='if(gte(Y,H - H*T/0.5),A,B)':shortest=1[8v11v];

        $services[2]
        $pred

         [v0][0v1m][map1][map2][map3][3m1v][v1][12v][v2][23v][v3][v3v11] $endOfstreamService [8v11v] [v8][89v][v9][910v][v10][104v][v4]concat=n=$services[3],format=yuv420p[v] \" -map \"[v]\" -s \"1280x720\" -y video\\$enBeach.mp4";
        

    
    file_put_contents("coman.txt",$comm);
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    //  echo $text;
    exec($text);


    $time[0] = $timeOfVisService + 10  ;
    $time[1] = $timeOfVisService + 10 + 3; 

    $addVoice = "ffmpeg  -async 1 -i video\Yashmovyy+plyazh.mp4
        -itsoffset 00:00:01 -i voice\\nameBeach.ogg 
        -itsoffset 00:00:03 -i voice\\placeBeach.ogg 
        -itsoffset 00:00:06 -i voice\\length.ogg 
        -itsoffset 00:00:10 -i voice\\surface.ogg 
        -itsoffset 00:00:10 -i voice\bottom.ogg 

        -itsoffset 00:00:10 -i voice\\voiceService.ogg
        -itsoffset 00:00:10 -i voice\\receive.ogg
        -itsoffset 00:00:10 -i voice\score.ogg
        -f lavfi -t 1 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t 4 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        
        -f lavfi -t 7 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[0] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[1] -i anullsrc=channel_layout=stereo:sample_rate=44100 

        -filter_complex \"
            [9:a][4:a]concat=v=0:a=1 [addSilence1];
            [10:a][5:a]concat=v=0:a=1 [addSilence2];
            [11:a][6:a]concat=v=0:a=1 [addSilence3];
            [12:a][7:a]concat=v=0:a=1 [addSilence4];
            [13:a][8:a]concat=v=0:a=1 [addSilence5];

            [1][2][3][addSilence1][addSilence2][addSilence3][addSilence4][addSilence5]amix=inputs=8\" 
        -c:v copy -c:a aac  -y video\\test.mp4";


    

    $addBG = "ffmpeg  -i Hand.mp4 -i Yashmovyy+plyazh.mp4
              -filter_complex \"[0:v]alphaextract[alfa];[1:v][alfa]alphamerge\"                
              -y testBG.mp4";
    $text2= str_replace(array("\n\r","\r\n"), "", $addVoice);
    exec($text2);
    
        // unlink("$enBeach.mp4");
}