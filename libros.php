<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
	<link rel="stylesheet" href="css/design2.css">    
	<link rel="stylesheet" href="css/libros.css">
    <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>  
    <script src="js/libros.js"></script> 
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php session_start(); include("includes/menu.php"); ?>			
	</header>
		<?php		
		if($_SESSION['logged'] == '1') { 
			$usuario = $_SESSION['user'];					
			?>
			<section class="cargarLibros">
				<?php echo "<p class='blanco'>Informacion sobre libros que se encuentran en la Biblioteca.</p>"; ?>
				<form id="busquedaLibros">					
					<select name="tipo">
					   <option value="autor">Autor</option>
					   <option value="titulo">titulo</option>
					   <option value="area">Area</option>
					   <option value="editorial">Editorial</option>
		 			</select>
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscas algun libro?">
				</form>
				<div id="resultados"></div>
				<hr size="5">
			</section>
		<?php }else{
			header("location: index.php");
		} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>		
	</footer>
</body>
</html>