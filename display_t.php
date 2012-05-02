<?php
include("bd.php");
global $conex;
$busca="SELECT thumbnail FROM fotos WHERE foto_id=".$_GET["id"];
$res =$conex->query($busca);
$result_array = mysqli_fetch_array($res);
header("Content-Type: image/jpeg");
echo $result_array[0];
//echo $busca;
?>