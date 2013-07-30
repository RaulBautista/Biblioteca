$(document).on('ready', function(){

	var div = $("#form");
	var boton = $('#open_form');
    var mensajes_foro = $('.msg_resp_foro');
	var inicio = 0;
    var limite = 3;
    var ocupado = false;
    var ultimo = false;

	$("#open_form").on('click', function(){
		div.fadeIn(1500);
        $('#fade').fadeIn(1000);		
        mensajes_foro.fadeOut("slow");
	});
    $('#close_form').on('click', function(){
        div.fadeOut(1000);
        $('#fade').fadeOut(1000);
    });
    $('#fade').on('click', function(){
        div.fadeOut(1000);
        $('#fade').fadeOut(1000);
    });    
	//Funcion AJAX nueva pregunta
    function numPreguntas(){
        $.ajax({
            url: "includes/numPreguntas.php",
            type: 'POST',
            dataType: "json",
            success: function(data){                
                $('.totalPreguntas p').text(data);
            }
        });
    }
    numPreguntas();
	function postearPregunta(pregunta, mensaje, tag){
        $.ajax({
	        url: "includes/nuevoTema.php",
	        type: 'POST',
	        data: {pregunta: pregunta, mensaje: mensaje, tag: tag},
	        dataType: "json",
            beforeSend: function(){
                mensajes_foro.html('<img src="img/preloader.gif">');
                mensajes_foro.fadeIn("slow");
            },
	        success: function(datos){
	        	if(datos == "false"){
	        		$(mensajes_foro).html('<h1>Ops! Algo salio mal</h1>');	        		
	        	}
	        	else{
	        		$.each(datos, function(c, v){
		                var total = v.total;		               
		                if(total == 0){
		                    total = '<div class="num_respuestas_cero">Sé el primero en responder</div>';
		                }
		                else if(total == 1){
		                    total = '<div class="num_respuestas">'+total+' comentario</div>';
		                }else{
		                    total = '<div class="num_respuestas">'+total+' comentarios</div>';
		                }
	                	$(".contenido").prepend(
                            '<article class="area_preguntas preg_last"><div class="mensaje_foro">'+
                            v.mensaje+'</div>'+
                            '<div class="votos_preg">'+v.votos+'<br>votos</div>'+
                            '<div class="fecha_foro"><span data-livestamp="'+
                            moment(v.fecha).unix()+'"></span></div>'+total+
                            '<br><div class="tags_foro">'+v.tag+'</div></article>'
                        );
                        $('.preg_last').hide().slideDown(1000);
            		}); 		         
	        		//$(mensajes_foro).html('<h2>Publicación exitosa</h2>');
                    $(mensajes_foro).hide();
	        		$('#pregunta').val("");
	        		$('#msg').val("");	        		
	        	}
	        	inicio = inicio + 1;
                ocupado = false;
                numPreguntas();
	        },
	        error: function (xhr, ajaxOptions, thrownError) {
	            console.log(xhr.status);
	            console.log(thrownError);
	            $(mensajes_foro).html('<h1>Ops! Algo salio mal</h1>');                
	            $('#pregunta').val("");
	        	$('#msg').val("");
                ocupado = false;
	        }            
	    });
        div.fadeOut(700);
        visible = false;
        $('#mensajes_form').html("<h2>Haz tu pregunta aquí</h2>");
        $(boton).text("Realiza una pregunta");
    };
    //Ajax peticion de preguntas
    function peticion(){
        $.ajax({
        url: "includes/preguntas.php",
        type: 'POST',
        data: {inicio: inicio, limite: limite},
        dataType: "json",
        beforeSend: function(){            
            $('button#cargando').html('<img src="img/preloader.gif" width="24px">');
        },
        success: function(data){
        $('button#cargando').text('Click para ver mas');
        if(data == "no"){
            $('button#cargando').html('<center>No hay mas preguntas</center>');
            //$(window).off("scroll");
            $('button#cargando').off("click").addClass('boton_error');
            ultimo = true;
        }
        else{
            $.each(data, function(c, v){
                var total = v.total;
                if(total == 0){
                    total = '<div class="num_respuestas_cero">Sé el primero en responder</div>';
                }
                else if(total == 1){
                    total = '<div class="num_respuestas">'+total+'<br>comentario</div>';
                }else{
                    total = '<div class="num_respuestas">'+total+'<br>comentarios</div>';
                }
                $(".contenido").append(
                    '<article class="area_preguntas"><div class="mensaje_foro">'+
                    v.mensaje+'</div>'+
                    '<div class="votos_preg">'+v.votos+'<br>votos</div>'+
                    total+                    
                    '<div class="fecha_foro"><span data-livestamp="'+
                    moment(v.fecha).unix()+'"></span></div>'+
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
            $('#fade').fadeOut(1000);
    		var pregunta = $('#pregunta').val();
    		var mensaje = $('#msg').val();
            var tag1 = $('#tags').val();
            if(tag1 != null)
            var tag = tag1.toString().replace(/\,/g,' ');
            ocupado = true;
    		postearPregunta(pregunta, mensaje, tag);
    	}
    });
    //
    $(window).on("scroll", function(){
    if(ultimo == false){
        if($(this).scrollTop() == $(document).height() - $(window).height() && !ocupado){
        //if($(window).scrollTop() + $(window).height() > $('boton#cargando').height() && !ocupado)                 
            ocupado = true;
            setTimeout(function() {            
                peticion();
            }, 100);            
        }
    }
    });
    $('button#cargando').on("click", function(){
        if(ocupado == false) {
            ocupado = true;
            peticion();
        }
    });
    //Subir boton
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) { //!=
        $('.subir').slideDown(500);
        } else {
        $('.subir').slideUp(500);
        }
        });

        $('.subir').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    //Busqueda
    //var resp = true;
    $('#busquedaForo').on('submit', function(ev){
        ev.preventDefault();
    })
    $('#buscar').focusin(function() {   
        $('.closeSearch').addClass('closeSearchAdd');
        $('.closeSearch').hide().fadeIn(500);
    });
    $('#buscar').focusout(function(){
        $('.closeSearch').fadeOut(500);
    });
    $('.closeSearch').on('click', function(){
        $('.contenido').hide().delay(500).fadeIn(900);
        $('.resultadoBusqueda').fadeOut(600);
        $('#cargando').hide().delay(900).fadeIn(300);
        $('#buscar').val('');
    })
    $('#buscar').on('keyup', function(){
        var abuscar = $(this).val();
        $('.contenido').hide().fadeOut(600);
        $('#cargando').hide();          
        if (abuscar.length > 2){
            busqueda(abuscar);
        }
    });
    function busqueda(abuscar){        
        var contador = 0;
        setTimeout(function(){
         $.ajax({
                url: "includes/buscarPreguntas.php",
                type: 'POST',
                data: {buscar: abuscar},
                dataType: "json",
                beforeSend: function(){                
                    console.log("buscando");
                    $('.resultadoBusqueda').html('<img src="img/preloader.gif" alt="..." style="width: 40px; display: block; margin: 40px auto;">').fadeIn(100);
                },
                success: function(data){                    
                    if (data == 'no') {
                        $('.resultadoBusqueda').fadeIn(100);
                        $('.resultadoBusqueda').html('<h1>No hay resultados</h1>');                                               
                    }else{
                        $('.resultadoBusqueda').html('');  
                        $('.resultadoBusqueda').hide().fadeIn(600);             
                        $.each(data, function(c, v){    
                        contador ++;                    
                            $('.resultadoBusqueda').append(
                                '<div class="resBusqueda"><span>'+contador+'</span> '+v.pregunta+'</div>'
                            ).hide().fadeIn(300);
                        });
                    }
                }
            });
        }, 100);
    }
    //
    peticion();
});