<?php  
require_once "conexion.php";
$id = $_POST['id'];
$query = mysql_query("SELECT * FROM Libros WHERE id = '$id'", $link);
$row = mysql_fetch_array($query);
	echo "
	<article class='datosLibro'>
		<img src='img/vuelta.jpg'>
		<div class='abajoImagen'>
			<p>Promedio: 3.6</p>
			<div class='ec-stars-wrapper'>
				<a href='#' data-value='1' title='Vota 1 estrella'>&#9733;</a>
				<a href='#' data-value='2' title='Vota 2 estrellas'>&#9733;</a>
				<a href='#' data-value='3' title='Vota 3 estrellas'>&#9733;</a>
				<a href='#' data-value='4' title='Vota 4 estrellas'>&#9733;</a>
				<a href='#' data-value='5' title='Vota 5 estrellas'>&#9733;</a>
			</div>
			<noscript>Necesitas tener habilitado javascript para poder votar</noscript>
			<p>$row[estado]</p>
		</div>
		<div class='derecha'>
		<p>Titulo:  $row[titulo]</p>
		<p>Autor:   $row[autor]</p>
		<p>Edicion: $row[edicion]</p>
		<p>Lugar de edicion: $row[lugar_edicion]</p>
		<p>Editorial: $row[editorial]</p>
		<p>Año de edicion: $row[ano_edicion]</p>
		<p>Paginas: $row[num_paginas]</p>
		<p>Ejemplar: $row[ejemplar_num]</p>
		<p>Serie o coleccion: $row[area]</p>
		</div>		
	</article>
	<div class='numComenarios'><p>Comentarios sobre este libro: $row[num_comentarios]</p></div>
	";

?>