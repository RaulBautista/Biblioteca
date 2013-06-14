<!DOCTYPE HTML>
<html lang="es-MX">
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
		</header>
<?php
	//error_reporting(E_ALL & ~E_NOTICE); 
	session_start();
	$tipo = strip_tags($_POST['tipo']);
	$numcontrol = strip_tags($_POST['numcontrol']);
	$password = sha1($_POST['pass']);	

	if($tipo == '1') {
	require_once('conexion.php');
		$query = @mysql_query('SELECT * FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"', $link);
		if (!$existe = @mysql_fetch_object($query)) {
			echo "<br><p align='center'> No esta registrado o sus datos son incorrectos. Compruebe sus datos </p> 
			<a href='../colecciones.php' class='boton'> Intente nuevamente </a>
			<footer>
				<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
			</footer>
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

	elseif($tipo == '2') {
		require_once('conexion.php');
		$query2 = @mysql_query('SELECT * FROM Administradores WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"', $link);
		if(!$encontrado = @mysql_fetch_object($query2)) {
			echo "<p align='center'> Sus datos son incorrectos. Compruebelos por favor</p> 
			<a href='../colecciones.php' class='boton'> Intente nuevamente </a>
			<footer>
				<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
			</footer>
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