<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Respuestas</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/prettify.css">
	<style>#checkbox{display: inline; margin-left: 10px;}</style>
	<script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
	<script src="js/prettify/prettify.js"></script>
	<script>
		$(document).on('ready', function(){
			prettyPrint();
		});
	</script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">			
		<?php include("includes/menu.php");?>
	</header>
	<section class="contenedor">
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
			<br>
			<article id='pregunta'>
				<h1>%s</h1>
				<p>Posteado por: %s || %s</p><br>
				<p id='problema'>%s</p><br>				
			</article>						
				", 
			$row["pregunta"], $row["autor"],date("j M Y - g:i A ", strtotime($row["fecha"])), nl2br(htmlspecialchars($row["mensaje"])));
			$nombre = $_SESSION['user'];
			?>
			<?php
			?>
			<form method="POST" action="responder.php" id="FormRespuesta">
				<textarea name="respuesta" id="respuesta" rows="5" required></textarea>
				<input type="hidden" name="autor" value="<?php echo $nombre ?>"/>
				<input type="hidden" name="id" value="<?php echo $id ?>"/>
				<div id="contador"></div>
				<div align="center" style="color: darkred;">¿Incluiste código de algún lenguaje como Java o PHP?<input type="checkbox" id="checkbox" name="control" value="1"></div>
				<input type="submit" id="boton" value="Publica tu respuesta" class="boton2"/><br>
			</form>
			<hr size='4'/ class="division">
			<script>
			$('#respuesta').keydown(function(e){
			var maxChars = 499;
			if($(this).val().length <= maxChars)
			{
				var charsLeft = ( maxChars - $(this).val().length );
				$('#contador').text( charsLeft + ' caracteres restantes.' ).css('color', (charsLeft<10)?'#F00':'#000' );
			}else{
				return ($.inArray(e.keyCode,[8,35,36,37,38,39,40]) !== -1);
			}
			})
			</script>
			<?php
			$consulta = @mysql_query('SELECT * FROM Respuestas WHERE id_pregunta = "'.mysql_real_escape_string($id).'" ORDER BY fecha DESC')
			or die (mysql_error()); 
			//$num_respuestas = mysql_num_rows($consulta);
			while ($row = mysql_fetch_array($consulta)) {
			if ($row['control'] == "1") {
				$res = htmlspecialchars($row["respuesta"]);
				printf("<article class='respuetas_alumnos'>
					<div class='autor'>
						<p>%s || %s</p>
					</div>
					<hr size='3'><br>
					<div class='msg_respuesta'>						
						<pre class='prettyprint'>
							<p>%s</p>
						</pre>			
					</div>
				</article><br>
				",   
				$row['autor'],date("j M Y - g:i:s A ", strtotime($row["fecha"])) , nl2br($res));
			}
			else{
				$res = strip_tags($row["respuesta"],'<iframe><img>'); //segundo parametro etiquetas que permite							
				printf("<article class='respuetas_alumnos'>
					<div class='autor'>
						<p>%s || %s</p>
					</div>
					<hr size='3'><br>
					<div class='msg_respuesta'>						
						<p>%s</p>			
					</div>
				</article><br>
				",   
				$row['autor'],date("j M Y - g:i:s A ", strtotime($row["fecha"])) , nl2br($res));
			}			
				// nl2br(htmlspecialchars($row["respuesta"]))); .... nl2br(strip_tags($row["respuesta"], '<iframe><img>')));
			}																		
		//nl2br($cadena_de_texto);
		mysql_free_result($consulta);
		mysql_close($link); ?>	

		<a href="foro.php" class="boton">Regresar al foro</a>

		<?php }else{
			header("Location: index.php");
		} ?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>