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
    $stream[0] = 0; $stream[1] = 14;
    $pred[0] = ""; $pred[1]="[13v]";
    $endOfstreamService = "";
    $whCanvas = "200x200";
    $position[0] = -550;
    $position[1] = 25;
    $cellSize = 64;
    $transitionDuration = 0.5;
    $timeOfVisService=2;
    $voiceOfService = "Инфраструктура пляжа разнообразная. Здесь есть ";
   $time = 0;
    $receiveBeach =  explode(" ", $arrayOfBeaches[$j]);
    $j++;
    $upDown=true;

    $infoBeach = $beaches[$receiveBeach[0]-1]; // info of the beach
    $infrastructure =  array_unique(explode("\n", $infoBeach[5]));;
    

//инфраструктура     
    $counServ=0;
    foreach($infrastructure as $srv){
        if($counServ <= 14){
            switch ("$srv") {
                case "Туалет": 
                    $services[0] .= " -i mat\Иконки\\$srv.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                case "Терминал оплаты": 
                    
                    $services[0] .= " -i mat\Иконки\Терминал.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case "Парк": 
                    $services[0] .= " -i mat\Иконки\\$srv.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                case "Кабины для переодевания": 
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                case "Пункт медицинской помощи":
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                case "Спасательная вышка": 
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                case "Бар": 
                    $services[0] .= " -i mat\Иконки\\$srv.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                

                case "Душевые кабины" :
                        $ser =str_replace(" ", "_", $srv);
                        $services[0] .= " -i mat\Иконки\\$ser.mov ";
                        $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                    $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                    $pred[0] = "[x0$stream[0]];";
                                    $pred[1] = "[x0$stream[0]]";

                        if($position[0] < 380){
                            $position[0] = $position[0] + 175;
                            if($upDown){
                                $position[1] = $position[1]-75;
                                $upDown=false;
                            }else {
                                $position[1] = $position[1]+75;
                                $upDown=true;
                            }
                        }
                        else{
                            $position[0]=-550;
                            $position[1] = 275;
                        }

                        $stream[0] =$stream[0] +  1;
                        $stream[1] =$stream[1] +  1;
                        $timeOfVisService = $timeOfVisService + 0.5;

                        $voiceOfService .= " $srv.";
                        break;
                case 'Кафе'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Банкомат'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Гостиница'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Аттракционы'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Ресторан'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Место для курения ' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Спортплощадка'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\Спорт_площадка.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Камера хранения'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Санаторий'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Гостевой дом'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Бассейн' :
                        $ser =str_replace(" ", "_", $srv);
                        $services[0] .= " -i mat\Иконки\\$ser.mov ";
                        $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                    $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                    $pred[0] = "[x0$stream[0]];";
                                    $pred[1] = "[x0$stream[0]]";

                        if($position[0] < 380){
                            $position[0] = $position[0] + 175;
                            if($upDown){
                                $position[1] = $position[1]-75;
                                $upDown=false;
                            }else {
                                $position[1] = $position[1]+75;
                                $upDown=true;
                            }
                        }
                        else{
                            $position[0]=-550;
                            $position[1] = 275;
                        }

                        $stream[0] =$stream[0] +  1;
                        $stream[1] =$stream[1] +  1;
                        $timeOfVisService = $timeOfVisService + 0.5;

                        $voiceOfService .= " $srv.";
                        break;
                case 'Пандус' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Глэмпинг'  :
                        $ser =str_replace(" ", "_", $srv);
                        $services[0] .= " -i mat\Иконки\\$ser.mov ";
                        $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                    $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                    $pred[0] = "[x0$stream[0]];";
                                    $pred[1] = "[x0$stream[0]]";

                        if($position[0] < 380){
                            $position[0] = $position[0] + 175;
                            if($upDown){
                                $position[1] = $position[1]-75;
                                $upDown=false;
                            }else {
                                $position[1] = $position[1]+75;
                                $upDown=true;
                            }
                        }
                        else{
                            $position[0]=-550;
                            $position[1] = 275;
                        }

                        $stream[0] =$stream[0] +  1;
                        $stream[1] =$stream[1] +  1;
                        $timeOfVisService = $timeOfVisService + 0.5;

                        $voiceOfService .= " $srv.";
                        break;
                case 'Детский лагерь'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Пляж'  :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Место для купания детей' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                
                case 'Шезлонги' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Пляжные зонтики' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Пляжные полотенца' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Инвентарь для активного отдыха' :
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;
                case 'Инвентарь для плавания':
                    $ser =str_replace(" ", "_", $srv);
                    $services[0] .= " -i mat\Иконки\\$ser.mov ";
                    $services[1] .= " $pred[0] [$stream[1]:v]scale=1280:-1,fade=t=in:st=$timeOfVisService:alpha=1[X$stream[1]];
                                $pred[1][X$stream[1]]overlay=$position[0]:$position[1]";

                                $pred[0] = "[x0$stream[0]];";
                                $pred[1] = "[x0$stream[0]]";

                    if($position[0] < 380){
                        $position[0] = $position[0] + 175;
                        if($upDown){
                            $position[1] = $position[1]-75;
                            $upDown=false;
                        }else {
                            $position[1] = $position[1]+75;
                            $upDown=true;
                        }
                    }
                    else{
                        $position[0]=-550;
                        $position[1] = 275;
                    }

                    $stream[0] =$stream[0] +  1;
                    $stream[1] =$stream[1] +  1;
                    $timeOfVisService = $timeOfVisService + 0.5;

                    $voiceOfService .= " $srv.";
                    break;

                default: 
                    echo "Ниxего не нашлось: $srv\n";
                    break;
            }
        }else break;
    }
    
        
//вариации
    if($stream[0] != 0){//
        if(false){//$infoBeach[4] != null
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]split=4[pbv3a][pbv3b][v3a][pbv3aa];
                    [pbv3a]zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='in':d=2[a3a];
                    [pbv3aa]zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='12+in':d=2,split=3[a3d][a3b][a3c];
                
                [v3a]zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='25+in':d=2:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600 :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650 :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
                [pbv3b]zoompan=z=1.25:x='iw/2-(iw/zoom/2)':y='75+in':d=2[bv3b];
                
                [bv2b]split[b2a][b2b];
                    [b2a]zoompan=z='zoom + 0.15 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720,split[2a][2b];
                    [b2b]zoompan=z='zoom + 0.2 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[2av];
    
                [2av][a3d]blend=all_opacity = 0.5[2x3c];
                    [2a][a3a]blend=all_opacity = 0.5,split[2x3a][2x3b]; 
                       
                        [2b][2x3a]xfade=transition=vdslice:duration=1[a2x3];
                        [a2x3][2x3b]xfade=transition=hrslice:duration=1,trim=0:1[an2x3a];
    
                        [2x3c][a3b]xfade=transition=vdslice:duration=1[b2x3];
                        [b2x3][a3c]xfade=transition=hrslice:duration=1,trim=0:1[an2x3b];";

            $v3[1]="[an2x3a][an2x3b][v3]";
            $v3[2]="[bv3b]";
            $services[3] = 26;
        }else{
            $v3[0]="[bv2b]zoompan=z='zoom + 0.15 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[v2b];";
        

            $v3[1]="";
            $v3[2]="[v2b]";
            $services[3] = 23;            
        }
        $endOfstreamService = "$v3[1][endService][8v13v]";
        $services[2] = "$services[1]$pred[1];";
        
        $time = $stream[0] + 6.5;
        $pred[1] = "$pred[1]trim=0:$time [endService];";
        $stream11 = "
            $v3[2][13]overlay=0:0[13v];
            color=white:s=1280x720:d=25[canvas1];
            [canvas1][bv8a]xfade=transition=hblur:duration=1,trim=0:1[8v13v];";


        voice($voiceOfService, "voiceService$receiveBeach[1]");
    }else {
         if($infoBeach[4] != null){//
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]split=4[pbv3a][pbv3b][v3a][pbv3aa];
                    [pbv3a]zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='in':d=1[a3a];
                    [pbv3aa]zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='25+in':d=1,split=3[a3b][a3c][a3d];

                [v3a]format=yuv444p,zoompan=z=1.25:x='iw/2-(iw/zoom)/2':y='50+in':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650:alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
                [pbv3b]split[b3a][b3b];
                    [b3a]zoompan=z=1.25:d=1:x='iw/2-(iw/zoom/2)':y='100+in',split[3a][3b];
                    [b3b]zoompan=z=1.25:d=1:x='iw/2-(iw/zoom/2)':y='125+in'[3av];
                    
                [bv2b]split[b2a][b2b];
                    [b2a]zoompan=z='zoom + 0.15 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720,split[2a][2b];
                    [b2b]zoompan=z='zoom + 0.2 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[2av];
            

                [2av][a3d]blend=all_opacity = 0.5[2x3c];
                [2a][a3a]blend=all_opacity = 0.5,split[2x3a][2x3b]; 
                   
                    [2b][2x3a]xfade=transition=vdslice:duration=1[a2x3];
                    [a2x3][2x3b]xfade=transition=hrslice:duration=1,trim=0:1[an2x3a];

                    [2x3c][a3b]xfade=transition=vdslice:duration=1[b2x3];
                    [b2x3][a3c]xfade=transition=hrslice:duration=1,trim=0:1[an2x3b];";
            $v3[1]="[an2x3a][an2x3b][v3]";
            $services[3] = 26;
            $stream11= "
                        [bv8a]split[a8aa][a8bc];
                            [a8aa]scale=iw*4:ih*4, zoompan=z='1+in/1000':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[a8a];
                            [a8bc]scale=iw*4:ih*4, zoompan=z='1+0.025+in/1000':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,split=3[a8d][a8b][a8c];
                            
                            [3av][a8d]blend=all_opacity = 0.5[3x8c]; 
                            [3a][a8a]blend=all_opacity = 0.5,split[3x8a][3x8b];

                            [3b][3x8a]xfade=transition=vdslice:duration=1[a3x8];
                            [a3x8][3x8b]xfade=transition=hrslice:duration=1,trim=0:1[an3x8a];

                            [3x8c][a8b]xfade=transition=vdslice:duration=1[b3x8];
                            [b3x8][a8c]xfade=transition=hrslice:duration=1,trim=0:1[an3x8b];";
            $endOfstreamService="$v3[1][an3x8a][an3x8b]";
        }else{
            $v3[0]=null;
            $v3[1]=null;
            $v3[2]="[bv2b]";
            $services[3] = 23;   
            $stream11= "[bv2b]split[b2a][b2b];
                            [b2a]zoompan=z='zoom + 0.15 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720,split[2a][2b];
                            [b2b]zoompan=z='zoom + 0.2 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[2av];
                        
                        [bv8a]split[a8aa][a8bc];
                            [a8aa]scale=iw*4:ih*4, zoompan=z='1+in/1000':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[a8a];
                            [a8bc]scale=iw*4:ih*4, zoompan=z='1+0.025+in/1000':d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,split=3[a8d][a8b][a8c];

                        [2av][a8d]blend=all_opacity = 0.5[2x8c]; 
                        [2a][a8a]blend=all_opacity = 0.5,split[2x8a][2x8b];

                            [2b][2x8a]xfade=transition=vdslice:duration=1[a2x8];
                            [a2x8][2x8b]xfade=transition=hrslice:duration=1,trim=0:1[an2x8a];

                            [2x8c][a8b]xfade=transition=vdslice:duration=1[b2x8];
                            [b2x8][a8c]xfade=transition=hrslice:duration=1,trim=0:1[an2x8b];";        
                        $endOfstreamService="[an2x8a][an2x8b]"; 
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
            
            -i mat\Лого.mp4
            -i mat\Сайт_клик.mov
            -i mat\bg.mov

        $services[0] 

        -filter_complex \"
            [11:v]split[11a][11b];
            
            [0:v]format=yuv444p,split[pr1][pbv0];
                [pr1]scale=iw*4:ih*4, zoompan=z=min(max(zoom\,pzoom)+($zoompanupto - 1) / 25 / 2\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[q1];
                [q1]drawtext=fontfile=Noah-Bold.ttf:text='$infoBeach[0]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=200+n/2:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[1]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=300-n/2:y=650[pre2];
                [pre2]fade=t=in:st=0:d=1[v0]; 

                [pbv0] zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[bv0];
                    
            [1:v]split[v1a][pbv1b];

                [v1a] scale=iw*4:ih*4,
                    zoompan=z=1.3-(in/500): d=2: x='iw/2.5-(iw/zoom/2.5)': y='ih/2.5-(ih/zoom/2.5)':s=1280x720[we];
                    [we]drawtext=fontfile=Noah-Bold.ttf:text='Длина береговой линии':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,3.5),1,if(lt(t,3.9),(1-(t-3.5)),0))))'
                    :fontsize=50:x=200+n/2:y=600,

                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[2]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5)/0.1,if(lt(t,3.5),1,if(lt(t,3.9),(1-(t-3.3)) ,0))))'
                    :fontsize=50:x=300-n/2:y=650,trim=0:4[v1];

                
                [pbv1b]zoompan=z=1.3-((50+in)/500):d=2:x='iw/2.5-(iw/zoom/2.5)':y='ih/2.5-(ih/zoom/2.5)'[bv1b];

            [2:v]split=3[bv2aa][v2a][bv2b];

                [bv2aa]scale=iw*4:ih*4,zoompan=z='zoom +  in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[bv2a];
                [v2a]scale=iw*4:ih*4,zoompan=z='zoom + 0.05 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n/2:y=650
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v2];

                

            $v3[0]
            [4:v]split=3[bv4a][bv4b][v4a];
                
                [bv4a]split[a4aa][a4bc];
                    [a4aa]zoompan=z=1.2:x='in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720[a4a];
                    [a4bc]zoompan=z=1.2:x='25+in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,split=3[a4c][a4d][a4b];

                [v4a]zoompan=z=1.2:x='50+in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Оценка поситителей':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=50:x=200+6+n/2:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[8]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=50:x=350-6-n/2:y=650
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v4];

                [bv4b]split[b4a][b4b];
                    [b4a]zoompan=z=1.2:x='100+in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720,split[4a][4b];
                    [b4b]zoompan=z=1.2:x='125+in':y='ih/2-(ih/zoom)/2':d=1:s=1280x720[4av];

            [5]split=[bv1ma][m1];
                [m1]scale=iw*4:ih*4, zoompan=z='if(between(time,0,1), zoom+0.005+0.2,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:0[map1];
                [bv1ma] scale=iw*4:ih*4, zoompan=z='zoom+0.005':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [bv1m];


            [6]scale=iw*4:ih*4,
                zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:1.4[map2];


            [7]scale=iw*4:ih*4,zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2) ':s=1280x720,trim=0:1.4[map3];
            
            [8:v]split=3[bv8a][bv8b][v8a];
                [v8a]scale=iw*4:ih*4, zoompan=z=1+0.05+in/1000:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[v8];
                [bv8b]split[b8a][b8b];
                    [b8a]scale=iw*4:ih*4,zoompan=z=1.1+in/1000:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,split[8a][8b];
                    [b8b]scale=iw*4:ih*4,zoompan=z=1.1+0.025+in/1000:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[8av];

            [9:v]split=3[bv9a][bv9b][v9a];

                [bv9a]split[a9aa][a9bc];
                    [a9aa] zoompan=z=1.25:x='in':y='in':d=1:s=1280x720[a9a];
                    [a9bc] zoompan=z=1.25:x='25+in':y='25+in':d=1:s=1280x720,split=3[a9d][a9b][a9c];

                [v9a]zoompan=z=1.25:x='50+in':y='50+in':d=1:s=1280x720[v9];
                
                [bv9b]split[b9a][b9b];
                    [b9a]zoompan=z=1.25:x='100+in':y='100+in':d=1:s=1280x720,split[9a][9b];
                    [b9b]zoompan=z=1.25:x='125+in':y='125+in':d=1:s=1280x720[9av];


            [10:v]split=3[bv10a][v10b][v10a];   
                [bv10a]split[a10aa][a10bc];
                    [a10aa] zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='in':d=1:s=1280x720[a10a];
                    [a10bc] zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='25+in':d=1:s=1280x720,split=3[a10d][a10b][a10c];

                [v10a]format=yuv444p,zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='50+in':d=1:s=1280x720,trim=0:1[v10];

                [v10b]format=yuv444p,zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='75+in':d=1:s=1280x720[v10bb];

            [bv1m][bv0]blend=all_expr='if(gte(Y,H - H*T/0.1),A,B)':shortest=1[0v1m];
            
            [bv1b][bv2a]xfade=transition=fade:duration=1,trim=0:1[v1x2];

                
            
            
            
            [8av][a9d]blend=all_opacity = 0.5[8x9c];
                [8a][a9a]blend=all_opacity = 0.5,split[8x9a][8x9b]; 

                [8b][8x9a]xfade=transition=vdslice:duration=1[a8x9];
                [a8x9][8x9b]xfade=transition=hrslice:duration=1,trim=0:1[an8x9a];

                [8x9c][a9b]xfade=transition=vdslice:duration=1[b8x9];
                [b8x9][a9c]xfade=transition=hrslice:duration=1,trim=0:1[an8x9b];
            
            [9av][a4d]blend=all_opacity = 0.5[9x4c];
                [9a][a4a]blend=all_opacity = 0.5,split[9x4a][9x4b]; 

                [9b][9x4a]xfade=transition=vdslice:duration=1[a9x4];
                [a9x4][9x4b]xfade=transition=hrslice:duration=1,trim=0:1[an9x4a];

                [9x4c][a4b]xfade=transition=vdslice:duration=1[b9x4];
                [b9x4][a4c]xfade=transition=hrslice:duration=1,trim=0:1[an9x4b];

            [4av][a10d]blend=all_opacity = 0.5[4x10c];
                [4a][a10a]blend=all_opacity = 0.5,split[4x10a][4x10b]; 

                [4b][4x10a]xfade=transition=vdslice:duration=1[a4x10];
                [a4x10][4x10b]xfade=transition=hrslice:duration=1,trim=0:1[an4x10a];

                [4x10c][a10b]xfade=transition=vdslice:duration=1[b4x10];
                [b4x10][a10c]xfade=transition=hrslice:duration=1,trim=0:1[an4x10b];

             

            $stream11

            $services[2]
            $pred

            [v10bb][12]overlay=0:0[v10x12];
            
            [11b]split[11ba][11bb];
            [11ba][11bb]xfade=transition=hblur:duration=1[11v];

              [11a][v0][0v1m][map1][map2][map3][v1][v1x2][v2] $endOfstreamService [v8]  [an8x9a][an8x9b][v9][an9x4a][an9x4b][v4][an4x10a][an4x10b][v10][v10x12][11v]concat=n=$services[3],
            format=yuv420p[v] 
        \"
         -map \"[v]\" -s \"1280x720\"  -y Anim01.mp4";
        
                // video\\$enBeach
    
    $text =str_replace(array("\n\r","\r\n"), "", $comm);
    file_put_contents("coman.txt", $beach . "\n" . $text  . "\n" . PHP_EOL, FILE_APPEND);
    //  echo $text;
    // exec($text);
   
//voice
    $time=[];
    $vService=[];
    $countStream=7;
    
    if($timeOfVisService == 0){//
        $vService[0] = null;
        $vService[1] = null;
        $vService[2]=null;
        $time[0]= 4+2+2+ 5;
        $time[1]=  4+2+2+ 3+5+2.5;
        $time[3]= 4+2+2+ 3+5+5+3;
    } 
    else{
        $vService[0] = "[15:a][6:a]concat=v=0:a=1[addSilence3];";
        $vService[1] = "[addSilence3]";
        $time[2]= '14';
        $vService[2] = "-f lavfi -t $time[2] -i anullsrc=channel_layout=stereo:sample_rate=44100";
        
        $time[0] = $timeOfVisService + (int)$time[2];
        $time[1] = $timeOfVisService + (int)$time[2] + 3 + 3; 
        $time[3] = $timeOfVisService + (int)$time[2] + 3 +3+1+5; 
        $countStream++;
    }

    if(false){//$infoBeach[4] != null
        $voiceOfBot[0]='[14:a][5:a]concat=v=0:a=1 [addSilence2];';
        $voiceOfBot[1]='[addSilence2]';
        $voiceOfBot[2]="-f lavfi -t 8 -i anullsrc=channel_layout=stereo:sample_rate=44100 ";
       

        $countStream++;
    }else{
        if($timeOfVisService != 0){$vService[0] = "[14:a][6:a]concat=v=0:a=1[addSilence3];";}
        
        $voiceOfBot[0]=null;
        $voiceOfBot[1]=null;
        $voiceOfBot[2]=null;
        $time[2]="8";
        $time[0] = $timeOfVisService + (int)$time[2];
        $time[1] = $timeOfVisService + (int)$time[2]  + 3+2+2;
        $time[3] = $timeOfVisService + (int)$time[2]  + 3+2+2+5.5;
        $vService[2] = "-f lavfi -t $time[2] -i anullsrc=channel_layout=stereo:sample_rate=44100";
        
    }

    $addVoice = "ffmpeg  -async 1 -i Anim01.mp4
        -itsoffset 00:00:02 -i voice\\nameBeach$enBeach.ogg 
        -itsoffset 00:00:05 -i voice\\placeBeach$enBeach.ogg 
        -itsoffset 00:00:09 -i voice\\length$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\\surface$enBeach.ogg 
        -itsoffset 00:00:10 -i voice\bottom$enBeach.ogg 

        -itsoffset 00:00:10 -i voice\\voiceService$enBeach.ogg
        -itsoffset 00:00:10 -i voice\\receive$enBeach.ogg
        -itsoffset 00:00:10 -i voice\score$enBeach.ogg
        -f lavfi -t 4 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        
        -f lavfi -t $time[0] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[1] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -itsoffset 00:00:10 -i voice\\end.ogg
        -f lavfi -t $time[3] -i anullsrc=channel_layout=stereo:sample_rate=44100

        $voiceOfBot[2]
        $vService[2]
        

        -filter_complex \"
            [9:a][4:a]concat=v=0:a=1 [addSilence1];
            $voiceOfBot[0]
            $vService[0]
            [10:a][7:a]concat=v=0:a=1 [addSilence4];
            [11:a][8:a]concat=v=0:a=1 [addSilence5];
            [13:a][12:a]concat=v=0:a=1 [addSilence6];

            [1][2][3][addSilence1]$voiceOfBot[1] $vService[1][addSilence4][addSilence5][addSilence6]amix=inputs=$countStream\" 
        -c:v copy -c:a aac  -y testVoice01.mp4";


        
    file_put_contents("coman.txt", $beach . "\n" . $addVoice  . "\n" . PHP_EOL, FILE_APPEND);
    $text2= str_replace(array("\n\r","\r\n"), "", $addVoice);
    exec($text2);
 
        // unlink("$enBeach.mp4");
}

