<?php


////////////////////Start Captura de datos///////////////
$size = $_POST['size'];
$color_titulo = $_POST['color_titulo'];
$color_detalle = $_POST['color_detalle'];
$color_borde = $_POST['color_borde'];
$texto_t = $_POST['texto_t'];
$size_tit = $_POST['size_tit'];
$margintop_tit = $_POST['margintop_tit'];
$marginlef_tit = $_POST['marginlef_tit'];
$detalle = $_POST['texto'];
$origin_x = $_POST['textox'];
$origin_y = $_POST['textoy'];
$size_det = $_POST['size_det'];
$ancho_det = $_POST['ancho_det'];
$logo_margen_dcho = $_POST['logo_margen_dcho'];
$logo_margen_inf = $_POST['logo_margen_inf'];
$resizeHeight = $_POST['resizeHeight'];
$resizeWidth = $_POST['resizeWidth'];
$fuente_t = $_POST['fuente_t'];
$fuente_det = $_POST['fuente_det'];
$rotacion_t = $_POST['rotacion_t'];
$border = $_POST['border'];
$border_thick = $_POST['border_thick'];
$logo_opt = $_POST['logo_opt'];

if ($logo_opt == 1) {
  if (isset($_POST['logo'])) {
    $nombreArchivo = $_POST['logo'];
  }
}



////////////////////End Captura de datos///////////////

////////////////////Start FUNCIONES///////////////
  //Funcion para convertir hexa en rgb
function hex2rgb($hex) {

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}


  //funcion para dibujar un borde a la imagen.
function drawBorder(&$img, &$color, $thickness = 1)
{
    $x1 = 0;
    $y1 = 0;
    $x2 = ImageSX($img) - 1;
    $y2 = ImageSY($img) - 1;

    for($i = 0; $i < $thickness; $i++)
    {
        ImageRectangle($img, $x1++, $y1++, $x2--, $y2--, $color);
    }
}
////////////////////End FUNCIONES///////////////

//seteando el header de la imagen para mostrarla. puede ser png, jpeg o gif. Hay que especificarlo.
header('Content-Type: image/png');


//Creacion de la imagen. La imagen se crea del tamaño de la imagen proporcionada. Debemos controlar esto con templates para escoger entre tamaños. Procurar que la imagen de fondo sea del tamaño del banner.
switch ($size) {
  case 1:
    $image = imagecreatefromjpeg('468x60.jpg');
    break;
  case 2:
    $image = imagecreatefromjpeg('728x90.jpg');
    break;
  case 3:
    $image = imagecreatefromjpeg('234x60.jpg');
    break;
  case 4:
    $image = imagecreatefromjpeg('336x280.jpg');
    break;

  default:
    $image = imagecreatefrompng('bg2.png');
    break;
}

////////////////Start - COLORES//////////////////////

  //transformo los hexa en arrays de rgb
$ct = hex2rgb($color_titulo);
$cd = hex2rgb($color_detalle);
$cb = hex2rgb($color_borde);

  //creo los colores
$ctit = imagecolorallocate($image, $ct[0], $ct[1], $ct[2]);
$cdet = imagecolorallocate($image, $cd[0], $cd[1], $cd[2]);
$cbor = imagecolorallocate($image, $cb[0], $cb[1], $cb[2]);
////////////////End - COLORES//////////////////////

//////////////// Start - LOGO//////////////////////

if($logo_opt == 1){

//creación de la imagen del logo.
if (isset($nombreArchivo)) {
  $logo = imagecreatefrompng('uploads/'.$nombreArchivo);
} else {
  $logo = imagecreatefrompng('uploads/logo.png');
}


//cambio de tamaño del logo. Si es fondo transparente termina con fondo negro.
$imgResized = imagescale($logo, $resizeWidth, $resizeHeight );

//mantengo el fondo transparente con estas dos funciones
imagealphablending($imgResized, true);
imagesavealpha($imgResized, true);

//impresion de la nueva imagen en un archivo.
imagepng($imgResized, 'logo_100_100.png');

//tomo el archivo creado y lo guardo en una variable creando el logo con el nuevo tamaño
$logo = imagecreatefrompng('logo_100_100.png');


// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = $logo_margen_dcho;
$margen_inf = $logo_margen_inf;
$sx = imagesx($logo);
$sy = imagesy($logo);


// Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el ancho de la foto para calcular la posición de la estampa.
imagecopy($image, $logo, imagesx($image) - $sx - $margen_dcho, imagesy($image) - $sy - $margen_inf, 0, 0, imagesx($logo), imagesy($logo));

}//end If Logo-No

//////////////// END - LOGO//////////////////////



////////////////START - Titulo  y propiedades//////////////////////
$titulo = $texto_t;
$font_size_t = $size_tit;
$rotation_t = $rotacion_t;
$origin_x_t = $marginlef_tit;
$origin_y_t = $margintop_tit;
$font_t = "fonts/".$fuente_t;
$width_t = 300;
$margin_t = 20;
////////////////END - Titulo  y propiedades//////////////////////

////////////////START - Detalle y propiedades//////////////////////
$font_size = $size_det;
//$rotation = 10;
$font = "fonts/".$fuente_det;
$width = $ancho_det;
$margin = 20;

    ///////start text wrapping///////
//Hago un explode del texto por palabra
$text_a = explode(' ', $detalle);
//creo el nuevo texto vacio
$text_new = '';

//recorro el array creado. Se usan los parametros del $detalle para construir los saltos de linea.
foreach($text_a as $word){
    //Create a new text, add the word, and calculate the parameters of the text
    $box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);
    //if the line fits to the specified width, then add the word with a space, if not then add word with new line
    if($box[2] > $width - $margin*2){
        $text_new .= "\n".$word;
    } else {
        $text_new .= " ".$word;
    }
}
//trip spaces
$text_new = trim($text_new);
//new text box parameters
$box = imagettfbbox($font_size, 0, $font, $text_new);
//new text height
$height = $box[1] + $font_size + $margin * 2;
    ///////end -text wrapping///////

////////////////END - Detalle y propiedades//////////////////////


////////////////START - Impresión de textos en imagen//////////////////////
    //array imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
$texto_tit = imagettftext($image, $font_size_t, $rotation_t, $origin_x_t, $origin_y_t, $ctit, $font_t, $titulo);

//($im, $font_size, 0, $margin, $font_size+$margin, $black, $font, $text_new);
$texto_det = imagettftext($image, $font_size, 0, $origin_x, $origin_y, $cdet, $font, $text_new);
////////////////END - Impresión de textos en imagen//////////////////////


//dibuja un borde si el usuario eligio borde SI.
if ($border == 1) {
  drawBorder($image, $cbor, $border_thick);
}

//Muestreode la imagen en un archivo png.
imagepng($image, 'imagen1.png');

////
$path = 'imagen1.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

echo $base64;

imagedestroy($image);
if ($logo_opt == 1) {
  imagedestroy($logo);
  imagedestroy($imgResized);
}




//error_log("Error message\n", 3, "/home/threehdm/php.log");
 ?>
