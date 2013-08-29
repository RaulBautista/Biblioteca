<?php 
require_once 'conexion.php';

$enviar = array();
$query = mysql_query("SELECT id FROM Preguntas");
$total = mysql_num_rows($query);

echo json_encode($total);

mysql_free_result($query);
mysql_close($link);
?>