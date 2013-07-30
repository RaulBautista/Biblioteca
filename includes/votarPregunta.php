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
$query = mysql_query("SELECT ha_votado FROM votoPregunta WHERE id_pregunta = '$id' AND votante = '$votante'", $link);
$datos = mysql_fetch_array($query);
$yaVoto = $datos['ha_votado'];
$conteo = mysql_num_rows($query);	

if ($accion == 'up') {
	if ($conteo == 0) {
		$alta = mysql_query("INSERT INTO votoPregunta (id_pregunta, votante, ha_votado) VALUES ('$id', '$votante', 1)", $link) or die(mysql_error());
		$update = mysql_query("UPDATE Preguntas SET votos = votos + 1 WHERE id = '$id'", $link) or die(mysql_error());
		if ($alta && $update) {
			$query2 = mysql_query("SELECT votos FROM Preguntas where id = '$id'", $link);
			$row = mysql_fetch_array($query2);			
			$enviar = array(
				'votos' => $row['votos'],
				'statuss' => 'up'
			);
			echo json_encode($enviar);
			exit();
		}else{
			echo json_encode("Error up");
			exit();
		}
	}else{
		if ($yaVoto == 0) {
			$update = mysql_query("UPDATE Preguntas SET votos = votos + 2 WHERE id = '$id'", $link);
			$updateup = mysql_query("UPDATE votoPregunta SET ha_votado = 1", $link);
			if ($update && $updateup) {
				$query2 = mysql_query("SELECT votos FROM Preguntas where id = '$id'", $link);
				$row = mysql_fetch_array($query2);
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'up'
				);
				echo json_encode($enviar);
				exit();
				
			}else{
				echo json_encode("Error down");
			}
		}else{
			$enviar = array(
				'statuss' => 'up',
				'msge' => 'Ya has votado positivamente esta pregunta'
			);
			echo json_encode($enviar);			
		}
	}
}elseif($accion == 'down') {
	if ($conteo == 0) {
		$alta = mysql_query("INSERT INTO votoPregunta (id_pregunta, votante, ha_votado) VALUES ('$id', '$votante', 0)", $link) or die(mysql_error());
		$update = mysql_query("UPDATE Preguntas SET votos = votos - 1 WHERE id = '$id'", $link) or die(mysql_error());
		if ($alta && $update) {
			$query2 = mysql_query("SELECT votos FROM Preguntas where id = '$id'", $link);
			$row = mysql_fetch_array($query2);
			$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'down'
				);
				echo json_encode($enviar);
			exit();
		}else{
			echo json_encode("Error");
			exit();
		}
	}else{
		if ($yaVoto == 1) {
			$update = mysql_query("UPDATE Preguntas SET votos = votos - 2 WHERE id = '$id'", $link);
			$updateup = mysql_query("UPDATE votoPregunta SET ha_votado = 0", $link);
			if ($update && $updateup) {
				$query2 = mysql_query("SELECT votos FROM Preguntas where id = '$id'", $link);
				$row = mysql_fetch_array($query2);
				$enviar = array(
					'votos' => $row['votos'],
					'statuss' => 'down'
				);
				echo json_encode($enviar);
				exit();
				
			}else{
				echo json_encode("Error");
			}
		}else{
			$enviar = array(
				'statuss' => 'down',
				'msge' => 'Ya has votado positivamente esta pregunta'
			);
			echo json_encode($enviar);
		}
	}
}
?>