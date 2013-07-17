<?php 
require_once 'conexion.php';

$inicio = $_POST['inicio'];
$limite = $_POST['limite'];
//$inicio = 1;
//$limite = 1;

$query = mysql_query("SELECT * FROM Preguntas ORDER BY fecha DESC LIMIT $inicio, $limite");

while($row = mysql_fetch_array($query)) {
	$mensaje = nl2br($row['pregunta']);
	$datos = array('total' =>$row['total'] ,'mensaje'=>"<a href='respuestas.php?id=$row[id]'>$mensaje</a>", 'fecha'=>$row['fecha']);
	print_r(json_encode($datos));
}
mysql_free_result($query);
mysql_close($link);

?>