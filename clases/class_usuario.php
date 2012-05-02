<?php
class usuario{

function __construct(){
include("bd.php");
global $conex;

}

function ingresar($parametros){
global $conex;

$qry_user="SELECT usuario_id, usuario_nombre, usuario_user,usuario_pwd FROM usuarios WHERE usuario_user='".$parametros["usuario"]."' AND usuario_pwd='".$parametros["clave"]."'";

$res_user=$conex->query($qry_user);

if($res_user->num_rows>0){
  $respuesta="OK"; 
  while($ar_user=$res_user->fetch_array(MYSQLI_BOTH)){
     $_SESSION["usuario"]=$ar_user["usuario_nombre"];
  }
  $plantilla='<div id="menu" style="float:none;width:1024px;">
   <a id="alta_usuarios" class="boton">Alta Usuarios</a>
   <a id="editar_usuarios" class="boton">Editar Usuarios</a>
   <a id="gps_carga_individual" class="boton" style="font-size:10px">GPS Carga Individual</a>
   <a id="gps_carga_masiva" class="boton" style="font-size:10px">GPS Carga Masiva</a>
   <a id="gps_administrar_fotos" class="boton" style="font-size:10px">GPS Administrar Fotos</a>
   <a id="art_carga_individual" class="boton" style="font-size:10px">ARTE Carga Individual</a>
   <a id="art_carga_masiva" class="boton" style="font-size:10px">ARTE Carga Masiva</a>
   <a id="art_administrar_fotos" class="boton" style="font-size:10px">ARTE Administrar Fotos</a>
   <a id="cerrar_sesion" class="boton" style="font-size:10px">Cerrar Sesi&oacute;n</a>
</div>';
  
}else{
  $respuesta="ER"; 
  $plantilla="Usuario / Pasword err&oacute;neos";

}


$adicional1=$qry_user;
$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}


function form_usuarios(){

$respuesta="OK";
$plantilla='
<div id="aux_form" style=" width:730px">
<form id="form_usuario" name="form_usuario" style="padding:15px;">
<label class="texto_azul" for="usuario_nombre" >Nombre:</label>
<br />
<input type="text" id="usuario_nombre" name="usuario_nombre" maxlength="60" size="60"  />
<br />
<br />
<label class="texto_azul" for="usuario_user" >Usuario:</label>
<br />
<input type="text" id="usuario_user" name="usuario_user" maxlength="60" size="60"  />
<br />
<br />
<label class="texto_azul" for="usuario_pwd" >Password:</label>
<br />
<input type="text" id="usuario_pwd" name="usuario_pwd" maxlength="60" size="60"  />
<br />
<br />
<a name="agregar_usuario" id="agregar_usuario" style="font-size:10px">Agregar</a>
</form>
<br/>
<div id="respuesta_usuario"></div>
</div>';


$adicional1="";

$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}


function alta_usuario($parametros){
global $conex;

$qry_alta="INSERT INTO usuarios SET usuario_nombre='".$parametros["usuario_nombre"]."', usuario_user='".$parametros["usuario_user"]."', usuario_pwd='".$parametros["usuario_pwd"]."', auditoria_usuario='".$_SESSION["usuario"]."'";
$res_alta=$conex->query($qry_alta);

if($res_alta){
  $respuesta="OK";	
  $plantilla="Se dio de alta correctamente el usuario";
}else{
  $respuesta="ER";
  $plantilla="Ocurrio un error de query->$qry_alta, $conex->error";
}
$adicional1="";

$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}//function alta_articulo



function listar_usuarios(){
global $conex;
$plantilla="
<div id='aux_form' style='width:900px;height:600px;'>
<div id='cabecera'>
    <div class='cel_encabezado' style='width:100px;'>Usuario Id</div>
    <div class='cel_encabezado' style='width:150px;'>Nombre</div>
	<div class='cel_encabezado' style='width:150px'>Usuario</div>
	<div class='cel_encabezado' style='width:150px'>Dado de alta por:</div>
	<div class='cel_encabezado' style='width:150px'>Fecha</div>
</div>
<div id='listado_usuarios'>
  <div class='page_navigation'></div>
    <div class='content'>";
$qry_usuario="SELECT usuario_id AS id, usuario_nombre AS nombre, usuario_user AS user, auditoria_usuario AS autor, auditoria_fecha AS fecha
FROM usuarios";
$res_usuario=$conex->query($qry_usuario);

if($res_usuario){
   $respuesta="OK"; 
   while($ar_usuario=$res_usuario->fetch_array(MYSQLI_BOTH)){

     $plantilla.="
  <div class='renglon'>
	<div class='cel_renglon' style='width:100px;font-weight:bold;'>
	    <p style='padding-top:25px;'>
	       <a href='#' class='edit_usuario' usuario_id='".$ar_usuario["id"]."'>".$ar_usuario["id"]."</a>
	    </p>
    </div>
	<div class='cel_renglon' style='width:150px;font-weight:bold;'><p style='padding-top:25px;'>".$ar_usuario["nombre"]."</p></div>  
	<div class='cel_renglon' style='width:150px;font-weight:bold;'><p style='padding-top:25px;'>".$ar_usuario["user"]."</p></div>
	<div class='cel_renglon' style='width:150px;font-weight:bold;'><p style='padding-top:25px;'>".$ar_usuario["autor"]."</p></div>
	<div class='cel_renglon' style='width:150px;'><p style='padding-top:25px;'>".$ar_usuario["fecha"]."</p></div>
  </div>";
	 
    }//while($ar_deporte=$res_deporte->fetch_array(MYSQLI_BOTH)){
}else{
	  $respuesta="ER";
	  $plantilla="Ocurrio un error de query->$qry_usuario, $conex->error";
}//if($res_subtemas){
	
if($respuesta=="OK")
{
  $plantilla.="      </div><!--content-->
                     <div class='page_navigation'></div>
                   </div><!--listado usuario-->
				 </div><!--aux form-->";
}

$adicional1="";
$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}



function editar_usuario($parametros){

global $conex;

$qry_usuario="SELECT usuario_id, usuario_nombre, usuario_user, usuario_pwd FROM usuarios WHERE usuario_id=".$parametros["usuario_id"];
$res_usuario=$conex->query($qry_usuario);

if($res_usuario){
   $respuesta="OK"; 
   while($ar_usuario=$res_usuario->fetch_array(MYSQLI_BOTH)){
  
	 $plantilla='
<div id="aux_form" style=" width:730px">
<form id="edit_usuario" name="edit_usuario" style="padding:15px;">
<input type="hidden" id="usuario_id" name="usuario_id" value="'.$parametros["usuario_id"].'" />
<label class="texto_azul" for="usuario_nombre" >Nombre:</label>
<br />
<input type="text" id="usuario_nombre" name="usuario_nombre" maxlength="60" size="60" value="'.$ar_usuario["usuario_nombre"].'" />
<br />
<br />
<label class="texto_azul" for="usuario_user" >Usuario:</label>
<br />
<input type="text" id="usuario_user" name="usuario_user" maxlength="60" size="60" value="'.$ar_usuario["usuario_user"].'" />
<br />
<br />
<label class="texto_azul" for="usuario_pwd" >Password:</label>
<br />
<input type="text" id="usuario_pwd" name="usuario_pwd" maxlength="60" size="60" value="'.$ar_usuario["usuario_pwd"].'" />
<br />
<br />
<a name="actualizar_usuario" id="actualizar_usuario" style="font-size:10px">Actualizar</a>
</form>
<br/>
<div id="respuesta_usuario"></div>
</div>';
	 
	 
	 
    }
}else{
	  $respuesta="ER";
	  $salida="Ocurrio un error de query->$qry_usuario, $conex->error";
}

$adicional1="";
$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}




function guardar_usuario($parametros){
global $conex;

$qry_usuario="UPDATE usuarios SET usuario_nombre='".$parametros["usuario_nombre"]."', usuario_user='".$parametros["usuario_user"]."', usuario_pwd='".$parametros["usuario_pwd"]."', auditoria_usuario='".$_SESSION["usuario"]."' WHERE usuario_id=".$parametros["usuario_id"];
$res_usuario=$conex->query($qry_usuario);

if($res_usuario){
   $respuesta="OK";
   $plantilla="Se actualizo correctamente el usuario";
}else{
   $respuesta="ER";
   $plantilla="Ocurrio un error de query->$qry_usuario, $conex->error";
}
$adicional1="";
$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;
}//function guardar_usuario

function cerrar_sesion($parametros){
$respuesta="OK";
$plantilla="Hasta luego ".$_SESSION["usuario"];
session_destroy();
$adicional1="";
$salida=array("respuesta"=>$respuesta,"plantilla"=>$plantilla,"adicional1"=>$adicional1);
$salida=json_encode($salida);
return $salida;	
}

}//class usuario