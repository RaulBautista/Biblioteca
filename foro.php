<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Foro</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/formulario.css">
  	<link rel="stylesheet" type="text/css" media="all" href="css/fancybox/jquery.fancybox.css">
  	<style>
  		#checkbox{display: inline; margin-left: 10px;}
  	</style>
	<script type="text/javascript" src="js/new/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="css/fancybox/jquery.fancybox.js?v=2.0.6"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/es.js"></script>
	<script src="js/livestamp.min.js"></script>
	<script src="js/scrollFunction.js"></script>
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
			<a href="#inline" class="boton" id="modalbox">Tienes alguna pregunta</a>
			<div id="inline">
				<h2>Ingresa datos suficientes para ayudarte a resolver tu pregunta</h2><br>
				<form id="contact" name="contact" action="NuevoTema" method="post">
					<label>Titulo</label>
					<input type="text" id="pregunta" name="pregunta" class="txt" placeholder="Maximo 100 caracteres" maxlength="100px"><br>
					<label>Describe tu pregunta</label>
					<textarea id="msg" name="msg" class="txtarea"></textarea>				
					<div id="contador"></div>
					<button id="send">Publica tu pregunta</button>
				</form>
			</div>
			<script type="text/javascript" src="js/new/formularioNuevoTema.js"></script>
			<div class="contenido"></div>
			<br><br>
			<button id="cargando" class="boton2">Click para ver mas</button>
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
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>