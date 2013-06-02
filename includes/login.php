<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Ingresar</title>
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
	session_start();
	require_once('conexion.php');
	echo gettype($link);
	$tipo = strip_tags($_POST['tipo']);
	$numcontrol = strip_tags($_POST['numcontrol']);
	$password = strip_tags(sha1($_POST['pass']));	

	if ($tipo == 1) {
		$query = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"');
		if (!$existe = @mysql_fetch_object($query)) {
			echo "<p align='center'> No esta registrado o sus datos son incorrectos. Compruebe sus datos </p> 
			<a href='../colecciones.php' class='boton'> Intente nuevamente! </a>
			";
				exit();
		}else{
			$sql = mysql_query('SELECT * FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'"', $link);
			$row = mysql_fetch_array($sql);
			$nombre = $row['nombre'];
			$_SESSION['logged'] = '1';
			$_SESSION['user'] = $nombre;
			//echo '<script> window.location="../alumno.php"</script>';
			header ("Location: ../alumno.php");
		}
	}	
	if ($tipo==2) {
		$query = @mysql_query('SELECT * FROM Administradores WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"');
		if(!$existe = @mysql_fetch_object($query)) {
			echo "<p align='center'> No esta registrado o sus datos son incorrectos. </p> 
			<a href='../colecciones.php' class='boton'> Intente nuevamente! </a>
			";
				exit();
		}else{
			$_SESSION['logged'] = '2';
			//echo '<script> window.location="../administrador.php"</script>';
			header ("Location: ../administrador.php"); 
		}
	}	
?>
	</section>
</body>
</html>