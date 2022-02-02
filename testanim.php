<?php

$t;
$cmd="ffmpeg 
-f lavfi -i color=c=white:s=1280x720 -loop 1 -i fly.png  
    -filter_complex \"
    
    [1]scale=640:-1,
    fade=t=in:0:50[x21],
    [0][x21]overlay=(W-w)/2:(H-h)/2,trim=0:12
    \"

    -pix_fmt yuv420p -t 15 -c:a copy -y output.mp4";

$text =str_replace(array("\n\r","\r\n"), "", $cmd);
// [1]split[bv1a][1v] ; [bv1][title]concat=n=2\" :enable='between(t,1,3) 
exec($text);
// [0] drawtext=fontfile=/Library/Fonts/Arial.ttf:text='Инфраструктура пляжа':fontcolor=black:fontsize=54:x=(w-tw)/2:y=(h/w)+th [title];
    