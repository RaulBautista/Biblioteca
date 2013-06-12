<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Respuestas</title>
	<link rel="stylesheet" href="css/design.css">
	<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php");?>
		</header>
		<?php
		error_reporting(E_ALL & ~E_NOTICE);  
		session_start();
		if($_SESSION['logged'] == '1') { 
			include "includes/menualumno.php";
			require_once("includes/conexion.php");
			$id = $_GET['id'];
			$consulta = @mysql_query('SELECT * FROM Preguntas WHERE id = "'.mysql_real_escape_string($id).'"')
			or die (mysql_error()); 
			$row = mysql_fetch_array($consulta);
			$pregunta = $row['pregunta'];
			$mensaje = nl2br(htmlspecialchars($row['mensaje']));
			$autor = $row['autor'];

			printf("
			<article id='respuestas'>
				<h1>%s</h1>
				<p>Posteado por: %s || %s</p><br>
				<p id='problema'>%s</p><br>
			</article>						
				", 
		$row["pregunta"], $row["autor"],$row["fecha"], nl2br(htmlspecialchars($row["mensaje"])));
		

			$nombre = $_SESSION['user'];
			?>
			<?php
			?>
			<form method="POST" action="responder.php" id="FormRespuesta">
				<textarea name="respuesta" id="respuesta" rows="7" required></textarea>
				<input type="hidden" name="autor" value="<?php echo $nombre ?>"/>
				<input type="hidden" name="id" value="<?php echo $id ?>"/>
				<input type="submit" id="enviarRespuesta" value="Deja una respuesta" /><br>
			</form>
			<?php
			$consulta = @mysql_query('SELECT * FROM Respuestas WHERE id_pregunta = "'.mysql_real_escape_string($id).'" ORDER BY fecha DESC')
			or die (mysql_error()); 
			$num_respuestas = mysql_num_rows($consulta);

		while ($row = mysql_fetch_array($consulta)) {
		printf("<article id='mensaje2'>
				<div id='autor'>
					<p>%s || %s</p>
				</div>
				<div id='mensaje'>
					<p>%s</p>
				</div>
				</article><br>
				",   
				$row['autor'],$row["fecha"] , nl2br(htmlspecialchars($row["respuesta"])));
		}
		//nl2br($cadena_de_texto);
		mysql_free_result($consulta);
		mysql_close($link); ?>	
		<a href="foro.php" class="boton">Regresar</a>

		<?php } ?>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		</footer>
	</section>
</body>
</html>