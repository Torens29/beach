<?php
$bg= "-f lavfi -i color=c=white:s=1280x720 -loop 1 ";
$img= "-i map\PlyazhvNemeckoybalke1.png";
$out="-s 1280x720 -y -an -r 24 out.mp4";
// exec("ffmpeg -f image2 -r 0.5 -i map\PlyazhvNemeckoybalke%0d.png  -s 1280x720 -y -an -r 24 out.mp4");
// exec("ffmpeg $bg $img $out");
exec("ffmpeg -i map\PlyazhvNemeckoybalke%0d.png -vf zoompan=d=(3+1)/2:s=1250x1250:fps=1/2,framerate=25:interp_start=0:interp_end=255:scene=100 -c:v mpeg4 -maxrate 5M -q:v 2 -y out.mp4" );