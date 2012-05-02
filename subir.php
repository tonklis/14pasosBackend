<?php
include("clases/main_lib.php");
$uploaddir = ruta_absoluta.'/usrfiles/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
   echo "<div id='nombre_imagen' status='ok'>".$uploadfile."</div>";
} else {
  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
  // Otherwise onSubmit event will not be fired
  echo "<div id='nomre_imagen' status='er'>Error!-".$_FILES['userfile']['name']."</div>";
}
?>