<?php

$order;$services;$pred = "";$i=1;

$services[0] .= "-f lavfi -i color=c=gray:s=200x200  -loop 1 -i fly.png";
$services[1] .= " $pred [2:v]scale=150:-1[x2],
             [1:v][x2]overlay=(W-w)/2:0[x12],
             [x12]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Add text':fontcolor=black:
                fontsize=20:x=(w-text_w)/2:y=h-th[x1t2],
             [x1t2]fade=t=in:0:50:alpha=1[X1];
             [0:v][X1]overlay=280:200";
$pred = "[x00];";
$services[0] .= " -f lavfi -i color=c=gray:s=200x200 -loop 1 -i fly.png";
$services[1] .= "$pred [4:v]scale=150:-1[x4],
                [3:v][x4]overlay=(W-w)/2:0[x34],
                [x34]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Add text':fontcolor=black:
                fontsize=20:x=(w-text_w)/2:y=h-th[x3t4],
                [x3t4]fade=t=in:30:50:alpha=1[X3];
                [x00][X3]overlay=580:200";

$cmd="ffmpeg 
    -f lavfi -i color=c=white:s=1280x720  $services[0] 
    -filter_complex \"
    $services[1] \"
    
    -pix_fmt yuv420p -t 5 -s \"1280x720\" -c:a copy -y output.mp4";

$text =str_replace(array("\n\r","\r\n"), "", $cmd); 
exec($text);
