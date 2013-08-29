$(document).on('ready', function(){
	$.ajax({
		url: 'includes/datoLibro.php',
		type: 'post',
		data: {id: id},	
		success: function(data) {			
			$('.cargarDatos').append(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status+' '+ajaxOptions+' '+thrownError);
		},
		statusCode: {
			404: function() {
			alert("Pagina no encontrada");
			}
		}
	});
	//Obtener Comentarios
	$.ajax({
		url: 'includes/comentariosLibro.php',
		type: 'post',
		data: {id: id},
		dataType: 'json',
		success: function(data) {
			if (data == '0') {
				$('#comentariosLibro').append('<h1 class="blanco ocultar">¿Que te parecio este libro? Dejanos tus comentarios</h1>');
			}else{				
				$.each(data, function(c, v){												
					$('#comentariosLibro').append(
						'<div class="areaComentario">'+
							'<div class="fechaComentario" >'+v.fecha+'</div>'+							
							'<img class="fotoComentario" src="'+v.imagen+'">'+
							'<div class="alignDerecha">'+
								'<div class="autorComentario">'+v.autor+'</div>'+
								'<div class="comentario">'+v.comentario+'</div>'+
							'</div>'+
						'</div>'
					);					
				$('.totalComentarios').html('<h1>'+v.total+' comentarios</h1>').show();
				});
			}
			$('#comentario').val('');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status+' '+ajaxOptions+' '+thrownError);
		},
		statusCode: {
			404: function() {
			alert("Seccion no encontrada");
			}
		}
	});
	//Enviar comentarios
	$('#comentarLibro').on('submit', function(e){
		e.preventDefault();
		if ($('#comentario').val().length > 5) {
		$.ajax({
			url: 'includes/comentarLibro.php',
			type: 'POST',
			data: $('#comentarLibro').serialize(),
			dataType: 'json',
			success: function(data){
				$('.ocultar').fadeOut(500);
				$.each(data, function(c, v){
					$('.totalComentarios').after(
						'<div class="areaComentario nuevo">'+
							'<div class="fechaComentario" >'+v.fecha+'</div>'+							
							'<img class="fotoComentario" src="'+v.imagen+'">'+
							'<div class="alignDerecha">'+
								'<div class="autorComentario">'+v.autor+'</div>'+
								'<div class="comentario">'+v.comentario+'</div>'+
							'</div>'+
						'</div>'
					);
					$('.totalComentarios').html('<h1><span>'+v.total+'</span> comentarios</h1>').show();					
					$('.totalComentarios span').hide().delay(1000).fadeIn(1000);
				});					
				$('#comentario').val('');
				$('.nuevo').hide().slideDown(700);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status+' '+ajaxOptions+' '+thrownError);
			}
		})
		}else{
			alert('Ops! Comentario muy corto');
		}
	});
});