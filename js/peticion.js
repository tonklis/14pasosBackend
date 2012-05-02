/*
*Aqui se haran las petiiones para los los procesos de inicio. 
*utilizado el parámetro iniciar evitamos iniciar sesión.
*cualquier otra petricion requiere que el usuario tenga iniciada sesión.
*Los paramentros para la peticion son:
*clase=Nombre de la clase a invocar
*Metodo=Nombre del método a invocar 
*Parametros= Informacion adicionales en formato par:valor, separados por comas y como cadena"
*  siempre se deberá indicar si una instancia de clase es primaria o secundaria.
*Modo= Indica si se utilizará la validación de sesión o no (unicamente para metodos de inicio)
*Destino= el div donde se presentará la respuesta)"
*
*Nota importante: si se esta utilizando un metodo comobo, se invocará el metodo combo cascada, con base al nombre de clase.
*/

function peticion(clase,metodo,parametros,destino){
	datos="&clase="+clase+"&metodo="+metodo+parametros;
	//alert(datos);
    var salida=$.ajax({
                      type: "POST",
                      url: "broker.php",
                      data: datos,
					  contentType: "application/x-www-form-urlencoded; charset=utf-8",
					  dataType: "json",
					  success: function(respuesta){
						 //alert(respuesta["respuesta"]);
					     if(respuesta["respuesta"]=="OK"){
							$("#formulario_login").hide("slow"); 	 
						    $(destino).empty().html(respuesta["plantilla"]);
							$(".boton").css("font-size","10px").button();
							
							$("#alta_usuarios").click(function(){
							  alta_usuarios();
							});
							
							$("#editar_usuarios").click(function(){
							   editar_usuarios();
							})
							
							$("#admon_usuarios").click(function(){
							   admon_usuarios();
							});
							
							$("#gps_carga_individual").click(function(){
							   gps_carga_individual();
							});
							
							$("#gps_carga_masiva").click(function(){
							   gps_carga_masiva();
							});
							
							$("#gps_administrar_fotos").click(function(){
							    gps_administrar_fotos();
							});
							
							$("#art_carga_individual").click(function(){
							    art_carga_individual();
							});
							
							$("#art_carga_masiva").click(function(){
							    art_carga_masiva();
							});
							
							$("#art_administrar_fotos").click(function(){
							    art_administrar_fotos();
							});
							
							$("#cerrar_sesion").click(function(){
							    cerrar_sesion();
							});
							
						 }else{
						    $(destino).empty().html(respuesta["plantilla"]);
						 }
                      },
					  error: function(XMLHttpRequest, textStatus, errorThrown){
                        $(destino).text(textStatus+" "+errorThrown);
                      }
	             });//ajax	   
      return salida;				
}//


function peticion2(clase,metodo,parametros,destino){
	datos="&clase="+clase+"&metodo="+metodo+parametros;
    var salida=$.ajax({
                      type: "POST",
                      url: "broker.php",
                      data: datos,
					  contentType: "application/x-www-form-urlencoded; charset=utf-8",
					  dataType: "json",
					  success: function(respuesta){
						 //alert(respuesta["respuesta"]);
						    $(destino).hide("fast").empty().html(respuesta["plantilla"]);
                      },
					  error: function(XMLHttpRequest, textStatus, errorThrown){
                        $(destino).text(textStatus+" "+errorThrown);
                      }
	             });//ajax	   
      return salida;				
}//


function admon_usuarios(){
   alert("Usuarios");
}

function gps_carga_individual(){
	    resultado=peticion("catalogo_gps","forma_carga_individual","&tipo_instancia=primaria","#area_trabajo");
		resultado.done(function(respuesta){
			if(respuesta["respuesta"]=="OK"){
	          subir();
			  $("#btn_procesar").click(function(){
			   parametros=$("#frm_carga").serialize();
			   parametros="&"+parametros+"&nombre_archivo="+$("#nombre_archivo").attr("archivo")+"&tipo_instancia=primaria";
			   alert(parametros);
			   peticion("catalogo_gps","carga_individual",parametros,"#area_trabajo");
			  })
			}
		})//resultado.done						
}

function gps_carga_masiva(){
   alert("gps_carga_masiva");
}

function gps_administrar_fotos(){
   alert("gps_administrar_fotos");
}

function art_carga_individual(){
   alert("art_carga_individual");
}

function art_carga_masiva(){
   alert("art_carga_masiva");
}

function art_administrar_fotos(){
   alert("art_administrar_fotos");
}

function cerrar_sesion(){
 $("#aux_form").remove();	
 var salir=peticion2("usuario","cerrar_sesion","","#usuario_respuesta")
 salir.done(function(respuesta){
    if(respuesta["respuesta"]=="OK"){
	$('#frm_login').clearForm();	
	 $("#formulario_login").show("slow", function(){
	     $("#area_trabajo").hide("fast"); 
		 $("#usuario_respuesta").show("fast"); 	 
	  }); 
	
	}
 })
}


function alta_usuarios(){
$("#aux_form").remove();
var respuesta=peticion2("usuario","form_usuarios","","#area_trabajo");
 respuesta.done(function(resultado){
  if(resultado["respuesta"]=="OK"){
	  
	$("#form_usuario").validate({
	   rules:{
	          usuario_nombre:"required",
			  usuario_user:"required",
			  usuario_pwd:"required"
			  
	   },
	
	   messages:{
	           usuario_nombre:"Debe escribir el nombre",
			  usuario_user:"Se require un usuario",
			  usuario_pwd:"Es necesario un password"
	   }  
	});
	  
	$("#agregar_usuario").button().click(function(){
     var procesar=$("#form_usuario").valid();
	    if(procesar==true){
		
		parametros="&"+$("#form_usuario").serialize();
		var salida=peticion2('usuario','alta_usuario',parametros,"#respuesta_usuario");
		    salida.done(function(respuesta){
				if(resultado["respuesta"]=="OK"){
				 $("#respuesta_usuario").show("slow");
		          $('#form_usuario').clearForm();
				}
 	        })//salida.done(function(respuesta){

	     }//if
     })//$("#agregar_tema").button().click(function(){
	 $("#area_trabajo").show("slow");	 
  }//if(resultado["respuesta"]=="OK"){						
 })//respuesta.done(function(resultado){
}


function editar_usuarios(){
  $("#aux_form").remove();
 
  var respuesta=peticion2("usuario","listar_usuarios","","#area_trabajo");
  respuesta.done(function(){
						  
	$("#listado_articulos").pajinate({
	            items_per_page : 4,
				nav_label_first : '<<',
				nav_label_last : '>>',
				nav_label_prev : '<',
				nav_label_next : '>'
	});

    $("#area_trabajo").show("slow");
	
    $(".edit_usuario").click(function(){
	     editar_usuario($(this).attr('usuario_id'));
	})
  })//respuesta.done(function(){

}



function editar_usuario(usuario){
  $("#aux_form").remove();
  var respuesta=peticion2("usuario","editar_usuario","&usuario_id="+usuario,"#area_trabajo");
  respuesta.done(function(resultado){
    if(resultado["respuesta"]=="OK"){
	  
	  $("#edit_usuario").validate({
	   rules:{
	          usuario_nombre:"required",
			  usuario_user:"required",
			  usuario_pwd:"required"
			  
	   },
	
	   messages:{
	          usuario_nombre:"Debe escribir el nombre",
			  usuario_user:"Se require un usuario",
			  usuario_pwd:"Es necesario un password"
	   }  
	});
	  
	  $("#actualizar_usuario").button().click(function(){
	     var procesar=$("#edit_usuario").valid();
	     if(procesar==true){
		    parametros="&"+$("#edit_usuario").serialize();
		    
		    var salida=peticion2('usuario','guardar_usuario',parametros,"#respuesta_usuario");
		    salida.done(function(respuesta){
				if(resultado["respuesta"]=="OK"){
				   $("#respuesta_usuario").show("slow");
			    }
 	        })//salida.done(function(respuesta){

	     }//if
		  
       })//$("#agregar_articulo").button().click(function(){

	  $("#area_trabajo").show("slow", function(){
	  });
    }
  })
}

function preparar(cadena){
  cadena=cadena.replace(/=/g,"^");
  cadena=cadena.replace(/&/g,"|");
return cadena;
}


function combo_cascada(combo){
  //alert("combo");
  $("#"+combo).change(function(){
   parametros=$(this).attr("name")+"="+$(this).val()+'&tipo_instancia=primaria';	
   parametros=preparar(parametros);
  // alert(parametros);
   peticion($(this).attr("clase"), $(this).attr("metodo"),parametros, "iniciar" ,"#"+$(this).attr("metodo"));
   
  })//$("#"+combo).change(function()

}//combo_cascada(combo){
	
	
	
$.fn.clearForm = function() {
      return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
          return $(':input',this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea')
          this.value = '';
        else if (type == 'checkbox' || type == 'radio')
          this.checked = false;
        else if (tag == 'select')
          this.selectedIndex = -1;
      });
};

	