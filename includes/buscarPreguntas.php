<?php 
	require_once "conexion.php";
	$buscar = $_POST['buscar'];
	$enviar = array();
	if ($buscar != '') {
		$query = @mysql_query('SELECT id, pregunta FROM Preguntas WHERE pregunta like "'.mysql_real_escape_string('%'.$buscar.'%').'" ',$link)
			 or die("Error: ".mysql_error());
		$num = mysql_num_rows($query);
		while($row = mysql_fetch_array($query)) {
			$enviar[] = array(
				'pregunta' => "<a href='respuestas.php?id=$row[id]'>$row[pregunta]</a>"				
			);
		}
		if (empty($enviar)) {
			echo json_encode("no");
		}else{
			echo json_encode($enviar);
		}
	}
?>