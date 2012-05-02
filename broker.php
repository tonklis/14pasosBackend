<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
/**
* Gestor de clases
*
* Mediante el patron Factory instancia cada clase. 
* Recibe y envia los datos.
*
* @author: Daniel Garnier Paris
* @package MacroSport
*/
/**
* Funcion Gestor
* Crea las instancias de clase 
*@author: Daniel Garnier Paris
*@version: beta
*/
echo gestor($_POST);

function gestor($parametros)
{
	
     if (include_once 'clases/class_'.$parametros["clase"]. '.php') {
            $oClase = new $parametros["clase"]($parametros);
			$salida=$oClase->$parametros["metodo"]($parametros);
			return $salida;
        } else {
            throw new Exception('clase no encontrada');
        }
}//function gestor($clase,$metodo,$parametros="")
?>