<?php 
session_start();
require_once "conexion.php";
$votante = $_SESSION['user'];
$id = $_POST['id'];
$pregunta = array();

$consulta = @mysql_query('SELECT id, pregunta, autor, fecha, mensaje, total, votos FROM Preguntas WHERE id = "'.mysql_real_escape_string($id).'"'); 
$row = mysql_fetch_array($consulta);
$mensaje = nl2br(htmlspecialchars($row['mensaje']));

$query = @mysql_query("SELECT status FROM votoPregunta WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
$row2 = mysql_fetch_array($query);
$status = $row2['status'];
if ($status == null) {
	$status = 0;
}

	$pregunta[] = array(
		'pregunta' => $row['pregunta'] ,
		'autor' => $row['autor'],
		'fecha' => $row['fecha'],
		'mensaje' => $row['mensaje'],
		'votos' => $row['votos'],
		'total' => $row['total'],
		'statuss' => $status
	);

echo json_encode($pregunta);

mysql_free_result($consulta);
mysql_close($link);
 ?>