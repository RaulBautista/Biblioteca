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
			$(".chzn-select").chosen({width: "400px", no_results_text: "Oops, etiqueta no disponible", max_selected_options: 3});
			$('#msg').keydown(function(e){
			var maxChars = 299;
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
		<?php include("includes/menu.php");?>
	</header>
	<section class="contenedor">
		<?php
		error_reporting(E_ALL & ~E_NOTICE);  
		session_start();
		if($_SESSION['logged'] == '1') { 
			include "includes/menualumno.php";
			require_once ("includes/conexion.php");
			$consulta = @mysql_query('SELECT * FROM Preguntas')
			or die (mysql_error()); 
			echo "<div class='bienvenido'>Bienvenido al Foro de preguntas.</div><hr><br>"
			?>
			<button class="boton" id="open_form">Realiza un pregunta</button>
			<div class="msg_resp_foro"></div>
			<div id="form">
				<div id="mensajes_form"><h2>Haz tu pregunta aquí</h2></div><br>
				<form id="form_preguntar">
					<label>Titulo para tu pregunta</label>
					<input type="text" id="pregunta" name="pregunta" class="txt" placeholder="Maximo 100 caracteres" maxlength="100px"><br>
					<label>Describe tu pregunta</label>
					<textarea id="msg" name="msg" class="txtarea" ></textarea>				
					<div id="contador_foro"></div>					
					<select data-placeholder="Tags..." name="tags" id="tags" class="chzn-select" multiple style="width:200px;" tabindex="4">
			    		<option value="<a href='#'>PHP</a>">PHP</option> 
			    		<option value="<a href='#'>Java</a>">Java</option>
			    		<option value="<a href='#'>Javascript</a>">Javascript</option> 
			 			<option value="<a href='#'>HTML</a>">HTML</option>
			 			<option value="<a href='#'>CSS</a>">CSS</option>
			 			<option value="<a href='#'>Android</a>">Android</option>
			 			<option value="<a href='#'>C++</a>">C++</option>
					</select><br>
					<input type="submit" class="boton2" id="enviar" value="Preguntar"><br>
				</form>
			</div>			
			<div class="contenido"></div>
			<br><br>
			<button id="cargando" class="boton2">Click para ver mas</button>
			<script>
			
			</script>
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