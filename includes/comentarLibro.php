<?php 
session_start();
if ($_SESSION['logged'] == '1') {
	require_once 'conexion.php';
	$id_libro = $_POST['id'];
	$comentario = strip_tags($_POST['comentario']);
	$autor = $_SESSION['user'];
	$hoy = time();
	$fecha = date('Y-m-d H:i:s', $hoy);
	$enviar = array();
	
	$insert = @mysql_query('INSERT INTO ComentariosLibro (id_libro, autor, comentario, fecha) 
	VALUES ("'.mysql_real_escape_string($id_libro).'", "'.mysql_real_escape_string($autor).'", "'.mysql_real_escape_string($comentario).'", "'.mysql_real_escape_string($fecha).'" )', $link);
	$actualizar =@mysql_query("UPDATE Libros SET num_comentarios = num_comentarios + 1 WHERE id = '$id_libro'", $link);
	if (!$insert && !$actualizar) {
		echo json_encode("Error");
		exit();
	}else{
		$query = @mysql_query("SELECT * FROM ComentariosLibro WHERE id_libro = '$id_libro' ORDER BY fecha DESC", $link);
		$total = mysql_num_rows($query);
		if (!$query) {
			echo json_encode("Error");
			exit();
		}else{
			$row = mysql_fetch_array($query);
			$query2 = @mysql_query("SELECT imagen FROM Alumnos WHERE nombre = '$autor'", $link);
			$row2 = mysql_fetch_array($query2);
			$enviar[] = array(
				'total' => $total,
				'autor' => $row['autor'],
				'imagen' => $row2['imagen'],
				'comentario' => $row['comentario'],
				'fecha' => $row['fecha']
			);
			echo json_encode($enviar);
		}
		mysql_close($link);
	}
}
?>