function menu(){

//Prepara el menu principal
$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)  
  
    $("ul.topnav li span").click(function() { //When trigger is clicked...  
  
        //Following events are applied to the subnav itself (moving subnav up and down)  
        $(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click  
  
        $(this).parent().hover(function() {  
        }, function(){  
            $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up  
        });  
  
        //Following events are applied to the trigger (Hover events for the trigger)  
        }).hover(function() {  
            $(this).addClass("subhover"); //On hover over, add class "subhover"  
        }, function(){  //On Hover Out  
            $(this).removeClass("subhover"); //On hover out, remove class "subhover"  
}); 

//Carga las peticiones a los menues.

$("#admon_usuarios").click(function(){
	   peticion("usuarios","administracion","tipo_instancia^primaria|usuario^daniel"," ","#area_trabajo");									
})
	
$("#gps_carga_individual").click(function(){
	    resultado=peticion("catalogo_gps","forma_carga_individual","tipo_instancia^primaria"," ","#area_trabajo");
		resultado.done(function(respuesta){
			if(respuesta["respuesta"]=="OK"){
	          subir();
			  $("#btn_procesar").click(function(){
			   parametros=preparar($("#frm_carga").serialize());
			   parametros=parametros+"|nombre_archivo^"+$("#nombre_archivo").attr("archivo")+"|tipo_instancia^primaria";
			   //alert(parametros);
			   peticion("catalogo_gps","carga_individual",parametros," ","#area_trabajo");
			  })
			}
		})//resultado.done						
})

$("#gps_carga_masiva").click(function(){
	peticion("catalogo_gps","consulta","tipo_instancia^primaria"," ","#area_trabajo");								
})


$("#gps_administrar_fotos").click(function(){
		depurar();						 
	    resultado=peticion("catalogo_gps","carga_masiva","tipo_instancia^primaria"," ","#area_trabajo");
		resultado.done(function(respuesta){
		  if(respuesta["respuesta"]=="OK"){
		    $("#listado_fotos").pajinate({
	            items_per_page : 5,
				nav_label_first : '<<',
				nav_label_last : '>>',
				nav_label_prev : '<',
				nav_label_next : '>'
		     });
		  }
		})
})

$("#art_carga_individual").click(function(){
	    resultado=peticion("catalogo_arte","forma_carga_individual","tipo_instancia^primaria"," ","#area_trabajo");
		resultado.done(function(respuesta){
			if(respuesta["respuesta"]=="OK"){
	          subir();
			  $("#btn_procesar").click(function(){
			   parametros=preparar($("#frm_carga").serialize());
			   parametros=parametros+"|nombre_archivo^"+$("#nombre_archivo").attr("archivo")+"|tipo_instancia^primaria";
			   //alert(parametros);
			   peticion("catalogo_arte","carga_individual",parametros," ","#area_trabajo");
			  })
			}
		})//resultado.done											
})

$("#art_carga_masiva").click(function(){
	peticion("catalogo_gps","carga_masiva","tipo_instancia^primaria"," ","#area_trabajo");								
})


$("#art_administrar_fotos").click(function(){
		depurar();						 
	    resultado=peticion("catalogo_gps","carga_masiva","tipo_instancia^primaria"," ","#area_trabajo");
		resultado.done(function(respuesta){
		  if(respuesta["respuesta"]=="OK"){
		    $("#listado_fotos").pajinate({
	            items_per_page : 5,
				nav_label_first : '<<',
				nav_label_last : '>>',
				nav_label_prev : '<',
				nav_label_next : '>'
		     });
		  }
		})
})

}

