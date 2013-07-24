<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
if($_SESSION['logged'] == '1') { 
	include("conexion.php");
	$autor = $_SESSION['user'];
	$pregunta = $_POST['pregunta'];
	$mensaje = $_POST['mensaje'];
	$tags = $_POST['tag'];
	if(empty($pregunta)){
		echo json_encode("false");
		exit();
	}
	elseif(empty($mensaje)){
		echo json_encode("false");
		exit();
	}else{
		$hoy = time();
		$fecha = date("Y-m-d H:i:s", $hoy);

		$meter = @mysql_query('INSERT INTO Preguntas (
		autor, pregunta, mensaje, fecha, tags)
		values
		("'.mysql_real_escape_string($autor).'", 
		"'.mysql_real_escape_string($pregunta).'",
		"'.mysql_real_escape_string($mensaje).'",
		"'.mysql_real_escape_string($fecha).'",
		"'.mysql_real_escape_string($tags).'")');
		if($meter){
			$preguntas = array();
			$query = mysql_query("SELECT id, total, pregunta, fecha, tags FROM Preguntas ORDER BY fecha DESC LIMIT 0, 1");
			$row = mysql_fetch_array($query);
			$mensaje = nl2br($row['pregunta']);
			$preguntas[] = array(
				'total' =>$row['total'],
				'mensaje'=>"<a href='respuestas.php?id=$row[id]'>$mensaje</a>",
				'fecha'=>$row['fecha'],
				'tag' => $row['tags']
			);
			echo json_encode($preguntas);

		}else{
			echo json_encode("false");
		}
	}
}else{
	header("location: ../index.php");
}
mysql_free_result($query);
mysql_close($link);
?>