<?php

require_once "conexion.php";

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();


$run = mysql_query("SELECT * FROM Preguntas ORDER BY fecha DESC LIMIT ".$postnumbers." OFFSET ".$offset);


while($row = mysql_fetch_array($run)) {
	printf("<article id='preguntas'>
					<p><a href='respuestas.php?id=$row[id]'>%s</a></p>
					<p id='fecha'>%s</p>	
					<p id='num_respuestas'>%s</p>	
			</article><br>
	", 
	$row["pregunta"], date("j M Y - g:i A ", strtotime($row["fecha"])), $row['total']);
	}
	mysql_free_result($run);
	mysql_close($link);
?>