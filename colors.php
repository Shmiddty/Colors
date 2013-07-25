<?php
header('Content-Type: image/png');
function rgbFromHex($hexValue) {
 
        //$hexValue = str_replace('#', '', $hexValue);
        //SILLY ME WAS EXPECTING # TO BE PASSED. BUT USING $_GET[] VARIABLES THAT ISN'T POSSIBLE...  
       
        if (strlen($hexValue) == 3) { //CHECK FOR SHORTHAND
                $r = hexdec(substr($hexValue, 0, 1) . substr($hexValue, 0, 1));
                $g = hexdec(substr($hexValue, 1, 1) . substr($hexValue, 1, 1));
                $b = hexdec(substr($hexValue, 2, 1) . substr($hexValue, 2, 1));
        } else { //FUNCTION FOR NORMAL 6 DIGIT VALUES
                $r = hexdec(substr($hexValue, 0, 2));
                $g = hexdec(substr($hexValue, 2, 2));
                $b = hexdec(substr($hexValue, 4, 2));
        }
        $rgb = array($r,$g,$b);
       
        return $rgb;
}
 
function createSwatch($colors){
    $colArray = explode(",", $colors);
        $colWidth = 200 / count($colArray);
        $im = imagecreate(200, 40);
        $x = 0;
        
        foreach($colArray as $col){
                $rgb = rgbFromHex($col); //DON'T DO ANYTHING IF A COLOR ISN'T PROVIDED
                $color = imagecolorallocate($im, $rgb[0], $rgb[1], $rgb[2]); //FIND A BETTER WAY TO DO THIS.
                
                imagefilledrectangle($im, $x, 0, $x + $colWidth, 40, $color);
                $x += $colWidth;
        }

     if ($colors === NULL) {
     	$textColor = imagecolorallocate($im, 255, 255, 255);
     	$text = 'Try using a hexValue';
     	imagestring($im, 20, 0, 10, $text, $textColor);
     }
     
    return imagepng($im);
}
 
createSwatch($_GET['color'])
?>


