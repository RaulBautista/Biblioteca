<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Foro</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/infinite.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/formulario.css">
  	<link rel="stylesheet" type="text/css" media="all" href="css/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="js/new/jquery-1.7.2.min.js"></script>
	<script src="js/new/infinite.js"></script>
	<script type="text/javascript" src="css/fancybox/jquery.fancybox.js?v=2.0.6"></script>
	<script>
	$(document).ready(function() {
	$('#content').scrollPagination({
		nop     : 1, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'No hay mas resultados!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
	});
	});
	</script>

</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php");?>
		</header>
		<?php
		error_reporting(E_ALL & ~E_NOTICE);  
		session_start();
		if($_SESSION['logged'] == '1') { 
			include "includes/menualumno.php";
			require_once ("includes/conexion.php");
			$consulta = @mysql_query('SELECT * FROM Preguntas')
			or die (mysql_error()); 
			echo "<p id='bienvenido'>Bienvenido al Foro de preguntas <strong>$_SESSION[user]</strong></p><br>"
			?>
			<a href="#inline" class="boton" id="modalbox">Nuevo Tema</a>
			<div id="inline">
				<h2>Ingresa datos suficientes para ayudarte a resolver tu pregunta</h2>
				<form id="contact" name="contact" action="NuevoTema" method="post">
					<label>Titulo</label>
					<input type="text" id="pregunta" name="pregunta" class="txt"><br>
					<label>Describe tu pregunta</label>
					<textarea id="msg" name="msg" class="txtarea"></textarea>
					<div id="contador"></div>
					<button id="send">Preguntar</button>
				</form>
			</div>
			<script type="text/javascript" src="js/new/formularioNuevoTema.js"></script>
			<div id="content"></div>
			<script>
			$('#msg').keydown(function(e){
			var maxChars = 299;
			if($(this).val().length <= maxChars)
			{
				var charsLeft = ( maxChars - $(this).val().length );
				$('#contador').text( charsLeft + ' caracteres restantes' ).css('color', (charsLeft<10)?'#F00':'#000' );
			}else{
				return ($.inArray(e.keyCode,[8,35,36,37,38,39,40]) !== -1);
			}
			})
			</script>
		<?php 
		}else{
		header("Location: index.php");
		} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>