<?php
	require_once "conexion.php";
	$id = $_POST['id'];
	$respuestas = array();
	$consulta = @mysql_query('SELECT id, autor, fecha, respuesta, control, votos FROM Respuestas WHERE id_pregunta = "'.mysql_real_escape_string($id).'" ORDER BY fecha DESC')
	or die (mysql_error());
	while ($row = mysql_fetch_array($consulta)) {
	if ($row['control'] == "1") {
		$res = htmlspecialchars($row["respuesta"]);		
	}else{
		$res2 = strip_tags($row["respuesta"],'<iframe><img><a>'); 
		$res = nl2br($res2);
	}
	$respuestas[] = array(
			'id'=>$row['id'],
			'autor'=>$row['autor'],
			'fecha'=>$row['fecha'],
			'respuesta'=>$res,
			'control'=>$row['control'],
			'votos'=>$row['votos']
		);
	}//end while
echo json_encode($respuestas);
mysql_free_result($consulta);
mysql_close($link); 
?>