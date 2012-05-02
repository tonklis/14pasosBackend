<?php
class catalogo {
	
function __construct(){

  include("bd.php");
  global $conex;
 
}//function __construct($parametros){
	
	
	function consulta($parametros="") {
		 global $conex;
		 $qry_fotos="SELECT foto_id,referencia, latitud, longitud, fotografo FROM fotos";
         $res_fotos=$conex->query($qry_fotos);

         if($res_fotos){
   
        $consulta=array();
        $contador=0;
        while($ar_fotos=$res_fotos->fetch_array(MYSQLI_BOTH)){
 
        $consulta[$contador]["foto_id"]=$ar_fotos["foto_id"];
        $consulta[$contador]["referencia"]=$ar_fotos["referencia"];
        $consulta[$contador]["latitud"]=$ar_fotos["latitud"];
        $consulta[$contador]["longitud"]=$ar_fotos["longitud"];
        $consulta[$contador]["fotografo"]=$ar_fotos["fotografo"];
		$consulta[$contador]["url_thumbnail"]="http://macrosport.com.mx/14pasos/display_t.php?id=".$ar_fotos["foto_id"];
		$consulta[$contador]["url_comping"]="http://macrosport.com.mx/14pasos/display.php?id=".$ar_fotos["foto_id"];
        $contador++;
        }
        }//if($res_edin){
		
		return $consulta;
	}
function prueba() {
		 global $conex;
		 $qry_fotos="SELECT foto_id,referencia, latitud, longitud, fotografo FROM fotos";
         $res_fotos=$conex->query($qry_fotos);

         if($res_fotos){
   
        $consulta=array();
        $contador=0;
        while($ar_fotos=$res_fotos->fetch_array(MYSQLI_BOTH)){
 
        $consulta[$contador]["foto_id"]=$ar_fotos["foto_id"];
        $consulta[$contador]["referencia"]=$ar_fotos["referencia"];
        $consulta[$contador]["latitud"]=$ar_fotos["latitud"];
        $consulta[$contador]["longitud"]=$ar_fotos["longitud"];
        $consulta[$contador]["fotografo"]=$ar_fotos["fotografo"];
        $contador++;
        }
        }//if($res_edin){
		
		return $consulta;
	}	
	
	function galeria($parametros="") {
		 global $conex;
		 $qry_fotos="SELECT foto_id,referencia, fotografo FROM fotos_galeria";
         $res_fotos=$conex->query($qry_fotos);

         if($res_fotos){
   
        $consulta=array();
        $contador=0;
        while($ar_fotos=$res_fotos->fetch_array(MYSQLI_BOTH)){
 
        $consulta[$contador]["foto_id"]=$ar_fotos["foto_id"];
        $consulta[$contador]["referencia"]=$ar_fotos["referencia"];
        $consulta[$contador]["fotografo"]=$ar_fotos["fotografo"];
		$consulta[$contador]["url_thumbnail"]="http://macrosport.com.mx/14pasos/show_t.php?id=".$ar_fotos["foto_id"];
		$consulta[$contador]["url_comping"]="http://macrosport.com.mx/14pasos/show.php?id=".$ar_fotos["foto_id"];
        $contador++;
        }
        }//if($res_edin){
		
		return $consulta;
	}

}