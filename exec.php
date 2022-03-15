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
   $time = 0;
    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    $j++;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    $infrastructure = explode("\n", $infoBeach[5]);
    

                
    
    foreach($infrastructure as $srv){
        switch ("$srv") {
            case "dТуалет": 
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

            case "dТерминал оплаты": 
                
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
            case "dПарк": 
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
            case "dКабины для переодевания": 
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
            case "dПункт медицинской помощи":
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
            case "dСпасательная вышка": 
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
            case "dБар": 
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
         if($infoBeach[4] != null){//
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]split=3[pbv3a][pbv3b][v3a];
                    [pbv3a]zoompan=z=1.2:x='iw/2-(iw/zoom)/2':y='0',split=3[a3a][a3b][a3c];
                
                [v3a]format=yuv444p,zoompan=z=1.2:x='iw/2-(iw/zoom)/2':y='in':d=1:s=1280x720[q3];
                [q3]drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600:alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650:alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
                [pbv3b]zoompan=z=1.2:d=1:x='iw/2-(iw/zoom/2)':y='50'[bv3b];
                    
                [bv2b]split[2a][2b];

                    [2a][a3a]blend=all_opacity = 0.5,split=3[2x3a][2x3b][2x3c]; 
                        [2b][2x3a]xfade=transition=vdslice:duration=1[a2x3];
                        [a2x3][2x3b]xfade=transition=hrslice:duration=1,trim=0:1[an2x3a];

                        [2x3c][a3b]xfade=transition=vdslice:duration=1[b2x3];
                        [b2x3][a3c]xfade=transition=hrslice:duration=1,trim=0:1[an2x3b];";

            $v3[1]="[an2x3a][an2x3b][v3][vXv11]";
            $v3[2]="[bv3b]";
            $services[3] = 20;
        }else{
            $v3[0]=null;
            $v3[1]="[vXv11]";
            $v3[2]="[bv2b]";
            $services[3] = 18;            
        }
        $endOfstreamService = "$v3[1][endService][8v11v]";
        $services[2] = "$services[1]$pred[1];";
        
        $time = $stream[0] + 4.5;
        $pred[1] = "$pred[1]trim=0:$time [endService];";
        $stream11 = "
            [11:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Инфраструктура пляжа':fontcolor=#56b2df:fontsize=70:x=(w-tw)/2:y=40,
            split=3[bv11a][bv11b][11v];
            
            [bv11a]$v3[2]blend=all_expr='if((lte(mod(X,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration)+lte(mod(Y,$cellSize),$cellSize/2-($cellSize/2)*T/$transitionDuration))+(gte(mod(X,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)+gte(mod(Y,$cellSize),($cellSize/2)+($cellSize/2)*T/$transitionDuration)),B,A)':shortest=1[vXv11];
            
            [bv8a][bv11b]blend=all_expr='if(gte(Y,H - H*T/0.5),A,B)':shortest=1,trim=0:0.2[8v11v];";


        voice($voiceOfService, "voiceService$receiveBeach[1]");
    }else {
        if($infoBeach[4] != null){
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]split=3[pbv3a][pbv3b][v3a];
                    [pbv3a]zoompan=z=1.2:x='iw/2-(iw/zoom)/2':y='0',split=3[a3a][a3b][a3c];
                
                [v3a]format=yuv444p,zoompan=z=1.2:x='iw/2-(iw/zoom)/2':y='in':d=1:s=1280x720[q3];
                [q3]drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/        2:y=600
                :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650:alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
                [pbv3b]zoompan=z=1.2:d=1:x='iw/2-(iw/zoom/2)':y='50',split[3a][3b];
                    
                    [2a][a3a]blend=all_opacity = 0.5,split=3[2x3a][2x3b][2x3c]; 

                    [bv2b]split[2a][2b];
                        [2b][2x3a]xfade=transition=vdslice:duration=1[a2x3];
                        [a2x3][2x3b]xfade=transition=hrslice:duration=1,trim=0:1[an2x3a];

                        [2x3c][a3b]xfade=transition=vdslice:duration=1[b2x3];
                        [b2x3][a3c]xfade=transition=hrslice:duration=1,trim=0:1[an2x3b];";
            $v3[1]="[an2x3a][an2x3b][v3]";
            $services[3] = 18;
            $stream11= "
                        [bv8a]split=3[a8a][a8b][a8c];
                        [3a][a8a]blend=all_opacity = 0.5,split=3[3x8a][3x8b][3x8c]; 

                            [3b][3x8a]xfade=transition=vdslice:duration=1[a3x8];
                            [a3x8][3x8b]xfade=transition=hrslice:duration=1,trim=0:1[an3x8a];

                            [3x8c][a8b]xfade=transition=vdslice:duration=1[b3x8];
                            [b3x8][a8c]xfade=transition=hrslice:duration=1,trim=0:1[an3x8b];";
            $endOfstreamService="$v3[1][an3x8a][an3x8b]";
        }else{
            $v3[0]=null;
            $v3[1]=null;
            $v3[2]="[bv2b]";
            $services[3] = 16;   
            $stream11= "[bv2b]split[2a][2b];
                        [bv8a]split=3[a8a][a8b][a8c];
                        [2a][a8a]blend=all_opacity = 0.5,split=3[2x8a][2x8b][2x8c]; 

                            [2b][2x8a]xfade=transition=vdslice:duration=1[a2x8];
                            [a2x8][2x8b]xfade=transition=hrslice:duration=1,trim=0:1[an2x8a];

                            [2x8c][a8b]xfade=transition=vdslice:duration=1[b2x8];
                            [b2x8][a8c]xfade=transition=hrslice:duration=1,trim=0:1[an2x8b];";        
                        $endOfstreamService="[2v8v]"; 
        }

        voice("", "voiceService$receiveBeach[1]");
        $services[2]=null;
        $pred[1]= null;
    }

    video($infoBeach,$receiveBeach[1], $zoompanupto, $zoomdelta, $services, $pred[1], $endOfstreamService, $cellSize, $transitionDuration, $time,$stream11, $arrayOfBeaches[$j-1],$v3);
}
 

function video($infoBeach, $enBeach, $zoompanupto, $zoomdelta, $services, $pred, $endOfstreamService, $cellSize, $transitionDuration, $timeOfVisService, $stream11, $beach, $v3){
    
    switch ($infoBeach[3]) {
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
    voice("$infoBeach[0]", "nameBeach$enBeach");
    voice("Месторасположение $infoBeach[1]", "placeBeach$enBeach");
    voice("Протяженность береговой линии примерно $infoBeach[2]", "length$enBeach");
    voice("Поверхность пляжа $infoBeach[3]", "surface$enBeach");
    voice("Морское дно $infoBeach[4]", "bottom$enBeach");
    // // voiceService  уже готово
        
        
    $receiveBeach= "Добраться до пляжа можно на ";
    $l = 0;
    $receive = explode("\n", $infoBeach[7]);
    foreach ($receive as $s) {
        switch ($s) {
            case "Автомобиль":
                if ($l == 0) {
                    $receiveBeach .= "автомобиле и общественом транспорте";
                    $l = $l +1;
                } else {
                    $receiveBeach .= "и автомобиле";
                }
                break;
            case "Общественный транспорт":
                if ($l == 0) {
                    $receiveBeach .= "общественом транспорте ";
                    $l = $l +1;
                } else {
                    $receiveBeach .= "и общественом транспорте";
                }
                break;
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
                [q1]drawtext=fontfile=Noah-Bold.ttf:text='$infoBeach[0]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.7),(t-0.6)/0.1,if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=200+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[1]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=300-n/2:y=650[pre2];
                [pre2]fade=t=in:st=0:d=1[v0]; 

                [pbv0] zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[bv0];
                    
            [1:v]split=2[pbv1b][v1a];

                [v1a] scale=iw*4:ih*4,
                    zoompan=z=1.2-(on/500): d=2: x='iw/2.5-(iw/zoom/2.5)': y='ih/2.5-(ih/zoom/2.5)':s=1280x720[we];
                    [we]drawtext=fontfile=Noah-Bold.ttf:text='Длина береговой линии':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.8),(t-0.7)/0.1,if(lt(t,3.3),1,if(lt(t,3.9),(1-(t-3.3)),0))))'
                    :fontsize=50:x=200+n/2:y=600,

                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[2]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.8),(t-0.7)/0.1,if(lt(t,3.3),1,if(lt(t,3.9),(1-(t-3.3)) ,0))))'
                    :fontsize=50:x=300-n/2:y=650,trim=0:4[v1];

                [pbv1b]zoompan=z=1:d=25:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)', 
                        split[1a][1b];
                
            

            [2:v]split=3[pbv2a][pbv2b][v2a];
                [pbv2a]zoompan=z=1.2:x='0':y='0':d=1:s=1280x720,split=3[a2a][a2b][a2c];

                [v2a]format=yuv444p,zoompan=z=1.2:x='in':y='in':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v2];

                [pbv2b]zoompan=z=1.2:d=1:x='50':y='50'[bv2b];

           

            $v3[0]
            [4:v] split=3[pbv4a][v4a][bv4ba];
                [pbv4a]zoompan=z=1.2:x='0':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,split=3[a4a][a4b][a4c];

                [v4a]format=yuv444p,zoompan=z=1.2:x='in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Оценка поситителей':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[8]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=350-6-n/2:y=650
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t-0.4),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v4];

                [bv4ba]format=yuv444p,zoompan=z=1.2:x='50':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,split[4a][4b];

            [5]split=[bv1ma][m1];
                [m1]scale=iw*4:ih*4, zoompan=z='if(between(time,0,1), zoom+0.005+0.2,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:0[map1];
                [bv1ma] scale=iw*4:ih*4, zoompan=z='zoom+0.005':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [bv1m];


            [6]scale=iw*4:ih*4,
                zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:1.4[map2];


            [7]scale=iw*4:ih*4,zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2) ':s=1280x720,trim=0:1.4[map3];
            
            [8:v]split=3[bv8a][bv8ba][v8a];
                [v8a]scale=iw*4:ih*4, zoompan=z=min(max(zoom\,pzoom)+($zoompanupto - 1) / 25 / 2\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[v8];
                [bv8ba]zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,split[8a][8b];

            [9:v]split=3[bv9aa][bv9baa][v9a];
                [bv9aa]zoompan=z=1.2:x='0':y='0':d=1:s=1280x720,split=3[a9a][a9b][a9c];
                [v9a]format=yuv444p,zoompan=z=1.2:x='in':y='in':d=1:s=1280x720[v9];
                [bv9baa]zoompan=z=1.2:d=1.2:x='50':y='50':s=1280x720,split[9a][9b];

            [10:v]split[bv10aa][v10a];
                [bv10aa]zoompan=z=1.2:x='iw/2-(iw/zoom/2)':y='0':d=1:s=1280x720,split=3[a10a][a10b][a10c];
                [v10a]format=yuv444p,zoompan=z=1.2:x='iw/2-(iw/zoom/2)':y='in':d=1:s=1280x720[v10];

            [bv1m][bv0]blend=all_expr='if(gte(Y,H - H*T/0.1),A,B)':shortest=1[0v1m];
            
            [1a][a2a]blend=all_opacity = 0.5,split=3[1x2a][1x2b][1x2c]; 
                [1b][1x2a]xfade=transition=vdslice:duration=1[a1x2];
                [a1x2][1x2b]xfade=transition=hrslice:duration=1,trim=0:1[an1x2a];

                [1x2c][a2b]xfade=transition=vdslice:duration=1[b1x2];
                [b1x2][a2c]xfade=transition=hrslice:duration=1,trim=0:1[an1x2b];
            
            
            
            [8a][a9a]blend=all_opacity = 0.5,split=3[8x9a][8x9b][8x9c]; 

                [8b][8x9a]xfade=transition=vdslice:duration=1[a8x9];
                [a8x9][8x9b]xfade=transition=hrslice:duration=1,trim=0:1[an8x9a];

                [8x9c][a9b]xfade=transition=vdslice:duration=1[b8x9];
                [b8x9][a9c]xfade=transition=hrslice:duration=1,trim=0:1[an8x9b];
            
            
            [9a][a4a]blend=all_opacity = 0.5,split=3[9x4a][9x4b][9x4c]; 

                [9b][9x4a]xfade=transition=vdslice:duration=1[a9x4];
                [a9x4][9x4b]xfade=transition=hrslice:duration=1,trim=0:1[an9x4a];

                [9x4c][a4b]xfade=transition=vdslice:duration=1[b9x4];
                [b9x4][a4c]xfade=transition=hrslice:duration=1,trim=0:1[an9x4b];

            [4a][a10a]blend=all_opacity = 0.5,split=3[4x10a][4x10b][4x10c]; 

                [4b][4x10a]xfade=transition=vdslice:duration=1[a4x10];
                [a4x10][4x10b]xfade=transition=hrslice:duration=1,trim=0:1[an4x10a];

                [4x10c][a10b]xfade=transition=vdslice:duration=1[b4x10];
                [b4x10][a10c]xfade=transition=hrslice:duration=1,trim=0:1[an4x10b];

            

            $stream11

            $services[2]
            $pred

            [v0][0v1m][map1][map2][map3][v1][an1x2a][an1x2b][v2] $endOfstreamService [v8][an8x9a][an8x9b][v9][an9x4a][an9x4b][v4][an4x10a][an4x10b][v10]concat=n=24,
            format=yuv420p[v] 
        \"
         -map \"[v]\" -s \"1280x720\"  -y Anim.mp4";
        
                // video\\$enBeach
                // [bv10ba]zoompan=z=1.2:d=1.2:x='iw/2-(iw/zoom/2)':y='50':s=1280x720[bv10b];
    
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    file_put_contents("coman.txt", $beach . "\n" . $text  . "\n" . PHP_EOL, FILE_APPEND);
    //  echo $text;
    exec($text);
   

    $time=[];
    $vService=[];
    $countStream=6;
    
    if($timeOfVisService == 0){
        $vService[0] = null;
        $vService[1] = null;
        $vService[2]=null;
        $time[0]= 4 + 2+1;
        $time[1]=  4+2+2 + 3;
    } 
    else{
        $vService[0] = "[13:a][6:a]concat=v=0:a=1[addSilence3];";
        $vService[1] = "[addSilence3]";
        $time[2]= '7';
        $vService[2] = "-f lavfi -t $time[2] -i anullsrc=channel_layout=stereo:sample_rate=44100";
        
        $time[0] = $timeOfVisService + (int)$time[2] + 2;
        $time[1] = $timeOfVisService + (int)$time[2] + 3 + 3; 
        $countStream++;
    }

    if($infoBeach[4] != null){
        $voiceOfBot[0]='[12:a][5:a]concat=v=0:a=1 [addSilence2];';
        $voiceOfBot[1]='[addSilence2]';
        $voiceOfBot[2]="-f lavfi -t 4 -i anullsrc=channel_layout=stereo:sample_rate=44100 ";
        
        $countStream++;
    }else{
        $voiceOfBot[0]=null;
        $voiceOfBot[1]=null;
        $voiceOfBot[2]=null;
        $time[2]="4";
        $time[0] = $timeOfVisService + (int)$time[2] ;
        $time[1] = $timeOfVisService + (int)$time[2]  + 3+2;
        $vService[2] = "-f lavfi -t $time[2] -i anullsrc=channel_layout=stereo:sample_rate=44100";
    }

    $addVoice = "ffmpeg  -async 1 -i video\\$enBeach.mp4
        -itsoffset 00:00:01 -i voice\\nameBeach$enBeach.ogg 
        -itsoffset 00:00:04 -i voice\\placeBeach$enBeach.ogg 
        -itsoffset 00:00:07 -i voice\\length$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\\surface$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\bottom$enBeach.ogg 

        -itsoffset 00:00:10 -i voice\\voiceService$enBeach.ogg
        -itsoffset 00:00:10 -i voice\\receive$enBeach.ogg
        -itsoffset 00:00:10 -i voice\score$enBeach.ogg
        -f lavfi -t 1 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        
        -f lavfi -t $time[0] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[1] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        $voiceOfBot[2]
        $vService[2]
        

        -filter_complex \"
            [9:a][4:a]concat=v=0:a=1 [addSilence1];
            $voiceOfBot[0]
            $vService[0]
            [10:a][7:a]concat=v=0:a=1 [addSilence4];
            [11:a][8:a]concat=v=0:a=1 [addSilence5];

            [1][2][3][addSilence1]$voiceOfBot[1]$vService[1][addSilence4][addSilence5]amix=inputs=$countStream\" 
        -c:v copy -c:a aac  -y video\\voice\\1$enBeach.mp4";


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