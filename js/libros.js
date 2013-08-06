$(document).on('ready', function(){
	$.ajax({
		url: 'includes/peticionLibros.php',
		type: 'post',		
		success: function(data) {			
			$('.cargarLibros').append(data);
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
	//Busqueda
	$('#busquedaLibros').on('submit', function(e){
		e.preventDefault();	
		$.ajax({
			url: 'includes/buscarLibro.php',
			type: 'post',
			data: $('#busquedaLibros').serialize(),
			beforeSend: function(){				
				$('#resultados').html('<img class="preloader" src="img/preloader.gif">');
				$('#resultados').fadeIn(900);
			},
			success: function(data){				
				$('#resultados').html(data);
				$('#resultados').append('<img src="img/close.png" class="cerrarBusqueda" alt="x">');
				cerrar();
			}
		});
	});
	function cerrar(){
		$('.cerrarBusqueda').on('click', function(){
			$('#resultados').slideUp(800);
			$('#busqueda').val('');
		});
	}
});