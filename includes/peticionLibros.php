<?php 
//session_start();
require_once "conexion.php";

$query = mysql_query("SELECT * FROM Libros LIMIT 10");
$contador = 0;
while($row = mysql_fetch_array($query)){
	$contador ++;
	echo"
		<article class='libro'>
			<a href='datosLibro.php?id=$row[id]'>
				<img src='img/pdf.png' class='imagenLibro'>
			</a>
			<p class='numLibro'>$contador</p>
			<div class='datosLibro'>
				<a href='datosLibro.php?id=$row[id]'><p>$row[titulo]</p></a>
				<p>$row[autor]</p>
				<p>$row[editorial]</p>				
			</div>
				<p>&#9733; 2.4</p>			
				<p class='coments'>&#9993; $row[num_comentarios] comentarios</p>			
		</article>
	";
}
?>