
  
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
    $stream[0] = 0; $stream[1] = 17;
    $pred[0] = ""; $pred[1]="[16v]";
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
    // var_dump($infoBeach);

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

                    $voiceOfService .= " кафэ.";
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
                    $services[0] .= " -i mat\Иконки\\Спортплощадка.mov ";
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
        if($infoBeach[4] != null){//$infoBeach[4] != null
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]format=yuv444p,split=4[pbv3a][pbv3b][v3a][pbv3aa];
                    [pbv3a]zoompan=z=1.3:x='iw/2-(iw/zoom)/2':y='in':d=1[a3a];
                    [pbv3aa]zoompan=z=1.3:x='iw/2-(iw/zoom)/2':y='25+in':d=1,split=3[a3d][a3b][a3c];
                
                [v3a]zoompan=z=1.3:x='iw/2-(iw/zoom)/2':y='50+in':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n:y=600 :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n:y=650 :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
                [pbv3b]zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='100+in':d=1[bv3b];
                
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
            $services[3] = 20;
        }else{
            $v3[0]="[bv2b]zoompan=z='zoom + 0.15 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[v2b];";
        

            $v3[1]="";
            $v3[2]="[v2b]";
            $services[3] = 17;            
        }
        $endOfstreamService = "$v3[1][endService][8v16v]";
        $services[2] = "$services[1]$pred[1];";
        
        $time = $stream[0] + 6.5;
        $pred[1] = "$pred[1]trim=0:$time [endService];";
        $stream11 = "
            $v3[2][16]overlay=0:0[16v];
            color=white:s=1280x720:d=25[canvas1];
            [canvas1][8:v]xfade=transition=hblur:duration=1,trim=0:1[8v16v];";


        voice($voiceOfService, "voiceService$receiveBeach[1]");
    }else {
         if($infoBeach[4] != null){//
            $infoBeach[4] = mb_strtolower($infoBeach[4]);
            $v3[0]="
                [3:v]split = [3c][pbv3b];
                [3c]format=yuv444p,scale=iw*4:ih*4,split=3[pbv3a][v3a][pbv3aa];
                    [pbv3a]zoompan=z=1.3:x='iw/2-(iw/zoom)/2':y='in':d=1[a3a];
                    [pbv3aa]zoompan=z=1.3:x='iw/2-(iw/zoom)/2':y='25+in':d=1,split=3[a3b][a3c][a3d];
                [v3a]format=yuv444p,zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='50+in':d=1:s=1280x720,
                    drawtext=fontfile=Noah-Bold.ttf:text='Морское дно':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=200+6+n:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[4]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=50:x=300-6-n:y=650:alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v3];
                
               
                    
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
            $services[3] = 19;
            $stream11= "[pbv3b][8:v]xfade=transition=hblur:duration=1,trim=0:1[3v8v]; ";
            $endOfstreamService="$v3[1][3v8v]";
        }else{
            $v3[0]=null;
            $v3[1]=null;
            $v3[2]="[bv2b]";
            $services[3] = 17;   
            $stream11= "[bv2b][8:v]xfade=transition=hblur:duration=1,trim=0:1[2v8v];";        
                        $endOfstreamService="[2v8v]"; 
        }

        voice("", "voiceService$receiveBeach[1]");
        $services[2]=null;
        $pred[1]= null;
    }

    video($infoBeach,$receiveBeach[1], $zoompanupto, $zoomdelta, $services, $pred[1], $endOfstreamService, $cellSize, $transitionDuration, $time,$stream11, $arrayOfBeaches[$j-1],$v3);
}
 

function video($infoBeach, $enBeach, $zoompanupto, $zoomdelta, $services, $pred, $endOfstreamService, $cellSize, $transitionDuration, $timeOfVisService, $stream11, $beach, $v3){
    // var_dump($infoBeach);
    switch ($infoBeach[3]) {
        case "Бетонные пляжи": $infoBeach[3]="бетонная";
            break;
        case "Галечные пляжи": $infoBeach[3]="галечная";
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
    $v= 0;
    $receive = explode("\n", $infoBeach[7]);
    foreach ($receive as $s) {
        switch ($s) {
            case "Автомобиль":
                if ($l == 0) {
                    // $receiveBeach .= "автомобиле ";
                    $l = $l +1;
                    $v = $v+1;
                } else {
                    // $receiveBeach .= "и автомобиле";
                    $v = $v+1;
                }
                break;
            case "Общественный транспорт":
                if ($l == 0) {
                    // $receiveBeach .= "общественом транспорте ";
                    $l = $l +1;
                    $v = $v+2;
                } else {
                    // $receiveBeach .= "и общественом транспорте";
                    $v = $v+2;
                }
                break;
        }
    }
 
    if($v==1){// только автомобиль
        $transp="[15:v]";
        $receiveBeach .= "автомобиле ";
        $transition=" -loop 1 -t 2 -i mat\транспорт\авто.png";

    } else if($v==2){ // только общественный
        $transp="[14:v]";
        $receiveBeach .= "общественом транспорте ";
        $transition="-loop 1 -t 2 -i mat\транспорт\общественный.png ";
    } else if($v==3){// и личный и общественный транспорт
        $transp="[13:v]";
        $receiveBeach .= "общественом транспорте и автомобиле ";
        $transition=" -loop 1 -t 2 -i mat\транспорт\общ+авт.png";
    }

    voice($receiveBeach, "receive$enBeach");
    
    $score= str_replace(".",",",$infoBeach[8]);
    voice("Посетители дают оценку. $score", "score$enBeach");

    $comm = "ffmpeg 
        -loop 1 -t 2 -i F:\ПляжиВидео\img\\" . $enBeach . "0.jpg 
            -loop 1 -t 4 -i F:\ПляжиВидео\img\\" . $enBeach . "1.jpg 
            -loop 1 -t 2 -i F:\ПляжиВидео\img\\" . $enBeach . "2.jpg 
            -loop 1 -t 2 -i F:\ПляжиВидео\img\\" . $enBeach . "3.jpg 
            -i mat\\reyting.mp4
            -loop 1 -t 1 -i F:\ПляжиВидео\map\\" . $enBeach . "1.png

            -loop 1 -t 1 -i F:\ПляжиВидео\map\\" . $enBeach . "2.png
            -loop 1 -t 1 -i F:\ПляжиВидео\map\\" . $enBeach . "3.png
            $transition 
            -loop 1 -t 2 -i mat\рейтинг.png
            -loop 1 -t 2 -i F:\ПляжиВидео\img\\" . $enBeach . "4.jpg 
            
            -i mat\Лого.mp4
            -i mat\Сайт_клик.mov


            -i mat\транспорт\общественный+личный.mp4
            -i mat\транспорт\общественный.mp4
            -i mat\транспорт\общественный+личный.mp4

            -i mat\bg.mov
        $services[0] 
        -filter_complex \"
            [11:v]split[11a][11b];
            
            color=white:s=1280x720:d=25[canvas2];
            [canvas2][9:v]xfade=transition=circleopen:duration=0.5,trim=0:0.5[14v4v];

            [0:v]format=yuv444p,split[pr1][pbv0];
                [pr1]scale=iw*4:ih*4, zoompan=z=min(max(zoom\,pzoom)+($zoompanupto - 1) / 25 / 2\,$zoompanupto):d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720[q1];
                [q1]drawtext=fontfile=Noah-Bold.ttf:text='$infoBeach[0]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=200+n:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[1]':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                        :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'
                        :fontsize=50:x=300-n:y=650[pre2];
                [pre2]fade=t=in:st=0:d=1[v0]; 
                [pbv0] zoompan=z=1.1:d=1:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)'[bv0];
                    
            [1:v]split[v1a][pbv1b];
                [v1a] format=yuv444p,scale=iw*4:ih*4,
                    zoompan=z=1.3-(in/500): d=1: x='iw/2.5-(iw/zoom/2.5)': y='ih/2.5-(ih/zoom/2.5)':s=1280x720[we];
                    [we]drawtext=fontfile=Noah-Bold.ttf:text='Длина береговой линии':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,3.5),1,if(lt(t,3.9),(1-(t-3.5)),0))))'
                    :fontsize=50:x=200+n:y=600,
                    drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[2]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5)/0.1,if(lt(t,3.5),1,if(lt(t,3.9),(1-(t-3.3)) ,0))))'
                    :fontsize=50:x=300-n:y=650,trim=0:4[v1];
                
                [pbv1b]zoompan=z=1.3-((100+in)/500):d=2:x='iw/2.5-(iw/zoom/2.5)':y='ih/2.5-(ih/zoom/2.5)'[bv1b];
            [2:v]format=yuv444p,split=3[bv2aa][v2a][bv2b];
                [bv2aa]scale=iw*4:ih*4,zoompan=z='zoom +  in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720[bv2a];
                [v2a]scale=iw*4:ih*4,zoompan=z='zoom + 0.05 + in/500':x='iw/2-(iw/zoom/2)':y='iw/2-(iw/zoom/2)':d=1:s=1280x720,
                drawtext=fontfile=Noah-Bold.ttf:text='Поверхность пляжа':fontcolor=white:shadowcolor=black@0.5:shadowy=3:shadowx=3:fontsize=50:x=200+6+n:y=600
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))',
                drawtext=fontfile=Noah-Regular.ttf:text='$infoBeach[3]':fontcolor=white:shadowcolor=black@0.5: shadowy=3:shadowx=3:fontsize=50:x=300-6-n:y=650
                    :alpha='if(lt(t,0.1),0,if(lt(t,0.5),(t/0.5),if(lt(t,1.5),1,if(lt(t,1.9),(1-(t-1.5)),0))))'[v2];
                
            $v3[0]
            [4:v]drawtext=fontfile=Noah-Bold.ttf:text='$infoBeach[8]':fontcolor=white:fontsize=80:x=1025:y=550:
            alpha='if(lt(t,3),0,if(lt(t,5),(t/(5)),1))',trim=0:6[v4];
    
            [5]format=yuv444p,split=[bv1ma][m1];
                [m1]scale=iw*4:ih*4, zoompan=z='if(between(time,0,1), zoom+0.005+0.2,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:0[map1];
                [bv1ma] scale=iw*4:ih*4, zoompan=z='zoom+0.005':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720 [bv1m];
            [6]format=yuv444p,scale=iw*4:ih*4,
                zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720,trim=0:1.4[map2];
            [7]format=yuv444p,scale=iw*4:ih*4,zoompan=z='if(between(time,0.2,1.2), zoom+0.005,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2) ':s=1280x720,trim=0:1.4[map3];
            
            
                
            [10:v]format=yuv444p,split=2[v10b][v10a];   
                
                
                [v10a]zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='50+in':d=1:s=1280x720[v10a];
                color=white:s=1280x720:d=25[circl];
                [circl][v10a]xfade=transition=circleclose:duration=0.5,format=yuv420p,trim=0:1[v10];
                [v10b]zoompan=z=1.3:x='iw/2-(iw/zoom/2)':y='75+in':d=1:s=1280x720[v10bb];
            [bv1m][bv0]blend=all_expr='if(gte(Y,H - H*T/0.1),A,B)':shortest=1[0v1m];
            
            [bv1b][bv2a]xfade=transition=fade:duration=1,trim=0:1[v1x2];
            
            
            
            
             
            $stream11
            $services[2]
            $pred
            [v10bb][12]overlay=0:0[v10x12];
            
              [11a][v0][0v1m][map1][map2][map3][v1][v1x2][v2] $endOfstreamService $transp [14v4v] [v4][v10][v10x12][11b]concat=n=$services[3],
            format=yuv420p[v] 
        \"
         -map \"[v]\" -s \"1280x720\"  -y F:\ПляжиВидео\\$enBeach.mp4";
        
                // video\\$enBeach
    
    $video =str_replace(array("\n\r","\r\n"), "", $comm);
    file_put_contents("coman.txt", $beach . "\n" . $video  . "\n" . PHP_EOL, FILE_APPEND);
    //  echo $text;
exec($video);
   
//voice
    $time=[];
    $vService=[];
    $countStream=8;
    
    if($timeOfVisService == 0){//
        $vService[0] = null;
        $vService[1] = null;
        $vService[2]=null;
        $time[0]= 4+2+2+ 5;
        $time[1]=  4+2+2+ 3+5+2.5;
        $time[3]= 4+2+2+ 3+5+5+3;
    } 
    else{
        $vService[0] = "[16:a][6:a]concat=v=0:a=1[addSilence3];";
        $vService[1] = "[addSilence3]";
        $time[2]= '12';
        $vService[2] = "-f lavfi -t $time[2] -i anullsrc=channel_layout=stereo:sample_rate=44100";
        
        $time[0] = $timeOfVisService + (int)$time[2];
        $time[1] = $timeOfVisService + (int)$time[2] + 3 + 3; 
        $time[3] = $timeOfVisService + (int)$time[2] + 3 +4+5; 
        $countStream++;
    }

    if($infoBeach[4] != null){// $infoBeach[4] != null
        $voiceOfBot[0]='[15:a][5:a]concat=v=0:a=1 [addSilence2];';
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

    $addVoice = "ffmpeg  -async 1 -i F:\ПляжиВидео\\$enBeach.mp4
        -itsoffset 00:00:02 -i F:\ПляжиВидео\\voice\\nameBeach$enBeach.ogg 
        -itsoffset 00:00:05 -i F:\ПляжиВидео\\voice\\placeBeach$enBeach.ogg 
        -itsoffset 00:00:09 -i F:\ПляжиВидео\\voice\\length$enBeach.ogg 
        -itsoffset 00:00:10 -i F:\ПляжиВидео\\voice\\surface$enBeach.ogg 
        -itsoffset 00:00:10 -i F:\ПляжиВидео\\voice\bottom$enBeach.ogg 
        -itsoffset 00:00:10 -i F:\ПляжиВидео\\voice\\voiceService$enBeach.ogg
        -itsoffset 00:00:10 -i F:\ПляжиВидео\\voice\\receive$enBeach.ogg
        -itsoffset 00:00:10 -i F:\ПляжиВидео\\voice\score$enBeach.ogg
        -f lavfi -t 4 -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[0] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -f lavfi -t $time[1] -i anullsrc=channel_layout=stereo:sample_rate=44100 
        -itsoffset 00:00:10 -i mat\\end.ogg
        -f lavfi -t $time[3] -i anullsrc=channel_layout=stereo:sample_rate=44100
        -f lavfi -t 1 -i anullsrc=channel_layout=stereo:sample_rate=44100
        $voiceOfBot[2]
        $vService[2]
        
        -f lavfi -t 2 -i anullsrc=channel_layout=stereo:sample_rate=44100
        -filter_complex \"
            [9:a][4:a]concat=v=0:a=1 [addSilence1];
            $voiceOfBot[0]
            $vService[0]
            [10:a][7:a]concat=v=0:a=1 [addSilence4];
            [11:a][8:a]concat=v=0:a=1 [addSilence5];
            [13:a][12:a]concat=v=0:a=1,volume = -8dB [addSilence6];
            [addSilence6][17:a]concat=v=0:a=1[add];
            
            [14][1][2][3][addSilence1]$voiceOfBot[1] $vService[1][addSilence4][addSilence5][add]amix=inputs=$countStream\" 
        -c:v copy -c:a aac  -y F:\ПляжиВидео\\v$enBeach.mp4";


        
    // file_put_contents("coman.txt", $beach . "\n" . $addVoice  . "\n" . PHP_EOL, FILE_APPEND);
    $addvoice= str_replace(array("\n\r","\r\n"), "", $addVoice);
// exec($addvoice);
// музыка
    $addMusComm = "ffmpeg 
            -i F:\ПляжиВидео\\v$enBeach.mp4
            -i mat\mus.mp3 
            
            -filter_complex \"
            [1:a]volume = -35dB[mus];
            [0:a][mus]amerge=inputs=2[a]\"
             -map 0:v -map \"[a]\" -c:v copy -ac 2 
            -shortest -y F:\ПляжиВидео\\$enBeach.mp4 ";
        
        $addMus =str_replace(array("\n\r","\r\n"), "", $addMusComm);
// exec($addMus);
// unlink("F:\ПляжиВидео\\v$enBeach.mp4");

$add = "ffmpeg -i video\\voice\\$enBeach.mp4 -i mat\demo.png -filter_complex \"[0:v][1:v]overlay=0:0\" -y video\\result.mp4";
// exec($add);


}