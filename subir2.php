<?php
include("clases/main_lib.php");
require_once("clases/coordinates.functions.php");
include("clases/class_catalogo_gps.php");
include("bd.php");


$archivo=basename($_FILES['userfile']['name']);
//echo $archivo;
$uploaddir = ruta_absoluta.'/usrfiles/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	$parametros=array("usuario_id"=>"2","entidad_id"=>$_POST["idestado"],"usuario"=>$_POST["usuario"],"nombre_archivo"=>$archivo,"latitud"=>$_POST["lat"],"longitud"=>$_POST["long"]);
	$parametros1=array("tipo_instancia"=>"secundaria");
	$catalogo=new catalogo_gps($parametros1);
	$res=$catalogo->carga_individual($parametros);
	//echo print_r($res);
   echo "<div id='nombre_imagen' status='ok'>"."Se ha subido el archivo correctamente"."</div>";
} else {
  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
  // Otherwise onSubmit event will not be fired
  echo "<div id='nomre_imagen' status='er'>Error!-".$_FILES['userfile']['name']."</div>";
}
?>