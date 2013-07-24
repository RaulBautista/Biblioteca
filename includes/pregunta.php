<?php 
require_once "conexion.php";

$id = $_POST['id'];
$pregunta = array();

$consulta = @mysql_query('SELECT pregunta, autor, fecha, mensaje, total FROM Preguntas WHERE id = "'.mysql_real_escape_string($id).'"')
	or die (mysql_error()); 
	$row = mysql_fetch_array($consulta);

	$mensaje = nl2br(htmlspecialchars($row['mensaje']));

	$pregunta[] = array(
		'pregunta' =>$row['pregunta'] ,
		'autor'=>$row['autor'],
		'fecha'=>$row['fecha'],
		'mensaje'=>$row['mensaje'],
		'total'=>$row['total']
	);
echo json_encode($pregunta);
mysql_free_result($consulta);
mysql_close($link);
 ?>