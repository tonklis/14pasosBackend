<?php
global $conex;
/**
 * Conexion a la base de datos.
 * @author Daniel Garnier Paris <dgarnier@dgparis.com>
 * @version preAlpha
 * @package miliga
 * @copyright Copyright (c) 2011-2012
 */
$conex=new mysqli('localhost', 'u199904_14pasos', '14pasos2012', 'u199904_14pasos');
$acentos = $conex->query("SET NAMES 'utf8'");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
?>