<?php
/*
 * Establecer los parámetros del motor de plantillas. Incluye tambien constantes sobre rutas.
 * @author Daniel Garnier Paris <dgarnier@dgparis.com>
 * @version preAlpha
 * @package MacroSport
 * @copyright Copyright (c) 2011-2012
 */
global $smarty;
error_reporting(E_ERROR | E_WARNING | E_PARSE | ~E_DEPRECATED);
/**
*Rutas del sistema
*/

define("ruta_absoluta","/home/u199904/public_html/14pasos");
define("ruta_relativa","http://196925m.com/14pasos");

/*
*Esta funcion es una mejora sobre la funcion comping original
*/
function comping2($imagen){
$nombre=substr($imagen,strripos($imagen,"/")+1);
//destination
$image = imagecreatefromjpeg($imagen); 
if(!$image){
   $comping[0]="Error";
}else{
   $comping=array();
   $ancho = imagesx($image);
   $alto = imagesy($image);
   $ancho_o=$ancho;
   $alto_o=$alto;
   if($alto>300 or $ancho>300){
 //dimensiones originales  
      
      $tamano=553;
      if($ancho==$alto){
         $aspecto="C";
      }elseif($ancho>$alto){
	     $aspecto="L";
      }else{
	     $aspecto="P";
      }//if de aspecto
	  
//se determina el tamaño de comping con base al aspecto
      switch($aspecto){
         case "C":
	         $ancho=$tamano;
             $alto=$tamano;
      break;
      case "L":
	        //$ancho=$tamano;
	        //$alto=($tamano*$alto_o)/$ancho_o;
                $ancho=325;
	        $alto=241;
	  break;
      case "P":
	       $alto=$tamano;
	       $ancho=($tamano*$ancho_o)/$alto_o;
      }//switch de aspecto
   
    }//if($alto>300 or $ancho>300){
$new_imagen=imagecreatetruecolor($ancho,$alto);	
imagecopyresampled($new_imagen,$image,0,0,0,0,$ancho,$alto,$ancho_o,$alto_o);

  
//Crea la imagen de marca de agua
   //$fondo = imagecreatefrompng("img/marca_de_agua.png");
 /*
*se cambio de imagecopy a imagecopyresampled para prevenir el reescalamiento de imagen si el orgien es
*muy grande
*@author Daniel Garnier
*@version 2.0
*@package Junior Masters
*/  
//pega la imagen de marca de agua
   //imagecopyresampled($new_imagen,$fondo,0,195,0,0,275,103,275,103);
   ob_start(); 
   imagejpeg($new_imagen); 
   $jpg = ob_get_contents();
   ob_end_clean();
   $comping= str_replace('##','##',mysql_escape_string($jpg));
   
}//if

return $comping;
}//Function comping


//Funcion para la creación del thumbnail de las imagenes.
function thumbnail2($imagen){
$image = imagecreatefromjpeg($imagen); 
if(!$image){
   $thumbnail="Error";
}else{
   $tamano=150;
   $ancho = imagesx($image);
   $alto = imagesy($image);

//Determina el aspecto de la imagen
   if($ancho==$alto){
      $aspecto="C";
   }elseif($ancho>$alto){
	  $aspecto="L";
   }else{
	  $aspecto="P";
   }//if de aspecto
//se determina el tamaño de thumbnail con base al aspecto
   switch($aspecto){
     case "C":
	  $nancho=$tamano;
      $nalto=$tamano;
      break;
     case "L":
	  //$nancho=$tamano;
	  //$nalto=($tamano*$alto)/$ancho;
          $nancho=179;
          $nalto=133;
	  break;
   case "P":
	  $nalto=$tamano;
	  $nancho=($tamano*$ancho)/$alto;
   }//switch de aspecto
			
   $thumb = imagecreatetruecolor($nancho,$nalto);
   imagecopyresampled($thumb,$image,0,0,0,0,$nancho,$nalto,$ancho,$alto);
//Creacion del Thumbnail
   ob_start();
   imagejpeg($thumb);
   $thumbf=ob_get_contents();
   ob_end_clean();
//Graba en bd
   $thumbnail = str_replace('##','##',mysql_escape_string($thumbf));
}//if de validacion de imagen  

return $thumbnail;
}//function thmbnail
?>