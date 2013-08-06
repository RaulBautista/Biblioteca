<?php
//session_start();
require_once "conexion.php";

$tipo = $_POST['tipo'];
$buscar = $_POST['busqueda'];
$contador = 0;

$query = @mysql_query('SELECT * FROM Libros WHERE '.mysql_real_escape_string($tipo).' like "'.mysql_real_escape_string('%'.$buscar.'%').'" ',$link);
$total = mysql_num_rows($query);
if ($total == 0) {
	echo "<h1 class='letras'>No hay resultados</h1>";
}else{
echo "<p class='letras'>resultados: $total</p>";	
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
				<p class='coments'>&#9993; 10 comentarios</p>			
		</article>
	";
}
}

?>