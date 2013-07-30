<?php
	//error_reporting(E_ALL & ~E_NOTICE); 
	session_start();
	$tipo = strip_tags($_POST['tipo']);
	$numcontrol = strip_tags($_POST['numcontrol']);
	$password = sha1($_POST['pass']);	

	if($tipo == '1') {
	require_once('conexion.php');
		$query = @mysql_query('SELECT numcontrol FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"', $link);
		if (!$existe = @mysql_fetch_object($query)) {
			echo "error";
			exit();
		}else{
			$sql = mysql_query('SELECT nombre FROM Alumnos WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'"', $link);
			$row = mysql_fetch_array($sql);
			$nombre = $row['nombre'];
			$_SESSION['logged'] = '1';
			$_SESSION['user'] = $nombre;
			//echo '<script> window.location="../alumno.php"</script>';
			echo "exito";
			header ("Location: ../alumno.php");
			exit();
		}
	}
	elseif($tipo == '2') {
		require_once('conexion.php');
		$query2 = mysql_query('SELECT numcontrol FROM Administradores WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'" AND password="'.mysql_real_escape_string($password).'"', $link);
		if(!$encontrado = @mysql_fetch_object($query2)) {
			echo "error";
			exit();
		}else{
			$sql2 = mysql_query('SELECT nombre FROM Administradores WHERE numcontrol="'.mysql_real_escape_string($numcontrol).'"', $link);
			$row2 = mysql_fetch_array($sql2);
			$_SESSION['logged'] = '2';
			$_SESSION['user'] = $row2['nombre'];
			echo "exito";
			//echo '<script> window.location="../administrador.php"</script>';
			header ("Location: ../administrador.php"); 
		}
	}	
?>