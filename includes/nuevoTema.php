<?php
error_reporting(E_ALL & ~E_NOTICE);  
session_start();
if($_SESSION['logged'] == '1') { 
	include("conexion.php");
	$autor = $_SESSION['user'];
	$pregunta = $_POST['pregunta'];
	$mensaje = $_POST['msg'];
	$hoy = time();
	$fecha = date("y-m-d H:i:s", $hoy);

	$meter = @mysql_query('INSERT INTO Preguntas (
	autor, pregunta, mensaje, fecha)
	values
	("'.mysql_real_escape_string($autor).'", 
	"'.mysql_real_escape_string($pregunta).'",
	"'.mysql_real_escape_string($mensaje).'",
	"'.mysql_real_escape_string($fecha).'")');
	if($meter){
		echo "true";
	}else{
		echo "false";	
	}
}
?>