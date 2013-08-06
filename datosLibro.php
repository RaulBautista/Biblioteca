<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/datosLibro.css">
    <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script> 
    <script src="js/datosLibro.js"></script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php session_start(); include("includes/menu.php"); ?>	
	</header>
		<?php		
		if($_SESSION['logged'] == '1') {  $id = $_GET['id']; ?>
			<script>var id = <?php echo $id?>;</script>
			<section class="contenedorLibro">
				<div class="cargarDatos"></div>
				<form action="" id="comentarLibro">
					<textarea name="comentario" id="comentario" placeholder="Deja un comentario sobre este libro"></textarea>
					<input type="submit" class="boton2" value="comentar">
				</form>
				<div class="cargarComentarios"></div>
			</section>
		<?php }else{
			header("location: index.php");
		} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>