<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Estado Prestamo</title>
	<link rel="stylesheet" href="css/design.css">
</head>
<body>
<section class="contenedor">
	<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php") ?>		
		</header>
<?php
	header ('Content-type: text/html; charset=utf-8');
	require("includes/conexion.php");

	$id_libro = strip_tags($_POST['id_libro']);
	$numcontrol = strip_tags($_POST['numcontrol_alum']);
	$fechaprestamo = strip_tags($_POST['fechaprestamo']);
	$fechadevolver = strip_tags($_POST['fechadevolver']);
	$observacion = strip_tags($_POST['observacion']);
	$fecha_prestamo = date("Y/m/d", strtotime($fechaprestamo));
	$fecha_devolver = date("Y/m/d", strtotime($fechadevolver));

	$consulta = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol = "'.mysql_real_escape_string($numcontrol).'"')
	or die(mysql_error());


	if($existe = @mysql_fetch_object($consulta)){

	$consulta = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol = "'.mysql_real_escape_string($numcontrol).'"')
	or die(mysql_error());
	$row = mysql_fetch_array($consulta);

	$meter = @mysql_query('INSERT INTO Prestamo(
		id_libro,
		numcontrol_alum,
		fecha_prestamo,
		fecha_devolver,
		observacion)
		VALUES
		("'.mysql_real_escape_string($id_libro).'",
		"'.mysql_real_escape_string($numcontrol).'",
		"'.mysql_real_escape_string($fecha_prestamo).'",
		"'.mysql_real_escape_string($fecha_devolver).'",
		"'.mysql_real_escape_string($observacion).'")');
		if($meter)
			{	
				mysql_query ("UPDATE Libros SET 
				estado = 'Prestado'
				WHERE id = '$id_libro'", $link)
				or die(mysql_error());
				echo" <p align='center'> Prestamo realizado con exito al alumno <b>$row[nombre]</b></p> <br>
				<a href='colecciones.php' class='boton'>Regresar</a>";
			}else{
				echo "<p align='center'> Ha ocurrido un error en su prestamo. Intentelo de nuevo </p> <br>
				<a href='EstadoLibro.php?id=$id_libro' class='boton'>Intentar de nuevo</a>";	
			}

	}else{
		echo "<p align='center'>El numero de control <b>" .$numcontrol. "</b> no existe en la BD</p>
		<a href='EstadoLibro.php?id=$id_libro' class='boton'>Intentar de nuevo</a>";
	}	
?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
</section>
</body>
</html>