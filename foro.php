<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Foro</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/formulario_foro.css">
  	<link rel="stylesheet" href="css/chosen.css">
	<script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/es.js"></script>
	<script src="js/livestamp.min.js"></script>
	<script src="js/chosen.jquery.min.js"></script>
	<script src="js/jquery.autosize-min.js"></script>
	<script type="text/javascript" src="js/new/cargaDatosForo.js"></script>
	<script>
		$(document).on('ready', function(){
			$('.txtarea').autosize({append: "\n"});
			$(".chzn-select").chosen({width: "300px", no_results_text: "Oops, etiqueta no disponible", max_selected_options: 3});
			$('#msg').keydown(function(e){
			var maxChars = 699;
			if($(this).val().length <= maxChars)
			{
				var charsLeft = ( maxChars - $(this).val().length );
				$('#contador_foro').text( charsLeft + ' caracteres restantes' ).css('color', (charsLeft<10)?'#F00':'darkcyan' );
			}else{
				return ($.inArray(e.keyCode,[8,35,36,37,38,39,40]) !== -1);
			}
			})
		});
	</script>
</head>
<body>	
	<header>
		<img src="img/logo_mini.png" alt="tec">	
		<?php session_start(); include("includes/menu.php");?>
	</header>	
	<section class="contenedorForo">		
		<?php
		error_reporting(E_ALL & ~E_NOTICE); 				
		if($_SESSION['logged'] == '1') {			
			require_once ("includes/conexion.php");			
			echo "<div class='blanco'>Bienvenido al Foro de preguntas.</div><hr><br>"
			?>			
			<article id="alignDerecha">
			<div id="fade" class="fadebox"></div>
			<div class="msg_resp_foro"></div>
			<div class="totalPreguntas"><p></p><span>preguntas</span></div>
			<button class="boton" id="open_form">Realiza un pregunta</button><br>
			<div id="form">
				<img src="img/close.png" id="close_form" alt="x">
				<div id="mensajes_form"><h2>Haz tu pregunta aquí</h2></div><br>
				<form id="form_preguntar">
					<label>Titulo para tu pregunta</label>
					<input type="text" id="pregunta" name="pregunta" class="txt" placeholder="Maximo 150 caracteres" maxlength="150"><br>
					<label>Describe tu pregunta</label>
					<textarea id="msg" name="msg" class="txtarea" ></textarea>				
					<div id="contador_foro"></div>					
					<select data-placeholder="Tags..." name="tags" id="tags" class="chzn-select" multiple style="width:200px;" tabindex="4">
			 			<option value="<a href='#'>Android</a>">Android</option>
			 			<option value="<a href='#'>Ajax</a>">Ajax</option>
			 			<option value="<a href='#'>Apache</a>">Apache</option>
			 			<option value="<a href='#'>C++</a>">C++</option>
			 			<option value="<a href='#'>Chrome</a>">Chrome</option>
			 			<option value="<a href='#'>CSS</a>">CSS</option>
			 			<option value="<a href='#'>Django</a>">Django</option>
			 			<option value="<a href='#'>Debian</a>">Debian</option>
			 			<option value="<a href='#'>Eclipse</a>">Eclipse</option>
			 			<option value="<a href='#'>Facebook</a>">Facebook</option>
			 			<option value="<a href='#'>Firefox</a>">Firefox</option>			 			
			 			<option value="<a href='#'>Gnome</a>">Gnome</option>
			 			<option value="<a href='#'>Git</a>">Git</option>
			 			<option value="<a href='#'>GitHub</a>">GitHub</option>
			 			<option value="<a href='#'>HTML</a>">HTML</option>
			 			<option value="<a href='#'>IDE's</a>">IDE's</option>
			 			<option value="<a href='#'>IExplorer</a>">I Explorer</option>
			 			<option value="<a href='#'>IIS</a>">IIS</option>
			    		<option value="<a href='#'>Java</a>">Java</option>
			    		<option value="<a href='#'>Javascript</a>">Javascript</option>
			    		<option value="<a href='#'>JQuery</a>">JQuery</option>
			    		<option value="<a href='#'>KDE</a>">KDE</option>
			    		<option value="<a href='#'>Linux</a>">Linux</option>
			    		<option value="<a href='#'>MySQL</a>">MySQL</option>
			    		<option value="<a href='#'></a>">Netbeans</option>
			    		<option value="<a href='#'>Opera</a>">Opera</option>
			    		<option value="<a href='#'>PHP</a>">PHP</option>
			    		<option value="<a href='#'>Programacion</a>">Programación</option>
			    		<option value="<a href='#'>Python</a>">Python</option>
			    		<option value="<a href='#'>Safari</a>">Safari</option>
			    		<option value="<a href='#'>SQL</a>">SQL</option>
			    		<option value="<a href='#'>Twitter</a>">Twitter</option>		    		
			    		<option value="<a href='#'>Ubuntu</a>">Ubuntu</option>
			    		<option value="<a href='#'>Windows</a>">Windows</option>
					</select><br>									
					<input type="submit" class="boton2" id="enviar" value="Preguntar">
				</form>
			</div>
			<form id="busquedaForo">
				<input type="text" id="buscar" placeholder="Buscar..">
				<div class="closeSearch"></div>
			</form>
			<br>
			<div id="chose">
				<ul>
					<li><a href="#">Mas comentadas</a></li>
					<li><a href="#">Mas votadas</a></li>
					<li><a href="#">Sin responder</a></li>
					<li><a href="#">Tags</a></li>
				</ul>
			</div>
			<br>
			<p style="text-align: center;">Recuerda que el administrador del foro puede borrar contenido indevido y preguntas o respuestas ofensivas.</p>
			</article><br>
			<div class="contenido"></div>
			<div class="resultadoBusqueda"></div>
			<br><br>
			<button id="cargando" class="boton2">Click para ver mas</button>
			<div class="subir"><img src="img/up.png" alt="subir"></div>
		<?php 
		}else{
			header("Location: index.php");
		} ?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>