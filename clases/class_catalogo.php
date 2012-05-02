<?php
/**
* Clase para el manejo del Catálogo GPS
*
* @author Daniel Garnier Paris
* @version 1.0
* @package 14Pasos
* @copyright Daniel Garnier Paris
*/

/**
* Clase catalogo_gps
* Clase para la creacion, listado, manejo de imagenes del catalogo GPS
*
* @package 14Pasos
* @author Daniel Garnier Paris
* @version 1.0
* @copyright Daniel Garnier Paris
*/
class catalogo{
function __construct($parametros){
//Control de las plantillas

  include("main_lib.php");
  include("../bd.php");
  global $conex;
 
}//function __construct($parametros){

function consulta() {
global $conex;
$qry_fotos="SELECT foto_id,referencia, latitud, longitud, fotografo FROM fotos";
$res_fotos=$conex->query($qry_fotos);

if($res_fotos){
   
   $consulta=array();
   $contador=0;
   while($ar_fotos=$res_fotos->fetch_array(MYSQLI_BOTH)){
 
   $consulta[$contador]["foto_id"]=$ar_edin["foto_id"];
   $consulta[$contador]["referencia"]=$ar_edin["referencia"];
   $consulta[$contador]["latitud"]=$ar_edin["latitud"];
   $consulta[$contador]["longitud"]=$ar_edin["longitud"];
   $consulta[$contador]["fotografo"]=$ar_edin["fotografo"];
   $contador++;
   }
}//if($res_edin){
        $result->metric = array('height'=>"10", 'weight'=>"10");
		$result->imperial = array('height'=>"23 25", 'weight'=>"50");
		return $result;
}


}//catalogo_gps{

?>