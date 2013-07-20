$(document).on('ready', function(){

	var visible = false;
	var div = $("#form");
	var boton = $('#open_form');
	var inicio = 0;
    var limite = 2;
    var ocupado = false;

	$("#open_form").on('click', function(){
		
		if (visible == false) {
			div.fadeIn(1500);
			visible = true;
			$(boton).text("Cancelar");
		}else{
			div.fadeOut(1000);
			visible = false;
			$(boton).text("Realiza una pregunta");
		}
	});
	//Funcion AJAX nueva pregunta
	function postearPregunta(pregunta, mensaje, tag){
        $.ajax({
	        url: "includes/nuevoTema.php",
	        type: 'POST',
	        data: {pregunta: pregunta, mensaje: mensaje, tag: tag},
	        dataType: "json",
	        success: function(datos){
	        	if(datos == "true"){
	        		div.fadeOut(1500);
	        		visible = false;
	        		$('#mensajes_form').html('<h2>Pregunta publicada con exito</h2>');
	        		$(boton).text("Realiza otra pregunta");
	        	}
	        	else if(datos == "false"){
	        		div.fadeOut(1500);
	        		visible = false;
	        		$('#mensajes_form').html('<h1>Ocurrio un error intente mas tarde</h1>');
	        		$(boton).text("Realiza una pregunta");
	        	}
	        	else{
	        		$.each(datos, function(c, v){
		                var total = v.total;		               
		                if(total == 0){
		                    total = '<div class="num_respuestas_cero">Sé el primero en responder</div>';
		                }
		                else if(total == 1){
		                    total = '<div class="num_respuestas">'+total+' respuesta</div>';
		                }else{
		                    total = '<div class="num_respuestas">'+total+' respuestas</div>';
		                }
	                	$(".contenido").prepend(
                            '<article class="area_preguntas"><div class="mensaje_foro">'+
                            v.mensaje+'</div><div class="fecha_foro"><span data-livestamp="'+
                            moment(v.fecha).unix()+'"></span></div>'+total+
                            '<br><div class="tags_foro">'+v.tag+'</div></article>'
                        );
            		});
            		div.fadeOut(1500);
	        		visible = false;	         
	        		$(boton).text("Publicación exitosa");
	        		$('#pregunta').val("");
	        		$('#msg').val("");	        		
	        	}
	        	inicio = inicio + 1; 
	        },
	        error: function (xhr, ajaxOptions, thrownError) {
	            console.log(xhr.status);
	            console.log(thrownError);
	            $(boton).text("Ocurrio un error");          
	            $('#pregunta').val("");
	        	$('#msg').val("");
	        }
	    });
        $('#mensajes_form').html("<h2>Haz tu pregunta aquí</h2>");
    };
    //Ajax peticion de preguntas
    function peticion(){
        $.ajax({
        url: "includes/preguntas.php",
        type: 'POST',
        data: {inicio: inicio, limite: limite},
        dataType: "json",
        success: function(data){
        if(data == "no"){
            $('button#cargando').html('<center>No hay mas preguntas</center>'); 
            $(window).off("scroll");
            $('button#cargando').off("click").addClass('boton_error');
        }
        else{
            $.each(data, function(c, v){
                var total = v.total;
                if(total == 0){
                    total = '<div class="num_respuestas_cero">Sé el primero en responder</div>';
                }
                else if(total == 1){
                    total = '<div class="num_respuestas">'+total+' respuesta</div>';
                }else{
                    total = '<div class="num_respuestas">'+total+' respuestas</div>';
                }
                $(".contenido").append(
                    '<article class="area_preguntas"><div class="mensaje_foro">'+
                    v.mensaje+'</div><div class="fecha_foro"><span data-livestamp="'+
                    moment(v.fecha).unix()+'"></span></div>'+total+
                    '<br><div class="tags_foro">'+v.tag+'</div></article>'
                );
            });
            inicio = inicio + limite;            
        }
            ocupado = false;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $('button#cargando').html('<center>Ocurrio un error. Intente mas tarde.</center>'); 
            $(window).off("scroll");
            $('button#cargando').off("click");
            ocupado = false;
        }
        });
        }
    //Validar formulario de pregunta
    function validar(){    	
    	if($('#pregunta').val().length < 10){
    		$('#mensajes_form').html("<h1>La pregunta debe contener mas de 10 caracteres</h1>").hide().fadeIn(1000);
    		$('#pregunta').focus(); 
    		return false;
    	}
    	else if($('#msg').val().length < 20){
    		$('#mensajes_form').html("<h1>Tu descripcion debe contener mas de 20 caracteres</h1>").hide().fadeIn(1000);
    		$('#msg').focus(); 
    		return false;
    	}
    	return true;
    };

    $('#form_preguntar').on('submit', function(e){
    	e.preventDefault();
    	if (validar()) {
    		var pregunta = $('#pregunta').val();
    		var mensaje = $('#msg').val();
            var tag1 = $('#tags').val();
            if(tag1 != null)
            var tag = tag1.toString().replace(/\,/g,' ');
            //regresar = importe.toString(); 
    		postearPregunta(pregunta, mensaje, tag);
    	}
    });
    //
    $(window).on("scroll", function(){
        //if($(window).scrollTop() == $(document).height() - $(window).height())
        if($(window).scrollTop() + $(window).height() > $('boton#cargando').height() && !ocupado)
        {                
            ocupado = true;
            setTimeout(function() {            
                peticion();
            }, 500);
        }
    });
    $('button#cargando').on("click", function(){
        if(ocupado == false) {
            ocupado = true;
            peticion();
        }
    });
    //
    peticion();
});