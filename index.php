
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="conten-type" content="text/html; charset=UTF-8" />
<title>14Pasos: Administracion</title>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<link rel="stylesheet" href="css/estilo_principal.css"/>
<link rel="stylesheet" href="css/menu.css"/>
<link rel="stylesheet" href="css/jquery-ui-1.8.18.custom.css" />

<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/mensajes.js"></script>
<script type="text/javascript" src="js/jquery.pajinate.js"></script>
<script type="text/javascript" src="js/ajaxupload.3.6.js"></script>

<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/peticion.js"></script>
<script type="text/javascript" src="js/subir.js"></script>

<script type="text/javascript">
$(function(){

 $("#frm_login").validate({
	rules:{
	usuario:"required",
	clave:"required"
	},
	
	messages:{
	 usuario: "Debe escribir su nombre de usuario",
	 clave:"Debe ingresar su password"
	}
});

$("#btn_acceso").button();

$("#btn_acceso").click(function(){
   var procesar=$("#frm_login").valid();
   if(procesar==true){
	  parametros="&"+$("#frm_login").serialize();
	  peticion("usuario","ingresar",parametros,"#usuario_respuesta")
   }
});

});
</script>
</head>
<body>
<div  style="width:1110px; position: relative; margin-left: auto; margin-right: auto;">
<div id="pleca_superior" style="width:900px;height:129px; background-image:url(img/logo.png); background-repeat:no-repeat;margin-left:150px; margin-bottom:15px;"></div>
   <div id="formulario_login" style="width:400px; margin-top:150px; margin-left:150px;">
      <form id="frm_login" name="frm_login">
        <fieldset>
           <legend class="texto_azul">Ingrese sus datos de acceso</legend>
           <div style="float:none">
              <div style="float:left; width:100px"><label class="texto_azul" for="usuario">Usuario</label></div>
              <div>
                 <input type="text" id="usuario" name="usuario" size="50px" maxlength="50" />
                 <span></span> 
              </div>
           </div>
           <br/>   
           <div style="float:none">
               <div style="float:left; width:100px"><label class="texto_azul" for="clave">Password</label></div>
              <div>
                 <input type="password" id="clave" name="clave" size="50px" maxlength="50" />
                 <span></span>
              </div>
           </div>
           <br />   
           <a href="#" id="btn_acceso" style="font-size:10px">Enviar</a>
        </fieldset>
     </form>
   </div>
<div id="usuario_respuesta">
</div>
<div id="area_trabajo" style="margin-top:50px; margin-left:10px">
</div>      
</div>

</body>
</html>