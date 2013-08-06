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
});