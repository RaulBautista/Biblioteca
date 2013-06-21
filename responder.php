<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Responder</title>
	<link rel="stylesheet" href="css/design.css" />
</head>
<body>
<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
if($_SESSION['logged'] == '1') { 
	include("includes/conexion.php");
	$id = $_POST['id'];
	$respuesta = $_POST['respuesta'];
	$autor = $_POST['autor'];
	$control = $_POST['control'];
	$hoy = time();

	$fecha = date("y-m-d H:i:s", $hoy);
	//echo $fecha;
	$meter = @mysql_query('INSERT INTO Respuestas (id_pregunta, autor, respuesta, fecha, control) 
			values ("'.mysql_real_escape_string($id).'","'.mysql_real_escape_string($autor).'","'.mysql_real_escape_string($respuesta).'","'.mysql_real_escape_string($fecha).'","'.mysql_real_escape_string($control).'")');
	$consulta = mysql_query("SELECT total FROM Preguntas
			WHERE id = $id", $link)
			or die(mysql_error());
			$row = mysql_fetch_array($consulta);
			$num = $row['total'];
			$total = $num + 1;
			if(!$meter)
			{
			echo "<script type='text/javascript'>
			alert('Ocurrio un error intenta mas tarde.');
			document.location=('respuestas.php?id=$id');
			</script>";	
			exit();
			}else{ 
			mysql_query ("UPDATE Preguntas SET 
				total = '$total'
				WHERE id = '$id'", $link)
				or die(mysql_error());
			echo "<script type='text/javascript'>
			alert('Respuesta publicada exitosamente.');
			document.location=('respuestas.php?id=$id');
			</script>";
			}
}
?>
</body>
</html>