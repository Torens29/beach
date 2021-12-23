<?php
$W="1280";
$H="720";
$A="6";//time of img
$B="1";//time of animation

// function video()
// $img = "https://back.plyazhi.ru/upload/iblock/152/152a86afbe9ebb8364a29324fa957376.jpg https://back.plyazhi.ru/upload/iblock/9ee/9eeba0e7b1f49dadf7341d8acc541603.jpg https://back.plyazhi.ru/upload/iblock/058/05886080d45a3b9b700393636f899b5d.jpg";

// $bg= "-f lavfi -i color=c=white:s=1280x720 -loop 1 ";
// $img= "-i map\PlyazhvNemeckoybalke1.png";
// $out="-s 1280x720 -y -an -r 24 out.mp4";
// exec("ffmpeg -f image2 -r 0.5 -i img\Yashmovyy+plyazh%0d.jpg -vf zoompan=d=(3+1)/2:s=1280x720:fps=1/2  -s 1280x720 -y -an -r 24 out.mp4");

// exec("ffmpeg -i img\Yashmovyy+plyazh%0d.jpg -vf zoompan=d=($A+$B)/$B:s=1280x720:fps=1/$B,framerate=25:interp_start=0:interp_end=255:scene=100 -c:v mpeg4 -maxrate 5M -q:v 2 -y out.mp4");

$comm = "ffmpeg  -loop 1 -t 6 -i img\Yashmovyy+plyazh0.jpg -loop 1 -t 5 -i img\Yashmovyy+plyazh1.jpg -loop 1 -t 5 -i img\Yashmovyy+plyazh2.jpg -loop 1 -t 5 -i img\Yashmovyy+plyazh3.jpg -loop 1 -t 5 -i img\Yashmovyy+plyazh4.png -filter_complex \"[0:v] scale=1280:-1, drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FIRST TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,drawtext=fontfile=/Library/Fonts/Arial.ttf:text='AFTER FIRST TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th+100,split[pre][pbv0];[pbv0]fifo[bv0]; [pre]fade=t=in:st=0:d=1[v0]; [1:v]scale=1280:-1, drawtext=fontfile=/Library/Fonts/Arial.ttf:text='SECOND TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,split=3[pbv1a][pbv1b][v1];[pbv1a]fifo[bv1a];[pbv1b]fifo[bv1b]; [2:v]drawtext=fontfile=/Library/Fonts/Arial.ttf:text='THIRD TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,split=3[pbv2a][pbv2b][v2];[pbv2a]fifo[bv2a];[pbv2b]fifo[bv2b]; [3:v]scale=1280:-1, drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FOURTH TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,split=3[pbv3a][pbv3b][v3];[pbv3a]fifo[bv3a];[pbv3b]fifo[bv3b]; [4:v]scale=1280:-1, drawtext=fontfile=/Library/Fonts/Arial.ttf:text='FIFTH TEXT':fontcolor=white:fontsize=24:x=(w-tw)/2:y=(h/PHI)+th,split[pbv4][v4];[pbv4]fifo[bv4]; [bv1a][bv0]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[01v]; [bv2a][bv1b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[12v]; [bv3a][bv2b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[23v]; [bv4][bv3b]blend=all_expr='A*T/0.5+B*(0.5-T)/0.5',trim=0:0.5[34v]; [v0][01v][v1][12v][v2][23v][v3][34v][v4]concat=n=9,format=yuv420p[v]\" -map \"[v]\" -s 1280x720 -y out.mp4";
//  $text =str_replace("^\n", "",$comm);
 exec($comm);