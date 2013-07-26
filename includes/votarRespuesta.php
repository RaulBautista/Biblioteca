<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
require_once "conexion.php";

$votante = $_SESSION['user'];
$id = $_POST['id'];
$enviar = array();
$consultar = mysql_query("SELECT * FROM VotoRespuesta WHERE id_respuesta = '$id' AND votante = '$votante'", $link);
$cont = mysql_num_rows($consultar);
if ($cont == 0) {
	$act1 = mysql_query("UPDATE Respuestas SET votos = votos + 1 WHERE id = '$id'", $link);
	$int1 = mysql_query("INSERT INTO VotoRespuesta (id_respuesta, votante, status, ha_votado) VALUES ('$id', '$votante', 1, 1)",$link);
	if ($act1 && $int1) {
		$obt = mysql_query("SELECT votos FROM Respuestas WHERE id = '$id'", $link);
		$obta = mysql_fetch_array($obt);		
		$enviar[] = array(
			'valor' =>$obta['votos'],
			'id' => $id,
			'voto' => 1
		);
		echo json_encode($enviar);
		exit();
	}else{
		echo json_encode("error");
		exit();
	}
}else{
	$obt2 = mysql_query("SELECT status FROM VotoRespuesta WHERE id_respuesta = '$id' AND votante = '$votante'", $link);
	$datos = mysql_fetch_array($obt2);
	$status = $datos['status'];
	if ($status == 1) {
		$act2 = mysql_query("UPDATE Respuestas SET votos = votos - 1 WHERE id = '$id'", $link);
		$upd = mysql_query("UPDATE VotoRespuesta SET status = 0, ha_votado = 0 WHERE id_respuesta = '$id' AND votante = '$votante'", $link);
		if ($act2 && $upd) {
			$obt2 = mysql_query("SELECT votos FROM Respuestas WHERE id = '$id'", $link);
			$obta2 = mysql_fetch_array($obt2);		
			$enviar[] = array(
				'valor' =>$obta2['votos'],
				'id' => $id,
				'voto' => 0
			);
			echo json_encode($enviar);
			exit();
		}else{
			echo json_encode("error");
		}
	}elseif($status == 0){
		$act3 = mysql_query("UPDATE Respuestas SET votos = votos + 1 WHERE id = '$id'", $link);
		$upd2 = mysql_query("UPDATE VotoRespuesta SET status = 1, ha_votado = 1 WHERE id_respuesta = '$id' AND votante = '$votante'", $link);
		if ($act3 && $upd2) {
			$obt3 = mysql_query("SELECT votos FROM Respuestas WHERE id = '$id'", $link);
			$obta3 = mysql_fetch_array($obt3);			
			$enviar[] = array(
				'valor' =>$obta3['votos'],
				'id' => $id,
				'voto' => 1
			);
			echo json_encode($enviar);
			exit();
		}else{
			echo json_encode("error");
			exit();
		}
	}else{
		echo json_encode("error");
		exit();
	}
}
 ?>