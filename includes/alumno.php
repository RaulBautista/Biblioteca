<?php 
session_start();
if ($_SESSION['logged'] == '1') {
	require_once 'conexion.php';

	$usuario = $_SESSION['user'];			
			$dato = mysql_query("SELECT numcontrol, imagen FROM Alumnos WHERE nombre ='$usuario'", $link);
			$datos = mysql_fetch_array($dato);
			$imagen = $datos['imagen'];
			if ($imagen == null) {
				$imagen = 'imagenesAlumnos/default.png';
			}
			echo "<div class='bienvenido blanco'>
			<div class='elegirImagen'><img src='".$imagen."' alt='Ops! sube una imagen para tu perfil' class='imagenAlumno'><a href='subirImagen.php' class='link'>Cambiar imagen</a></div><p>Bienvenido(a) <strong>$usuario</strong></p><hr>
			</div><br>";			
			//echo gettype($link);
			//echo is_resource($link);
			//echo get_resource_type($link);
			$numcontrol = $datos['numcontrol'];
			$hoy = date("Y-m-d H:i:s A");
			$consult = mysql_query("SELECT fecha_devolver FROM Prestamo WHERE numcontrol_alum = '$numcontrol' ORDER BY fecha_devolver ", $link);
			$num = mysql_num_rows($consult);
			if ($num > 0) {
			echo "<div class='frame'><h2>Tus prestamos</h2><br><hr size='4'><br> ";
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
				echo "<div class='frame'><h3>Te invitamos a visitar la Biblioteca del instituto.</h3></div>";
			}
		$consultap = mysql_query("SELECT id, pregunta, total FROM Preguntas where autor ='$usuario'", $link);
		$numero_preguntas = mysql_num_rows($consultap);
		if ($numero_preguntas > 0) { ?>
		<div class="frame">
			<ul class="lista_preguntas">
				<?php
				echo "<h1>Tienes $numero_preguntas preguntas realizadas en el foro</h1><br><hr size='4'><br>";
				while ($preguntas = mysql_fetch_array($consultap)) {
					$total = $preguntas['total'];
					if ($total == 0) {
						$total = 'sin respuestas aún';
					}elseif($total == 1){
						$total = $total.' respuesta';
					}else{
						$total = $total.' respuestas';
					}
				echo "				
					<li><a href='respuestas.php?id=$preguntas[id]'> $preguntas[pregunta] </a> <span>$total<span></li>
				";
				} ?>
			</ul>
		</div><br>
		<?php }else{
			echo "<br><div class='frame'><h3><a href='foro.php'>
			Visitia nuestro foro donde puedes realizar alguna pregunta o ayudar a tus compañeros.
			</a></h3></div><br>";
		}
	}else{
		header("location: index.php");
	}
?>