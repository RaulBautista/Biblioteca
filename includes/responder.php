<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
if($_SESSION['logged'] == '1') { 
	include("conexion.php");
	$id = $_POST['id'];
	$respuesta = $_POST['respuesta'];
	$autor = $_POST['autor'];
	$control = $_POST['control'];
	$hoy = time();

	$fecha = date("Y-m-d H:i:s", $hoy);
	//echo $fecha;
	$meter = @mysql_query('INSERT INTO Respuestas (id_pregunta, autor, respuesta, fecha, control) 
			values ("'.mysql_real_escape_string($id).'","'.mysql_real_escape_string($autor).'","'.mysql_real_escape_string($respuesta).'","'.mysql_real_escape_string($fecha).'","'.mysql_real_escape_string($control).'")', $link);
	$consulta = @mysql_query("SELECT total FROM Preguntas WHERE id = $id", $link);
	$row = mysql_fetch_array($consulta);
	$num = $row['total'];
	$total = $num + 1;
	if(!$meter){
		echo json_encode("error");
		exit();
	}else{ 
		$update = mysql_query ("UPDATE Preguntas SET total = '$total' WHERE id = '$id'", $link);
		if(!$update){
			echo json_encode("error");
			exit();
		}else{		
			$respuesta = array();
			$consul = @mysql_query("SELECT * FROM Respuestas WHERE id_pregunta = '$id' ORDER BY fecha DESC", $link);
			$data = mysql_fetch_array($consul);
				if ($data['control'] == "1") {
					$res = htmlspecialchars($data["respuesta"]);		
				}else{
					$res2 = strip_tags($data["respuesta"],'<iframe><img><a>'); 
					$res = nl2br($res2);
				}
				$respuesta[] = array(
					'id'=>$data['id'],
					'autor' =>$data['autor'],
					'fecha'=>$data['fecha'],
					'respuesta'=>$res,
					'control'=>$data['control'],
					'votos'=>$data['votos']
				);
				echo json_encode($respuesta);				
		}
	}
	mysql_close($link);
}
?>