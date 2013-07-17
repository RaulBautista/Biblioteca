<?php
require_once "conexion.php";

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();


$run = mysql_query("SELECT * FROM Preguntas ORDER BY fecha DESC LIMIT ".$postnumbers." OFFSET ".$offset);
while($row = mysql_fetch_array($run)) {
	printf("<article class='preguntas'>					
					<p><a href='respuestas.php?id=$row[id]' class='pregunta_foro'>%s</a></p>
					<p class='fecha'>%s</p>	
					<p class='num_respuestas'>%s</p>	
			</article><br>
	",
	$row["pregunta"], date("j M Y - g:i A ", strtotime($row["fecha"])), $row['total']); //date("j M Y - g:i A ", strtotime($row["fecha"]))
	}
	mysql_free_result($run);
	mysql_close($link);
?>