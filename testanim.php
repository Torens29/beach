<?php

$t;
$text1[0] = "-f lavfi -i color=c=white:s=200x200  -loop 1 -i fly.png";
$text1[1] = "[2:v]scale=-1:150[x2],
             [1:v][x2]overlay=(W-w)/2:H[x12],
             [x12]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Add text':fontcolor=black:
                    fontsize=20:x=(w-text_w)/2:y=h-th[x1t2],
             [x1t2]fade=t=in:0:50:alpha=1[X1];
             [0:v][X1]overlay=(W-w)/2:(H-h)/2";

$text2 = "[f2]fade=t=in:st=3:d=0.5:alpha=1[x22],
    [de][x22]overlay=(W-w)/2+200:(H-h)/2+200";

$cmd="ffmpeg 
    -f lavfi -i color=c=white:s=1280x720  $text1[0] 
    -filter_complex \"
    $text1[1] \"
    
    -pix_fmt yuv420p -t 5 -s \"1280x720\" -c:a copy -y output.mp4";

$text =str_replace(array("\n\r","\r\n"), "", $cmd); 
exec($text);