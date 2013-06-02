<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Datos</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/tabla.css">
</head>
<body>
<section class="contenedor">
	<header>
		<img src="img/logos.png" alt="tec">
		<h1>Instituto Tecnologico De Iztapalapa II</h1>
		<?php include("includes/menu.php") ?>
	</header>
<?php
session_start();
if($_SESSION['logged']=='2'){
	//header ('Content-type: text/html; charset=utf-8');
	require_once ("includes/conexion.php");
	$numcontrol = $_GET['numcontrol'];
	$id = $_GET['id'];
	$query = mysql_query("SELECT * FROM Alumnos
			WHERE numcontrol = $numcontrol", $link)or die(mysql_error());
?>
<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1>
	<thead>
		<tr>
			<th>No. control</th>
			<th>Nombre</th>
			<th>Semestre</th>
			<th>Carrera</th>
			<th>E-mail</th>
		</tr>
	</thead>
	<?php
	while ($row = mysql_fetch_array($query)) {
		printf("
			<tr>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			</tr>
		", $row['numcontrol'], $row['nombre'], $row['semestre'], $row['carrera'], $row['correo']);
	}

	?>
</table>

	<?php
	echo"<a href='EstadoLibro.php?id=$id' class='boton'>Regresar</a>";
			}else{
			header("location: colecciones.php");
		} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>