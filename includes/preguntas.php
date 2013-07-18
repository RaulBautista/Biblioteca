<?php 
require_once 'conexion.php';

$inicio = $_POST['inicio'];
$limite = $_POST['limite'];
//$inicio = 0;
//$limite = 2;

$preguntas = array();
$query = mysql_query("SELECT * FROM Preguntas ORDER BY fecha DESC LIMIT $inicio, $limite");

while($row = mysql_fetch_array($query)) {
	$mensaje = nl2br($row['pregunta']);

	$preguntas[] = array(
		'total' =>$row['total'] ,
		'mensaje'=>"<a href='respuestas.php?id=$row[id]'>$mensaje</a>",
		'fecha'=>$row['fecha']
	);
	
}
if (empty($preguntas)){
	echo json_encode("no");
}else{
echo json_encode($preguntas);
}

//mysql_free_result($query);
//mysql_close($link);

?>