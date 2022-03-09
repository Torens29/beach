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
$lengthArr = count($arrayOfBeaches);
while($j != $lengthArr){

    
    // for zoom
    $zoompanupto = 1.1;
    $duration = 1;
    $zoomdelta = ($zoompanupto - 1) / 25 / $duration; //0.004
    $services[0] = '';$services[1]='';
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


    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    $j++;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    $infrastructure = explode("\n", $infoBeach[5]);

    foreach($infrastructure as $srv){
        switch ("$srv") {
            case "Туалет": 
                $services[0] .= " -f lavfi -i color=c=white:s=$whCanvas  -loop 1 -i fly.png ";
                $services[1] .= " $pred[0][$stream[2]:v]scale=150:-1[x$stream[2]],
                            [$stream[1]:v][x$stream[2]]overlay=(W-w)/2:0[x$stream[1]$stream[2]],
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$srv':fontcolor=#56b2df:
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Терминал':fontcolor=#56b2df:
                                fontsize=20:x=(w-text_w)/2:y=h-th-30,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='оплаты':fontcolor=#56b2df:                                fontsize=20:x=(w-text_w)/2:y=h-th-10
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='$srv':fontcolor=#56b2df:
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Кабины':fontcolor=#56b2df:fontsize=20:x=(w-text_w)/2:y=h-th-40,
                            drawtext=fontfile=/Library/Fonts/Arial.ttf:text='для':fontcolor=#56b2df:fontsize=20:x=(w-text_w)/2:y=h-th-20,
                            drawtext=fontfile=/Library/Fonts/Arial.ttf:text='переодевания':fontcolor=#56b2df:fontsize=20:x=(w-text_w)/2:y=h-th
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Пункт':fontcolor=#56b2df:
                                fontsize=20:x=(w-text_w)/2:y=h-th-40,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='медицинской':fontcolor=#56b2df:
                                fontsize=20:x=(w-text_w)/2:y=h-th-20,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='помощи':fontcolor=#56b2df:
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Спасательная':fontcolor=#56b2df:
                                fontsize=20:x=(w-text_w)/2:y=h-th-30,
                                drawtext=fontfile=/Library/Fonts/Arial.ttf:text='вышка':fontcolor=#56b2df:
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
                            [x$stream[1]$stream[2]]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Бар':fontcolor=#56b2df:
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


    if($stream[0] != 0){
        $endOfstreamService = "[v3v11][endService][8v11v]";
        $services[2] = "$services[1]$pred[1];";
        $services[3] = 19;
        $time = $stream[0] + 4.5;
        $pred[1] = "$pred[1]trim=0:$time [endService];";
        $stream11 = "
            [11:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Инфраструктура пляжа':fontcolor=#56b2df:fontsize=70:x=(w-tw)/2:y=40,
            split=3[bv11a][bv11b][11v];
            
            [bv11a][bv3b]blend=all_expr='if((lte(mod(X,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration)+lte(mod(Y,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration))+(gte(mod(X,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)+gte(mod(Y,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)),B,A)':shortest=1[v3v11];
            
            [bv8a][bv11b]blend=all_expr='if(gte(Y,H - H*T/0.5),A,B)':shortest=1,trim=0:0.2[8v11v];";


        voice($voiceOfService, "voiceService");
    }else {
        $stream11= "
        [bv8a][bv3b]blend=all_expr='if(gte(Y,H - H*T/0.5),A,B)':shortest=1,trim=0:0.2[3v8v];";
        $services[2]=null;
        $pred[1]= null;
        $services[3] = 16;
        $endOfstreamService="[3v8v]";
    }

    video($infoBeach,$receiveBeach[1], $zoompanupto, $zoomdelta, $services, $pred[1], $endOfstreamService, $cellSize, $transitionDuration, $time,$stream11, $arrayOfBeaches[$j-1]);
}
 

function video($infoBeach, $enBeach, $zoompanupto, $zoomdelta, $services,$pred, $endOfstreamService, $cellSize, $transitionDuration, $timeOfVisService, $stream11, $beach){

    if($infoBeach[4]==null){
        $infoBeach[4]="неизвестно";
    }else
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
        voice("$infoBeach[0]","nameBeach$enBeach");
        voice("Месторасположение $infoBeach[1]", "placeBeach$enBeach");
        voice("Протяженность береговой линии примерно $infoBeach[2]", "length$enBeach");
        voice("Поверхность пляжа $infoBeach[3]","surface$enBeach");
        voice("Морское дно $infoBeach[4]", "bottom$enBeach");
        // // voiceService  уже готово
        
        if($infoBeach[7] != null ){
            $receiveBeach= "Добраться до пляжа можно на ";
            $l = 0;
            $receive = explode("\n", $infoBeach[7]);
            foreach($receive as $s){
                switch($s){
                    case "Автомобиль":
                        if($l == 0){
                            $receiveBeach .= "автомобиле и общественом транспорте";
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
        }
        
        voice($receiveBeach, "receive$enBeach");
        voice("Посетители дают оценку $infoBeach[8]", "score$enBeach");

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

        -filter_complex \"
            [0:v]format=yuv444p,split[pr1][pbv0];
                [pr1]scale=iw*4:ih*4, zoompan=z=min(max(zoom\,pzoom)+($zoompanupto - 1) / 25 / 2\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[q1];
                [q1]drawtext=fontfile=Noah-Bold.ttf:text='$infoBeach[0]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=45:x=200+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[1]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=45:x=300-n/2:y=650[pre2];
                [pre2]fade=t=in:st=0:d=1[v0]; 

                [pbv0] zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[bv0];
                    
            [1:v]split=2[pbv1b][v1a];

                [v1a] scale=iw*4:ih*4,
                zoompan=z=1.4-(on/500): d=2: x='iw/2.5-(iw/zoom/2.5)': y='ih/2.5-(ih/zoom/2.5)':s=1280x720[we];
                    [we]drawtext=fontfile=Noah-Bold.ttf:text='Длина береговой линии':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=40:x=200+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[2]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=40:x=300-n/2:y=650[v1];

                    [pbv1b]zoompan=z=1:d=25:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)', 
                        drawtext=fontfile=Noah-Bold.ttf:text='Длина береговой линии ':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=40:x=200+25/2*4+n/2:y=600,
                        drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[2]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=40:x=300-25/2*4-n/2:y=650 [bv1b];
                
            [2:v]split=3[pbv2a][pbv2b][v2a];
                [pbv2a]zoompan=z=1.2:x='0':y='0':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+n/2:y=600,
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-n/2:y=650[bv2a];

                [v2a]format=yuv444p,zoompan=z=1.2:x='in':y='in':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+6+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-6-n/2:y=650[v2];

                [pbv2b]zoompan=z=1.2:d=1:x='50':y='50',
                    drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+6+50+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-6-50-n/2:y=650[bv2b];

            [3:v]split=3[pbv3a][pbv3b][v3a];
                [pbv3a]zoompan=z=1.2:x='ih/2-(ih/zoom)/2':y='0',
                drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+n/2:y=600,
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-n/2:y=650[bv3a];
                
                [v3a]format=yuv444p,zoompan=z=1.2:x='ih/2-(ih/zoom)/2':y='in':d=1:s=1280x720[q3];
                [q3]drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+6+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-6-n/2:y=650[v3];
                
                [pbv3b]zoompan=z=1.2:d=1:x='iw/2-(iw/zoom/2)':y='50',
                    drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+25+6+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=300-25-6-n/2:y=650[bv3b];

            [4:v] split[pbv4][v4a];
                [pbv4]zoompan=z=1.2:x='0':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Оценка поситителей':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+n/2:y=600,
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[8]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=350-n/2:y=650[bv4];

                [v4a]format=yuv444p,zoompan=z=1.2:x='in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Оценка поситителей':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=200+6+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[8]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=45:x=350-6-n/2:y=650[v4];

            [5]split=[bv1ma][m1];
                [m1]scale=iw*4:ih*4, zoompan=z='if(between(time,0,1), zoom+0.005+0.2,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:0[map1];
                [bv1ma] scale=iw*4:ih*4, zoompan=z='zoom+0.005':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [bv1m];


            [6]scale=iw*4:ih*4,
                zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:1.4[map2];


            [7]scale=iw*4:ih*4,zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2) ':s=1280x720,trim=0:1.4[map3];
            
            [8:v]split=3[bv8a][bv8ba][v8a];
                [v8a]scale=iw*4:ih*4, zoompan=z=min(max(zoom\,pzoom)+($zoompanupto - 1) / 25 / 2\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[v8];
                [bv8ba]zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[bv8b];

            [9:v]split=3[bv9a][bv9ba][v9a];
                [v9a]format=yuv444p,zoompan=z=1.2:x='in':y='ih/2-(ih/zoom/2)':d=1:s=1280x720[v9];
                [bv9ba]zoompan=z=1.2:d=1:x='0':y='ih/2-(ih/zoom/2)':s=1280x720[bv9b];


            [bv1m][bv0]blend=all_expr='if(gte(Y,H - H*T/0.1),A,B)':shortest=1[0v1m];
            
            [bv2a][bv1b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[12v]; 
            [bv3a][bv2b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[23v]; 

            [bv9a][bv8b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[89v];
            [bv4][bv9b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[94v];

            $stream11

            $services[2]
            $pred

            [v0][0v1m][map1][map2][map3][v1][12v][v2][23v][v3] $endOfstreamService [v8][89v][v9][94v][v4]concat=n=$services[3],
            format=yuv420p[v] 
        \"
        -map \"[v]\" -s \"1280x720\"  -y video\\$enBeach.mp4";
        

    
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    file_put_contents("coman.txt", $beach . "\n" . $text  . "\n" . PHP_EOL, FILE_APPEND);
    //  echo $text;
    exec($text);


    $time[0] = $timeOfVisService + 8;
    $time[1] = $timeOfVisService + 9 + 3; 

    $addVoice = "ffmpeg  -async 1 -i video\\$enBeach.mp4
        -itsoffset 00:00:01 -i voice\\nameBeach$enBeach.ogg 
        -itsoffset 00:00:03 -i voice\\placeBeach$enBeach.ogg 
        -itsoffset 00:00:07 -i voice\\length$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\\surface$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\bottom$enBeach.ogg 

        -itsoffset 00:00:10 -i voice\\voiceService$enBeach.ogg
        -itsoffset 00:00:10 -i voice\\receive$enBeach.ogg
        -itsoffset 00:00:10 -i voice\score$enBeach.ogg
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
        -c:v copy -c:a aac  -y video\\voice\\$enBeach.mp4";


    $text2= str_replace(array("\n\r","\r\n"), "", $addVoice);
    // exec($text2);
 
        // unlink("$enBeach.mp4");
}

$addBG = "ffmpeg   -i video\akerm.mp4 -i alpha.mov
    -filter_complex \"
                    [1]format=rgb24,colorkey=black,colorchannelmixer=aa=0.3,setpts=PTS+8/TB[1d];[0][1d]overlay=(main_w-overlay_w)/2:(main_h-overlay_h)/2:shortest=1
    \"                
   -y testBG.mp4";
    
    $text3= str_replace(array("\n\r","\r\n"), "", $addBG);
    // exec($text3);