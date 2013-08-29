$(document).on('ready', function(){	
	$.ajax({
		url: 'includes/alumno.php',
		type: 'post',
		success: function(data){
			$('.contenedorAlumno').append(data);
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status+' '+ajaxOptions+' '+thrownError);
		},
		complete: function(){
			$('.elegirImagen').on('mouseenter', function(){
				$('.link').fadeIn('slow');				
			}).on('mouseleave', function(){
			    $('.link').fadeOut('slow');
			});			
		}
	});//Termina ajax	
});