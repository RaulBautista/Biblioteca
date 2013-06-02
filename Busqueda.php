<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Busqueda</title>
	<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/tabla.css">
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II<br>Biblioteca</h1>
			<?php include("includes/menu.php") ?>	
		</header><br>
		<?php 
		error_reporting(E_ALL & ~E_NOTICE);
		session_start();
		include("includes/conexion.php");
		if(isset($_POST['enviar']) == 'enviar') {
		$tipo = $_POST['tipo'];
			if ($tipo=='id_area') {
				$buscara = $_POST['busqueda'];
				$consulta = mysql_query('SELECT * FROM Area
				WHERE nombre= "'.mysql_real_escape_string($buscara).'" ', $link)
				or die(mysql_error());
				$row = mysql_fetch_array($consulta);
				$buscar = $row['id'];
				$result = @mysql_query('SELECT * FROM Libros where id_area = '.mysql_real_escape_string($buscar).' ', $link)
				or die (mysql_error());
			}else{
				$buscar = $_POST['busqueda'];
				$result = @mysql_query('SELECT * FROM Libros WHERE '.mysql_real_escape_string($tipo).' like "'.mysql_real_escape_string('%'.$buscar.'%').'" ',$link) or die("Error: ".mysql_error());
			}
		if($_SESSION['logged']=='1') { 
			if(mysql_num_rows($result) > 0){


		?>
		<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1>
	<thead>
		<TR>
			<TH>Autor</TH>
			<TH>Titulo</TH>
			<TH id="oculta">Edicion</TH>
			<TH id="oculta">Lugar de Edicion</TH>
			<TH>Editorial</TH>
			<TH id="oculta">Año de Edicion</TH>
			<TH>No. de Paginas</TH>
			<TH id="oculta">Ejemplar No.</TH>
			<TH id="oculta">Id area</TH>
			<TH>Estado</TH>
		</TR>
	</thead>
<?php
	while ($row = mysql_fetch_array($result)) {

		printf("<tr><td>%s</td>
					<td>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td>%s</td>
					<td id='oculta'>%s</td>
					<td>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td>%s</td>						
				</tr>", 
				$row["autor"], $row["titulo"], $row["edicion"], $row["lugar_edicion"], $row["editorial"], $row["ano_edicion"], $row["num_paginas"], $row["ejemplar_num"], $row["id_area"], $row["estado"]);
	}
	}else{
		echo "<p align='center'>No se hallaron registros que coincidan con el criterio de búsqueda </p>
			 ";
	}
	mysql_free_result($result);
	mysql_close($link);

?>
	</TABLE>

	<?php }else{ if(mysql_num_rows($result) > 0){?>
	
		<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1 >
		<thead>
			<TR>
				<TH>Autor</TH>
				<TH>Titulo</TH>
				<TH>Edicion</TH>
				<TH>Editorial</TH>
				<TH>Num. de Paginas</TH>
				<TH>Serie o Coleccion</TH>
			</TR>
		</thead>
		<?php
	while ($row = mysql_fetch_array($result)) {

		printf("<tr><td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>						
				</tr>", 
				$row["autor"], $row["titulo"], $row["edicion"], $row["editorial"], $row["num_paginas"], $row["id_area"]);
	}
	}else{
		echo "<p align='center'>No se hallaron registros que coincidan con el criterio de búsqueda </p>
			 ";
	}
	mysql_free_result($result);

	mysql_close($link);

?>
	</TABLE>
	<?php } ?>
	<a href='Busqueda.php' class='boton'>Nueva Busqueda</a>
		<?php }else{ 
		?>

		<form align="center" id="formbusqueda" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<select name="tipo">
			   <option value="autor">Autor</option>
			   <option value="titulo">titulo</option>
			   <option value="id_area">Area</option>
			   <option value="editorial">Editorial</option>
 			</select>
			<input type="search" name="busqueda" id="busqueda" results="5" required/>
			<input type="submit" name="enviar" value="Buscar">
		</form>
		<section id="libros">
			<article>
				<a href="consultaColeccion.php?area=001 "><p>Programacion</p></a>
			</article>	
			<article>
				<a href="consultaColeccion.php?area=002 "><p>Historia</p></a>
			</article>	
			<article>
				<a href="consultaColeccion.php?area=003 "><p>Quimica</p></a>
			</article>
			<article>
				<a href="consultaColeccion.php?area=004 "><p>Matematicas</p></a>
			</article>
		</section>	
		<?php } ?>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		</footer>
	</section>
</body>
</html>