<?php
/**
* Clase para el manejo del Catálogo arte
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
class catalogo_arte{

/**
* Constructor de la case
*
* Se carga el controlador de BD y se preparan variables de entorno de ser necesario
* @global string $conex que contiene la conexion a base de datos
* @param array|string $parametros arreglo con los diversos parámetros a incluir
* realizó.
*
* 
* @author Daniel Garnier Paris
* @version 1.0
* @copyright Daniel Garnier Paris
*/
function __construct($parametros){
//Control de las plantillas

if($parametros["tipo_instancia"]=="primaria")
{
  include("clases/main_lib.php");
  include("bd.php");
  global $conex;
}
 
}//function __construct($parametros){


/**
* Metodo carga_individual
* Muestra el panel para cargar imagenes de manera individual, de una en una
* Presenta el listado de elección de deportes
*
*
* @return array  $salida[respuesta]=ER para error,OK para correcto, $salida[plantilla]=codigo html para cargar las imagenes, $salida[adicional1]=""
*
* @author Daniel Garnier Paris
* @version 1.0
*/
function forma_carga_individual($parametros)
{
global $conex;

$salida='
       <form id="frm_carga" name="frm_carga">
	   <fieldset id="main_fields" class="single_text">
	   <input type="hidden" id="usuario_id" name="usuario_id" value="1"/>
  	   <legend>Indique los datos de la foto</legend>
	   <p>
	     <label for="entidad">Entidad</label><br/>
	     <select id="entidad_id" name="entidad_id">
		 <option value="9">Distrito Federal</option>
		 <option value="15">Estado de M&eacute;xico</option>
		 <option value="17">Morelos</option>
		 </select>
       </p>
	    <p>
	     <label for="referencia">Referencia</label><br/>
	     <input type="text" id="referencia" name="referencia" size="50" maxlength="50"/>
      </p>
	  	  <p>
	     <label for="fotografo">Fotografo</label><br/>
	      <input type="text" id="fotografo" name="fotografo" size="50" maxlength="50"/>
      </p>
	  <p>
	     <label for="fecha_foto">Fecha Foto</label><br/>
	      <input type="text" id="fecha_foto" name="fecha_foto" size="50" maxlength="50" class="fecha"/>
      </p>
	   <p>
	     <label for="foto_titulo">T&iacute;tulo</label><br/>
	      <input type="text" id="foto_titulo" name="foto_titulo" size="50" maxlength="50"/>
      </p>
	  <label for="foto_descripcion">Descripci&oacute;n</label><br/>
	  <textarea id="foto_descripcion" name="foto_descripcion" cols="48" rows="5"></textarea>
	   <div id="upload">
	     <p>
 	       <label for="archivo">&iquest;Desea subir una foto?: </label>
	       <ul>
	        <li id="example1" class="example">
		      <div class="wrapper">
			     <div id="button1" name="button1" class="button">Subir</div>
		      </div>
		       <ol id="files" name="files" class="files"></ol>
	        </li>
         </ul>
	    </p>
	   </div>
     </fieldset>
	 <p>
	   <input type="button" id="btn_procesar" name="btn_procesar" value="Procesar"/>
	</p>
  </form>';

//Arreglo de salida
$respuesta="OK"; 
$plantilla=$salida;
$adicional1="";//print_r($array_deporte);

$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}

function carga_individual($parametros){
global $conex;

if(isset($parametros["fotografo"])){
   $fotografo=$parametros["fotografo"];
}else{
   $fotografo="";
}

if(isset($parametros["foto_titulo"])){
   $foto_titulo=$parametros["foto_titulo"];
}else{
   $foto_titulo="";
}

if(isset($parametros["foto_descripcion"])){
   $foto_descripcion=$parametros["foto_descripcion"];
}else{
   $foto_descripcion="";
}


$archivo=ruta_absoluta."/usrfiles/".$parametros["nombre_archivo"];

$thumb=thumbnail2($archivo);
$comping=comping2($archivo);

$qry_foto="INSERT INTO fotos_galeria SET usuario_id=".$parametros["usuario_id"].", entidad_id=".$parametros["entidad_id"].", referencia='".$parametros["referencia"]."', fotografo='".$fotografo."', foto_titulo='".$foto_titulo."', foto_descripcion='".$foto_descripcion."' , thumbnail='".$thumb."', comping='".$comping."'";

$res_foto=$conex->query($qry_foto);
if($res_foto){
$respuesta="OK";
$plantilla="Se agrego la foto con exito";
unlink($archivo);
}else{
$respuesta="ER";
$plantilla="Ocurrio un error: $qry_foto ".$conex->error;
}

$adicional1="";

$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}
	
}//catalogo_gps{

?>