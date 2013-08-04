<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Colecciones</title>
	<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" type="text/css" href="css/tabla.css">
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">
		<?php include("includes/menu.php") ?>
	</header>
	<section class="contenedor">
<?php
	require_once('includes/conexion.php');
	$area = strip_tags($_GET['area']);
	$query = @mysql_query('SELECT * FROM Libros WHERE area="'.mysql_real_escape_string($area).'"', $link);
	if(mysql_num_rows($query) > 0){
	?>
	<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1>
		<thead>
			<TR>
				<th>ID</th>
				<TH>Autor</TH>
				<TH>Titulo</TH>
				<TH>Edicion</TH>
				<TH>Editorial</TH>
				<TH>Num. de Paginas</TH>
				<TH>Serie o Coleccion</TH>

			</TR>
		</thead>
	<?php
	while ($row = mysql_fetch_array($query)) {

		printf("<tr><td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>												
				</tr>", 
				$row["id"], $row["autor"], $row["titulo"], $row["edicion"], $row["editorial"], $row["num_paginas"], $row["area"]);
	}
	}else{
		echo "<br><p align='center'>No se hallaron registros que coincidan con el criterio de búsqueda </p>
			 ";
	}
	//mysql_free_result($query);
	mysql_close($link);

?>
	</TABLE>
	<a href='Busqueda.php' class='boton'>Nueva Busqueda</a>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
</body>
</html>