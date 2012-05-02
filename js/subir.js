function subir(){
//Funcion para subir archivos
var button = $('#button1'), interval;
	new AjaxUpload(button,{
		action: 'subir.php',  
		responseType: 'text/html',
		name: 'userfile',
		onSubmit : function(file, ext){
		    //alert(file);
			// change button text, when user selects file			
			button.text('Subiendo');
			
			// If you want to allow uploading only 1 file at time,
			// you can disable upload button
			this.disable();
			
			// Uploding -> Uploading. -> Uploading...
			interval = window.setInterval(function(){
			var text = button.text();
			if (text.length < 13){
					button.text(text + '.');					
				} else {
					button.text('Subiendo');				
			}
		 }, 200);//on submit
		},
		onComplete: function(file, response){
			button.text('Subir');
			window.clearInterval(interval);
				
			this.enable();
			$('<li id="nombre_archivo" archivo=""></li>').appendTo('#example1 .files').text(file);
			$("#nombre_archivo").attr("archivo",file);
		}//on complete
});
}//Function boton