<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
	<link rel="stylesheet" href="css/design2.css">
    <link rel="stylesheet" href="css/demo_table_jui.css">
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
    <style>
    	@media screen and (min-width : 320px) and (max-width: 480px) {input{max-width: 130px;}}
    </style>
    <script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
    <script src="js/new/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#datatables').dataTable({
            "sPaginationType":"full_numbers",
            "aaSorting":[[0, "asc"]],
            "bJQueryUI":true
        });
    })        
    </script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php include "includes/menu.php"; ?>	
	</header>
	<section class="contenedor">
		<?php
		session_start();
		if($_SESSION['logged'] == '1') { 
			$usuario = $_SESSION['user'];
			include "includes/menualumno.php";
			require_once "includes/conexion.php";
			echo "<div class='bienvenido'><img src='img/avatar.png' alt='avatar' class='avatar'><p>Bienvenido(a) <strong>$usuario</strong></p><hr></div><br>";
			//echo gettype($link);
			//echo is_resource($link);
			//echo get_resource_type($link);
			$dato = mysql_query("SELECT numcontrol FROM Alumnos WHERE nombre ='$usuario'", $link);
			$datos = mysql_fetch_array($dato);
			$numcontrol = $datos['numcontrol'];
			$hoy = date("Y-m-d H:i:s A");
			$consult = mysql_query("SELECT fecha_devolver FROM Prestamo WHERE numcontrol_alum = '$numcontrol' ORDER BY fecha_devolver ", $link);
			$num = mysql_num_rows($consult);
			if ($num > 0) {
			echo "<div class='frame'><h2>Tus prestamos</h2><br><hr><br> ";
				while ($devolver = mysql_fetch_array($consult)) {
					$fecha = date("j M Y - g:i A", strtotime($devolver['fecha_devolver']));
					$fecha_comparar = date("Y-m-d H:i:s A", strtotime($devolver['fecha_devolver']));
					if ($fecha_comparar < $hoy) {	
						echo "
						<div class='mensaje_error'>
						<p>Debiste devolver a la Biblioteca un libro antes del $fecha.</p>
						</div>
						";		
					}else{
						echo "						
						<div class='mensaje_warning'>
						<p>Debes devolver a la Biblioteca un libro antes del $fecha.</p>
						</div>
						";				
					}
				}
			echo "</div>";
			}else{
				echo "<h3>Te invitamos a visitar la Biblioteca del instituto.</h3>";
			}
		$consultap = mysql_query("SELECT id, pregunta, total FROM Preguntas where autor ='$usuario'", $link);
		$numero_preguntas = mysql_num_rows($consultap);
		if ($numero_preguntas > 0) { ?>
		<div class="frame">
			<ul>
				<?php
				echo "<h1>Tienes $numero_preguntas preguntas realizadas en el foro</h1><br><hr><br>";
				while ($preguntas = mysql_fetch_array($consultap)) {
					$total = $preguntas['total'];
					if ($total == 0) {
						$total = 'Parece que nadie a visto tu pregunta aún';
					}
				echo "<li><a href='respuestas.php?id=$preguntas[id]'><b>$preguntas[pregunta]<br> </b>respuestas: <b>$total</b></a></li><br>";
				} ?>
			</ul>
		</div>
		<?php }
	}else{
		header("location: index.php");
	} ?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>