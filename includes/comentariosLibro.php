<?php 
session_start();
//$nombre = $_SESSION['user'];
if ($_SESSION['logged'] == '1') {
	require_once 'conexion.php';
	//$id_libro = '1000';
	$id_libro = $_POST['id'];
	$enviar = array();
	$query = mysql_query("SELECT * FROM ComentariosLibro WHERE id_libro = '$id_libro' ORDER BY fecha DESC", $link);
	$total = mysql_num_rows($query);
	if ($total == 0) {
		echo json_encode("0");
	}else{
		while($row = mysql_fetch_array($query)){
			$query2 = @mysql_query("SELECT imagen FROM Alumnos WHERE nombre = '$row[autor]'", $link);
			$datos = mysql_fetch_array($query2);
			$enviar[] = array(
				'total' => $total,
				'autor' => $row['autor'],
				'imagen' => $datos['imagen'],
				'comentario' => $row['comentario'],
				'fecha' => $row['fecha']
			);
		}
		echo json_encode($enviar);
	}
	mysql_free_result($query);	
	mysql_close($link); 
}
?>