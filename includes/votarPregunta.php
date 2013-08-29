<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
require_once "conexion.php";

$votante = $_SESSION['user'];
$id = $_POST['id'];
$accion = $_POST['accion'];
//$id = '1001';
//$votante = 'Juan Manuel Luna Martinez';
//$accion = 'down';

$enviar = array();
$query = mysql_query("SELECT status FROM votoPregunta WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
$datos = mysql_fetch_array($query);
$status = $datos['status'];
$conteo = mysql_num_rows($query);
if ($conteo == 0) {
	if ($accion == 'up') {
		$insert_1 = @mysql_query("INSERT INTO votoPregunta (id_pregunta, votante, status) VALUES ('$id', '$votante', 1)", $link);	
		$act_1 = @mysql_query("UPDATE Preguntas SET votos = votos + 1 WHERE id = '$id'", $link);
		if ($insert_1 && $act_1) {
			$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
			$row = mysql_fetch_array($query);			
			$enviar = array(
				'votos' => $row['votos'],
				'statuss' => 'up_active'
			);
			echo json_encode($enviar);
		}else{
			echo json_encode("error");
		}
	}elseif($accion == 'down'){
		$insert_1 = @mysql_query("INSERT INTO votoPregunta (id_pregunta, votante, status) VALUES ('$id', '$votante', 2)", $link);	
		$act_down_1 = @mysql_query("UPDATE Preguntas SET votos = votos - 1 WHERE id = '$id'", $link);
		if ($insert_1 && $act_down_1) {
			$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
			$row = mysql_fetch_array($query);			
			$enviar = array(
				'votos' => $row['votos'],
				'statuss' => 'down_active'
			);
			echo json_encode($enviar);
		}else{
			echo json_encode("error");
		}
	}
}else{
	if($accion == 'up'){
		if ($status == 0) {
			$act_up = @mysql_query("UPDATE Preguntas SET votos = votos + 1 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 1 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_up && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'up_active'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}elseif($status == 1){
			$act_up = @mysql_query("UPDATE Preguntas SET votos = votos - 1 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 0 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_up && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'up'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}elseif($status == 2){
			$act_up = @mysql_query("UPDATE Preguntas SET votos = votos + 2 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 1 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_up && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'up_active'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}
	}elseif($accion == 'down'){
		if ($status == 0) {
			$act_up = @mysql_query("UPDATE Preguntas SET votos = votos - 1 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 2 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_up && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'down_active'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}elseif ($status == 1) {
			$act_down = @mysql_query("UPDATE Preguntas SET votos = votos - 2 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 2 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_down && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'down_active'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}elseif ($status == 2) {
			$act_down = @mysql_query("UPDATE Preguntas SET votos = votos + 1 WHERE id = '$id'", $link);
			$act_status = @mysql_query("UPDATE votoPregunta SET status = 0 WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
			if ($act_down && $act_status) {
				$query = @mysql_query("SELECT votos FROM Preguntas WHERE id = '$id'", $link);
				$row = mysql_fetch_array($query);			
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'down'
				);
				echo json_encode($enviar);
			}else{
				echo json_encode("error");
			}
		}
	}
}
?>