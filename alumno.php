<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenido</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/alumno.css">
    <script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script> 
    <script src="js/alumno.js"></script>    
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php session_start(); include "includes/menu.php"; if($_SESSION['logged'] == '1') {  ?>
	</header>
	<section class="contenedorAlumno">
	</section>
		<?php } else { header('location: index.php'); }?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>