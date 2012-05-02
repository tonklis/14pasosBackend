<?php
include("bd.php");
global $conex;
$busca="SELECT comping FROM fotos WHERE foto_id=".$_GET["id"];
$res =$conex->query($busca);
$result_array = mysqli_fetch_array($res);
mysqli_free_result  ($res);
header("Content-Type: image/jpeg");
echo $result_array[0];
?>