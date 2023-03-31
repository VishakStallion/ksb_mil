<?php
header('Content-Type: image/png');
$im = imagecreatetruecolor(48, 48);

$background = imagecolorallocate( $im, 59, 111, 149 );
$text_colour = imagecolorallocate( $im, 255, 255, 255 );

imagefilledrectangle($im, 0, 0, 48, 48, $background);

$font = 'dist/font/roboto/fonts/Black/Roboto-Black.ttf';
imagettftext($im, 14, 0, 12, 32, $text_colour, $font, 'AD');

imagepng($im);
imagedestroy($im);
