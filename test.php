<?php

$text = "ffmpeg 
        -loop 1 -t 2 -i img\Plyazh+Akvamarin0.jpg 
        -filter_complex 
        \"
        scale=iw*4:ih*4,
        

        zoompan=z='if(between(time,0.2,1.3), zoom+0.001,zoom+0.05 )':d=500:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720
        //на карту
        \"  -y testZoom.mp4";

        $text1 =str_replace(array("\n\r","\r\n"), "", $text);
        exec($text1);

        
        // zoompan=z='if(lte(zoom,1.1), zoom+0.005, zoom+0.5)':d=200:x='iw/2-(iw/zoom/2)':y='ih/2-(ih/zoom/2)':s=1280x720