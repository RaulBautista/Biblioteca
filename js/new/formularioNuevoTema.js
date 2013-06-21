$(document).ready(function() {
		$("#modalbox").fancybox();
		$("#contact").submit(function() { return false; });

		
		$("#send").on("click", function(){
			var preguntaval  = $("#pregunta").val();
			var msgval    = $("#msg").val();
			var msglen    = msgval.length;
			var preguntalen = preguntaval.length;

			if(preguntalen < 4) {
				$("#pregunta").addClass("error");				
			}
			else if(preguntalen >= 4){
				$("#pregunta").removeClass("error");
			}
			if(msglen < 10) {
				$("#msg").addClass("error");
			}
			else if(msglen >= 10){
				$("#msg").removeClass("error");
			}
			
			if(msglen >= 10 && preguntalen  >= 4) {
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send").replaceWith("<em>Enviando pregunta...</em>");
				
				$.ajax({
					type: 'POST',
					url: 'includes/nuevoTema.php',
					data: $("#contact").serialize(),
					success: function(data) {
						if(data == "true") {
							$("#contact").fadeOut("fast", function exito(){
								$(this).before("<p><strong><br><br>Pregunta publicada exitosamente! :)</strong></p>");
								//setTimeout("$.fancybox.close()", 2000);
								setTimeout("location.href='foro.php'", 1300);
								
							});
						}else{
							$("#contact").fadeOut("fast", function fracaso(){
								$(this).before("<p><strong><br><br>Ha ocurrido un error intente mas tarde :(</strong></p>");
								//setTimeout("$.fancybox.close()", 2000);
								setTimeout("location.href='foro.php'", 1300);
							});
						}
					}
				});
			}
		});
	});