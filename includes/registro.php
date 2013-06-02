<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Registro</title>
	<link rel="stylesheet" href="../css/design.css">
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="../img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("menu.php"); ?>
		</header>

<?php
	error_reporting(E_ALL & ~E_NOTICE);  
	if(isset($_POST['registro'])=='registro'){
	require_once('conexion.php');
		$numcontrol = strip_tags($_POST['numcontrol']);
		$nombre = strip_tags($_POST['nombre']);
		$semestre = strip_tags($_POST['semestre']);
		$carrera = strip_tags($_POST['carrera']);
		$password = strip_tags(sha1($_POST['pass']));
		$correo = strip_tags($_POST['correo']);

	$query = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'"');
	if($existe = @mysql_fetch_object($query))
	{
		echo "<p align='center'> El Alumno Con el Numero de Control $numcontrol ya esta registrado. </p>
		<a href='../colecciones.php' class='boton'>Regresar</a>
		";

	}else{
		$meter = @mysql_query('INSERT INTO Alumnos (numcontrol, nombre, semestre, carrera, password, correo) values ("'.mysql_real_escape_string($numcontrol).'","'.mysql_real_escape_string($nombre).'","'.mysql_real_escape_string($semestre).'","'.mysql_real_escape_string($carrera).'","'.mysql_real_escape_string($password).'","'.mysql_real_escape_string($correo).'")');
		if($meter)
		{
			echo "<p align='center'> Alumno Registrado Con Exito
			<a href='../colecciones.php' class='boton'>Aceptar</a>
			";
		}else{
			echo "<p align='center'> Ha Ocurrido Un Error En Su Registro, Intente Mas Tarde </p>
			<a href='../colecciones.php' class='boton'>Regresar</a>
			";
		}
	}
	}else{
		echo "<p align='center'> Debe llenar los datos solicitados, por favor intente de nuevo </p>
			<a href='../colecciones.php' class='boton'>Regresar</a>
			";
	}	
?>
	</section>
</body>
</html>