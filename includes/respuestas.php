<?php
	session_start();	
	$votante = $_SESSION['user'];
	require_once "conexion.php";
	$id = $_POST['id'];
	$respuestas = array();
	$consulta = @mysql_query('SELECT id, autor, fecha, respuesta, control, votos FROM Respuestas WHERE id_pregunta = "'.mysql_real_escape_string($id).'" ORDER BY fecha DESC', $link);
	while ($row = mysql_fetch_array($consulta)) {
	$id_respuesta = $row['id'];
	$consulta2 = @mysql_query("SELECT ha_votado FROM VotoRespuesta WHERE id_respuesta = '$id_respuesta' AND votante = '$votante'", $link);
	$row2 = mysql_fetch_array($consulta2);
	$voto = $row2['ha_votado'];
	if ($voto == NULL) {
		$voto = 0;
	}
	if ($row['control'] == "1") {
		$res = htmlspecialchars($row["respuesta"]);		
	}else{
		$res2 = strip_tags($row["respuesta"],'<iframe><img><a>'); 
		$res = nl2br($res2);
	}
	$respuestas[] = array(
			'id'=>$id_respuesta,
			'autor'=>$row['autor'],
			'fecha'=>$row['fecha'],
			'respuesta'=>$res,
			'control'=>$row['control'],
			'votos'=>$row['votos'],
			'voto'=>$voto			
		);
	}//end while
echo json_encode($respuestas);
mysql_free_result($consulta);
mysql_close($link); 
?>