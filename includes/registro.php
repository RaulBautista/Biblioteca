<?php
	error_reporting(E_ALL & ~E_NOTICE);
	require_once('conexion.php');
	$numcontrol = strip_tags($_POST['nocontrol']);
	$nombre = strip_tags($_POST['name']);
	$semestre = strip_tags($_POST['semestre']);
	$carrera = strip_tags($_POST['carrera']);
	$password = strip_tags(sha1($_POST['password']));
	$correo = strip_tags($_POST['email']);

	$query = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'"');
	if($existe = @mysql_fetch_object($query))
	{
		//echo "<p align='center'> El Alumno Con el Numero de Control $numcontrol ya esta registrado. </p>
		//<a href='../colecciones.php' class='boton'>Regresar</a>
		//";
		echo "existe";

	}else{
		$meter = @mysql_query('INSERT INTO Alumnos (numcontrol, nombre, semestre, carrera, password, correo) values ("'.mysql_real_escape_string($numcontrol).'","'.mysql_real_escape_string($nombre).'","'.mysql_real_escape_string($semestre).'","'.mysql_real_escape_string($carrera).'","'.mysql_real_escape_string($password).'","'.mysql_real_escape_string($correo).'")');
		if($meter)
		{
			//echo "<p align='center'> Alumno Registrado Con Exito
			//<a href='../colecciones.php' class='boton'>Aceptar</a>
			//";
			echo "exito";
		}else{
			//echo "<p align='center'> Ha Ocurrido Un Error En Su Registro, Intente Mas Tarde </p>
			//<a href='../colecciones.php' class='boton'>Regresar</a>
			//";
			echo "error";
		}
	}	
?>