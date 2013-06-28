<?php
// Set the content-type
header('Content-type: image/png');

// Create the image
$im = imagecreatetruecolor(500, 430);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$white = imagecolorallocate($im, 145, 201, 232);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 500, 430, $white);



// The text to draw
$text = 'A';
$text2 = '2';
// Replace path by your own font path
$font = "../heumm.ttf";

// Add some shadow to the text
imagettftext($im, 20, 0, 200, 60, $grey, $font, "서울");
Imageline($im, 200,60,120,110,$grey);

imagettftext($im, 20, 0, 70, 130, $grey, $font, "인천");
imagettftext($im, 20, 0, 140, 90, $grey, $font, "2");


imagettftext($im, 20, 0, 205, 200, $grey, $font, "대전");
Imageline($im, 120,110,200,190,$grey);
imagettftext($im, 20, 0, 160, 150, $grey, $font, "2");

Imageline($im, 200,60,200,190,$grey);
imagettftext($im, 20, 0, 200, 130, $grey, $font, "5");


imagettftext($im, 20, 0, 290, 250, $grey, $font, "대구");
Imageline($im, 200,190,280,240,$grey);
imagettftext($im, 20, 0, 250, 230, $grey, $font, "3");


imagettftext($im, 20, 0, 360, 310, $grey, $font, "울산");
Imageline($im, 280,240,360,300,$grey);
imagettftext($im, 20, 0, 330, 280, $grey, $font, "1");


imagettftext($im, 20, 0, 290, 370, $grey, $font, "부산");
Imageline($im, 360,300,300,350,$grey);
imagettftext($im, 20, 0, 330, 320, $grey, $font, "1");

Imageline($im, 280,240,300,350,$grey);
imagettftext($im, 20, 0, 290, 300, $grey, $font, "3");


imagettftext($im, 20, 0, 60, 320, $grey, $font, "광주");
Imageline($im, 300,350,100,310,$grey);
imagettftext($im, 20, 0, 200, 330, $grey, $font, "4");

Imageline($im, 280,240,100,310,$grey);
imagettftext($im, 20, 0, 180, 280, $grey, $font, "4");

Imageline($im, 120,110,100,310,$grey);
imagettftext($im, 20, 0, 110, 210, $grey, $font, "8");

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
