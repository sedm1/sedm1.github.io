<?php
session_start();
$string = "";
for ($i = 0; $i < 4; $i++)
$string .= chr(rand(48, 57));

$_SESSION['rand_code'] = $string;

$dir = "fonts/";

$image = imagecreatetruecolor(60, 30);
$black = imagecolorallocate($image, 0, 0, 0);
$color = (isset($_GET['color'])) ? imagecolorallocate($image, 199,151,149) : imagecolorallocate($image, 125,128,130);
$white = imagecolorallocate($image, 255,255,255);

imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 14, 0, 0, 22, $color, $dir."Circe-Regular.ttf", $_SESSION['rand_code']);

header("Content-type: image/png");
imagepng($image);
?>